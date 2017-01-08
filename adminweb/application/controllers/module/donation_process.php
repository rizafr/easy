<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation_Process extends IO_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('upload');

		$this->load->model('module/donate_model');
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();
			$data['donation'] = array();

			$this->db->trans_begin();

			$donate_id = $this->input->post('id');

			$status = trim($this->input->post('status'));
			if ( ! $status ) {
				$success = FALSE;
				$message['item'][] = array(
										'id'		=> 'status',
										'message'	=> 'Status required'
									);
			}
			else {
				$data['donation']['status'] = $status;
			}		

			if ($success) {

				$result['donation'] = $this->donate_model->updateDonate($id,$data['donation']);
				if ( ! isset($result['donation']['success']) || ! $result['donation']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : Donation update failed';
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
				$response = $this->donate_model->deleteDonate($id);
				echo json_encode($response);
			}
		}
	}

}

/* End of file slider_process.php */
/* Location: ./application/controllers/module/slider_process.php */