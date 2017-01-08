<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends MY_Model {

	private $user, $user_level, $user_access, $page, $page_menu, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->user = "`user`";
		$this->user_level = "`user_level`";
		$this->user_access = "`user_access`";
		$this->page = "`page`";
		$this->page_menu = "`page_menu`";
		$this->field = NULL;
	}

	public function Login($username,$password)
	{
		$this->field = array(
							$this->user . '.' . '`user_id`',
							$this->user . '.' . '`user_level_id`',
							$this->user . '.' . '`full_name`',
							$this->user . '.' . '`username`',
							$this->user . '.' . '`password`',
							$this->user . '.' . '`email`',
							$this->user . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%W, %d %M %Y %H:%i:%s") AS `created_date`',
							$this->user . '.' . '`date_actived`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_actived`,"%W, %d %M %Y %H:%i:%s") AS `actived_date`',
							$this->user . '.' . '`status`',

							$this->user_level . '.' . '`name` AS `user_level`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user);
		$this->db->join($this->user_level, $this->user_level . '.' . '`user_level_id`' . ' = ' . $this->user . '.' . '`user_level_id`','',FALSE);


		$this->db->where('`status`',1);
		$this->db->where('`username`',$username);
		$this->db->where('`password`',$password);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getPageAccess($user_level_id, $page_id)
	{
		$this->field = array(
							$this->user_access . '.' . '`user_access_id`',
							$this->user_access . '.' . '`user_level_id` AS `user_level`',
							$this->user_access . '.' . '`page_id` AS `user_page`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user_access);

		$this->db->where($this->user_access . '.' . '`user_level_id`',$user_level_id);
		$this->db->where($this->user_access . '.' . '`page_id`',$page_id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getParentAccess($user_level_id, $parent_menu_id)
	{
		$this->field = array(
							$this->user_access . '.' . '`user_access_id`',
							$this->user_access . '.' . '`user_level_id` AS `user_level`',
							$this->user_access . '.' . '`page_id` AS `user_page`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user_access);
		$this->db->join($this->page, $this->page . '.' . '`page_id`' . ' = ' . $this->user_access . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

		$this->db->where($this->user_access . '.' . '`user_level_id`',$user_level_id);
		$this->db->where($this->page_menu . '.' . '`page_menu_id`',$parent_menu_id);

		$this->db->group_by($this->user_access . '.' . '`page_id`');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getAllUser()
	{
		$this->field = array(
							$this->user . '.' . '`user_id`',
							$this->user . '.' . '`full_name`',
							$this->user . '.' . '`username`',
							$this->user . '.' . '`password`',
							$this->user . '.' . '`email`',
							$this->user . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%W, %d %M %Y %H:%i:%s") AS `created_date`',
							$this->user . '.' . '`date_actived`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_actived`,"%W, %d %M %Y %H:%i:%s") AS `actived_date`',
							$this->user . '.' . '`status`',

							$this->user_level . '.' . '`user_level_id`',
							$this->user_level . '.' . '`name` AS `level`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user);
		$this->db->join($this->user_level, $this->user_level . '.' . '`user_level_id`' . ' = ' . $this->user . '.' . '`user_level_id`','',FALSE);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getUser($id)
	{
		$this->field = array(
							$this->user . '.' . '`user_id`',
							$this->user . '.' . '`full_name`',
							$this->user . '.' . '`username`',
							$this->user . '.' . '`password`',
							$this->user . '.' . '`email`',
							$this->user . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_created`,"%W, %d %M %Y %H:%i:%s") AS `created_date`',
							$this->user . '.' . '`date_actived`',
							'DATE_FORMAT(' . $this->user . '.' . '`date_actived`,"%W, %d %M %Y %H:%i:%s") AS `actived_date`',
							$this->user . '.' . '`status`',

							$this->user_level . '.' . '`user_level_id`',
							$this->user_level . '.' . '`name` AS `level`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user);
		$this->db->join($this->user_level, $this->user_level . '.' . '`user_level_id`' . ' = ' . $this->user . '.' . '`user_level_id`','',FALSE);

		$this->db->where('user_id',$id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getAllUserLevel()
	{
		$this->field = array(
							$this->user_level . '.' . '`user_level_id`',
							$this->user_level . '.' . '`name` AS `level`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user_level);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getUserLevel($id)
	{
		$this->field = array(
							$this->user_level . '.' . '`user_level_id`',
							$this->user_level . '.' . '`name` AS `level`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user_level);

		$this->db->where('user_level_id',$id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getUserAccess($id)
	{
		$this->field = array(
							$this->user_access . '.' . '`user_access_id`',
							$this->user_access . '.' . '`user_level_id` AS `user_level`',
							$this->user_access . '.' . '`page_id` AS `user_page`'

						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->user_access);

		$this->db->where('user_level_id',$id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getUserPageRelation($user_id = NULL, $parent = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu` AS `name`',
							$this->page_menu . '.' . '`type` AS `menu_type`',
							$this->page_menu . '.' . '`order`',

							$this->user_access . '.' . '`user_access_id`',
							$this->user_access . '.' . '`user_level_id` AS `user_level`',
							$this->user_access . '.' . '`page_id` AS `user_page`',

							$this->user_level . '.' . '`user_level_id`',
							$this->user_level . '.' . '`name` AS `level`'
						);
		$this->db->select($this->field, FALSE);

		$user_condition = ' AND ' . $this->user_access . '.' . '`user_level_id`' . ( $user_id ? ' = ' . $user_id : ' IS NULL');

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->user_access, $this->user_access . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`' . $user_condition,'left',FALSE);
		$this->db->join($this->user_level, $this->user_level . '.' . '`user_level_id`' . ' = ' . $this->user_access . '.' . '`user_level_id`','left',FALSE);

		$this->db->where($this->page . '.' . '`is_menu`',TRUE);
		$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent);

		$this->db->group_by($this->page . '.' . '`page_id`');

		$this->db->order_by('`order`','ASC');
		$this->db->order_by('`date_created`','DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function setUser($data)
	{
		if ($data) {
			$query = $this->db->insert($this->user, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'add process failed. username already exists.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateUser($id,$data)
	{
		if ($id && $data) {
			$this->db->where('user_id', $id);
			$query = $this->db->update($this->user, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed. username already exists.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteUser($id)
	{
		if ($id) {
			$this->db->where_in('user_id',$id);
			$query = $this->db->delete($this->user);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setUserLevel($data)
	{
		if ($data) {
			$query = $this->db->insert($this->user_level, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'add process failed. username already exists.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateUserLevel($id,$data)
	{
		if ($id && $data) {
			$this->db->where('user_level_id', $id);
			$query = $this->db->update($this->user_level, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed. username already exists.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteUserLevel($id)
	{
		if ($id) {
			$this->db->where_in('user_level_id',$id);
			$query = $this->db->delete($this->user_level);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setUserAccess($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->user_access, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'add process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function clearUserAccess($user_level_id, $page_id = NULl)
	{
		$this->db->where('user_level_id',$user_level_id);
		if ($page_id) {
			$this->db->where_not_in('page_id',$page_id);
		}
		$query = $this->db->delete($this->user_access);

		if($query && $this->db->affected_rows()) {
			return array('success' => TRUE, 'message' => 'delete process successful.');
		} else {
			return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
		}
	}
}

/* End of file user_model.php */
/* Location: ./application/models/user/user_model.php */