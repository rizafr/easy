<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_model extends MY_Model {

	private $slider, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->slider = "`slider`";
		$this->field = NULL;
	}

	public function getAllSlider()
	{
		$this->field = array(
							$this->slider . '.' . '`slider_id`',
							$this->slider . '.' . '`title`',
							$this->slider . '.' . '`description`',
							$this->slider . '.' . '`vidbutt`',
							$this->slider . '.' . '`label`',
							$this->slider . '.' . '`url`',
							$this->slider . '.' . '`position`',
							$this->slider . '.' . '`image`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->slider);

		$query = $this->db->get();

		$this->db->order_by($this->slider . '.' . '`slider_id`','ASC');

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getSlider($id)
	{
		if ($id) {
			$this->field = array(
							$this->slider . '.' . '`slider_id`',
							$this->slider . '.' . '`title`',
							$this->slider . '.' . '`description`',
							$this->slider . '.' . '`vidbutt`',
							$this->slider . '.' . '`label`',
							$this->slider . '.' . '`url`',
							$this->slider . '.' . '`position`',
							$this->slider . '.' . '`image`'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->slider);

			$this->db->where($this->slider . '.' . '`slider_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

}

/* End of file slider_model.php */
/* Location: ./application/models/module/slider_model.php */
