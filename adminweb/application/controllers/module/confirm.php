<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('module/confirm_model');
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

		$data['donation'] = $this->confirm_model->getAllConfirm();

		$this->load->view('common/header',$data);
		$this->load->view('module/confirm/index');
		$this->load->view('common/footer');
	}

	public function edit($id)
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$data['id'] = $id;
		if ($id) {
			$data['confirm'] = $this->confirm_model->getConfirm($id);
			
			$this->load->view('common/header',$data);
			$this->load->view('module/confirm/edit');
			$this->load->view('common/footer');
		}
	}
	
	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id) {
				$response = $this->confirm_model->deleteConfirm($id);
				echo json_encode($response);
			}
		}
	}

}

/* End of file slider.php */
/* Location: ./application/controllers/module/slider.php */