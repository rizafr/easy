<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Language extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('pages/pages_model');
	}

	public function index()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['menu'] = 'settings-menu';

		$data['language'] = $this->pages_model->getPageLanguage();

		$this->load->view('common/header',$data);
		$this->load->view('settings/language/index');
		$this->load->view('common/footer');
	}
}

/* End of file settings_language.php */
/* Location: ./application/controllers/settings/settings_language.php */