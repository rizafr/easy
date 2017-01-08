<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends MY_Model {

	private $member, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->member = "`member`";
	}
	
	public function getAllMember()
	{
		$this->field = array(
				$this->member . '.' . '`member_id`',
				$this->member . '.' . '`first_name`',
				$this->member . '.' . '`last_name`',
				$this->member . '.' . '`address`',
				$this->member . '.' . '`contact`',
				$this->member . '.' . '`profile`',
				$this->member . '.' . '`email`'
// 				$this->member . '.' . '`username`',
// 				$this->member . '.' . '`password`',
// 				$this->member . '.' . '`activation_code`',
// 				$this->member . '.' . '`active`'
		);
	
		$this->db->select($this->field, FALSE);
	
		$this->db->from($this->member);
		
		$this->db->order_by($this->member . '.' . '`member_id`','DESC');
	
		$query = $this->db->get();
	
		if ($query && $query->num_rows()) {
			return $query->result_object();
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
// 							$this->member . '.' . '`activation_code`',
// 							$this->member . '.' . '`active`'
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
	
	public function deleteMember($id)
	{
		if ($id) {
			$this->db->where('member_id', $id);
			$query = $this->db->delete($this->member);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file member_model.php */
/* Location: ./application/models/member/member_model.php */