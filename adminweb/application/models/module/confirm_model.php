<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm_model extends MY_Model {

	private $confirm, $donate, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->donate = "`donate`";
		$this->confirm = "`confirm`";
		
		$this->field = NULL;
	}

	public function getAllConfirm()
	{
		$this->field = array(
							$this->confirm . '.' . '`confirm_id`',
							$this->confirm . '.' . '`member_id`',
							$this->confirm . '.' . '`jenis`',
							$this->confirm . '.' . '`name`',
							$this->confirm . '.' . '`frombank`',
							$this->confirm . '.' . '`tobank`',
							$this->confirm . '.' . '`date`',
							$this->confirm . '.' . '`email`',
							$this->confirm . '.' . '`note`',
							$this->confirm . '.' . '`amount`',
							$this->confirm . '.' . '`contact`',
							$this->confirm . '.' . '`branch_id`',
							$this->confirm . '.' . '`status`',
				'DATE_FORMAT(' . $this->confirm . '.' . '`date`,"%d %M %Y") AS `date_created_shorts`',
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->confirm);	
		$this->db->order_by($this->confirm . '.' . '`confirm_id`', 'DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}
	
	public function getConfirm($id)
	{
		$this->field = array(
				$this->confirm . '.' . '`confirm_id`',
				$this->confirm . '.' . '`member_id`',
				$this->confirm . '.' . '`jenis`',
				$this->confirm . '.' . '`name`',
				$this->confirm . '.' . '`frombank`',
				$this->confirm . '.' . '`tobank`',
				$this->confirm . '.' . '`date`',
				$this->confirm . '.' . '`email`',
				$this->confirm . '.' . '`note`',
				$this->confirm . '.' . '`amount`',
				$this->confirm . '.' . '`contact`',
				$this->confirm . '.' . '`branch_id`',
				$this->confirm . '.' . '`status`',
		);
	
		$this->db->select($this->field, FALSE);
	
		$this->db->from($this->confirm);
		
		$this->db->where($this->confirm . '.' . '`confirm_id`',$id);
	
		$query = $this->db->get();
	
		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}
	
	public function setConfirm($data)
	{
		if ($data) {
			$query = $this->db->insert($this->confirm, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	public function updateConfirm($id, $data)
	{
		if ($id && $data) {
			$this->db->where($this->confirm. '.' . '`confirm_id`', $id);
			$query = $this->db->update($this->confirm, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function deleteConfirm($id)
	{
		if ($id) {
			$this->db->where('confirm_id', $id);
			$query = $this->db->delete($this->confirm);
	
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
