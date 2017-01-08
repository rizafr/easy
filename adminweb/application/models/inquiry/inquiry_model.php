<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllInquiry($table)
	{
		$this->db->select('*', FALSE);

		$this->db->from($table);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getDetailInquiry($table, $id)
	{
		$this->db->select('*', FALSE);

		$this->db->from($table);

		$this->db->where($table . '.' . '`form_id`', $id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function deleteInquiry($table, $id)
	{
		if ($table && $id) {
			$this->db->where($table . '.' . '`form_id`', $id);
			$query = $this->db->delete($table);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete inquiry process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete inquiry process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file inquiry_model.php */
/* Location: ./application/models/inquiry/inquiry_model.php */