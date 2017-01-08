<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('member/member_model');
	}

	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$message = '';
			$redirect = '';

			$email = trim($this->input->post('username'));
			$password = trim($this->input->post('password'));

			if ($email && $password) {
				/*$result = $this->member_model->login($email,md5($password));
				if ($result) {
					if($result->active > 0) {
						$_SESSION['login']['profile']['user_id'] = $result->member_id;
						$message = 'login successed';
					}
					else {
						$success = FALSE;
						$message = 'please verify your account from email';
					}					
				} else {*/
					
					$form_url = "https://api.c27g.com/donor/v1/user/login";
					
					$data_to_post = array();
					$data_to_post['username'] = $email;
					$data_to_post['password'] = $password;
					
					// Initialize cURL
					$curl = curl_init();
					
					curl_setopt($curl,CURLOPT_URL, $form_url);
					curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
					curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
					$izitoken = curl_exec($curl);
					curl_close($curl);	
					if(strlen($izitoken)>=66) {
						$success = FALSE;
						$message = 'email or password invalid';
// 						echo json_encode($izitoken);exit();
					}
					else {
// 						user avalaible
						$izitoken = str_replace('"', '', $izitoken);
						
						$checkifexist = $this->member_model->login($izitoken);
						if ($checkifexist) {
								$_SESSION['login']['profile']['user_id'] = $checkifexist->member_id;
								$message = 'login success';
// 								$redirect = base_url() . 'myaccount';
							}
							else {
								$form_url = "https://api.c27g.com/donor/v1/profiles?access-token=".$izitoken;
								// Initialize cURL
								$curl = curl_init();
								
								curl_setopt($curl,CURLOPT_URL, $form_url);
								curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
								$profiles = curl_exec($curl);
								curl_close($curl);
								
								$obj = json_decode($profiles, true);
								
								$fullname = explode(" ",$obj[0]['full_name']);
								
								$firstname = $fullname[0];
								$lastname = '';
								if(count($fullname) > 2) {
									unset($fullname[0]);
									$lastname = implode(" ",$fullname);
								}
								else $lastname = $fullname[1];
								
								$data = array(
										'first_name'		=> $firstname,
										'last_name'			=> $lastname,
										'email'				=> $obj[0]['email'],
										'branch'			=> $obj[0]['branch_id'],
										'active'			=> '2',
										'izitoken'			=> $izitoken
								);
								
								$result = $this->member_model->setMember($data);
								if ($result['success']) {
									$success = TRUE;
									$member_id = $result['insert_id'];
									$_SESSION['login']['profile']['user_id'] = $member_id;
									$message = 'login success';
// 									$redirect = base_url() . 'myaccount';
								
								} else {
									$success = FALSE;
									$message = 'email or password invalid';
								}
							}
						}
			} else {
				$success = FALSE;
				$message = 'email and password required';
			}

			$response = array(
							'success'	=> $success,
							'message'	=> $message,
// 							'redirect'	=> $redirect
						);
			
			if ($success) {
				$verified = $this->member_model->checkAccount($email);
				if($verified)
				{
					if($verified->active == 2) {
						$result = $this->member_model->updateMember($verified->member_id, array("active"=>1));
					}
				}
				$response['redirect'] = base_url() . 'myaccount';
			}
			
			echo json_encode($response);
		}
	}

}

/* End of file login.php */
/* Location: ./application/controllers/authentication/login.php */