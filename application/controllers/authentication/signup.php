<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SignUp extends MY_controller {

	public function __construct()
	{	
		parent::__construct();
		
		$this->load->helper('email');

		$this->load->model('member/member_model');
	}

	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			$success = TRUE;
			$message = '';
			$position = '';
			$redirect = '';
			
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$passwordConfirm = $this->input->post('passconf');
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$nokontak = $this->input->post('nokontak');
			$address = $this->input->post('address');
			$cabang = $this->input->post('cabang');
			$username = $this->input->post('username');

			if ($success) {
				if($firstname) {
					$success = TRUE;
				}
				else {
					$success = FALSE;
					$message = 'Nama depan harus diisi';
					$position = 'firstname';
				}
			}
			
			if ($success) {
				if($lastname) {
					$success = TRUE;
				}
				else {
					$success = FALSE;
					$message = 'Nama belakang harus diisi';
					$position = 'lastname';
				}
			}
			
			if ($success) {
				if($email) {
					$check_email = $this->member_model->getMemberByEmail($email);
					if ($check_email) {
						$success = FALSE;
						$message = 'Email sudah terdaftar. Silahkan gunakan Email lain.';
						$position = 'email';
					}
				}
				else {
					$success = FALSE;
					$message = 'Email harus diisi';
					$position = 'email';
				}
			}
				
			if ($success) {
				if (!valid_email($email)) {
					$success = FALSE;
					$message = 'Format Email salah. Silahkan periksa format Email.';
					$position = 'email';
				}
			}
			
			if ($success) {
				if($username) {
					$success = TRUE;
				}
				else {
					$success = FALSE;
					$message = 'Nama belakang harus diisi';
					$position = 'username';
				}
			}

			if ($success) {
				if($passwordConfirm && $password) {
					if ($password !== $passwordConfirm) {
						$success = FALSE;
						$message = 'Konfirmasi Password tidak sesuai.';
						$position = 'password';
					}
				}
				else {
					$success = FALSE;
					$message = 'Password & Re-Enter Password Harus diisi.';
					$position = 'password';
				}
			}

			if ($success) {
				
				$form_url = "https://api.c27g.com/donor/v1/user/register";
				
				$data_to_post = array();
				$data_to_post['token'] = 'LokSQIST15dR0bYbi4TgHWewpnBFnyjP';
				$data_to_post['email'] = $email;
				$data_to_post['passwd'] = $password;
				$data_to_post['full_name'] = $firstname.' '.$lastname;
				$data_to_post['branch_id'] = $cabang;
				
				// Initialize cURL
				$curl = curl_init();
				
				curl_setopt($curl,CURLOPT_URL, $form_url);
				curl_setopt($curl,CURLOPT_POST, sizeof($data_to_post));
				curl_setopt($curl,CURLOPT_POSTFIELDS, $data_to_post);
				curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($curl);
				curl_close($curl);
				
				$obj = json_decode($result);
				
				if($obj->{'status'} == 406) {
					$success = FALSE;
					foreach($obj->message as $value)
					{ $message = "Anda telah terdaftar sebagai donatur PKPU, silahkan login menggunakan email & password akun tersebut";}
					//$message = $obj->{'message'};
					$position = 'other';
				}
				
				if($obj->{'status'} == 200) {
				
				$hash = md5( rand(0,1000) );
				$data = array(
							'first_name'		=> $firstname,
							'last_name'			=> $lastname,
							'contact'			=> $nokontak,
							'address'			=> $address,
							'email'				=> $email,
							'username'			=> $username,
// 							'password'			=> md5($password),
							'branch'			=> $cabang,
							'active'			=> '2',
							'activation_code'	=> $hash
						);

				$result = $this->member_model->setMember($data);
				if ($result['success']) {
					$member_id = $result['insert_id'];
					$_SESSION['login']['profile']['user_id'] = $member_id;		
					$success = TRUE;
					$redirect = base_url().'myaccount';
					
				} else {
					$success = FALSE;
					foreach($obj->message as $value)
					{ $message = "Anda telah terdaftar sebagai donatur PKPU, silahkan login menggunakan email & password akun tersebut";}
					//$message = 'Maaf, proses registrasi gagal. '.$obj->{'message'};
					$position = 'other';
				}
			}
			else {
				$success = FALSE;
				foreach($obj->message as $value)
				{ $message = "Anda telah terdaftar sebagai donatur PKPU, silahkan login menggunakan email & password akun tersebut";}
				//$message = 'Maaf, proses registrasi gagal.'.$obj->{'message'};
				$position = 'other';
			}
		}

			$response = array(
							'success'	=> $success,
							'position'	=> $position,
							'message'	=> $message,
							'redirect'  => $redirect
						);
			echo json_encode($response);
		}
	}

}

/* End of file signup.php */
/* Location: ./application/controllers/authentication/signup.php */