<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	private $upload_path, $upload_dir;

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('member/user_model');
		$this->load->model('member/profile_model');
		$this->load->model('member/product_model');
		$this->load->model('member/category_model');
		$this->load->model('member/member_model');

		$this->upload_path = $this->path . 'uploads/';
		$this->upload_dir = $this->dir . 'uploads/';
		
		$this->load->helper('email');
	}
	
	public function download_document()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = '';
			$position = '';
			$other = '';
			$email_fg = TRUE;
			
			$email = $this->input->post ( 'email' );
			$doc = $this->input->post ( 'file' );
			if ($success) {
				if($email) {
					if (! valid_email ( $email )) {
						$success = FALSE;
						$message = 'Format Email salah. Silahkan periksa format Email.';
						$position = 'email';
					}
					else 
					{
						$check_email = $this->member_model->getExistEmail($email);
						if ($check_email) {
							$url = '';
							switch ($doc){
								case 1: $url = base_url().'assets/pdf/Akta-Notaris-Pendirian-Yay-IZI.pdf';
								break;
								case 2: $url = base_url().'assets/pdf/Surat-Kemenkumham_25-Mei-2015.pdf';
								break;
								case 3: $url = base_url().'assets/pdf/SK-Kemenkumham-Yayasan-IZI.pdf';
								break;
								case 4: $url = base_url().'assets/pdf/SK-KEMENAG.pdf';
								break;
							}
							$sendfile = $this->member_model->sendMail($email,'Please click link below to download document <p /><a href="'.$url.'">download file</a>','Inisiatif Zakat Indonesia - Document');
							if($sendfile) $message = 'Silahkan periksa email untuk mendownload file.';
							else $message = 'Maaf, gagal mengirimkan email, silahkan coba lagi.';
							$email_fg = FALSE;
						}
					}
				}
				else {
					$success = FALSE;
					$message = 'Email harus diisi';
					$position = 'email';
				}
			}
			
			if ($success) {
				if($email_fg) {
					$result['success'] = $this->member_model->setEmail(array('email'=>$email,'date'=>$getdate));
					if ($result['success']) {
						$url = '';
						switch ($doc){
							case 1: $url = base_url().'assets/pdf/Akta-Notaris-Pendirian-Yay-IZI.pdf';
							break;
							case 2: $url = base_url().'assets/pdf/Surat-Kemenkumham_25-Mei-2015.pdf';
							break;
							case 3: $url = base_url().'assets/pdf/SK-Kemenkumham-Yayasan-IZI.pdf';
							break;
							case 4: $url = base_url().'assets/pdf/SK-KEMENAG.pdf';
							break;
						}
						$sendfile = $this->member_model->sendMail($email,'Please click link below to download document <p /><a href="'.$url.'">download file</a>','Inisiatif Zakat Indonesia - Document');
						if($sendfile) $message = 'Silahkan periksa email untuk mendownload file.';
						else $message = 'Maaf, gagal mengirimkan email, silahkan coba lagi.';
					} else {
						$success = FALSE;
						$message = 'Maaf, proses gagal.';
						$position = 'other';
					}
				}
			}
			$response = array(
					'success'	=> $success,
					'position'	=> $position,
					'message'	=> $message,
					'redirect'  => $other
			);
				
			echo json_encode($response);
		}
	}

	public function edit_profile()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$profile_id = $this->input->post('mid');

			$success = TRUE;
			$message = '';
			$position = '';
			$redirect = '';

			if (isset($_SESSION['login']['profile']['user_id']) && $_SESSION['login']['profile']['user_id'] === $profile_id) {
// 				$email = $this->input->post('email');
// 				$password = $this->input->post('password');
// 				$passwordConfirm = $this->input->post('passconf');
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
				$nokontak = $this->input->post('nokontak');
				$address = $this->input->post('address');
// 				$username = $this->input->post('username');

				/*if ($success) {
					if($passwordConfirm && $password) {
						if ($password !== $passwordConfirm) {
							$success = FALSE;
							$message = 'Konfirmasi Password tidak sesuai.';
							$position = 'password';
						}
					}
				}*/

				if ($success) {
					$data['user'] = array(
								'first_name'		=> $firstname,
								'last_name'			=> $lastname,
								'contact'			=> $nokontak,
								'address'			=> $address
// 								'email'				=> $email,
// 								'username'			=> $username
// 								'password'			=> md5($password)
							);

					$result['user'] = $this->member_model->updateMember($profile_id,$data['user']);

					if (! $result['user']['success'] ) {
						$message = 'update data failed'.$result['user']['error'];
						$success = FALSE;		
						$position = 'other';
					}
					else {
						$message = 'update data success';
						$redirect = base_url().'myaccount';
					}
				}
				
				$response = array(
						'success'	=> $success,
						'position'	=> $position,
						'message'	=> $message,
						'redirect'  => $redirect
				);
					
				echo json_encode($response);
			}
		}
	}

	public function edit_password($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$profile_id = $this->input->post('id');
			$user_id = $this->input->post('user_id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if (isset($_SESSION['login']['profile']['user_id']) && $_SESSION['login']['profile']['user_id'] === $user_id && $id === $profile_id) {
				
				$old_password = trim($this->input->post('old_password'));
				$password = trim($this->input->post('password'));
				$confirm_password = trim($this->input->post('confirm_password'));

				$get['user'] = $this->user_model->getUser($user_id);


				if ( ! $old_password) {
					$success = FALSE;
					$message['warning']['old_password'] = 'Password Lama harus diisi';
				} else if ( ! $get['user']) {
					$success = FALSE;
					$message['notify'][] = 'Data member tidak valid';
				} else if ($get['user']->user_password !== md5($old_password)) {
					$success = FALSE;
					$message['warning']['old_password'] = 'Password Lama salah';
				}

				if ( ! $this->input->post('password')) {
					$success = FALSE;
					$message['warning']['password'] = 'Password Baru harus diisi';
				} else if (strlen($this->input->post('password')) < 4) {
					$success = FALSE;
					$message['warning']['password'] = 'Password Baru tidak boleh kurang dari 4 karakter';
				}

				if ( ! $this->input->post('confirm_password')) {
					$success = FALSE;
					$message['warning']['confirm_password'] = 'Konfirmasi Password harus diisi';
				} else if ($password !== $confirm_password) {
					$success = FALSE;
					$message['warning']['confirm_password'] = 'Konfirmasi Password tidak sesuai';
				}

				if ($success) {
					$data['user'] = array(
										'password'		=> md5($password)
									);

					$result['user'] = $this->user_model->updateUser($user_id,$data['user']);

					if ( ! $result['user']['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Telah terjadi kesalahan. #1';
					}
				}
			} else {
				$success = FALSE;
			}

			if ($success) {
				$_SESSION['success'] = 'Data password berhasil diubah';
				$message['success'][] = 'Data password berhasil diubah';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data password gagal diubah.';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);

		}
	}

	public function add_product()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$user_id = $this->input->post('user');

			$success = TRUE;
			$message = array();
			$error = '';

			$this->db->trans_begin();

			if (isset($_SESSION['login']['profile']['user_id']) && $_SESSION['login']['profile']['user_id'] === $user_id) {
				
				$product_id = NULL;
				$profile = trim($this->input->post('profile'));
				$category = trim($this->input->post('category'));
				$name = trim($this->input->post('name'));
				$price = trim($this->input->post('price'));
				$description = trim($this->input->post('description'));
				$status = trim($this->input->post('status'));

				if ( ! $category) {
					$success = FALSE;
					$message['warning']['category'] = 'Kategori harus diisi';
				}

				if ( ! $name) {
					$success = FALSE;
					$message['warning']['name'] = 'Nama Produk harus diisi';
				}

				if ( ! $price) {
					$success = FALSE;
					$message['warning']['price'] = 'Harga harus diisi';
				}

				$price = preg_replace('/\D/', '', $price);

				// IMAGES UPLOAD
				$image_name = '';
				$width = 1000;
				$height = 1000;

				if ($success && isset($_FILES['image']['name']) && $_FILES['image']['name']) {

					$this->load->library('upload');
					$this->load->library('image_lib'); 

					if ( ! is_dir($this->upload_path . 'images/product/' . $profile . '/')) {
						mkdir($this->upload_path . 'images/product/' . $profile . '/',0777,TRUE);
					}

					$config['upload']['upload_path'] = $this->upload_path . 'images/product/' . $profile . '/';
					$config['upload']['allowed_types'] = 'png|jpg|gif|jpeg|pjpeg';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_upload('image') ) {
						$success = FALSE;
						$message['notify'][] = 'Gambar gagal di upload.';
						$message['warning']['image'] = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->data();
						$image_name = $upload_data['file_name'];

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$source_image = $this->upload_path . 'images/product/' . $profile . '/' . $image_name;
						$new_image = $this->upload_path . 'images/product/' . $profile . '/' . $image_name;

						$master_dim = 'auto';
						$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
						if ($original) {
							$original_aspect = $original['width'] / $original['height'];
							$thumb_aspect = $width / $height;
							$master_dim = $original_aspect <= $thumb_aspect ? 'height' : 'width';
						}

						$config['resize']['source_image'] = $source_image;
						$config['resize']['new_image'] = $new_image;
						$config['resize']['master_dim'] = $master_dim;
						$config['resize']['width'] = $width;
						$config['resize']['height'] = $height;

						$this->image_lib->initialize($config['resize']);
						$this->image_lib->resize();

						$this->image_lib->clear();
					}
				} else {
					$success = FALSE;
					$message['warning']['image'] = 'Gambar harus diisi';
				}

				if ($success) {
					$data['product'] = array(
										'profile_id'		=> $profile,
										'category_id'		=> $category,
										'name'				=> $name,
										'price'				=> $price,
										'description'		=> $description,
										'status'			=> $status,
										'image'				=> $image_name
									);

					$result['product'] = $this->product_model->setProduct($data['product']);

					if ( ! $result['product']['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Telah terjadi kesalahan. #1';
					} else {
						$product_id = $result['product']['insert_id'];
					}
				}
			} else {
				$success =FALSE;
			}

			if ($success) {
				$_SESSION['success'] = 'Data produk berhasil dibuat';
				$message['success'][] = 'Data produk berhasil dibuat.';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data produk gagal dibuat.';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function edit_product($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$product_id = $this->input->post('id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if ($id === $product_id) {
				$profile = trim($this->input->post('profile'));
				$category = trim($this->input->post('category'));
				$name = trim($this->input->post('name'));
				$price = trim($this->input->post('price'));
				$description = trim($this->input->post('description'));
				$status = trim($this->input->post('status'));

				if ( ! $category) {
					$success = FALSE;
					$message['warning']['category'] = 'Kategori harus diisi';
				}

				if ( ! $name) {
					$success = FALSE;
					$message['warning']['name'] = 'Nama Produk harus diisi';
				}

				if ( ! $price) {
					$success = FALSE;
					$message['warning']['price'] = 'Harga harus diisi';
				}

				$price = preg_replace('/\D/', '', $price);

				// IMAGES UPLOAD
				$image_name = trim($this->input->post('image_name'));
				$width = 1000;
				$height = 1000;

				if ($success && isset($_FILES['image']['name']) && $_FILES['image']['name']) {

					$this->load->library('upload');
					$this->load->library('image_lib'); 

					if ( ! is_dir($this->upload_path . 'images/product/' . $profile . '/')) {
						mkdir($this->upload_path . 'images/product/' . $profile . '/',0777,TRUE);
					}

					$config['upload']['upload_path'] = $this->upload_path . 'images/product/' . $profile . '/';
					$config['upload']['allowed_types'] = 'png|jpg|gif|jpeg|pjpeg';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_upload('image') ) {
						$success = FALSE;
						$message['notify'][] = 'Gambar gagal di upload.';
						$message['warning']['image'] = $this->upload->display_errors('','');
					} else {
						$upload_data = $this->upload->data();
						$image_name = $upload_data['file_name'];

						$config['resize']['image_library'] = 'gd2';
						$config['resize']['maintain_ratio'] = TRUE;

						$source_image = $this->upload_path . 'images/product/' . $profile . '/' . $image_name;
						$new_image = $this->upload_path . 'images/product/' . $profile . '/' . $image_name;

						$master_dim = 'auto';
						$original = file_exists($source_image) ? $this->_get_size($source_image) : NULL;
						if ($original) {
							$original_aspect = $original['width'] / $original['height'];
							$thumb_aspect = $width / $height;
							$master_dim = $original_aspect <= $thumb_aspect ? 'height' : 'width';
						}

						$config['resize']['source_image'] = $source_image;
						$config['resize']['new_image'] = $new_image;
						$config['resize']['master_dim'] = $master_dim;
						$config['resize']['width'] = $width;
						$config['resize']['height'] = $height;

						$this->image_lib->initialize($config['resize']);
						$this->image_lib->resize();

						$this->image_lib->clear();
					}
				}

				if ($success) {
					$data['product'] = array(
										'category_id'		=> $category,
										'name'				=> $name,
										'price'				=> $price,
										'description'		=> $description,
										'status'			=> $status,
										'image'				=> $image_name
									);

					$result['product'] = $this->product_model->updateProduct($id,$data['product']);

					if ( ! $result['product']['success'] ) {
						$success = FALSE;
						$message['notify'][] = 'Telah terjadi kesalahan. #1';
					}
				}
			}

			if ($success) {
				$_SESSION['success'] = 'Data produk berhasil diubah';
				$message['success'][] = 'Data produk berhasil diubah';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data produk gagal diubah.';
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