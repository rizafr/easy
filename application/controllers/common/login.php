<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Login_Controller {

	public function __construct()
	{	
		parent::__construct();
	}

	public function index()
	{
		$data = array();

		$this->load->view('common/login');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/common/login.php */