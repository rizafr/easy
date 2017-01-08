<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends MY_Model {

	private $user, $role, $profile, $category, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->user = "`member_user`";
		$this->role = "`member_role`";
		$this->profile = "`member_profile`";
		$this->category = "`business_category`";
		$this->field = NULL;
	}

	public function Login($username,$password)
	{
		$this->field = array(
							$this->user . '.' . '`user_id`',
							$this->user . '.' . '`status`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user);
		$this->db->join($this->role, $this->user . '.' . '`role_id`' . ' = ' . $this->role . '.' . '`role_id`', '', FALSE);

		$this->db->where($this->role . '.' . '`role`','member');
		$this->db->where('`username`',$username);
		$this->db->where('`password`',$password);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getUser($id = NULL, $status = NULL)
	{
		$this->field = array(
							$this->user . '.' . '`user_id`',
							$this->user . '.' . '`role_id`',
							$this->user . '.' . '`username` AS `user_username`',
							$this->user . '.' . '`password` AS `user_password`',
							$this->user . '.' . '`email` AS `user_email`',
							$this->user . '.' . '`fullname` AS `user_fullname`',
							$this->user . '.' . '`status` AS `user_status`',

							$this->user . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%d %M %Y %H:%i:%s") AS `date_created_format`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%d %M %Y") AS `date_created_short`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%W, %d %M %Y %H:%i:%s") AS `date_created_long`',

							$this->role . '.' . '`name` AS `role_name`',
							$this->role . '.' . '`role` AS `user_role`',

							$this->profile . '.' . '`category_id`',
							$this->profile . '.' . '`profile_id`',
							$this->profile . '.' . '`name` AS `profile_name`',
							$this->profile . '.' . '`address` AS `profile_address`',
							$this->profile . '.' . '`contact` AS `profile_contact`',
							$this->profile . '.' . '`website` AS `profile_website`',
							$this->profile . '.' . '`reseller_ready` AS `profile_reseller`',
							$this->profile . '.' . '`investment_ready` AS `profile_investment`',
							$this->profile . '.' . '`apprentice_ready` AS `profile_apprentice`',

							$this->category . '.' . '`name` AS `category_name`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user);
		$this->db->join($this->role, $this->user . '.' . '`role_id`' . ' = ' . $this->role . '.' . '`role_id`', '', FALSE);
		$this->db->join($this->profile, $this->user . '.' . '`user_id`' . ' = ' . $this->profile . '.' . '`user_id`', 'LEFT', FALSE);
		$this->db->join($this->category, $this->profile . '.' . '`category_id`' . ' = ' . $this->category . '.' . '`category_id`', 'LEFT', FALSE);

		if ($id) {
			$this->db->where($this->user . '.' . '`user_id`', $id);
		}

		if ($status) {
			$this->db->where($this->user . '.' . '`status`', $status);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $id ? $query->row_object() : $query->result_object();
		}
	}

	public function setUser($data)
	{
		if ($data) {
			$query = $this->db->insert($this->user, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'add process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateUser($id,$data)
	{
		if ($id && $data) {
			$this->db->where('user_id', $id);
			$query = $this->db->update($this->user, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file user_model.php */
/* Location: ./application/models/member/user_model.php */