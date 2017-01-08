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

		$this->db->order_by($this->slider . '.' . '`slider_id`','ASC');

		$query = $this->db->get();

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

	public function setSlider($data)
	{
		if ($data) {
			$query = $this->db->insert($this->slider, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	public function updateSlider($id, $data)
	{
		if ($id && $data) {
			$this->db->where($this->slider . '.' . '`slider_id`', $id);
			$query = $this->db->update($this->slider, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteSlider($id)
	{
		if ($id) {
			$this->db->where('slider_id', $id);
			$query = $this->db->delete($this->slider);

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
