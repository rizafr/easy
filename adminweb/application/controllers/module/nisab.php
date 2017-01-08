<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nisab extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('module/nisab_model');
		$this->load->model('pages/pages_model');
	}

	public function index()
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['nisab'] = $this->nisab_model->getNisab();

		$this->load->view('common/header',$data);
		$this->load->view('module/nisab/index');
		$this->load->view('common/footer');
	}

	public function edit()
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$data['nisab'] = $this->nisab_model->getNisab();
		$this->load->view('common/header',$data);
		$this->load->view('module/nisab/edit');
		$this->load->view('common/footer');
	}
	
	function update()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$success = TRUE;
			$message = array();
			$data = array();
			$data['nisab'] = array();
		
			$this->db->trans_begin();
		
		
			$nisab = $this->input->post('nisab_base');
			if ( ! $nisab ) {
				$success = FALSE;
				$message['item'][] = array(
						'id'		=> 'nisab',
						'message'	=> 'Nisab base value required'
				);
			}
			else {
				$data['nisab']['nisab_base'] = $nisab;
			}
		
			if ($success) {
		
				$result['nisab'] = $this->nisab_model->updateNisab(1,$data['nisab']);
				if ( ! isset($result['nisab']['success']) || ! $result['nisab']['success'] ) {
					$success = FALSE;
					$message['notify'][] = 'Error : Nisab base value update failed ';
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

}

/* End of file slider.php */
/* Location: ./application/controllers/module/slider.php */