<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends MY_Model {

	private $member, $field, $email;

	public function __construct()
	{
		parent::__construct();
		
		$this->member = "`member`";
		$this->email = "`email_bank`";
	}

	public function login($token)
	{
		$this->field = array(
							$this->member . '.' . '`member_id`',
							$this->member . '.' . '`first_name`',
							$this->member . '.' . '`last_name`',
							$this->member . '.' . '`address`',
							$this->member . '.' . '`contact`',
							$this->member . '.' . '`profile`',
							$this->member . '.' . '`email`',
							$this->member . '.' . '`password`',
							$this->member . '.' . '`activation_code`',
							$this->member . '.' . '`active`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->member);

		$this->db->where($this->member . '.' . '`izitoken`',$token);
// 		$this->db->where($this->member . '.' . '`password`',$password);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}
	
	public function checkAccount($email, $code=NULL)
	{
		$this->field = array(
				$this->member . '.' . '`member_id`',
				$this->member . '.' . '`first_name`',
				$this->member . '.' . '`last_name`',
				$this->member . '.' . '`address`',
				$this->member . '.' . '`contact`',
				$this->member . '.' . '`profile`',
				$this->member . '.' . '`email`',
				$this->member . '.' . '`activation_code`',
				$this->member . '.' . '`active`'
		);
	
		$this->db->select($this->field, FALSE);
	
		$this->db->from($this->member);
	
		$this->db->where($this->member . '.' . '`email`',$email);
// 		$this->db->where($this->member . '.' . '`activation_code`',$code);
	
		$query = $this->db->get();
	
		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getMember($id)
	{
		$this->field = array(
							$this->member . '.' . '`member_id`',
							$this->member . '.' . '`first_name`',
							$this->member . '.' . '`last_name`',
							$this->member . '.' . '`address`',
							$this->member . '.' . '`contact`',
							$this->member . '.' . '`profile`',
							$this->member . '.' . '`email`',
							$this->member . '.' . '`username`',
// 							$this->member . '.' . '`password`',
							$this->member . '.' . '`izitoken`',
							$this->member . '.' . '`active`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->member);

		$this->db->where($this->member . '.' . '`member_id`',$id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getMemberByUsername($username)
	{
		$this->field = array(
							$this->member . '.' . '`member_id`',
							$this->member . '.' . '`first_name`',
							$this->member . '.' . '`last_name`',
							$this->member . '.' . '`address`',
							$this->member . '.' . '`contact`',
							$this->member . '.' . '`profile`',
							$this->member . '.' . '`email`',
							$this->member . '.' . '`username`',
							$this->member . '.' . '`password`',
							$this->member . '.' . '`activation_code`',
							$this->member . '.' . '`active`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->member);

		$this->db->where($this->member . '.' . '`username`',$username);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getMemberByEmail($email)
	{
		$this->field = array(
							$this->member . '.' . '`member_id`',
							$this->member . '.' . '`first_name`',
							$this->member . '.' . '`last_name`',
							$this->member . '.' . '`address`',
							$this->member . '.' . '`contact`',
							$this->member . '.' . '`profile`',
							$this->member . '.' . '`email`',
							$this->member . '.' . '`username`',
							$this->member . '.' . '`password`',
							$this->member . '.' . '`activation_code`',
							$this->member . '.' . '`active`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->member);

		$this->db->where($this->member . '.' . '`email`',$email);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}
	
	public function getExistEmail($email)
	{
		$this->field = array(
				$this->email . '.' . '`email_id`',
				$this->email . '.' . '`email`',
				$this->email . '.' . '`date`'
		);
	
		$this->db->select($this->field, FALSE);
	
		$this->db->from($this->email);
	
		$this->db->where($this->email . '.' . '`email`',$email);
	
		$query = $this->db->get();
	
		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}
	
	public function setMember($data)
	{
		if ($data) {
			$query = $this->db->insert($this->member, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setEmail($data)
	{
		if ($data) {
			$query = $this->db->insert($this->email, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function updateMember($id,$data)
	{
		if ($id && $data) {
			$this->db->where('member_id', $id);
			$query = $this->db->update($this->member, $data);
	
			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file member_model.php */
/* Location: ./application/models/member/member_model.php */