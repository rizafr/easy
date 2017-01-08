<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Model extends MY_Model {

	private $category, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->category = "`business_category`";
		$this->field = NULL;
	}

	public function getCategory($id = NULL, $parent = NULL, $is_parent = NULL, $status = NULL)
	{
		$this->field = array(
							$this->category . '.' . '`category_id`',
							$this->category . '.' . '`parent_id`',
							$this->category . '.' . '`name`',
							$this->category . '.' . '`description`',
							$this->category . '.' . '`status`',

							'`parent`.`name` AS `parent`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->category);
		$this->db->join($this->category . ' ' . '`parent`', $this->category . '.' . '`parent_id`' . ' = ' . '`parent`.`category_id`','LEFT',FALSE);

		$this->db->where($this->category . '.' . '`status`','1');

		if ($id) {
			$this->db->where($this->category . '.' . '`category_id`', $id);
		}

		if ($parent) {
			$this->db->where($this->category . '.' . '`parent_id` IS NULL');
			if ($parent !== TRUE) {
				$this->db->where_not_in($this->category . '.' . '`category_id`',$parent);
			}
		}

		if ($is_parent) {
			$this->db->where($this->category . '.' . '`parent_id`',$is_parent);
		}

		if ($status) {
			$this->db->where($this->category . '.' . '`status`', $status);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $id ? $query->row_object() : $query->result_object();
		}
	}

}

/* End of file category_model.php */
/* Location: ./application/models/member/category_model.php */