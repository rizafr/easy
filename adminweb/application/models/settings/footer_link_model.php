<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footer_Link_Model extends MY_Model {

	private $table, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->table = "`setting_footer_link`";
		$this->field = array(
							'`setting_id`',
							'`image`',
							'`title`',
							'`url`'
						);
	}

	public function get($id = NULL)
	{
		$this->db->select($this->field, FALSE);

		$this->db->from($this->table);

		if ($id) {
			$this->db->where('`setting_id`', $id);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $id ? $query->row_object() : $query->result_object();
		}
	}

	public function set($data)
	{
		if ($data) {
			$query = $this->db->insert($this->table, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'add process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function update($id,$data)
	{
		if ($id && $data) {
			$this->db->where('setting_id', $id);
			$query = $this->db->update($this->table, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function delete($id)
	{
		if ($id) {
			$this->db->where_in('setting_id',$id);
			$query = $this->db->delete($this->table);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}
