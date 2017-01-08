<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();
	}

	public function index($error = NULL)
	{
		$this->load->view('common/error_404');
	}

}

/* End of file error.php */
/* Location: ./application/controllers/common/error.php */