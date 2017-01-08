<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();
	}

	public function index($guid)
	{
		//load our new Captcha library
		$this->load->library('SimpleCaptcha');

		$captcha = new SimpleCaptcha();
		// Image generation
		$captcha->wordsFile = 'words/ens.php';
		$captcha->session_var = 'captcha_' . str_replace('-', '_', $guid);

		$captcha->CreateImage();
	}
}

/* End of file captcha.php */
/* Location: ./application/controllers/content/captcha.php */