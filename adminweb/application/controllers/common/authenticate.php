<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authenticate extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('user/user_model');
	}

	public function login()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$redirect = base_url() . 'login';

			$captcha = $this->input->post('captcha');

			if ($captcha && isset($_SESSION['captcha_login']) && strtolower($captcha) === strtolower($_SESSION['captcha_login'])) {

				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));

				if ($username && $password) {
					$result = $this->user_model->login($username,$password);

					if ($result) {
						$_SESSION['admin_login']['active'] = TRUE;
						$_SESSION['admin_login']['user_id'] = $result->user_id;
						$_SESSION['admin_login']['user_level_id'] = $result->user_level_id;
						$_SESSION['admin_login']['full_name'] = $result->full_name;
						$_SESSION['admin_login']['user_level'] = $result->user_level;

						if (isset($_SESSION['captcha_login'])) {
							unset($_SESSION['captcha_login']);
						}

						$redirect = base_url();

					} else {
						$_SESSION['message']['login'] = array(
													'type'		=> 'nFailed', 
													'message'	=> 'Login failed: Username or Password Invalid'
												);
					}
				} else {
					$_SESSION['message']['login'] = array(
												'type'		=> 'nFailed', 
												'message'	=> 'Login failed: Username and Password Required'
											);
				}

			} else {
				$_SESSION['message']['login'] = array(
											'type'		=> 'nFailed', 
											'message'	=> 'Login failed: Captcha Invalid'
										);
			}

			redirect($redirect);
		}
	}

	public function logout()
	{
		if (isset($_SESSION['admin_login'])) {
			unset($_SESSION['admin_login']);
		}
		redirect(base_url());
	}

}

/* End of file authenticate.php */
/* Location: ./application/controllers/common/authenticate.php */