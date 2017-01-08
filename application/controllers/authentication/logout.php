<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_controller {

	public function __construct()
	{	
		parent::__construct();
	}

	public function index()
	{
		if (isset($_SESSION['login']['profile'])) {
			unset($_SESSION['login']['profile']);
		}

		redirect(base_url());
	}

}

/* End of file logout.php */
/* Location: ./application/controllers/authentication/logout.php */