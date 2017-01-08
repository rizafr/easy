<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_controller extends CI_Controller {

	public $site_title, $path, $dir, $language_id;

	public function __construct()
	{
		session_start();
		ob_start();
		
		parent::__construct();

		$this->site_title = 'IZI | Memudahkan Dimudahkan';

		$this->language_id = isset($_SESSION['language_id']) ? $_SESSION['language_id'] : $this->get_default_language();

		date_default_timezone_set('Asia/Jakarta');
		
		$fcpath = str_replace('\\', '/', FCPATH);

		$this->path = $fcpath;
		$this->dir = base_url();

		//echo $this->path . '<br>' . $this->dir; exit();
	}

	private function get_default_language()
	{
		$this->load->model('pages/pages_model');
		$language = $this->pages_model->getPageLanguage(NULL,TRUE);
		if ($language) {
			return $language[0]->page_language_id;
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */