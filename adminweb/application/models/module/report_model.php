<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends MY_Model {

	private $report, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->report = "`report`";
		$this->field = NULL;
	}

	public function getAllReport()
	{
		$this->field = array(
							$this->report . '.' . '`report_id`',
							$this->report . '.' . '`title`',
							$this->report . '.' . '`description`',
							$this->report . '.' . '`url`',
							$this->report . '.' . '`type`',
							$this->report . '.' . '`date`',
				
				'DATE_FORMAT(' . $this->report . '.' . '`date`' . ',"%d %M %Y") AS date_string',
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->report);

		$this->db->order_by($this->report . '.' . '`report_id`','DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getReport($id)
	{
		if ($id) {
			$this->field = array(
							$this->report . '.' . '`report_id`',
							$this->report . '.' . '`title`',
							$this->report . '.' . '`description`',
							$this->report . '.' . '`url`',
							$this->report . '.' . '`type`',
							$this->report . '.' . '`date`',
					
					'DATE_FORMAT(' . $this->report . '.' . '`date`' . ',"%d %M %Y") AS date_string',
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->report);

			$this->db->where($this->report . '.' . '`report_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function setReport($data)
	{
		if ($data) {
			$query = $this->db->insert($this->report, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	public function updateReport($id, $data)
	{
		if ($id && $data) {
			$this->db->where($this->report . '.' . '`report_id`', $id);
			$query = $this->db->update($this->report, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteReport($id)
	{
		if ($id) {
			$this->db->where('report_id', $id);
			$query = $this->db->delete($this->report);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
}

/* End of file slider_model.php */
/* Location: ./application/models/module/slider_model.php */