<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Process extends IO_Controller {

	private $allowed_download, $allowed_images;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');
		$this->load->library('image_lib');

		$this->load->model('pages/pages_model');
		$this->load->model('user/user_model');
		$this->load->model('inquiry/inquiry_model');

		$this->allowed_download = 'png|jpg|gif|jpeg|pjpeg|bmp|csv|pdf|xls|xlsx|doc|docx|ppt|zip|rar';
		$this->allowed_images = 'png|jpg|gif|jpeg|pjpeg|bmp';
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			// PAGE
			$type = $this->input->post('type');
			$is_menu = $this->input->post('is_menu') ? TRUE : FALSE;
			$page_maps = $this->input->post('page_maps');
			$publish = $this->input->post('publish') ? TRUE : FALSE;

			$data_page = array(
							'user_id'			=> $this->user_id,
							'type'				=> $type,
							'is_menu'			=> $is_menu,
							'page_maps'			=> $page_maps,
							'publish'			=> $publish
						);

			$result = $this->pages_model->setPage($data_page);
			
			if ( ! $result['success'] ) {
				$success = FALSE;
				$message['notify'][] = $result['message'];
			} else {
				$id = $result['insert_id'];

				// PAGE MENU
				$page_name = $this->input->post('page_name') ? $this->input->post('page_name') : NULL;
				$page_guid = $this->input->post('page_guid') ? $this->input->post('page_guid') : NULL;
				$page_order = $this->input->post('page_order');
				$parent_menu = $this->input->post('parent_menu');

				if ($is_menu && in_array($type, array('static'))) {
					$show_home = $this->input->post('show_home') ? TRUE : FALSE;
					$get['show_home'] = $this->pages_model->getPageSettings('show_home', $page_guid);

					if ($get['show_home']) {
						if ( ! $show_home) {
							$this->pages_model->deletePageSettings('show_home', $page_guid);
						}
					} else {
						if ($show_home) {
							$this->pages_model->setPageSettings(array('type' => 'show_home', 'guid' => $page_guid));
						}
					}
				}

				if ($is_menu && in_array($type, array('static', 'article', 'gallery'))) {
					$home_center = $this->input->post('home_center') ? TRUE : FALSE;
					$get['home_center'] = $this->pages_model->getPageSettings('home_center');

					if ($get['home_center']) {
						if ($home_center) {
							$this->pages_model->updatePageSettings('home_center', array('guid' => $page_guid));
						} else if ($get['home_center']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_center');
						}
					} else {
						if ($home_center) {
							$this->pages_model->setPageSettings(array('type' => 'home_center', 'guid' => $page_guid));
						}
					}

					$home_left = $this->input->post('home_left') ? TRUE : FALSE;
					$get['home_left'] = $this->pages_model->getPageSettings('home_left');

					if ($get['home_left']) {
						if ($home_left) {
							$this->pages_model->updatePageSettings('home_left', array('guid' => $page_guid));
						} else if ($get['home_left']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_left');
						}
					} else {
						if ($home_left) {
							$this->pages_model->setPageSettings(array('type' => 'home_left', 'guid' => $page_guid));
						}
					}

					$home_right = $this->input->post('home_right') ? TRUE : FALSE;
					$get['home_right'] = $this->pages_model->getPageSettings('home_right');

					if ($get['home_right']) {
						if ($home_right) {
							$this->pages_model->updatePageSettings('home_right', array('guid' => $page_guid));
						} else if ($get['home_right']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_right');
						}
					} else {
						if ($home_right) {
							$this->pages_model->setPageSettings(array('type' => 'home_right', 'guid' => $page_guid));
						}
					}
				}

				if ($type !== 'gallery' || $is_menu) {

					if ( ! $page_name ) {
						$success = FALSE;
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page Name Required'
											);
					}

					if ( ! $page_guid ) {
						$success = FALSE;
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page URL Required'
											);
					}
				}

				if ( ! $page_order ) {
					$success = FALSE;
					$message['item'][] = array(
											'id'		=> 'page-order',
											'message'	=> 'Page Order Required'
										);
				} else if ( ! is_int(intval($page_order)) ) {
					$success = FALSE;
					$message['item'][] = array(
											'id'		=> 'page-order',
											'message'	=> 'Please enter a valid number'
										);
				}

				if ($success) {

					$data_menu = array(
								'`page_id`'			=> $id,
								'`menu`'			=> $page_name,
								'`guid`'			=> $page_guid,
								'`parent_menu_id`'	=> $parent_menu ? $parent_menu : NULL,
								'`order`'			=> $page_order
							);

					$result = $this->pages_model->setPageMenu($data_menu);

					if ( ! $result['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Error : Main Form';
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page Name Already Exists.'
											);
					}

				} else {
					$message['notify'][] = 'Error : Main Form';
				}

				// PAGE PRODUCT
				$arr_product = array('product', 'product-item');
				if ($success && in_array($type, $arr_product)) {
					$product_type = $this->input->post('product_type') ? $this->input->post('product_type') : NULL;
					$product_available = $this->input->post('product_available') ? $this->input->post('product_available') : NULL;
					$product_area = $this->input->post('product_area') ? $this->input->post('product_area') : NULL;
					$product_beds = $this->input->post('product_beds') ? $this->input->post('product_beds') : NULL;
					$product_baths = $this->input->post('product_baths') ? $this->input->post('product_baths') : NULL;
					$product_living_room = $this->input->post('product_living_room') ? $this->input->post('product_living_room') : NULL;

					$data_product = array(
								'`page_id`'			=> $id,
								'`type`'			=> $product_type,
								'`available`'		=> $product_available,
								'`area`'			=> $product_area,
								'`beds`'			=> $product_beds,
								'`baths`'			=> $product_baths,
								'`living_room`'		=> $product_living_room,
							);

					$result = $this->pages_model->setPageProduct($data_product);

					if ( ! $result['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Error : Product Detail';
					}
				}

				// PAGE CATEGORY
				$arr_category = array('article', 'gallery', 'division');
				if ($success && $parent_menu && in_array($type, $arr_category)) {
					$category = $this->input->post('category');
					$category_new = $this->input->post('category_new');
					$category_name = $this->input->post('category_name');

					$category_join = array();

					if ($success) {
						$category_old = $this->pages_model->getPageCategory($parent_menu,$type);
						if (is_array($category) && ! empty($category) && is_array($category_old) && ! empty($category_old)) {
							foreach ($category_old as $key => $value) {
								if ($value->category_join === NULL && in_array($value->page_category_id, $category)) {
									$item = array(
												'page_id'			=> $id,
												'page_category_id'	=> $value->page_category_id
											);
									array_push($category_join, $item);
								}
							}
						}

						if ($category_name) {
							foreach ($category_name as $key => $value) {
								if ($value) {
									$item = array(
												'page_menu_id'	=> $parent_menu,
												'group'			=> $type,
												'category'		=> $value,
												'guid'			=> str_replace(' ','-',strtolower($value))
											);
									$result = $this->pages_model->setPageCategory($item);
									if ($result['success']) {
										$category_id = $result['insert_id'];
										if (isset($category_new[$key])) {
											$item = array(
														'page_id'			=> $id,
														'page_category_id'	=> $category_id
													);
											array_push($category_join, $item);
										}
									} else {
										$success = FALSE;
										$message['notify'][] = 'Category failed to be added';
									}
								}
							}
						}
					}

					/*
					if (empty($category_join) && empty($category)) {
						$success = FALSE;
						$message['notify'][] = 'Category Required';
					}
					*/

					if ($success && ! empty($category_join) ) {
						$result = $this->pages_model->setPageCategoryJoin($category_join);
						if ( ! $result['success'] ) {
							$success = FALSE;
							$message['notify'][] = 'Category failed to be added';
						}
					}
				}

				// PAGE CONTENT
				$page_content = $this->input->post('page_content');

				if ($success && is_array($page_content)) {

					$data_content = array(
										'menu'				=> '',
										'header'			=> '',
										'title'				=> '',
										'body'				=> ''
									);

					foreach ($page_content as $key => $value) {

						if ($type !== 'gallery' || $is_menu) {
							$data_content['menu']	= isset($value['menu']) && $value['menu'] ? $value['menu'] : $data_content['menu'];
							if ( ! $data_content['menu']) {
								$success = FALSE;
								$message['item'][] = array(
														'id'		=> 'page-content-menu-' . $key,
														'message'	=> 'Page Menu Required'
													);
							}
						}

						$data_content['title']	= isset($value['title']) && $value['title'] ? $value['title'] : $data_content['title'];
						if ( ! $data_content['title']) {
							$success = FALSE;
							$message['item'][] = array(
													'id'		=> 'page-content-title-' . $key,
													'message'	=> 'Page Title Required'
												);
						}

						$data_content['body']	= isset($value['body']) && $value['body'] ? $value['body'] : $data_content['body'];

						if ($success) {

							$data_content['page_id'] = $id;
							$data_content['page_language_id'] = $key;

							$result = $this->pages_model->setPageContent($data_content);

							if ( ! $result['success'] ) {
								$success = FALSE;
								break;
							}
							else {
								// PAGE RELATED
								
								$page_related = $this->input->post('page_related');
								
								if ($success && is_array($page_related)) {
								
									$data_related = array();
									foreach ($page_related as $key => $value) {
										if ($success) {
											$ixx = 0;
											foreach ($value as $values) {
												$data_related['page_related'] = $value[$ixx];
												$data_related['page_content_id'] = $result['insert_id'];
													
												$rel_result = $this->pages_model->setPageRelated($data_related);
													
												if ( ! $rel_result['success'] ) {
													$success = FALSE;
													break;
												}
												$ixx++;
											}
										}
									}
								
									if (! $success) {
										$message['notify'][] = 'Error : Page Related';
									}
								
								}
							}

						}
					}

					if (! $success) {
						$message['notify'][] = 'Error : Page Content';
					}

				}

				// PAGE FORM
				if ($type === 'form') {
					$mail_to = $this->input->post('mail_to');
					$form_description = $this->input->post('form_description');
					$form_table = 'p_' . $id;
					$form_field = json_decode($this->input->post('form_builder'));
					$authenticated = $this->input->post('authenticated') ? TRUE : FALSE;
					$signed_up = $this->input->post('signed_up') ? TRUE : FALSE;

					if ( ! empty($form_field)) {
						foreach ($form_field as $key => $value) {
							$form_field[$key] = get_object_vars($value);
						}
					}

					if ($success && $form_table && is_array($form_field)) {
						$data_form = array(
										'page_id'			=> $id,
										'form_name'			=> $page_name,
										'form_description'	=> $form_description,
										'table_name'		=> $form_table,
										'mail_to'			=> $mail_to,
										'data'				=> json_encode($form_field),
										'authenticated'		=> $authenticated,
										'signed_up'			=> $signed_up
									);

						$result = $this->pages_model->setPageForm($data_form);

						if ( ! $result['success'] ) {
							$success = FALSE;
							$message['notify'][] = 'Error : Page Form';
						}
					}

					if ($success && $form_table) {
						if ( ! is_array($form_field)) {
							$form_field = NULL;
						}

						$result = $this->pages_model->getTable($form_table,'form',$form_field);
						if ($result) {
							$this->pages_model->alterTable($form_table,'form',$result);
						} else {
							$this->pages_model->createTable($form_table,'form',$form_field);
						}

						$user_field = array(
											array(
												'name'	=> 'form_id',
												'type'	=> 'INT',
												'size' 	=> 11
											),
											array(
												'name'	=> 'email',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'username',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'password',
												'type'	=> 'VARCHAR',
												'size' 	=> 100
											),
											array(
												'name'	=> 'activation_code',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'activated',
												'type'	=> 'TINYINT',
												'size' 	=> 1
											)
										);
						$result = $this->pages_model->getTable($form_table,'user',$user_field);						
						if ($result) {
							$this->pages_model->alterTable($form_table,'user',$result);
						} else {
							$this->pages_model->createTable($form_table,'user',$user_field);
						}
					}
				}

				// IMAGES UPLOAD
				$is_upload = FALSE;
				$image_name = $this->input->post('image_name');
				$image_description = $this->input->post('image_description');

				if ( isset($_FILES['image_upload']) && is_array($_FILES['image_upload']) ) {
					foreach ($_FILES['image_upload']['name'] as $key => $value) {
						$name = str_replace(';', '-', $image_name[$key]);
						$description = str_replace(';', '-', $image_description[$key]);

						$_FILES['image_upload']['upload_name'][$key] = $name . ';' . $description;
						$_FILES['image_upload']['skip'][$key] = TRUE;

						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/images/')) {
						mkdir($this->path . 'uploads/images/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/full/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/full/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/thumb/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/thumb/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/images/' . $type . '/full/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '10000';
					$config['upload']['max_width'] = '1920';
					$config['upload']['max_height'] = '1080';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('image_upload') ) {
						$success = FALSE;
						$image_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();

						$this->load->library('image_lib'); 

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$data_image = array();
						foreach ($upload_data as $key => $value) {
							$width = 300;
							$height = 200;

							$source_image = $this->path . 'uploads/images/' . $type . '/full/' . $value['file_name'];
							$new_image = $this->path . 'uploads/images/' . $type . '/thumb/' . $value['file_name'];

							$master_dim = 'auto';
							$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
							if ($original) {
								$original_aspect = $original['width'] / $original['height'];
								$thumb_aspect = $width / $height;
								$master_dim = $original_aspect >= $thumb_aspect ? 'height' : 'width';
							}

							$config['resize']['source_image'] = $source_image;
							$config['resize']['new_image'] = $new_image;
							$config['resize']['master_dim'] = $master_dim;
							$config['resize']['width'] = $width;
							$config['resize']['height'] = $height;

							$this->image_lib->initialize($config['resize']);
							$this->image_lib->resize();

							$this->image_lib->clear();

							if ($type !== 'gallery' || $is_menu) {
								$resize = $this->_get_size($new_image);

								$y_axis = floor(($resize['height'] - $height) / 2);
								$x_axis = floor(($resize['width'] - $width) / 2);

								$config['crop']['image_library'] = 'gd2';
								$config['crop']['source_image'] = $new_image;
								$config['crop']['new_image'] = $new_image;
								$config['crop']['maintain_ratio'] = FALSE;
								$config['crop']['width'] = $width;
								$config['crop']['height'] = $height;
								$config['crop']['y_axis'] = $y_axis;
								$config['crop']['x_axis'] = $x_axis;

								$this->image_lib->initialize($config['crop']);
								$this->image_lib->crop();

								$this->image_lib->clear();
							}

							$upload_name = explode(';', $value['upload_name']);

							$item = array(
										'page_id'		=> $id,
										'name'			=> $upload_name[0],
										'description'	=> $upload_name[1],
										'file_name'		=> $value['file_name'],
										'file_type'		=> $value['file_type'],
										'file_size'		=> $value['file_size']
									);
							array_push($data_image, $item);

						}

						$result = $this->pages_model->setPageImage($data_image);

					}

					if (! $success) {
						$message['notify'][] = 'Page Images Error : ' . (isset($image_error) ? $image_error : '-');
					}

				}

				// IMAGES PRODUCT UPLOAD
				$is_upload = FALSE;
				if ( isset($_FILES['image_product']) && is_array($_FILES['image_product']) ) {
					foreach ($_FILES['image_product']['name'] as $key => $value) {
						$name = '';
						$description = '';

						$_FILES['image_product']['upload_name'][$key] = $name . ';' . $description;
						$_FILES['image_product']['skip'][$key] = TRUE;

						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/images/')) {
						mkdir($this->path . 'uploads/images/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/full/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/full/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/thumb/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/thumb/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/images/' . $type . '/full/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '10000';
					$config['upload']['max_width'] = '1920';
					$config['upload']['max_height'] = '1080';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('image_product') ) {
						$success = FALSE;
						$image_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();

						$this->load->library('image_lib'); 

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$data_image_product = array();
						foreach ($upload_data as $key => $value) {
							$width = 300;
							$height = 200;

							$source_image = $this->path . 'uploads/images/' . $type . '/full/' . $value['file_name'];
							$new_image = $this->path . 'uploads/images/' . $type . '/thumb/' . $value['file_name'];

							$master_dim = 'auto';
							$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
							if ($original) {
								$original_aspect = $original['width'] / $original['height'];
								$thumb_aspect = $width / $height;
								$master_dim = $original_aspect >= $thumb_aspect ? 'height' : 'width';
							}

							$config['resize']['source_image'] = $source_image;
							$config['resize']['new_image'] = $new_image;
							$config['resize']['master_dim'] = $master_dim;
							$config['resize']['width'] = $width;
							$config['resize']['height'] = $height;

							$this->image_lib->initialize($config['resize']);
							$this->image_lib->resize();

							$this->image_lib->clear();

							if ($type !== 'gallery' || $is_menu) {
								$resize = $this->_get_size($new_image);

								$y_axis = floor(($resize['height'] - $height) / 2);
								$x_axis = floor(($resize['width'] - $width) / 2);

								$config['crop']['image_library'] = 'gd2';
								$config['crop']['source_image'] = $new_image;
								$config['crop']['new_image'] = $new_image;
								$config['crop']['maintain_ratio'] = FALSE;
								$config['crop']['width'] = $width;
								$config['crop']['height'] = $height;
								$config['crop']['y_axis'] = $y_axis;
								$config['crop']['x_axis'] = $x_axis;

								$this->image_lib->initialize($config['crop']);
								$this->image_lib->crop();

								$this->image_lib->clear();
							}

							$item = array(
										'page_id'		=> $id,
										'file_name'		=> $value['file_name'],
										'file_type'		=> $value['file_type'],
										'file_size'		=> $value['file_size']
									);
							array_push($data_image_product, $item);

						}

						$result = $this->pages_model->setImageProduct($data_image_product);

					}

					if (! $success) {
						$message['notify'][] = 'Product Images Error : ' . (isset($image_error) ? $image_error : '-');
					}

				}

				// ATTACHMENT UPLOAD
				$is_upload = FALSE;
				$file_name = $this->input->post('file_name');

				if ( isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) ) {
					foreach ($_FILES['file_upload']['name'] as $key => $value) {
						$_FILES['file_upload']['upload_name'][$key] = isset($file_name[$key]) && $file_name[$key] ? $file_name[$key] : $value;
						$_FILES['file_upload']['skip'][$key] = TRUE;
						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/attachment/')) {
						mkdir($this->path . 'uploads/attachment/');
					}
					if ( ! is_dir($this->path . 'uploads/attachment/' . $type . '/')) {
						mkdir($this->path . 'uploads/attachment/' . $type . '/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/attachment/' . $type . '/';
					$config['upload']['allowed_types'] = $this->allowed_download;
					$config['upload']['max_size'] = '20000';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('file_upload') ) {
						$success = FALSE;
						$attachment_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();
						$data_download = array();
						foreach ($upload_data as $key => $value) {
							$item = array(
										'page_id'	=> $id,
										'name'		=> $value['upload_name'],
										'file_name'	=> $value['file_name'],
										'file_type'	=> $value['file_type'],
										'file_size'	=> $value['file_size']
									);
							array_push($data_download, $item);
						}
						$result = $this->pages_model->setPageDownload($data_download);
					}

					if (! $success) {
						$message['notify'][] = 'Page Attachment Error : ' . (isset($attachment_error) ? $attachment_error : '-');
					}

				}
			}

			if ($success) {
				$message['success'][] = (ucwords($type)) . ' Page has been added';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = (ucwords($type)) . ' Page failed to be added';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			$type = '';
			$page_id = $this->input->post('id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if ($id === $page_id) {
				// PAGE
				$type = $this->input->post('type');
				$is_menu = $this->input->post('is_menu') ? TRUE : FALSE;
				$page_maps = $this->input->post('page_maps');
				$publish = $this->input->post('publish') ? TRUE : FALSE;

				$data_page = array(
								'page_maps'			=> $page_maps,
								'publish'			=> $publish
							);

				$date = explode('/', $this->input->post('date_created'));
				if (count($date) === 3) {
					$date_created = $date[2] . '-' . $date[1] . '-' . $date[0];
					$data_page['date_created'] = $date_created;
				}

				$result = $this->pages_model->updatePage($id,$data_page);
				
				// PAGE MENU
				$page_name = $this->input->post('page_name') ? $this->input->post('page_name') : NULL;
				$page_guid = $this->input->post('page_guid') ? $this->input->post('page_guid') : NULL;
				$page_order = $this->input->post('page_order');
				$parent_menu = $this->input->post('parent_menu');

				if ($is_menu && in_array($type, array('static'))) {
					$show_home = $this->input->post('show_home') ? TRUE : FALSE;
					$get['show_home'] = $this->pages_model->getPageSettings('show_home', $page_guid);

					if ($get['show_home']) {
						if ( ! $show_home) {
							$this->pages_model->deletePageSettings('show_home', $page_guid);
						}
					} else {
						if ($show_home) {
							$this->pages_model->setPageSettings(array('type' => 'show_home', 'guid' => $page_guid));
						}
					}
				}

				if ($is_menu && in_array($type, array('static', 'article', 'gallery'))) {
					$home_center = $this->input->post('home_center') ? TRUE : FALSE;
					$get['home_center'] = $this->pages_model->getPageSettings('home_center');

					if ($get['home_center']) {
						if ($home_center) {
							$this->pages_model->updatePageSettings('home_center', array('guid' => $page_guid));
						} else if ($get['home_center']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_center');
						}
					} else {
						if ($home_center) {
							$this->pages_model->setPageSettings(array('type' => 'home_center', 'guid' => $page_guid));
						}
					}

					$home_left = $this->input->post('home_left') ? TRUE : FALSE;
					$get['home_left'] = $this->pages_model->getPageSettings('home_left');

					if ($get['home_left']) {
						if ($home_left) {
							$this->pages_model->updatePageSettings('home_left', array('guid' => $page_guid));
						} else if ($get['home_left']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_left');
						}
					} else {
						if ($home_left) {
							$this->pages_model->setPageSettings(array('type' => 'home_left', 'guid' => $page_guid));
						}
					}

					$home_right = $this->input->post('home_right') ? TRUE : FALSE;
					$get['home_right'] = $this->pages_model->getPageSettings('home_right');

					if ($get['home_right']) {
						if ($home_right) {
							$this->pages_model->updatePageSettings('home_right', array('guid' => $page_guid));
						} else if ($get['home_right']->guid == $page_guid) {
							$this->pages_model->deletePageSettings('home_right');
						}
					} else {
						if ($home_right) {
							$this->pages_model->setPageSettings(array('type' => 'home_right', 'guid' => $page_guid));
						}
					}
				}


				if ($type !== 'gallery' || $is_menu) {

					if ( ! $page_name ) {
						$success = FALSE;
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page Name Required'
											);
					}

					if ( ! $page_guid ) {
						$success = FALSE;
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page URL Required'
											);
					}
				}

				if ( ! $page_order ) {
					$success = FALSE;
					$message['item'][] = array(
											'id'		=> 'page-order',
											'message'	=> 'Page Order Required'
										);
				} else if ( ! is_int(intval($page_order)) ) {
					$success = FALSE;
					$message['item'][] = array(
											'id'		=> 'page-order',
											'message'	=> 'Please enter a valid number'
										);
				}

				if ($success) {

					$data_menu = array(
								'`menu`'			=> $page_name,
								'`guid`'			=> $page_guid,
								'`parent_menu_id`'	=> $parent_menu ? $parent_menu : NULL,
								'`order`'			=> $page_order
							);

					$result = $this->pages_model->updatePageMenu($id,$data_menu);

					if ( ! $result['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Error : Main Form';
						$message['item'][] = array(
												'id'		=> 'page-name',
												'message'	=> 'Page Name Already Exists.'
											);
					}

				} else {
					$message['notify'][] = 'Error : Main Form';
				}

				// PAGE PRODUCT
				$arr_product = array('product', 'product-item');
				if ($success && in_array($type, $arr_product)) {
					$product_type = $this->input->post('product_type') ? $this->input->post('product_type') : '';
					$product_available = $this->input->post('product_available') ? $this->input->post('product_available') : '';
					$product_area = $this->input->post('product_area') ? $this->input->post('product_area') : '';
					$product_beds = $this->input->post('product_beds') ? $this->input->post('product_beds') : '';
					$product_baths = $this->input->post('product_baths') ? $this->input->post('product_baths') : '';
					$product_living_room = $this->input->post('product_living_room') ? $this->input->post('product_living_room') : '';

					$data_product = array(
								'`type`'			=> $product_type,
								'`available`'		=> $product_available,
								'`area`'			=> $product_area,
								'`beds`'			=> $product_beds,
								'`baths`'			=> $product_baths,
								'`living_room`'		=> $product_living_room,
							);

					$get_product = $this->pages_model->getPageProduct($id);
					if ($get_product) {
						$result = $this->pages_model->updatePageProduct($id, $data_product);
					} else {
						$data_product['page_id'] = $id;
						$result = $this->pages_model->setPageProduct($data_product);
					}

					if ( ! $result['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Error : Product Detail' . $result['error'];
					}
				}

				// PAGE CATEGORY
				$arr_category = array('article', 'gallery', 'division');
				if ($success && $parent_menu && in_array($type, $arr_category)) {
					$category = $this->input->post('category');
					$category_new = $this->input->post('category_new');
					$category_name = $this->input->post('category_name');

					$category_join = array();

					$result = $this->pages_model->clearPageCategoryJoin($id,$category);
					if ( ! $result['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Category failed to be updated';
					}

					if ($success) {
						$category_old = $this->pages_model->getPageCategory($parent_menu,$type, $id);
						if (is_array($category) && ! empty($category) && is_array($category_old) && ! empty($category_old)) {
							foreach ($category_old as $key => $value) {
								if ($value->category_join === NULL && in_array($value->page_category_id, $category)) {
									$item = array(
												'page_id'			=> $id,
												'page_category_id'	=> $value->page_category_id
											);
									array_push($category_join, $item);
								}
							}
						}

						if ($category_name) {
							foreach ($category_name as $key => $value) {
								if ($value) {
									$item = array(
												'page_menu_id'	=> $parent_menu,
												'group'			=> $type,
												'category'		=> $value,
												'guid'			=> str_replace(' ','-',strtolower($value))
											);
									$result = $this->pages_model->setPageCategory($item);
									if ($result['success']) {
										$category_id = $result['insert_id'];
										if (isset($category_new[$key])) {
											$item = array(
														'page_id'			=> $id,
														'page_category_id'	=> $category_id
													);
											array_push($category_join, $item);
										}
									} else {
										$success = FALSE;
										$message['notify'][] = 'Category failed to be added';
									}
								}
							}
						}
					}

					/*
					if (empty($category_join) && empty($category)) {
						$success = FALSE;
						$message['notify'][] = 'Category Required';
					}
					*/

					if ($success && ! empty($category_join) ) {
						$result = $this->pages_model->setPageCategoryJoin($category_join);
						if ( ! $result['success'] ) {
							$success = FALSE;
							$message['notify'][] = 'Category failed to be added';
						}
					}
				}

				// PAGE CONTENT
				$page_content = $this->input->post('page_content');

				if ($success && is_array($page_content)) {

					$data_content = array(
										'menu'				=> '',
										'header'			=> '',
										'title'				=> '',
										'body'				=> ''
									);

					foreach ($page_content as $key => $value) {

						if ($type !== 'gallery' || $is_menu) {
							$data_content['menu']	= isset($value['menu']) && $value['menu'] ? $value['menu'] : $data_content['menu'];
							if ( ! $data_content['menu']) {
								$success = FALSE;
								$message['item'][] = array(
														'id'		=> 'page-content-menu-' . $key,
														'message'	=> 'Page Menu Required'
													);
							}
						}

						$data_content['title']	= isset($value['title']) && $value['title'] ? $value['title'] : $data_content['title'];
						if ( ! $data_content['title']) {
							$success = FALSE;
							$message['item'][] = array(
													'id'		=> 'page-content-title-' . $key,
													'message'	=> 'Page Title Required'
												);
						}

						$data_content['body']	= isset($value['body']) && $value['body'] ? $value['body'] : $data_content['body'];

						if ($success) {

							$check_page = $this->pages_model->getPageContent($id,$key);

							if ($check_page) {
								$result = $this->pages_model->updatePageContent($id,$key,$data_content);
							} else {
								$data_content['page_id'] = $id;
								$data_content['page_language_id'] = $key;
								$result = $this->pages_model->setPageContent($data_content);
							}

							if ( ! $result['success'] ) {
								$success = FALSE;
								break;
							}

						}
					}

					if (! $success) {
						$message['notify'][] = 'Error : Page Content';
					}

				}

				// PAGE FORM
				if ($type === 'form') {
					$mail_to = $this->input->post('mail_to');
					$form_description = $this->input->post('form_description');
					$form_table = 'p_' . $id;
					$form_field = json_decode($this->input->post('form_builder'));
					$authenticated = $this->input->post('authenticated') ? TRUE : FALSE;
					$signed_up = $this->input->post('signed_up') ? TRUE : FALSE;

					if ( ! empty($form_field)) {
						foreach ($form_field as $key => $value) {
							$form_field[$key] = get_object_vars($value);
						}
					}

					if ($success && $form_table) {
						$data_form = array(
										'form_name'			=> $page_name,
										'form_description'	=> $form_description,
										'table_name'		=> $form_table,
										'mail_to'			=> $mail_to,
										'data'				=> json_encode($form_field),
										'authenticated'		=> $authenticated,
										'signed_up'			=> $signed_up
									);

						$result = $this->pages_model->getPageForm($id);

						if ($result) {
							$page_form_id = $result->page_form_id;
							$result = $this->pages_model->updatePageForm($page_form_id,$data_form);
						} else {
							$data_form['page_id'] = $id;
							$result = $this->pages_model->setPageForm($data_form);
						}

						if ( ! $result['success'] ) {
							$success = FALSE;
							$message['notify'][] = 'Error : Page Form';
						}
					}

					if ($success && $form_table) {
						$result = $this->pages_model->getTable($form_table,'form',$form_field);

						$test = $result;

						if ($result) {
							$this->pages_model->alterTable($form_table,'form',$result);
						} else {
							$this->pages_model->createTable($form_table,'form',$form_field);
						}
						
						$user_field = array(
											array(
												'name'	=> 'form_id',
												'type'	=> 'INT',
												'size' 	=> 11
											),
											array(
												'name'	=> 'email',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'username',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'password',
												'type'	=> 'VARCHAR',
												'size' 	=> 100
											),
											array(
												'name'	=> 'activation_code',
												'type'	=> 'VARCHAR',
												'size' 	=> 200
											),
											array(
												'name'	=> 'activated',
												'type'	=> 'TINYINT',
												'size' 	=> 1
											)
										);
						$result = $this->pages_model->getTable($form_table,'user',$user_field);
						if ($result) {
							$this->pages_model->alterTable($form_table,'user',$result);
						} else {
							$this->pages_model->createTable($form_table,'user',$user_field);
						}
					}
				}

				// IMAGES UPLOAD
				$is_upload = FALSE;
				$image_name = $this->input->post('image_name');
				$image_description = $this->input->post('image_description');

				if ( isset($_FILES['image_upload']) && is_array($_FILES['image_upload']) ) {
					foreach ($_FILES['image_upload']['name'] as $key => $value) {
						$name = str_replace(';', '-', $image_name[$key]);
						$description = str_replace(';', '-', $image_description[$key]);

						$_FILES['image_upload']['upload_name'][$key] = $name . ';' . $description;
						$_FILES['image_upload']['skip'][$key] = TRUE;

						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/images/')) {
						mkdir($this->path . 'uploads/images/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/full/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/full/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/thumb/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/thumb/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/images/' . $type . '/full/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '10000';
					$config['upload']['max_width'] = '1920';
					$config['upload']['max_height'] = '1080';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('image_upload') ) {
						$success = FALSE;
						$image_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();

						$this->load->library('image_lib'); 

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$data_image = array();
						foreach ($upload_data as $key => $value) {
							$width = 300;
							$height = 200;

							$source_image = $this->path . 'uploads/images/' . $type . '/full/' . $value['file_name'];
							$new_image = $this->path . 'uploads/images/' . $type . '/thumb/' . $value['file_name'];

							$master_dim = 'auto';
							$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
							if ($original) {
								$original_aspect = $original['width'] / $original['height'];
								$thumb_aspect = $width / $height;
								$master_dim = $original_aspect >= $thumb_aspect ? 'height' : 'width';
							}

							$config['resize']['source_image'] = $source_image;
							$config['resize']['new_image'] = $new_image;
							$config['resize']['master_dim'] = $master_dim;
							$config['resize']['width'] = $width;
							$config['resize']['height'] = $height;

							$this->image_lib->initialize($config['resize']);
							$this->image_lib->resize();

							$this->image_lib->clear();

							if ($type !== 'gallery' || $is_menu) {
								$resize = $this->_get_size($new_image);

								$y_axis = floor(($resize['height'] - $height) / 2);
								$x_axis = floor(($resize['width'] - $width) / 2);

								$config['crop']['image_library'] = 'gd2';
								$config['crop']['source_image'] = $new_image;
								$config['crop']['new_image'] = $new_image;
								$config['crop']['maintain_ratio'] = FALSE;
								$config['crop']['width'] = $width;
								$config['crop']['height'] = $height;
								$config['crop']['y_axis'] = $y_axis;
								$config['crop']['x_axis'] = $x_axis;

								$this->image_lib->initialize($config['crop']);
								$this->image_lib->crop();

								$this->image_lib->clear();
							}

							$upload_name = explode(';', $value['upload_name']);

							$item = array(
										'page_id'		=> $id,
										'name'			=> $upload_name[0],
										'description'	=> $upload_name[1],
										'file_name'		=> $value['file_name'],
										'file_type'		=> $value['file_type'],
										'file_size'		=> $value['file_size']
									);
							array_push($data_image, $item);

						}

						$result = $this->pages_model->setPageImage($data_image);

					}

					if (! $success) {
						$message['notify'][] = 'Page Images Error : ' . (isset($image_error) ? $image_error : '-');
					}

				}

				// IMAGES PRODUCT UPLOAD
				$is_upload = FALSE;
				if ( isset($_FILES['image_product']) && is_array($_FILES['image_product']) ) {
					foreach ($_FILES['image_product']['name'] as $key => $value) {
						$name = '';
						$description = '';

						$_FILES['image_product']['upload_name'][$key] = $name . ';' . $description;
						$_FILES['image_product']['skip'][$key] = TRUE;

						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/images/')) {
						mkdir($this->path . 'uploads/images/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/full/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/full/');
					}
					if ( ! is_dir($this->path . 'uploads/images/' . $type . '/thumb/')) {
						mkdir($this->path . 'uploads/images/' . $type . '/thumb/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/images/' . $type . '/full/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '10000';
					$config['upload']['max_width'] = '1920';
					$config['upload']['max_height'] = '1080';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('image_product') ) {
						$success = FALSE;
						$image_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();

						$this->load->library('image_lib'); 

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$data_image_product = array();
						foreach ($upload_data as $key => $value) {
							$width = 300;
							$height = 200;

							$source_image = $this->path . 'uploads/images/' . $type . '/full/' . $value['file_name'];
							$new_image = $this->path . 'uploads/images/' . $type . '/thumb/' . $value['file_name'];

							$master_dim = 'auto';
							$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
							if ($original) {
								$original_aspect = $original['width'] / $original['height'];
								$thumb_aspect = $width / $height;
								$master_dim = $original_aspect >= $thumb_aspect ? 'height' : 'width';
							}

							$config['resize']['source_image'] = $source_image;
							$config['resize']['new_image'] = $new_image;
							$config['resize']['master_dim'] = $master_dim;
							$config['resize']['width'] = $width;
							$config['resize']['height'] = $height;

							$this->image_lib->initialize($config['resize']);
							$this->image_lib->resize();

							$this->image_lib->clear();

							if ($type !== 'gallery' || $is_menu) {
								$resize = $this->_get_size($new_image);

								$y_axis = floor(($resize['height'] - $height) / 2);
								$x_axis = floor(($resize['width'] - $width) / 2);

								$config['crop']['image_library'] = 'gd2';
								$config['crop']['source_image'] = $new_image;
								$config['crop']['new_image'] = $new_image;
								$config['crop']['maintain_ratio'] = FALSE;
								$config['crop']['width'] = $width;
								$config['crop']['height'] = $height;
								$config['crop']['y_axis'] = $y_axis;
								$config['crop']['x_axis'] = $x_axis;

								$this->image_lib->initialize($config['crop']);
								$this->image_lib->crop();

								$this->image_lib->clear();
							}

							$item = array(
										'page_id'		=> $id,
										'file_name'		=> $value['file_name'],
										'file_type'		=> $value['file_type'],
										'file_size'		=> $value['file_size']
									);
							array_push($data_image_product, $item);

						}

						$result = $this->pages_model->setImageProduct($data_image_product);

					}

					if (! $success) {
						$message['notify'][] = 'Product Images Error : ' . (isset($image_error) ? $image_error : '-');
					}

				}

				// ATTACHMENT UPLOAD
				$is_upload = FALSE;
				$file_name = $this->input->post('file_name');

				if ( isset($_FILES['file_upload']) && is_array($_FILES['file_upload']) ) {
					foreach ($_FILES['file_upload']['name'] as $key => $value) {
						$_FILES['file_upload']['upload_name'][$key] = isset($file_name[$key]) && $file_name[$key] ? $file_name[$key] : $value;
						$_FILES['file_upload']['skip'][$key] = TRUE;
						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($success && $is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/attachment/')) {
						mkdir($this->path . 'uploads/attachment/');
					}
					if ( ! is_dir($this->path . 'uploads/attachment/' . $type . '/')) {
						mkdir($this->path . 'uploads/attachment/' . $type . '/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/attachment/' . $type . '/';
					$config['upload']['allowed_types'] = $this->allowed_download;
					$config['upload']['max_size'] = '20000';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('file_upload') ) {
						$success = FALSE;
						$attachment_error = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->get_multi_upload_data();
						$data_download = array();
						foreach ($upload_data as $key => $value) {
							$item = array(
										'page_id'	=> $id,
										'name'		=> $value['upload_name'],
										'file_name'	=> $value['file_name'],
										'file_type'	=> $value['file_type'],
										'file_size'	=> $value['file_size']
									);
							array_push($data_download, $item);
						}
						$result = $this->pages_model->setPageDownload($data_download);
					}

					if (! $success) {
						$message['notify'][] = 'Page Attachment Error : ' . (isset($attachment_error) ? $attachment_error : '-');
					}

				}
			}

			if ($success) {
				$message['success'][] = (ucwords($type)) . ' Page has been updated';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = (ucwords($type)) . ' Page failed to be updated';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message, 'test' => isset($test) ? $test : NULL);
			echo json_encode($response);
		}
	}

	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id) {
				$get = $this->pages_model->getPageDetail($id);
				if ($get) {
					if ($get->type == 'form') {
						$this->pages_model->dropTable('p_' . $id);
					}

					$delete = array();

					$image = $this->pages_model->getPageImage($id);
					$product = $this->pages_model->getImageProduct($id);

					if ($image) {
						foreach ($image as $key => $value) {
							array_push($delete, $this->path . 'uploads/images/' . $get->type . '/full/' . $value->file_name);
							array_push($delete, $this->path . 'uploads/images/' . $get->type . '/thumb/' . $value->file_name);
						}
					}

					if ($product) {
						foreach ($product as $key => $value) {
							array_push($delete, $this->path . 'uploads/images/' . $get->type . '/full/' . $value->file_name);
							array_push($delete, $this->path . 'uploads/images/' . $get->type . '/thumb/' . $value->file_name);
						}
					}

					$response = $this->pages_model->deletePage($id);

					if (isset($response['success']) && $response['success'] && $delete) {
						foreach ($delete as $key => $value) {
							if (file_exists($value)) {
								unlink($value);
							}
						}
					}

					echo json_encode($response);
				}
			}
		}
	}

	public function get_page_guid()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$response = array();

			$guid = $this->input->post('guid');
			$id = $this->input->post('id');

			if (preg_match('/[^a-z_\-0-9]/i', $guid)) {
				$success = FALSE;
			}

			if ($success) {
				$response = json_encode($this->pages_model->getPageGuid($guid,$id));
			} else {
				$response = 'invalid';
			}

			echo $response;
		}
	}

	public function get_page_menu()
	{
		$response['menu'] = array();

		$this->create_menu($response['menu'],$this->level_id);

		$type = $this->input->post('type');

		echo json_encode($response);
	}

	private function create_menu(&$items, $id = NULL, $parent = NULL)
	{
		$menu = $this->user_model->getUserPageRelation($id,$parent);

		if (! empty($menu)) {
			foreach ($menu as $key => $value) {
				$item = array(
							'page_id'	=> $value->page_id,
							'publish'	=> $value->publish,
							'active'	=> $value->user_level || $this->is_super,
							'menu_id'	=> $value->page_menu_id,
							'parent_id'	=> $value->parent_menu_id,
							'name'		=> $value->name,
							'type'		=> $value->type,
							'menu_type'	=> $value->menu_type,
							'children'	=> array()
						);

				$this->create_menu($item['children'],$id,$item['menu_id']);
				if (empty($item['children'])) {
					unset($item['children']);
				}
				array_push($items,$item);
			}
		}
	}

	public function set_page_menu()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$type = $this->input->post('type');
			$data = $this->input->post('data');
			if ($type && $data) {
				$this->update_menu($type, $data);
				echo 'success';
			}
		}
	}

	private function update_menu($type, $data, $parent = NULL)
	{
		$order = 1;
		foreach ($data as $key => $value) {
			$parent_id = $parent ? $this->pages_model->getPageDetail($parent)->page_menu_id : NULL;
			$item = array(
						'`parent_menu_id`'	=> $parent_id,
						'`type`'			=> $type,
						'`order`'			=> $order
					);

			$this->pages_model->updatePageMenu($value['id'],$item);

			if (isset($value['children'])) {
				$this->update_menu($type, $value['children'], $value['id']);
			}
			$order++;
		}
	}

	public function update_comment($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$data = array(
							'publish'	=> $this->input->post('publish')
						);
				$response = $this->pages_model->updatePageComment($id,$data);
				echo json_encode($response);
			}
		}
	}

	public function delete_category($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$response = $this->pages_model->deletePageCategory($id);
				echo json_encode($response);
			}
		}
	}

	public function edit_category($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$category = $this->input->post('name');
				$guid = str_replace(' ', '-', strtolower($category));
				$data = array(
							'category'	=> $category,
							'guid'		=> $guid
						);
				$response = $this->pages_model->updatePageCategory($id,$data);
				echo json_encode($response);
			}
		}
	}

	public function edit_image($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$name = $this->input->post('caption');
				$desc = $this->input->post('desc');
				$data = array(
							'name'			=> $name,
							'description'	=> $desc
						);
				$response = $this->pages_model->updatePageImage($id,$data);
				echo json_encode($response);
			}
		}
	}

	public function delete_image($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$dir = $this->input->post('dir');
				$image = $this->input->post('image');

				if ($dir && $image) {
					if (file_exists($this->path . 'uploads/images/' . $dir . '/full/' . $image)) {
						unlink($this->path . 'uploads/images/' . $dir . '/full/' . $image);
					}
					if (file_exists($this->path . 'uploads/images/' . $dir . '/thumb/' . $image)) {
						unlink($this->path . 'uploads/images/' . $dir . '/thumb/' . $image);
					}
				}

				$response = $this->pages_model->deletePageImage($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_image_product($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$dir = $this->input->post('dir');
				$image = $this->input->post('image');

				if ($dir && $image) {
					if (file_exists($this->path . 'uploads/images/' . $dir . '/full/' . $image)) {
						unlink($this->path . 'uploads/images/' . $dir . '/full/' . $image);
					}
					if (file_exists($this->path . 'uploads/images/' . $dir . '/thumb/' . $image)) {
						unlink($this->path . 'uploads/images/' . $dir . '/thumb/' . $image);
					}
				}

				$response = $this->pages_model->deleteImageProduct($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_file($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$dir = $this->input->post('dir');
				$file = $this->input->post('file');

				if ($dir && $file) {
					if (file_exists($this->path . 'uploads/attachment/' . $dir . '/' . $file)) {
						unlink($this->path . 'uploads/attachment/' . $dir . '/' . $file);
					}
				}

				$response = $this->pages_model->deletePageDownload($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_gallery($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {

				if (file_exists($this->path . 'uploads/images/article/full/' . $this->input->post('image'))) {
					unlink($this->path . 'uploads/images/article/full/' . $this->input->post('image'));
				}
				if (file_exists($this->path . 'uploads/images/article/thumb/' . $this->input->post('image'))) {
					unlink($this->path . 'uploads/images/article/thumb/' . $this->input->post('image'));
				}

				$response = $this->pages_model->deletePageGallery($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_spesification($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$response = $this->pages_model->deletePageSpesification($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_help($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id === $this->input->post('id')) {
				$response = $this->pages_model->deletePageHelp($id);
				echo json_encode($response);
			}
		}
	}

	public function delete_inquiry($table, $id)
	{
		if ($table && $id) {
			$response = $this->inquiry_model->deleteInquiry($table,$id);
			echo json_encode($response);
		}
	}

	private function _get_size($image)
	{
		$img = getimagesize($image);
		if( ! empty($img) ) {
			return array('width' => $img['0'], 'height' => $img['1']);
		}
	}
	
}

/* End of file pages_process.php */
/* Location: ./application/controllers/pages/pages_process.php */