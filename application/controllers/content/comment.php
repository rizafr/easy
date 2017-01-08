<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('pages/pages_model');
	}

	public function index($guid)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;

			$response['notify'] = 'comment failed to be sent';

			$name = trim($this->input->post('name'));
			$email = trim($this->input->post('email'));
			$message = trim($this->input->post('message'));
			$page_id = $this->input->post('page_id');
			$parent = $this->input->post('parent') ? $this->input->post('parent') : NULL;

			if (!$name) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'name',
											'message'	=> 'Name required'
										);
			} else if (preg_match('/[^a-z0-9 \-\_\@\.\,]/im', $name)) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'name',
											'message'	=> 'Name is not valid. only letters and numbers are allowed'
										);
			}
			
			if (!$message) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'message',
											'message'	=> 'Message required'
										);
			} else if (preg_match('/[^a-z0-9 \-\_\@\.\,]/im', $message)) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'message',
											'message'	=> 'Message is not valid. only letters and numbers are allowed'
										);
			}

			if (!$email) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'email',
											'message'	=> 'Email required'
										);
			} else if (preg_match('/[^a-z0-9 \-\_\@\.\,]/im', $email)) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'email',
											'message'	=> 'Email is not valid. only letters and numbers are allowed'
										);
			} else if (filter_var($email,FILTER_VALIDATE_EMAIL) === FALSE) {
				$success = FALSE;
				$response['message'][] = array(
											'target'	=> 'email',
											'message'	=> 'Email is not valid. email format not valid'
										);
			}

			if ($success) {
				$data_comment = array(
									'parent_comment_id'	=> $parent,
									'page_id'			=> $page_id,
									'name'				=> $name,
									'email'				=> $email,
									'message'			=> $message,
									'publish'			=> FALSE
								);
				$result = $this->pages_model->setCommentData($data_comment);

				if ($result['success']) {
					$response['notify'] = 'comment has been sent';
				} else {
					$success = FALSE;
					$response['notify'] = 'comment failed to be sent';
				}
			}

			$response['success'] = $success;

			echo json_encode($response);
		}
	}
}

/* End of file comment.php */
/* Location: ./application/controllers/content/comment.php */