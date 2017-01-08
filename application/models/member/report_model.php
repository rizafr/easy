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
}

/* End of file slider_model.php */
/* Location: ./application/models/module/slider_model.php */