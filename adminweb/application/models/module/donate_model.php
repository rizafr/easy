<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate_model extends MY_Model {

	private $confirm, $donate, $field, $zakatku;

	public function __construct()
	{
		parent::__construct();
		
		$this->donate = "`donate`";
		$this->confirm = "`confirm`";
		$this->zakatku = "`zakatku`";
		$this->member = "`member`";
		
		$this->field = NULL;
	}

	public function getAllDonate()
	{
		$this->field = array(
							$this->donate . '.' . '`donate_id`',
							$this->donate . '.' . '`member_id`',
							$this->donate . '.' . '`date_transfer`',
							$this->donate . '.' . '`transfer_amount`',
							$this->donate . '.' . '`firstname`',
							$this->donate . '.' . '`lastname`',
							$this->donate . '.' . '`contact`',
							$this->donate . '.' . '`email`',
							$this->donate . '.' . '`payment_pupose`',
							$this->donate . '.' . '`transfer_method`',
							$this->donate . '.' . '`status`',
				'DATE_FORMAT(' . $this->donate . '.' . '`date_transfer`,"%d %M %Y") AS `date_created_shorts`',
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->donate);	
		$this->db->order_by($this->donate . '.' . '`donate_id`', 'DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getDonate($id)
	{
		if ($id) {
			$this->field = array(
								$this->donate . '.' . '`donate_id`',
								$this->donate . '.' . '`member_id`',
								$this->donate . '.' . '`date_transfer`',
								$this->donate . '.' . '`transfer_amount`',
								$this->donate . '.' . '`firstname`',
								$this->donate . '.' . '`lastname`',
								$this->donate . '.' . '`contact`',
								$this->donate . '.' . '`email`',
								$this->donate . '.' . '`payment_pupose`',
								$this->donate . '.' . '`transfer_method`',
								$this->donate . '.' . '`address`',
								$this->donate . '.' . '`status`',
					
					'DATE_FORMAT(' . $this->donate . '.' . '`date`,"%d %M %Y") AS `date_created_shorts`',
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->donate);

			$this->db->where($this->donate . '.' . '`donate_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}
	
	public function setZakatMember($data)
	{
		if ($data) {
			$query = $this->db->insert($this->zakatku, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setDonate($data)
	{
		if ($data) {
			$query = $this->db->insert($this->donate, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
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
	public function updateDonate($id, $data)
	{
		if ($id && $data) {
			$this->db->where($this->donate. '.' . '`donate_id`', $id);
			$query = $this->db->update($this->donate, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function deleteDonate($id)
	{
		if ($id) {
			$this->db->where('donate_id', $id);
			$query = $this->db->delete($this->donate);
	
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