<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch_model extends MY_Model {

	private $branch, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->branch = "`cabang`";
	}

	public function get_branch($id=NULL, $role=NULL)
	{
		$this->field = array(
							$this->branch . '.' . '`cabang_id`',
							$this->branch . '.' . '`name`',
							$this->branch . '.' . '`location`',
							$this->branch . '.' . '`display`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->branch);

		if($id) $this->db->where($this->branch . '.' . '`cabang_id`',$id);
		if($role) $this->db->where($this->branch . '.' . '`display`',$role);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $id ? $query->row_object() : $query->result_object();
		}
	}


	public function setCabang($data)
	{
		if ($data) {
			$query = $this->db->insert($this->branch, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function updateCabang($id,$data)
	{
		if ($id && $data) {
			$this->db->where('cabang_id', $id);
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