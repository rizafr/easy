<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nisab_model extends MY_Model {

	private $nisab;

	public function __construct()
	{
		parent::__construct();
		
		$this->nisab = "`nisab`";
		
		$this->field = NULL;
	}

	public function getNisab()
	{
			$this->field = array(
								$this->nisab . '.' . '`nisab_id`',
								$this->nisab . '.' . '`nisab_base`',
					
					'DATE_FORMAT(' . $this->nisab . '.' . '`update_date`,"%d %M %Y") AS `date_created_shorts`',
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->nisab);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
	}

	public function setNisab($data)
	{
		if ($data) {
			$query = $this->db->insert($this->nisab, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateNisab($id, $data)
	{
		if ($id && $data) {
			$this->db->where($this->nisab. '.' . '`nisab_id`', $id);
			$query = $this->db->update($this->nisab, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function deleteNisab($id)
	{
		if ($id) {
			$this->db->where('nisab_id', $id);
			$query = $this->db->delete($this->nisab);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file donate_model.php */
/* Location: ./application/models/module/donate_model.php */