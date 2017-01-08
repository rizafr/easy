<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_controller extends CI_Controller {

	public $admin_site, $path, $dir, $upload_path, $upload_dir, $site_title, $default_title, $user_id;

	public function __construct()
	{
		session_start();
		ob_start();
		
		parent::__construct();

		$this->admin_site = 'adminweb';
		$this->site_title = 'Administrator';
		$this->default_title = 'Administrator';

		$fcpath = str_replace('\\', '/', FCPATH);

		$admin_path = explode($this->admin_site,$fcpath);
		$admin_dir = explode($this->admin_site, base_url());

		$this->path = $this->admin_site ? $admin_path[0] : $fcpath;
		$this->dir = $this->admin_site ? $admin_dir[0] : base_url();

		$this->upload_path = $this->path . 'uploads/';
		$this->upload_dir = $this->dir . 'uploads/';

		date_default_timezone_set('Asia/Jakarta');
		
		//echo $this->path . '<br>' . $this->dir; exit();
	}

}

class UI_controller extends MY_controller {

	public function __construct()
	{
		parent::__construct();

		if ( ! isset($_SESSION['admin_login']) ) {
			redirect(base_url() . 'login');
			exit();
		}

		$this->user_id = isset($_SESSION['admin_login']['user_id']) ? $_SESSION['admin_login']['user_id'] : '';
		$this->level_id = isset($_SESSION['admin_login']['user_level_id']) ? $_SESSION['admin_login']['user_level_id'] : '';
		$this->full_name = isset($_SESSION['admin_login']['full_name']) ? $_SESSION['admin_login']['full_name'] : '';
		$this->level_name = isset($_SESSION['admin_login']['user_level']) ? $_SESSION['admin_login']['user_level'] : '';
		$this->is_super = strtolower($this->level_name) === 'superadmin' || strtolower($this->level_name) === 'super admin' ? TRUE : FALSE;
	}

}

class IO_controller extends MY_controller {

	public function __construct()
	{
		parent::__construct();

		if ( ! isset($_SESSION['admin_login']) ) {
			$response = array(
							'response'	=> FALSE,
							'message'	=> 'Authenticate Failed.'
						);
			echo json_encode($response);
			exit();
		}

		$this->user_id = isset($_SESSION['admin_login']['user_id']) ? $_SESSION['admin_login']['user_id'] : '';
		$this->level_id = isset($_SESSION['admin_login']['user_level_id']) ? $_SESSION['admin_login']['user_level_id'] : '';
		$this->full_name = isset($_SESSION['admin_login']['full_name']) ? $_SESSION['admin_login']['full_name'] : '';
		$this->level_name = isset($_SESSION['admin_login']['user_level']) ? $_SESSION['admin_login']['user_level'] : '';
		$this->is_super = strtolower($this->level_name) === 'superadmin' || strtolower($this->level_name) === 'super admin' ? TRUE : FALSE;
	}
}

class Login_controller extends MY_controller {

	public function __construct()
	{
		parent::__construct();

		if ( isset($_SESSION['admin_login']) ) {
			redirect(base_url());
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */