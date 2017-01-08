<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Footer_Link_Process extends IO_Controller {

	private $allowed_images;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');

		$this->load->model('settings/footer_link_model');

		$this->allowed_images = 'png|jpg|gif|jpeg|pjpeg|bmp';
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();

			$this->db->trans_begin();

			$title = trim($this->input->post('title'));
			$url = trim($this->input->post('url'));

			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
										'id'		=> 'image-title',
										'message'	=> 'Title required'
									);
			}

			$image = '';

			// IMAGES UPLOAD
			$is_upload = FALSE;
			if ( isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']) ) {
				$is_upload = TRUE;
			}

			if ( ! $is_upload) {
				$success = FALSE;
				$message['item'][] = array(
												'id'		=> 'image-upload',
												'message'	=> 'Image required'
											);
			}

			if ($success) {
				if ( ! is_dir($this->path . 'uploads/')) {
					mkdir($this->path . 'uploads/');
				}
				if ( ! is_dir($this->path . 'uploads/footer/')) {
					mkdir($this->path . 'uploads/footer/');
				}

				$config['upload']['upload_path'] = $this->path . 'uploads/footer/';
				$config['upload']['allowed_types'] = $this->allowed_images;
				$config['upload']['max_size'] = '8000';
				$config['upload']['max_width'] = '1000';
				$config['upload']['max_height'] = '1000';

				$this->upload->initialize($config['upload']);

				if ( ! $this->upload->do_upload('image') ) {
					$success = FALSE;
					$message['item'][] = array(
													'id'		=> 'image-upload',
													'message'	=> $this->upload->display_errors('','')
												);
				} else {
					$upload_data = $this->upload->data();
					$image = $upload_data['file_name'];
				}
			}

			if ($success && $image) {
				$data['footer'] = array(
									'image'		=> $image,
									'title'		=> $title,
									'url'		=> $url
								);

				$result['footer'] = $this->footer_link_model->set($data['footer']);
				if ( ! isset($result['footer']['success']) || ! $result['footer']['success'] ) {
					$success = FALSE;
					$message['notify'][] = '#1 has occurred an error';
				} else {
					//
				}
			}

			if ($success) {
				$message['success'][] = 'Data has been added';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data failed to be added';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();

			$this->db->trans_begin();

			$footer_id = $this->input->post('id');

			if ($id === $footer_id) {
				$title = trim($this->input->post('title'));
				$url = trim($this->input->post('url'));

				if ( ! $title ) {
					$success = FALSE;
					$message['item'][] = array(
											'id'		=> 'image-title',
											'message'	=> 'Title required'
										);
				}

				$get['footer'] = $this->footer_link_model->get($id);
				$image = $get['footer']->image;

				// IMAGES UPLOAD
				$is_upload = FALSE;
				if ( isset($_FILES['image']['name']) && ! empty($_FILES['image']['name']) ) {
					$is_upload = TRUE;
				}

				if ($is_upload) {
					if ( ! is_dir($this->path . 'uploads/')) {
						mkdir($this->path . 'uploads/');
					}
					if ( ! is_dir($this->path . 'uploads/footer/')) {
						mkdir($this->path . 'uploads/footer/');
					}

					$config['upload']['upload_path'] = $this->path . 'uploads/footer/';
					$config['upload']['allowed_types'] = $this->allowed_images;
					$config['upload']['max_size'] = '8000';
					$config['upload']['max_width'] = '1000';
					$config['upload']['max_height'] = '1000';

					$this->upload->initialize($config['upload']);

					if ( ! $this->upload->do_upload('image') ) {
						$success = FALSE;
						$message['item'][] = array(
														'id'		=> 'image-upload',
														'message'	=> $this->upload->display_errors('','')
													);
					} else {
						$upload_data = $this->upload->data();
						$image = $upload_data['file_name'];
					}
				}

				if ($success && $image) {
					$data['footer'] = array(
										'image'		=> $image,
										'title'		=> $title,
										'url'		=> $url
									);

					$result['footer'] = $this->footer_link_model->update($id, $data['footer']);
					if ( ! isset($result['footer']['success']) || ! $result['footer']['success'] ) {
						$success = FALSE;
						$message['notify'][] = '#1 has occurred an error';
					} else {
						//
					}
				}
			} else {
				$success = FALSE;
				$message['notify'][] = '#2 Invalid Data';
			}

			if ($success) {
				$message['success'][] = 'Data has been updated';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data failed to be updated';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id) {

				$get = $this->footer_link_model->get($id);
				$image = $get->image;

				$response = $this->footer_link_model->delete($id);
				if (isset($response['success']) && $response['success']) {
					if (file_exists($this->path . 'uploads/footer/' . $image)) {
						unlink($this->path . 'uploads/footer/' . $image);
					}
				}

				echo json_encode($response);
			}
		}
	}

}