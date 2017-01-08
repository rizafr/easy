<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends UI_Controller {

	public function __construct()
	{	
		parent::__construct();
	}

	public function index()
	{
		$data = array();

		$data['menu'] = 'dashboard-menu';

		$this->load->view('common/header',$data);
		$this->load->view('common/index');
		$this->load->view('common/footer');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/common/dashboard.php */