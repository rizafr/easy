<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Model extends MY_Model {

	private $schema, $db_name, $page_home, $page, $page_menu, $page_content, $page_related_content, $page_comment, $page_form, $page_category, $page_tags, $page_category_join, $page_image, $page_slider, $page_feature, $page_spesification, $page_download, $page_language, $image_product, $page_product, $page_settings, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->schema = '`information_schema`';
		$this->db_name = $this->db->database;
		$this->page_home = "`page_home`";
		$this->page = "`page`";
		$this->user = "`user`";
		$this->page_menu = "`page_menu`";
		$this->page_content = "`page_content`";
		$this->page_related_content = "`page_related_content`";
		$this->page_comment = "`page_comment`";
		$this->page_form = "`page_form`";
		$this->page_category = "`page_category`";
		$this->page_tags = "`page_tags`";
		$this->page_category_join = "`page_category_join`";
		$this->page_image = "`page_image`";
		$this->page_slider = "`page_slider`";
		$this->page_feature = "`page_feature`";
		$this->page_spesification = "`page_spesification`";
		$this->page_download = "`page_download`";
		$this->page_language = "`page_language`";
		$this->image_product = "`image_product`";
		$this->page_product = "`page_product`";
		$this->page_settings = "`page_settings`";
		$this->field = NULL;
	}

	public function getTable($table)
	{
		if ($this->db->table_exists($table)) {
			return $this->db->list_fields($table);
		}
	}

	public function getFormData($table, $id)
	{
		$this->db->select('*', FALSE);

		$this->db->from($table);

		$this->db->where($table . '.' . '`form_id`', $id);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function setFormData($table, $data)
	{
		if ($data) {
			$query = $this->db->insert($table, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}


	public function updateFormData($table, $id, $data)
	{
		if ($id && $data) {
			$this->db->where($table . '.' . '`form_id`', $id);
			$query = $this->db->update($table, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'insert process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function getPageDetail($key, $value)
	{
		if ($key && $value) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`is_featured`',
								$this->page . '.' . '`mega_menu`',
								$this->page . '.' . '`show_home`',
								$this->page . '.' . '`show_footer`',
								$this->page . '.' . '`show_children`',
								$this->page . '.' . '`page_maps`',
								$this->page . '.' . '`page_link`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d") AS created_date_day',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%b") AS created_date_month',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%Y") AS created_date_year',

								$this->user . '.' . '`full_name` AS author',

								$this->page_menu . '.' . '`page_menu_id`',
								$this->page_menu . '.' . '`parent_menu_id`',
								$this->page_menu . '.' . '`guid`',
								$this->page_menu . '.' . '`menu`',
								$this->page_menu . '.' . '`order`',

								$this->page_image . '.' . '`file_name` AS `image`',
								$this->page_image . '.' . '`name` AS `image_name`',
								$this->page_image . '.' . '`description` AS `image_description`',

								'GROUP_CONCAT( DISTINCT CONCAT("tag-",' . $this->page_category . '.' . '`guid`)' . ' SEPARATOR " ") AS category',
								'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ' SEPARATOR ",") AS category_name',
								'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ', ":",' . $this->page_category . '.' . '`guid`' . ' SEPARATOR " ") AS category_guid',

								'GROUP_CONCAT( DISTINCT ' . $this->page_tags . '.' . '`tags`' . ' SEPARATOR ",") AS tags'
							);

			$this->db->select($this->field, FALSE);

			$image = $this->page_image . '.' . '`is_feature` = "0"';

			$this->db->from($this->page);
			$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
			$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
			$this->db->join($this->page_category , $this->page_category . '.' . '`page_category_id`' . ' = ' . $this->page_category_join . '.' . '`page_category_id`','left',FALSE);
			$this->db->join($this->page_tags , $this->page_tags . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);

			switch ($key) {
				case 'guid'				: $this->db->where($this->page_menu . '.' . '`guid`',$value); break;
				case 'page_id'			: $this->db->where($this->page_menu . '.' . '`page_id`',$value); break;
				case 'menu_id'			: $this->db->where($this->page_menu . '.' . '`page_menu_id`',$value); break;
				case 'parent_menu_id'	: $this->db->where($this->page_menu . '.' . '`parent_menu_id`',$value); break;
				default					: $this->db->where($this->page_menu . '.' . '`page_id`',NULL); break;
			}

			$this->db->group_by('`page_id`');

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageChild($parent_menu_id, $child_type, $pagination = NULL, $rows = 5, $is_menu = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`is_menu`',
							$this->page . '.' . '`is_featured`',
							$this->page . '.' . '`mega_menu`',
							$this->page . '.' . '`show_home`',
							$this->page . '.' . '`show_footer`',
							$this->page . '.' . '`show_children`',
							$this->page . '.' . '`page_maps`',
							$this->page . '.' . '`page_link`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d") AS created_date_day',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%b") AS created_date_month',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%Y") AS created_date_year',

							$this->user . '.' . '`full_name` AS author',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`order`',

							$this->page_image . '.' . '`file_name` AS `image`',
							$this->page_image . '.' . '`name` AS `image_name`',
							$this->page_image . '.' . '`description` AS `image_description`',

							'GROUP_CONCAT( DISTINCT CONCAT("tag-",' . $this->page_category . '.' . '`guid`)' . ' SEPARATOR " ") AS category',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ' SEPARATOR ",") AS category_name',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ', ":",' . $this->page_category . '.' . '`guid`' . ' SEPARATOR " ") AS category_guid',

							'GROUP_CONCAT( DISTINCT ' . $this->page_tags . '.' . '`tags`' . ' SEPARATOR ",") AS tags'
						);

		$this->db->select($this->field, FALSE);

		$image = $this->page_image . '.' . '`is_feature` = "0"';

		$this->db->from($this->page);
		$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_tags , $this->page_tags . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
		$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_category , $this->page_category . '.' . '`page_category_id`' . ' = ' . $this->page_category_join . '.' . '`page_category_id`','left',FALSE);

		$this->db->where($this->page . '.' . '`publish`',TRUE);
		$this->db->where_not_in($this->page . '.' . '`type`','home');

		if ($parent_menu_id !== FALSE) {
			$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent_menu_id);
		}

		if ($child_type === 'popular') {
			$this->db->where($this->page . '.' . '`visitor` > 0');
			$this->db->order_by($this->page . '.' . '`visitor`','DESC');
			$this->db->order_by($this->page . '.' . '`date_created`','DESC');
		} else if ($child_type === 'latest') {
			$this->db->order_by($this->page . '.' . '`date_created`','DESC');
		} else {
			$this->db->order_by($this->page_menu . '.' . '`order`','ASC');
			$this->db->order_by($this->page . '.' . '`date_created`','DESC');
		}

		if ($is_menu !== NULL) {
			$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		}

		if ($pagination !== NULL) {
			$start = ($pagination - 1) * $rows;
			$this->db->limit($rows,$start);
		}

		$this->db->group_by('`page_id`');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageArchiveChild($parent_menu_id, $archive, $pagination = NULL, $rows = 5, $is_menu = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`is_menu`',
							$this->page . '.' . '`is_featured`',
							$this->page . '.' . '`mega_menu`',
							$this->page . '.' . '`show_home`',
							$this->page . '.' . '`show_footer`',
							$this->page . '.' . '`show_children`',
							$this->page . '.' . '`page_maps`',
							$this->page . '.' . '`page_link`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

							$this->user . '.' . '`full_name` AS author',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`order`',

							$this->page_image . '.' . '`file_name` AS `image`',
							$this->page_image . '.' . '`name` AS `image_name`',
							$this->page_image . '.' . '`description` AS `image_description`',

							'GROUP_CONCAT( DISTINCT CONCAT("tag-",' . $this->page_category . '.' . '`guid`)' . ' SEPARATOR " ") AS category',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ' SEPARATOR ",") AS category_name',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ', ":",' . $this->page_category . '.' . '`guid`' . ' SEPARATOR " ") AS category_guid',

							'GROUP_CONCAT( DISTINCT ' . $this->page_tags . '.' . '`tags`' . ' SEPARATOR ",") AS tags'
						);

		$this->db->select($this->field, FALSE);

		$image = $this->page_image . '.' . '`is_feature` = "0"';

		$this->db->from($this->page);
		$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_tags , $this->page_tags . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
		$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_category , $this->page_category . '.' . '`page_category_id`' . ' = ' . $this->page_category_join . '.' . '`page_category_id`','left',FALSE);

		$this->db->where($this->page . '.' . '`publish`',TRUE);
		$this->db->where_not_in($this->page . '.' . '`type`','home');

		if ($parent_menu_id !== FALSE) {
			$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent_menu_id);
		}

		$this->db->where($this->page . '.' . '`publish`',TRUE);

		$this->db->where('DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%m-%Y")',$archive);

		if ($is_menu !== NULL) {
			$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		}

		$this->db->order_by($this->page_menu . '.' . '`order`','ASC');
		$this->db->order_by($this->page . '.' . '`date_created`','DESC');

		if ($pagination !== NULL) {
			$start = ($pagination - 1) * $rows;
			$this->db->limit($rows,$start);
		}

		$this->db->group_by('`page_id`');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageCount($parent_id, $page_language_id, $archive = NULL)
	{
		$this->field = array('COUNT(' . $this->page . '.' . '`page_id`' . ') AS total');

		$this->db->select($this->field, FALSE);

		$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

		$this->db->from($this->page);
		$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);

		$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent_id);
		$this->db->where($this->page . '.' . '`publish`',TRUE);

		if ($archive) {
			$this->db->where('DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%m-%Y")',$archive);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getPageSearch($keyword, $page_language_id, $pagination = NULL, $rows = 5)
	{
		if ($keyword) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`is_featured`',
								$this->page . '.' . '`mega_menu`',
								$this->page . '.' . '`show_home`',
								$this->page . '.' . '`show_footer`',
								$this->page . '.' . '`show_children`',
								$this->page . '.' . '`page_maps`',
								$this->page . '.' . '`page_link`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

								$this->user . '.' . '`full_name` AS author',

								$this->page_menu . '.' . '`page_menu_id`',
								$this->page_menu . '.' . '`parent_menu_id`',
								$this->page_menu . '.' . '`guid`',
								$this->page_menu . '.' . '`menu`',
								$this->page_menu . '.' . '`order`',

								$this->page_image . '.' . '`file_name` AS `image`',
								$this->page_image . '.' . '`name` AS `image_name`',
								$this->page_image . '.' . '`description` AS `image_description`',

								'GROUP_CONCAT( DISTINCT CONCAT("tag-",' . $this->page_category . '.' . '`guid`)' . ' SEPARATOR " ") AS category',
								'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ' SEPARATOR ",") AS category_name',
								'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ', ":",' . $this->page_category . '.' . '`guid`' . ' SEPARATOR " ") AS category_guid',

								'GROUP_CONCAT( DISTINCT ' . $this->page_tags . '.' . '`tags`' . ' SEPARATOR ",") AS tags'
							);

			$this->db->select($this->field, FALSE);

			$image = $this->page_image . '.' . '`is_feature` = "0"';
			$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

			$this->db->from($this->page);
			$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_tags , $this->page_tags . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
			$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
			$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);
			$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
			$this->db->join($this->page_category , $this->page_category . '.' . '`page_category_id`' . ' = ' . $this->page_category_join . '.' . '`page_category_id`','left',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page_menu . '.' . '`guid` IS NOT NULL');
			$this->db->where($this->page_content . '.' . '`page_language_id`', $page_language_id);
			$this->db->where('(' . $this->page_content . '.' . '`menu` LIKE "%' . $keyword . '%"' . ' OR ' . $this->page_content . '.' . '`title` LIKE "%' . $keyword . '%"' . ' OR ' . $this->page_content . '.' . '`body` LIKE "%' . $keyword . '%")',NULL,FALSE);

			$this->db->group_by('`page_id`');

			$this->db->order_by($this->page . '.' . '`date_created`','DESC');

			if ($pagination !== NULL) {
				$start = ($pagination - 1) * $rows;
				$this->db->limit($rows,$start);
			}

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageSearchCount($keyword, $page_language_id)
	{
		if ($keyword) {
			$this->field = array('COUNT(' . $this->page . '.' . '`page_id`' . ') AS total');

			$this->db->select($this->field, FALSE);

			$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

			$this->db->from($this->page);
			$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page_menu . '.' . '`guid` IS NOT NULL');
			$this->db->where($this->page_content . '.' . '`page_language_id`', $page_language_id);
			$this->db->where('(' . $this->page_content . '.' . '`menu` LIKE "%' . $keyword . '%"' . ' OR ' . $this->page_content . '.' . '`title` LIKE "%' . $keyword . '%"' . ' OR ' . $this->page_content . '.' . '`body` LIKE "%' . $keyword . '%")',NULL,FALSE);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageContent($id,$lang)
	{
		if ($id && $lang) {
			$this->field = array(
								$this->page . '.' . '`page_id`',

								$this->page_content . '.' . '`page_content_id`',
								$this->page_content . '.' . '`menu`',
								$this->page_content . '.' . '`header`',
								$this->page_content . '.' . '`title`',
								$this->page_content . '.' . '`body`',
								$this->page_content . '.' . '`add_title`',
								$this->page_content . '.' . '`add_body`',
								$this->page_content . '.' . '`add_button`',
								$this->page_content . '.' . '`feature`',
								$this->page_content . '.' . '`detail`',

								$this->page_language . '.' . '`page_language_id`',
								$this->page_language . '.' . '`name`',
								$this->page_language . '.' . '`icon`',
								$this->page_language . '.' . '`default`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page);
			$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_language, $this->page_language . '.' . '`page_language_id`' . ' = ' . $this->page_content . '.' . '`page_language_id`','',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page . '.' . '`page_id`',$id);
			$this->db->where($this->page_language . '.' . '`page_language_id`',$lang);

			$this->db->group_by('`page_id`');

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}
	
	public function getPageRelated($id)
	{
		if ($id) {
			$this->field = array(
					$this->page . '.' . '`page_id`',
					$this->page_menu . '.' . '`guid`',
					
					$this->page . '.' . '`type`',
					$this->page . '.' . '`date_created`',
					'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
					'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',
					
					$this->user . '.' . '`full_name` AS author',
	
					$this->page_content . '.' . '`page_content_id`',
					$this->page_related_content . '.' . '`page_related`',
					$this->page_content . '.' . '`title`',
					
					$this->page_image . '.' . '`file_name` AS `image`',
					$this->page_image . '.' . '`name` AS `image_name`',
					$this->page_image . '.' . '`description` AS `image_description`',
					
					$this->page_language . '.' . '`page_language_id`',
					$this->page_language . '.' . '`name`',
					$this->page_language . '.' . '`icon`',
					$this->page_language . '.' . '`default`'
			);
	
			$this->db->select($this->field, FALSE);
			
			$image = $this->page_image . '.' . '`is_feature` = "0"';
	
			$this->db->from($this->page_content);			
			$this->db->join($this->page, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->user, $this->user . '.' . '`user_id`' . ' = ' . $this->page . '.' . '`user_id`','',FALSE);
			$this->db->join($this->page_related_content, $this->page_content . '.' . '`page_content_id`' . ' = ' . $this->page_related_content . '.' . '`page_related`','',FALSE);
			$this->db->join($this->page_language, $this->page_language . '.' . '`page_language_id`' . ' = ' . $this->page_content . '.' . '`page_language_id`','',FALSE);
			$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page_related_content . '.' . '`page_content_id`',$id);
	
			$this->db->group_by('`page_id`');
	
			$query = $this->db->get();
				
			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageProduct($page_id = NULL)
	{
		$this->field = array(
							$this->page_product . '.' . '`page_id`',
							$this->page_product . '.' . '`type`',
							$this->page_product . '.' . '`available`',
							$this->page_product . '.' . '`area`',
							$this->page_product . '.' . '`beds`',
							$this->page_product . '.' . '`baths`',
							$this->page_product . '.' . '`living_room`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_product);

		if ($page_id) {
			$this->db->where($this->page_product . '.' . '`page_id`',$page_id);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->row_object();
		}
	}

	public function getPageForm($id)
	{
		if ($id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

								$this->page_form . '.' . '`page_form_id`',
								$this->page_form . '.' . '`form_name`',
								$this->page_form . '.' . '`form_description`',
								$this->page_form . '.' . '`table_name`',
								$this->page_form . '.' . '`mail_to`',
								$this->page_form . '.' . '`data`',
								$this->page_form . '.' . '`authenticated`',
								$this->page_form . '.' . '`signed_up`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page);
			$this->db->join($this->page_form, $this->page_form . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page . '.' . '`page_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageCategory($parent, $group, $page_id = NULL)
	{
		if ($group) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

								$this->page_category . '.' . '`page_category_id`',
								$this->page_category . '.' . '`group`',
								$this->page_category . '.' . '`category`',
								$this->page_category . '.' . '`guid`',

								$this->page_category_join . '.' . '`page_category_join_id`',
								$this->page_category_join . '.' . '`page_id` AS `page_join`',
								$this->page_category_join . '.' . '`page_category_id` AS `category_join`'
							);

			$this->db->select($this->field, FALSE);

			$is_page = $page_id ? $this->page_category_join . '.' . '`page_id`' . ' = ' . $page_id : $this->page_category_join . '.' . '`page_id`' . ' IS NULL';

			$this->db->from($this->page_category);
			$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_category_id`' . ' = ' . $this->page_category . '.' . '`page_category_id`' . ' AND ' . $is_page,'left',FALSE);
			$this->db->join($this->page, $this->page . '.' . '`page_id`' . ' = ' . $this->page_category_join . '.' . '`page_id`','left',FALSE);

			$this->db->where($this->page_category . '.' . '`page_menu_id`',$parent);
			$this->db->where($this->page_category . '.' . '`group`',$group);

			$this->db->group_by($this->page_category . '.' . '`page_category_id`');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageTags($page_id = NULL)
	{
		$this->field = array(
							$this->page_tags . '.' . '`page_tags_id`',
							$this->page_tags . '.' . '`page_id`',
							$this->page_tags . '.' . '`tags`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_tags);

		if ($page_id) {
			$this->db->where($this->page_tags . '.' . '`page_id`',$page_id);
		}

		$this->db->group_by($this->page_tags . '.' . '`tags`');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageArchive($parent_menu_id)
	{
		$this->field = array(
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%M %Y") AS archive',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%m/%Y") AS archive_date',
							$this->page . '.' . '`date_created`' . ' AS archive_order'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

		$this->db->where($this->page . '.' . '`publish`',TRUE);

		$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent_menu_id);

		$this->db->where($this->page . '.' . '`is_menu`','0');

		$this->db->group_by('archive');
		$this->db->order_by('archive_order','DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageData($id)
	{
		if ($id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
							    $this->page . '.' . '`visitor`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

								$this->page_content . '.' . '`page_content_id`',
								$this->page_content . '.' . '`menu`',
								$this->page_content . '.' . '`header`',
								$this->page_content . '.' . '`title`',
								$this->page_content . '.' . '`body`',
								$this->page_content . '.' . '`add_title`',
								$this->page_content . '.' . '`add_body`',
								$this->page_content . '.' . '`add_button`',
								$this->page_content . '.' . '`feature`',
								$this->page_content . '.' . '`detail`',

								$this->page_language . '.' . '`page_language_id`',
								$this->page_language . '.' . '`name`',
								$this->page_language . '.' . '`icon`',
								$this->page_language . '.' . '`default`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page);
			$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_language, $this->page_language . '.' . '`page_language_id`' . ' = ' . $this->page_content . '.' . '`page_language_id`','',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page . '.' . '`page_id`',$id);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageSettingData()
	{
		$this->field = array(
							$this->page_home . '.' . '`page_home_id`',
							$this->page_home . '.' . '`visi_misi`',
							$this->page_home . '.' . '`weapon_title`',
							$this->page_home . '.' . '`weapon_desc`',
							$this->page_home . '.' . '`ammunition_title`',
							$this->page_home . '.' . '`ammunition_desc`',
							$this->page_home . '.' . '`vehicle_title`',
							$this->page_home . '.' . '`vehicle_desc`',
							$this->page_home . '.' . '`forging_title`',
							$this->page_home . '.' . '`forging_desc`',
							$this->page_home . '.' . '`service_title`',
							$this->page_home . '.' . '`service_desc`',
							$this->page_home . '.' . '`commercial_title`',
							$this->page_home . '.' . '`commercial_desc`',
							$this->page_home . '.' . '`news`',
							$this->page_home . '.' . '`product`',
							$this->page_home . '.' . '`innovation`',
							$this->page_home . '.' . '`procurement`',
							$this->page_home . '.' . '`career`',
							$this->page_home . '.' . '`footer_about_title`',
							$this->page_home . '.' . '`footer_about_body`',
							$this->page_home . '.' . '`footer_contact_title`',
							$this->page_home . '.' . '`footer_contact_body`',
							$this->page_home . '.' . '`footer_newsletter_title`',


							$this->page_language . '.' . '`page_language_id`',
							$this->page_language . '.' . '`name`',
							$this->page_language . '.' . '`icon`',
							$this->page_language . '.' . '`default`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_home);
		$this->db->join($this->page_language, $this->page_language . '.' . '`page_language_id`' . ' = ' . $this->page_home . '.' . '`page_language_id`','',FALSE);

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageGuid($guid, $id = NULL)
	{
		$this->field = array(
							$this->page_menu . '.' . '`guid`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_menu);

		$this->db->where($this->page_menu . '.' . '`guid`',$guid);

		if ($id) {
			$this->db->where_not_in($this->page_menu . '.' . '`page_id`',$id);
		}

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageMenu($parent = NULL, $is_menu = NULL, $page_language_id = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`is_menu`',
							$this->page . '.' . '`is_featured`',
							$this->page . '.' . '`mega_menu`',
							$this->page . '.' . '`show_home`',
							$this->page . '.' . '`show_footer`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`order`',

							$this->page_content . '.' . '`menu` AS `content_menu`',

							$this->page_image . '.' . '`file_name` AS `image`',
							$this->page_image . '.' . '`name` AS `image_name`',
							$this->page_image . '.' . '`description` AS `image_description`',

						);

		$this->db->select($this->field, FALSE);

		$image = $this->page_image . '.' . '`is_feature` = "0"';
		$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
		$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);

		if ($is_menu !== NULL) {
			$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		}

		$this->db->where($this->page . '.' . '`publish`',TRUE);
		$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent);

		$this->db->group_by('`page_id`');

		$this->db->order_by('`order`','ASC');
		$this->db->order_by('`date_created`','DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageMenus($parent = FALSE, $is_menu = TRUE, $page_language_id = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`is_menu`',
							$this->page . '.' . '`is_featured`',
							$this->page . '.' . '`mega_menu`',
							$this->page . '.' . '`show_home`',
							$this->page . '.' . '`show_footer`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`type` AS `menu_type`',
							$this->page_menu . '.' . '`order`',

							$this->page_content . '.' . '`menu` AS `content_menu`',
							$this->page_content . '.' . '`title` AS `content_title`',
							$this->page_content . '.' . '`header` AS `content_header`',
							$this->page_content . '.' . '`body` AS `content_body`',

							$this->page_image . '.' . '`file_name` AS `image`',
							$this->page_image . '.' . '`name` AS `image_name`',
							$this->page_image . '.' . '`description` AS `image_description`'

						);

		$this->db->select($this->field, FALSE);

		$image = $this->page_image . '.' . '`is_feature` = "0"';
		$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
		$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);

		if ($is_menu !== NULL) {
			$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		}
		$this->db->where($this->page . '.' . '`publish`',TRUE);

		if ($parent !== FALSE) {
			$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent);
		}

		$this->db->group_by('`page_id`');

		$this->db->order_by('`order`','ASC');
		$this->db->order_by('`date_created`','DESC');

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageSettings($type, $guid = NULL)
	{
		if ($type) {
			$this->field = array(
								$this->page_settings . '.' . '`guid`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page_settings);

			$this->db->where($this->page_settings . '.' . '`type`',$type);

			if ($guid) {
				$this->db->where($this->page_settings . '.' . '`guid`',$guid);
			}

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $type == 'show_home' ? $query->result_object() : $query->row_object();
			}
		}
	}

	public function getPageComment($page_id, $parent = NULL, $publish = TRUE)
	{
		if ($page_id) {
			$this->field = array(
								$this->page_comment . '.' . '`page_comment_id`',
								$this->page_comment . '.' . '`parent_comment_id`',
								$this->page_comment . '.' . '`page_id`',
								$this->page_comment . '.' . '`name`',
								$this->page_comment . '.' . '`email`',
								$this->page_comment . '.' . '`message`',
								$this->page_comment . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page_comment . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								$this->page_comment . '.' . '`publish`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page_comment);

			$this->db->where($this->page_comment . '.' . '`page_id`',$page_id);
			$this->db->where($this->page_comment . '.' . '`parent_comment_id`',$parent);
			$this->db->where($this->page_comment . '.' . '`publish`',$publish);

			$this->db->order_by('`date_created`','ASC');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function setCommentData($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_comment, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function getPageParent($menu_id, $page_language_id = NULL)
	{
		if ($menu_id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

								$this->page_menu . '.' . '`page_menu_id`',
								$this->page_menu . '.' . '`parent_menu_id`',
								$this->page_menu . '.' . '`guid`',
								$this->page_menu . '.' . '`menu`',
								$this->page_menu . '.' . '`order`',

								$this->page_content . '.' . '`menu` AS `content_menu`'
							);

			$this->db->select($this->field, FALSE);

			$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

			$this->db->from($this->page);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
			$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);

			$this->db->where($this->page . '.' . '`publish`',TRUE);
			$this->db->where($this->page_menu . '.' . '`page_menu_id`',$menu_id);

			$this->db->group_by('`page_id`');

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageByType($type, $is_menu = TRUE)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`order`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

		$this->db->where($this->page . '.' . '`publish`',TRUE);
		$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		$this->db->where($this->page . '.' . '`type`',$type);

		$this->db->order_by('`order`','ASC');

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageImage($id, $is_feature = FALSE)
	{
		$this->field = array(
							$this->page_image . '.' . '`page_image_id`',
							$this->page_image . '.' . '`name`',
							$this->page_image . '.' . '`description`',
							$this->page_image . '.' . '`file_name`',
							$this->page_image . '.' . '`file_type`',
							$this->page_image . '.' . '`file_size`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_image);

		$this->db->where($this->page_image . '.' . '`page_id`',$id);

		$this->db->where($this->page_image . '.' . '`is_feature`',$is_feature);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $is_feature ? $query->row_object() : $query->result_object();
		}
	}

	public function getImageProduct($id)
	{
		$this->field = array(
							$this->image_product . '.' . '`image_product_id`',
							$this->image_product . '.' . '`file_name`',
							$this->image_product . '.' . '`file_type`',
							$this->image_product . '.' . '`file_size`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->image_product);

		$this->db->where($this->image_product . '.' . '`page_id`',$id);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageSlider($id)
	{
		$this->field = array(
							$this->page_slider . '.' . '`page_slider_id`',
							$this->page_slider . '.' . '`page_language_id`',
							$this->page_slider . '.' . '`slider_title`',
							$this->page_slider . '.' . '`slider_description`',
							$this->page_slider . '.' . '`slider_button1`',
							$this->page_slider . '.' . '`slider_link1`',
							$this->page_slider . '.' . '`slider_button2`',
							$this->page_slider . '.' . '`slider_link2`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_slider);

		$this->db->where($this->page_slider . '.' . '`page_image_id`',$id);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageFeature($id)
	{
		$this->field = array(
							$this->page_feature . '.' . '`page_feature_id`',
							$this->page_feature . '.' . '`pos_x`',
							$this->page_feature . '.' . '`pos_y`',
							$this->page_feature . '.' . '`title`',
							$this->page_feature . '.' . '`description`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_feature);

		$this->db->where($this->page_feature . '.' . '`page_id`',$id);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageSpesification($id)
	{
		$this->field = array(
							$this->page_spesification . '.' . '`page_spesification_id`',
							$this->page_spesification . '.' . '`name`',
							$this->page_spesification . '.' . '`description`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_spesification);

		$this->db->where($this->page_spesification . '.' . '`page_id`',$id);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageDownload($id)
	{
		$this->field = array(
							$this->page_download . '.' . '`page_download_id`',
							$this->page_download . '.' . '`name`',
							$this->page_download . '.' . '`file_name`',
							$this->page_download . '.' . '`file_type`',
							$this->page_download . '.' . '`file_size`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_download);

		$this->db->where($this->page_download . '.' . '`page_id`',$id);

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getFeatured($page_language_id = NULL, $limit = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`is_menu`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %b %Y") AS created_date',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d %b, %Y") AS created_date_short',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu`',
							$this->page_menu . '.' . '`order`',

							$this->page_image . '.' . '`file_name` AS `image`',

							$this->page_content . '.' . '`menu` AS `content_menu`',
							$this->page_content . '.' . '`title` AS `content_title`',
							$this->page_content . '.' . '`header` AS `content_header`',
							$this->page_content . '.' . '`body` AS `content_body`',

							'GROUP_CONCAT( DISTINCT CONCAT("tag-",' . $this->page_category . '.' . '`guid`)' . ' SEPARATOR " ") AS category',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ' SEPARATOR ",") AS category_name',
							'GROUP_CONCAT( DISTINCT ' . $this->page_category . '.' . '`category`' . ', ":",' . $this->page_category . '.' . '`guid`' . ' SEPARATOR " ") AS category_guid',

							'GROUP_CONCAT( DISTINCT ' . $this->page_tags . '.' . '`tags`' . ' SEPARATOR ",") AS tags'
						);

		$this->db->select($this->field, FALSE);

		$image = $this->page_image . '.' . '`is_feature` = "0"';
		$language = $page_language_id ? $this->page_content . '.' . '`page_language_id` = "' . $page_language_id . '"' : $this->page_content . '.' . '`page_language_id` IS NULL';

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_tags , $this->page_tags . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $image,'left',FALSE);
		$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id` AND ' . $language,'left',FALSE);
		$this->db->join($this->page_category_join, $this->page_category_join . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);
		$this->db->join($this->page_category , $this->page_category . '.' . '`page_category_id`' . ' = ' . $this->page_category_join . '.' . '`page_category_id`','left',FALSE);

		$this->db->where($this->page . '.' . '`publish`',TRUE);
		$this->db->where($this->page . '.' . '`type`','division');
		$this->db->where($this->page . '.' . '`is_menu`',FALSE);
		$this->db->where($this->page . '.' . '`is_featured`',TRUE);

		$this->db->group_by('`page_id`');

		$this->db->order_by($this->page . '.' . '`date_created`','DESC');

		if ($limit !== NULL) {
			$this->db->limit($limit);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageLanguage($id = NULL, $default = FALSE)
	{
		$this->field = array(
							$this->page_language . '.' . '`page_language_id`',
							$this->page_language . '.' . '`name`',
							$this->page_language . '.' . '`icon`',
							$this->page_language . '.' . '`order`',
							$this->page_language . '.' . '`default`',
							$this->page_language . '.' . '`active`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page_language);

		$this->db->where($this->page_language . '.' . '`active`',TRUE);

		if ($id) {
			$this->db->where($this->page_language . '.' . '`page_language_id`',$id);
		}

		if ($default) {
			$this->db->where($this->page_language . '.' . '`default`',TRUE);
		}

		$this->db->order_by($this->page_language . '.' . '`order`','ASC');

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getUser($table, $user_id)
	{
		if ($table && $user_id) {
			$this->field = array(
							$table . '.' . '`user_id` AS `id`',
							$table . '.' . '`form_id`',
							$table . '.' . '`email`',
							$table . '.' . '`username`',
							$table . '.' . '`activation_code`',
							$table . '.' . '`activated`'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($table);

			$this->db->where($table . '.' . '`user_id`',$user_id);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getUserForm($table, $form_id)
	{
		if ($table && $form_id) {
			$this->field = array(
							'*'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($table);

			$this->db->where($table . '.' . '`form_id`',$form_id);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function checkEmail($table, $email)
	{
		if ($table && $email) {
			$this->field = array(
							$table . '.' . '`user_id` AS `id`',
							$table . '.' . '`email`',
							$table . '.' . '`username`',
							$table . '.' . '`activation_code`',
							$table . '.' . '`activated`'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($table);

			$this->db->where($table . '.' . '`email`',$email);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function checkUser($table, $username)
	{
		if ($table && $username) {
			$this->field = array(
							$table . '.' . '`user_id` AS `id`',
							$table . '.' . '`email`',
							$table . '.' . '`username`',
							$table . '.' . '`activation_code`',
							$table . '.' . '`activated`'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($table);

			$this->db->where($table . '.' . '`username`',$username);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function login($table, $username, $password)
	{
		if ($table && $username) {
			$this->field = array(
							$table . '.' . '`user_id` AS `id`',
							$table . '.' . '`email`',
							$table . '.' . '`username`',
							$table . '.' . '`activated`'
						);

			$this->db->select($this->field, FALSE);

			$this->db->from($table);

			$this->db->where($table . '.' . '`username`',$username);
			$this->db->where($table . '.' . '`password`',$password);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function activated($table, $user_id)
	{
		if ($table && $user_id) {
			$data = array('activated' => TRUE);
			$this->db->where($table . '.' . '`user_id`', $user_id);
			$query = $this->db->update($table, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}

	}

	public function signup($table, $data)
	{		
		if ($table && $data) {
			$query = $this->db->insert($table, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateUser($table, $user_id, $data)
	{		
		if ($table && $user_id && $data) {
			$this->db->where($table . '.' . '`user_id`',$user_id);
			$query = $this->db->update($table, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageCounter($id)
	{
		if ($id) {
			$query = $this->db->query("UPDATE `page` SET `visitor` = `visitor` + 1 WHERE `page_id` = '$id'");
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
}

/* End of file pages_model.php */
/* Location: ./application/models/pages/pages_model.php */