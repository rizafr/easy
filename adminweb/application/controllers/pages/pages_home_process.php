<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Home_Process extends IO_Controller {

	private $allowed_download, $allowed_images;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('pages/pages_model');

		$this->allowed_download = 'png|jpg|gif|jpeg|pjpeg|bmp|csv|pdf|xls|xlsx|doc|docx|ppt|zip|rar';
		$this->allowed_images = 'png|jpg|gif|jpeg|pjpeg|bmp';
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$page_id = $this->input->post('id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if ($id === $page_id) {

				$page_setting = $this->input->post('page_setting');

				if ($success && is_array($page_setting)) {
					$data_content = array(
										'visi_misi'					=> '',
										'weapon_title'				=> '',
										'weapon_desc'				=> '',
										'ammunition_title'			=> '',
										'ammunition_desc'			=> '',
										'vehicle_title'				=> '',
										'vehicle_desc'				=> '',
										'forging_title'				=> '',
										'forging_desc'				=> '',
										'service_title'				=> '',
										'service_desc'				=> '',
										'commercial_title'			=> '',
										'commercial_desc'			=> '',
										'news'						=> '',
										'product'					=> '',
										'innovation'				=> '',
										'procurement'				=> '',
										'career'					=> '',
										'footer_about_title'		=> '',
										'footer_about_body'			=> '',
										'footer_contact_title'		=> '',
										'footer_contact_body'		=> '',
										'footer_newsletter_title'	=> ''
									);
					foreach ($page_setting as $key => $value) {

						foreach ($data_content as $k => $val) {
							if ($k !== 'page_language_id') {
								$data_content[$k]	= $value[$k] ? $value[$k] : $data_content[$k];
								if ( ! $data_content[$k]) {
									$success = FALSE;
									$message['item'][] = array(
															'id'		=> 'page-content-' . $k . '-' . $key,
															'message'	=> 'Field Required'
														);
								}
							}
						}

						$check_page = $this->pages_model->getPageSetting($key);
						if ($check_page) {
							$result = $this->pages_model->updatePageSetting($key,$data_content);
						} else {
							$data_content['page_language_id'] = $key;
							$result = $this->pages_model->setPageSetting($data_content);
						}

						if ( ! $result['success'] ) {
							$success = FALSE;
							$message['notify'][] = $result['message'];
							break;
						}
					}
				}

				$current_slider = $this->input->post('current_slider');

				if ($current_slider) {
					foreach ($current_slider as $key => $value) {
						$page_image_id = $key;
						foreach ($value['name'] as $k => $val) {
							$page_language_id = $k;
							$data_slider = array(
												'slider_title'		=> $value['name'][$k],
												'slider_description'=> $value['description'][$k],
												'slider_button1'	=> $value['button1'][$k],
												'slider_link1'		=> $value['link1'],
												'slider_button2'	=> $value['button2'][$k],
												'slider_link2'		=> $value['link2']
											);
							$result = $this->pages_model->updatePageSlider($page_image_id,$page_language_id,$data_slider);
							if ( ! $result['success']) {
								$success = FALSE;
							}
						}
					}
				}

				$is_upload = FALSE;
				$slider = $this->input->post('slider');
				$slider_link1 = $this->input->post('slider_link1');
				$slider_link2 = $this->input->post('slider_link2');

				if ( isset($_FILES['slider_upload']) && is_array($_FILES['slider_upload']) ) {
					foreach ($_FILES['slider_upload']['name'] as $key => $value) {
						$slider_data = array();

						if ($slider) {
							foreach ($slider as $k => $val) {
								$slider_data['name'][$k] = $val['name'][$key];
								$slider_data['description'][$k] = $val['description'][$key];
								$slider_data['button1'][$k] = $val['button1'][$key];
								$slider_data['button2'][$k] = $val['button2'][$key];
							}
						}

						$slider_data['link1'] = isset($slider_link1[$key]) ? $slider_link1[$key] : NULL;
						$slider_data['link2'] = isset($slider_link2[$key]) ? $slider_link2[$key] : NULL;

						$_FILES['slider_upload']['upload_name'][$key] = $slider_data;
						$_FILES['slider_upload']['skip'][$key] = TRUE;

						if ($value) {
							$is_upload = TRUE;
						}
					}
				}

				if ($is_upload) {
					// init upload config
					$config['upload']['upload_path'] = $this->path . 'uploads/images/article/full/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '8000';
					/*$config['upload']['max_width'] = '1366';
					$config['upload']['max_height'] = '768';*/

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_multi_upload('slider_upload') ) {
						$success = FALSE;
						$error = $this->upload->display_errors('','');
						$message['notify'][] = $error;
					} else {
						$upload_data = $this->upload->get_multi_upload_data();

						$this->load->library('image_lib'); 

						// init resize config
						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						foreach ($upload_data as $key => $value) {

							$width = 300;
							$height = 200;

							$source_image = $this->path . 'uploads/images/article/full/' . $value['file_name'];
							$new_image = $this->path . 'uploads/images/article/thumb/' . $value['file_name'];

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

							// clear image_lib
							$this->image_lib->clear();

							$resize = $this->_get_size($new_image);

							$y_axis = floor(($resize['height'] - $height) / 2);
							$x_axis = floor(($resize['width'] - $width) / 2);

							// init crop config
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

							$data_image = array(
										'page_id'		=> $id,
										'file_name'		=> $value['file_name'],
										'file_type'		=> $value['file_type'],
										'file_size'		=> $value['file_size']
									);
							
							$result = $this->pages_model->setPageImage($data_image,FALSE);
							if ($result['success']) {
								$image_id = $result['insert_id'];
								$slider_item = $value['upload_name'];

								foreach ($slider_item['name'] as $k => $val) {
									$data_slider = array(
														'page_image_id'		=> $image_id,
														'page_language_id'	=> $k,
														'slider_title'		=> $slider_item['name'][$k],
														'slider_description'=> $slider_item['description'][$k],
														'slider_button1'	=> $slider_item['button1'][$k],
														'slider_link1'		=> $slider_item['link1'],
														'slider_button2'	=> $slider_item['button2'][$k],
														'slider_link2'		=> $slider_item['link2']
													);
									$result = $this->pages_model->setPageSlider($data_slider);
									if ( ! $result['success']) {
										$success = FALSE;
									}
								}
							} else {
								$success = FALSE;
							}
						}
					}
				}
			}

			if ($success) {
				$message['success'][] = 'The Home Page has been updated';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'The Home Page failed to be updated';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
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

/* End of file pages_home_process.php */
/* Location: ./application/controllers/pages/pages_home_process.php */