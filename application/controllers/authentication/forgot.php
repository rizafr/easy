<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends MY_controller {

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

			$email = trim($this->input->post('email'));

			if ($email) {
				$result = $this->member_model->getMemberByEmail($email);

				if ($result) {
					$update = $this->member_model->updateMember($result->member_id, array("active"=>0));
					$subject = "IZI Password Reset";
					$messages = "<html><div>Klik link dibawah ini untuk mengganti password :</p><br />".base_url()."mypassword/reset?email=".$email."&code=".$result->activation_code."</div></html>";
// 					$send_email = $this->member_model->sendMail("",$email,$message, $subject);
					$send_email = $this->sendMail($email, $messages, $subject);
					if($send_email==FALSE) {
						$success = FALSE;
						$message = "can't send an email";
					}
				} else {
					$success = FALSE;
					$message = 'wrong email or not found';
				}
			} else {
				$success = FALSE;
				$message = 'email required';
			}

			$response = array(
							'success'	=> $success,
							'message'	=> $message
						);
			
			if ($success) {
				$response['redirect'] = base_url() . 'home';
			}
			
			echo json_encode($response);
		}
	}
	
	private function sendMail($to, $message, $subject, $attached=NULL)
	{
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',//'ssl://cyberpkpu.gugahnurani.com',
				'smtp_port' => 465,
				'smtp_user' => 'iziorg2016@gmail.com',//'hi@izi.or.id',
				'smtp_pass' => '@1nisiatif',//'@1zi123',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'priority' => '2',
				'wordwrap' => TRUE
		);
	
		$this->load->library('email', $config);
		$this->email->clear(TRUE);
		$this->email->set_newline("\r\n");
		$this->email->from('salam@izi.or.id','noreply@izi.or.id'); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		if($attached) $this->email->attach($attached);
		if($this->email->send())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
			//show_error($this->email->print_debugger());
		}
	
	}

}

/* End of file login.php */
/* Location: ./application/controllers/authentication/login.php */