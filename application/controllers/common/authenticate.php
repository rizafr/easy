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

			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$result = $this->user_model->login($username,$password);

			if ($result) {
				$_SESSION['admin_login']['active'] = TRUE;
				$_SESSION['admin_login']['id'] = $result->user_id;
				redirect(base_url());
			} else {
				$_SESSION['message']['login'] = array(
											'type' => 'nFailed', 
											'message' => 'login failed. username or password invalid'
										);
				redirect(base_url() . 'login');
			}

			echo json_encode($result);

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