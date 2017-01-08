<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_Process extends IO_Controller {

	private $allowed_download, $allowed_images;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');

		$this->load->model('module/report_model');

		$this->allowed_download = 'png|jpg|gif|jpeg|pjpeg|bmp|csv|pdf|xls|xlsx|doc|docx|ppt|zip|rar';
		$this->allowed_images = 'png|jpg|gif|jpeg|pjpeg|bmp';
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();
			$data['report'] = array();
			
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
				$data['report']['title'] = $title;
			}
			
			$type = trim($this->input->post('type'));
			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
						'id'		=> 'type',
						'message'	=> 'Type required'
				);
			}
			else {
				$data['report']['type'] = $type;
			}

			$descr = $this->input->post('description');
			$data['report']['description'] = $descr;

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
				$message['notify'][] = 'File Error : File required.';
				$message['item'][] = array(
												'id'		=> 'image_upload',
												'message'	=> 'File required'
											);
			}

			if ($success) {
				if ( ! is_dir($this->path . 'uploads/')) {
					mkdir($this->path . 'uploads/');
				}
				if ( ! is_dir($this->path . 'uploads/files/')) {
					mkdir($this->path . 'uploads/files/');
				}

				$config['upload']['upload_path'] = $this->path . 'uploads/files/';
				$config['upload']['allowed_types'] = $this->allowed_download;
				$config['upload']['max_size'] = '155000';
				$config['upload']['max_width'] = '1920';
				$config['upload']['max_height'] = '1080';

				$this->upload->initialize($config['upload']);

				if ( ! $this->upload->do_multi_upload('image_upload') ) {
					$success = FALSE;
					$image_error = $this->upload->display_errors('','');
					$message['notify'][] = 'File Error : ' . (isset($image_error) ? $image_error : 'Upload file failed.');
					$message['item'][] = array(
													'id'		=> 'image_upload',
													'message'	=> (isset($image_error) ? $image_error : 'Upload file failed.')
												);
				} else {
					$upload_data = $this->upload->get_multi_upload_data();

					foreach ($upload_data as $key => $value) {
						$image = $value['file_name'];
					}
				}
			}

			if ($success) {
				
				$data['report']['url'] = $image;
				
				date_default_timezone_set('Asia/Jakarta');
				$getdate = date("Y-m-d");
				$data['report']['date'] = $getdate;
				
				$result['report'] = $this->report_model->setReport($data['report']);
				if ( ! isset($result['report']['success']) || ! $result['report']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : File add failed';
				} else {
					$insert_id['report'] = $result['report']['insert_id'];
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
			$data['report'] = array();

			$this->db->trans_begin();

			$report_id = $this->input->post('id');

			$title = trim($this->input->post('title'));
			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
										'id'		=> 'title',
										'message'	=> 'Title required'
									);
			}
			else {
				$data['report']['title'] = $title;
			}	

			$type = trim($this->input->post('type'));
			if ( ! $title ) {
				$success = FALSE;
				$message['item'][] = array(
						'id'		=> 'type',
						'message'	=> 'Type required'
				);
			}
			else {
				$data['report']['type'] = $type;
			}
			
			$descr = $this->input->post('description');
			$data['report']['description'] = $descr;

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
				if ( ! is_dir($this->path . 'uploads/files/')) {
					mkdir($this->path . 'uploads/files/');
				}

				$config['upload']['upload_path'] = $this->path . 'uploads/files/';
				$config['upload']['allowed_types'] = $this->allowed_download;
				$config['upload']['max_size'] = '115000';
				$config['upload']['max_width'] = '1920';
				$config['upload']['max_height'] = '1080';

				$this->upload->initialize($config['upload']);

				if ( ! $this->upload->do_multi_upload('image_upload') ) {
					$success = FALSE;
					$image_error = $this->upload->display_errors('','');
					$message['notify'][] = 'File Error : ' . (isset($image_error) ? $image_error : 'Upload file failed.');
					$message['item'][] = array(
													'id'		=> 'image_upload',
													'message'	=> (isset($image_error) ? $image_error : 'Upload file failed.')
												);
				} else {
					$gData = $this->report_model->getReport($id);
					$path = $_SERVER['DOCUMENT_ROOT'].'/izi/uploads/files/'.$gData->url;
					unlink($path);
					$upload_data = $this->upload->get_multi_upload_data();

					foreach ($upload_data as $key => $value) {
						$image = $value['file_name'];
					}
				}
			}

			if ($success) {

				if ($image) {
					$data['report']['url'] = $image;
				}

				$result['report'] = $this->report_model->updateReport($id,$data['report']);
				if ( ! isset($result['report']['success']) || ! $result['report']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : File update failed';
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
				$gData = $this->report_model->getReport($id);
				$path = $_SERVER['DOCUMENT_ROOT'].'/izi/uploads/files/'.$gData->url;
				unlink($path);
				$response = $this->report_model->deleteReport($id);
				echo json_encode($response);
			}
		}
	}

}

/* End of file slider_process.php */
/* Location: ./application/controllers/module/slider_process.php */