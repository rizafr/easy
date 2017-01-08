<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_Process extends IO_Controller {

	private $allowed_download, $allowed_images;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');

		$this->load->model('module/slider_model');

		$this->allowed_download = 'png|jpg|gif|jpeg|pjpeg|bmp|csv|pdf|xls|xlsx|doc|docx|ppt|zip|rar';
		$this->allowed_images = 'png|jpg|gif|jpeg|pjpeg|bmp';
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();
			$data['slider'] = array();
			
			$this->db->trans_begin();

			$title = trim($this->input->post('title'));
			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
										'id'		=> 'title',
										'message'	=> 'Title required'
									);
			}
			else {
				$data['slider']['title'] = $title;
			}
			
			$position = $this->input->post('position');
			$data['slider']['position'] = $position;
			$descr = $this->input->post('description');
			$data['slider']['description'] = $descr;
			$vidbutt = $this->input->post('vidbutt');
			$data['slider']['vidbutt'] = $vidbutt;
			if($vidbutt > 0)
			{
				$url = $this->input->post('url');
				if ( ! $url ) {
					$success = FALSE;
					$message['notify'][] = 'Url required';
				}
				else {
					$data['slider']['url'] = $url;
				}
				if($vidbutt == '1')
				{
					$buttname = $this->input->post('button_name');			
					
					if (! $buttname ) {
						$success = FALSE;
						$message['notify'][] = 'Button Name required';
					}
					else {
						$data['slider']['label'] = $buttname;
					}
				}
				
			}

			$slider = array();

			$image = '';

			// IMAGES UPLOAD
			$is_upload = FALSE;
			if ( isset($_FILES['image_upload']) && is_array($_FILES['image_upload']) ) {
				foreach ($_FILES['image_upload']['name'] as $key => $value) {
					if ($value) {
						$is_upload = TRUE;
					}
				}
			}

			if ( ! $is_upload) {
				$success = FALSE;
				$message['notify'][] = 'Slider Images Error : Slider image required.';
				$message['item'][] = array(
												'id'		=> 'image_upload',
												'message'	=> 'Slider image required'
											);
			}

			if ($success) {
				if ( ! is_dir($this->path . 'uploads/')) {
					mkdir($this->path . 'uploads/');
				}
				if ( ! is_dir($this->path . 'uploads/slides/')) {
					mkdir($this->path . 'uploads/slides/');
				}

				$config['upload']['upload_path'] = $this->path . 'uploads/slides/';
				$config['upload']['allowed_types'] = $this->allowed_images;
				$config['upload']['max_size'] = '15000';
				$config['upload']['max_width'] = '1920';
				$config['upload']['max_height'] = '1080';

				$this->upload->initialize($config['upload']);

				if ( ! $this->upload->do_multi_upload('image_upload') ) {
					$success = FALSE;
					$image_error = $this->upload->display_errors('','');
					$message['notify'][] = 'Slider Images Error : ' . (isset($image_error) ? $image_error : 'Upload image failed.');
					$message['item'][] = array(
													'id'		=> 'image_upload',
													'message'	=> (isset($image_error) ? $image_error : 'Upload image failed.')
												);
				} else {
					$upload_data = $this->upload->get_multi_upload_data();

					foreach ($upload_data as $key => $value) {
						$image = $value['file_name'];
					}
				}
			}

			if ($success) {
				
				$data['slider']['image'] = $image;

				$result['slider'] = $this->slider_model->setSlider($data['slider']);
				if ( ! isset($result['slider']['success']) || ! $result['slider']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : Slider add failed';
				} else {
					$insert_id['slider'] = $result['slider']['insert_id'];
				}
			}

			if ($success) {
				$message['success'][] = 'Data has been added';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data failed to be added';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message, 'data' => $data);
			echo json_encode($response);
		}
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();
			$data['slider'] = array();

			$this->db->trans_begin();

			$slider_id = $this->input->post('id');

			$title = trim($this->input->post('title'));
			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
										'id'		=> 'title',
										'message'	=> 'Title required'
									);
			}
			else {
				$data['slider']['title'] = $title;
			}		

			$position = $this->input->post('position');
			$data['slider']['position'] = $position;
			$descr = $this->input->post('description');
			$data['slider']['description'] = $descr;
			$vidbutt = $this->input->post('vidbutt');
			$data['slider']['vidbutt'] = $vidbutt;
			if($vidbutt > 0)
			{
				$url = $this->input->post('url');
				if ( ! $url ) {
					$success = FALSE;
					$message['notify'][] = 'Url required';
				}
				else {
					$data['slider']['url'] = $url;
				}
				if($vidbutt == '1')
				{
					$buttname = $this->input->post('button_name');
						
					if (! $buttname ) {
						$success = FALSE;
						$message['notify'][] = 'Button Name required';
					}
					else {
						$data['slider']['label'] = $buttname;
					}
				}
			
			}

			$image = '';

			// IMAGES UPLOAD
			$is_upload = FALSE;
			if ( isset($_FILES['image_upload']) && is_array($_FILES['image_upload']) ) {
				foreach ($_FILES['image_upload']['name'] as $key => $value) {
					if ($value) {
						$is_upload = TRUE;
					}
				}
			}

			if ($success &&  $is_upload) {
			if ( ! is_dir($this->path . 'uploads/')) {
					mkdir($this->path . 'uploads/');
				}
				if ( ! is_dir($this->path . 'uploads/slides/')) {
					mkdir($this->path . 'uploads/slides/');
				}

				$config['upload']['upload_path'] = $this->path . 'uploads/slides/';
				$config['upload']['allowed_types'] = $this->allowed_images;
				$config['upload']['max_size'] = '15000';
				$config['upload']['max_width'] = '1920';
				$config['upload']['max_height'] = '1080';

				$this->upload->initialize($config['upload']);

				if ( ! $this->upload->do_multi_upload('image_upload') ) {
					$success = FALSE;
					$image_error = $this->upload->display_errors('','');
					$message['notify'][] = 'Slider Images Error : ' . (isset($image_error) ? $image_error : 'Upload image failed.');
					$message['item'][] = array(
													'id'		=> 'image_upload',
													'message'	=> (isset($image_error) ? $image_error : 'Upload image failed.')
												);
				} else {
					$upload_data = $this->upload->get_multi_upload_data();

					foreach ($upload_data as $key => $value) {
						$image = $value['file_name'];
					}
				}
			}

			if ($success) {

				if ($image) {
					$data['slider']['image'] = $image;
				}

				$result['slider'] = $this->slider_model->updateSlider($id,$data['slider']);
				if ( ! isset($result['slider']['success']) || ! $result['slider']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : Slider update failed';
				} else {
					//
				}
			}

			if ($success) {
				$message['success'][] = 'Data has been updated';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data failed to be updated';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message, 'data' => $data);
			echo json_encode($response);
		}
	}

	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id) {
				$response = $this->slider_model->deleteSlider($id);
				echo json_encode($response);
			}
		}
	}

}

/* End of file slider_process.php */
/* Location: ./application/controllers/module/slider_process.php */
