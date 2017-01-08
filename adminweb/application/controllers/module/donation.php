<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('module/donate_model');
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

		$data['donation'] = $this->donate_model->getAllDonate();

		$this->load->view('common/header',$data);
		$this->load->view('module/donate/index');
		$this->load->view('common/footer');
	}

	public function edit($id)
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$data['id'] = $id;
		if ($id) {
			$data['donate'] = $this->donate_model->getDonate($id);
// 			echo json_encode($data['donate']); exit();
			$this->load->view('common/header',$data);
			$this->load->view('module/donate/edit');
			$this->load->view('common/footer');
		}
	}

}

/* End of file slider.php */
/* Location: ./application/controllers/module/slider.php */