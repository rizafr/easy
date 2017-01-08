<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate_model extends MY_Model {

	private $confirm, $nisab, $donate, $donate_member, $donate_history, $field, $zakatku;

	public function __construct()
	{
		parent::__construct();
		
		$this->nisab = "`nisab`";
		$this->donate = "`donate`";
		$this->confirm = "`confirm`";
		$this->zakatku = "`zakatku`";
		$this->member = "`member`";
		$this->donate_member = "`donate_member`";
		$this->donate_history = "`donate_history`";
		
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

	public function getAllDonate()
	{
		$this->field = array(
							$this->donate . '.' . '`donate_id`',
							$this->donate . '.' . '`name`',
							$this->donate . '.' . '`category`',
							$this->donate . '.' . '`image`',
							$this->donate . '.' . '`selection`',
							$this->donate . '.' . '`value`',
							$this->donate . '.' . '`start_date`',
							$this->donate . '.' . '`end_date`',
							$this->donate . '.' . '`description`',

							'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%W,<br /> %d %M %Y") AS start_date_string',
							'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%d/%m/%Y") AS start_date_format',

							'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%W,<br /> %d %M %Y") AS end_date_string',
							'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%d/%m/%Y") AS end_date_format',

							$this->donate . '.' . '`active`',

							'SUM(' . $this->donate_member . '.' . '`value`' . ') AS value_sum'

						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->donate);
		$this->db->join($this->donate_member, $this->donate_member . '.' . '`donate_id`' . ' = ' . $this->donate . '.' . '`donate_id`' . ' AND ' . $this->donate_member . '.' . '`status`' . ' NOT IN (4) ','left',FALSE);

		$this->db->group_by($this->donate . '.' . '`donate_id`');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getActiveDonate()
	{
		$this->field = array(
							$this->donate . '.' . '`donate_id`',
							$this->donate . '.' . '`name`',
							$this->donate . '.' . '`category`',
							$this->donate . '.' . '`image`',
							$this->donate . '.' . '`selection`',
							$this->donate . '.' . '`value`',
							$this->donate . '.' . '`start_date`',
							$this->donate . '.' . '`end_date`',
							$this->donate . '.' . '`description`',

							'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%W,<br /> %d %M %Y") AS start_date_string',
							'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%d/%m/%Y") AS start_date_format',

							'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%W,<br /> %d %M %Y") AS end_date_string',
							'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%d/%m/%Y") AS end_date_format',

							$this->donate . '.' . '`active`',

							'SUM(' . $this->donate_member . '.' . '`value`' . ') AS value_sum'

						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->donate);
		$this->db->join($this->member, $this->member . '.' . '`member_id`' . ' = ' . $this->donate . '.' . '`member_id`' . ' AND ' . $this->donate . '.' . '`status`' . ' = 0 ','left',FALSE);

// 		$this->db->where('NOW()' . ' BETWEEN ' . 'STR_TO_DATE(CONCAT(' . $this->donate . '.' . '`start_date`," 00:00:00")' . ',"%Y-%m-%d %H:%i:%s")' . ' AND ' . 'STR_TO_DATE(CONCAT(' . $this->donate . '.' . '`end_date`," 23:59:59")' . ',"%Y-%m-%d %H:%i:%s")');

// 		$this->db->group_by($this->donate . '.' . '`donate_id`');

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
								$this->donate . '.' . '`firstname`',
								$this->donate . '.' . '`lastname`',
								$this->donate . '.' . '`transfer_amount`',
								$this->donate . '.' . '`transfer_method`',
								$this->donate . '.' . '`payment_pupose`',
								$this->donate . '.' . '`date`',
								$this->donate . '.' . '`day`',
					
					'DATE_FORMAT(' . $this->donate . '.' . '`date`,"%d %M %Y") AS `date_created_shorts`',
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->donate);
// 			$this->db->join($this->donate_member, $this->donate_member . '.' . '`donate_id`' . ' = ' . $this->donate . '.' . '`donate_id`','left',FALSE);

			$this->db->where($this->donate . '.' . '`member_id`',$id);
			$this->db->where($this->donate . '.' . '`status`'. ' = ' .'0');
// 			$this->db->group_by($this->donate . '.' . '`donate_id`');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getDonateByDonate($id)
	{
		if ($id) {
			$this->field = array(
								$this->member . '.' . '`member_id`',
								$this->member . '.' . '`first_name`',
								$this->member . '.' . '`last_name`',
								$this->member . '.' . '`email`',

								$this->donate_member . '.' . '`donate_member_id`',
								$this->donate_member . '.' . '`donate_id`',
								$this->donate_member . '.' . '`date`',

								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%W,<br /> %d %M %Y") AS date_string',
								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%d/%m/%Y") AS date_format',

								$this->donate_member . '.' . '`value`',
								$this->donate_member . '.' . '`status`',
								$this->donate_member . '.' . '`description`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->donate_member);
			$this->db->join($this->member, $this->member . '.' . '`member_id`' . ' = ' . $this->donate_member . '.' . '`member_id`','',FALSE);

			$this->db->where($this->donate_member . '.' . '`donate_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getDonateCustomer($id)
	{
		if ($id) {
			$this->field = array(
								$this->donate . '.' . '`donate_id`',
								$this->donate . '.' . '`name`',
								$this->donate . '.' . '`category`',
								$this->donate . '.' . '`description` AS `donate_description`',

								$this->member . '.' . '`member_id`',
								$this->member . '.' . '`first_name`',
								$this->member . '.' . '`last_name`',
								$this->member . '.' . '`email`',

								$this->donate_member . '.' . '`donate_member_id`',
								$this->donate_member . '.' . '`date`',

								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%W,<br /> %d %M %Y") AS date_string',
								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%d/%m/%Y") AS date_format',

								$this->donate_member . '.' . '`value`',
								$this->donate_member . '.' . '`status`',
								$this->donate_member . '.' . '`description`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->donate_member);
			$this->db->join($this->member, $this->member . '.' . '`member_id`' . ' = ' . $this->donate_member . '.' . '`member_id`','',FALSE);
			$this->db->join($this->donate, $this->donate . '.' . '`donate_id`' . ' = ' . $this->donate_member . '.' . '`donate_id`','',FALSE);

			$this->db->where($this->donate_member . '.' . '`donate_member_id`',$id);

			$this->db->group_by($this->donate_member . '.' . '`donate_member_id`');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getDonateCustomerByCustomer($id)
	{
		if ($id) {
			$this->field = array(
								$this->donate . '.' . '`donate_id`',
								$this->donate . '.' . '`name`',
								$this->donate . '.' . '`category`',
								$this->donate . '.' . '`image`',
								$this->donate . '.' . '`selection`',
								$this->donate . '.' . '`value`',
								$this->donate . '.' . '`start_date`',
								$this->donate . '.' . '`end_date`',
								$this->donate . '.' . '`description`',

								'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%W,<br /> %d %M %Y") AS start_date_string',
								'DATE_FORMAT(' . $this->donate . '.' . '`start_date`' . ',"%d/%m/%Y") AS start_date_format',

								'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%W,<br /> %d %M %Y") AS end_date_string',
								'DATE_FORMAT(' . $this->donate . '.' . '`end_date`' . ',"%d/%m/%Y") AS end_date_format',

								$this->donate . '.' . '`active`',

								$this->member . '.' . '`member_id`',
								$this->member . '.' . '`first_name`',
								$this->member . '.' . '`last_name`',
								$this->member . '.' . '`email`',

								$this->donate_member . '.' . '`donate_member_id`',
								$this->donate_member . '.' . '`date`',

								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%W,<br /> %d %M %Y") AS date_string',
								'DATE_FORMAT(' . $this->donate_member . '.' . '`date`' . ',"%d/%m/%Y") AS date_format',

								$this->donate_member . '.' . '`value`',
								$this->donate_member . '.' . '`status`',
								$this->donate_member . '.' . '`description`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->donate_member);
			$this->db->join($this->donate, $this->donate . '.' . '`donate_id`' . ' = ' . $this->donate_member . '.' . '`donate_id`','',FALSE);
			$this->db->join($this->member, $this->member . '.' . '`member_id`' . ' = ' . $this->donate_member . '.' . '`member_id`','',FALSE);

			$this->db->where($this->member . '.' . '`member_id`',$id);

			$this->db->group_by($this->donate_member . '.' . '`donate_member_id`');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getDonateXml($id)
	{
		if ($id) {
			$this->field = array(
					$this->payment . '.' . '`id`',
					$this->payment . '.' . '`raw`',
					$this->payment . '.' . '`trx_id`',
					$this->payment . '.' . '`signature`',
					$this->payment . '.' . '`authkey`'
			);
	
			$this->db->select($this->field, FALSE);
	
			$this->db->from($this->payment);
	
			$this->db->where($this->payment . '.' . '`trx_id`',$id);
	
			$query = $this->db->get();
	
			if ($query && $query->num_rows()) {
				return $query->result_object();
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

	public function setDonateMember($data)
	{
		if ($data) {
			$query = $this->db->insert($this->donate_member, $data);

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


	public function setCustomerHistory($data)
	{
		if ($data) {
			$query = $this->db->insert($this->donate_history, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setXml($data)
	{
		if ($data) {
			$query = $this->db->insert('rawtes', $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
}

/* End of file donate_model.php */
/* Location: ./application/models/module/donate_model.php */
