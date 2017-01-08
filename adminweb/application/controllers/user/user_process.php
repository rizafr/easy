<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Process extends IO_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('user/user_model');
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			$full_name = $this->input->post('full_name');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$level = $this->input->post('level');

			$data = array(
						'full_name'		=> $full_name,
						'email'			=> $email,
						'username'		=> $username,
						'password'		=> md5($password),
						'user_level_id'	=> $level,
						'status'		=> TRUE
					);

			$result = $this->user_model->setUser($data);

			if ( ! $result['success'] ) {
				$success = FALSE;
			}

			if ($success) {
				$message['success'][] = 'User data has been created';
				$this->db->trans_commit();
			} else {
				$error = $result['errno'] == '1062' ? 'username already registered' : '';
				$message['notify'][] = 'User data failed to be created. ' . $error;
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function edit($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$page_id = $this->input->post('id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if ($id === $page_id) {

				$full_name = trim($this->input->post('full_name'));
				$email = trim($this->input->post('email'));
				$username = trim($this->input->post('username'));
				$password = trim($this->input->post('password'));
				$level = $this->input->post('level');

				if (! $full_name) {
					$success = FALSE;
					$message['notify'][] = 'Full Name is required';	
				}

				if (! $username) {
					$success = FALSE;
					$message['notify'][] = 'Username is required';	
				}

				if (! $password) {
					$success = FALSE;
					$message['notify'][] = 'Password is required';	
				}

				if ($success) {

					$data = array(
								'full_name'		=> $full_name,
								'email'			=> $email,
								'username'		=> $username
							);

					if ($password) {
						$data['password'] = md5($password);
					}

					if ($level) {
						$data['user_level_id'] = $level;
					}

					$result = $this->user_model->updateUser($id,$data);

					if ( ! $result['success'] ) {
						$success = FALSE;
					}
				}
			}

			if ($success) {
				$message['success'][] = 'User data has been updated';
				$this->db->trans_commit();
			} else {
				$error = $result['errno'] == '1062' ? 'username already registered' : '';
				$message['notify'][] = 'User data failed to be updated. ' . $error;
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);

		}
	}

	public function delete($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			if ($id) {
				$response = $this->user_model->deleteUser($id);
				echo json_encode($response);
			}
		}
	}

	public function add_level()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			$level = $this->input->post('level');
			$access = $this->input->post('access');

			$data = array(
						'name'		=> $level
					);

			$result = $this->user_model->setUserLevel($data);

			if ($result['success']) {
				$id = $result['insert_id'];

				$access = $this->input->post('access');
				$new_access = array();

				if ($access) {
					foreach ($access as $key => $value) {
						$item = array(
									'user_level_id'	=> $id,
									'page_id'		=> $value
								);
						array_push($new_access, $item);
					}

					if ( ! empty($new_access)) {
						$result = $this->user_model->setUserAccess($new_access);
						if ( ! $result['success']) {
							$success = FALSE;
							$message['notify'][] = 'User Access data failed to be updated';
						}
					}
				}
			} else {
				$success = FALSE;
			}

			if ($success) {
				$message['success'][] = 'User Level data has been created';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'User Level data failed to be created';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);
		}
	}

	public function edit_level($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$page_id = $this->input->post('id');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if ($id === $page_id) {

				$level = $this->input->post('level');

				$data = array(
							'name'		=> $level
						);

				$result = $this->user_model->updateUserLevel($id,$data);

				if ( ! $result['success'] ) {
					$success = FALSE;
				}

				$access = $this->input->post('access');

				$result = $this->user_model->clearUserAccess($id,$access);

				$old_access = array();
				$new_access = array();
				$user_access = $this->user_model->getUserAccess($id);

				if ($user_access) {
					foreach ($user_access as $key => $value) {
						array_push($old_access, $value->user_page);
					}
				}

				if ($access) {
					foreach ($access as $key => $value) {
						$item = array(
									'user_level_id'	=> $id,
									'page_id'		=> $value
								);
						if (empty($old_access)) {
							array_push($new_access, $item);
						} else if ( ! in_array($value, $old_access)) {
							array_push($new_access, $item);
						}
					}

					if ( ! empty($new_access)) {
						$result = $this->user_model->setUserAccess($new_access);
						if ( ! $result['success']) {
							$success = FALSE;
							$message['notify'][] = 'User Access data failed to be updated';
						}
					}
				}
			}

			if ($success) {
				$message['success'][] = 'User Level data has been updated';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'User Level data failed to be updated';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);

		}
	}

	public function delete_level($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			if ($id) {
				$response = $this->user_model->deleteUserLevel($id);
				echo json_encode($response);
			}
		}
	}
}

/* End of file user_process.php */
/* Location: ./application/controllers/user/user_process.php */