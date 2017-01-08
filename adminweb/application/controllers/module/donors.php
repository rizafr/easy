<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donors extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('member/member_model');		
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

		$data['member'] = $this->member_model->getAllMember();
		$this->load->view('common/header',$data);
		$this->load->view('module/member/index');
		$this->load->view('common/footer');
	}


	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($id) {
				$response = $this->member_model->deleteMember($id);
				echo json_encode($response);
			}
		}
	}

}

/* End of file slider.php */
/* Location: ./application/controllers/module/slider.php */