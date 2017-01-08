<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_Model extends MY_Model {

	private $db_schema;
	private $db_name;
	private $page_home;
	private $page;
	private $page_menu;
	private $page_content;
	private $page_related;
	private $page_comment;
	private $page_form;
	private $page_category;
	private $page_tags;
	private $page_category_join;
	private $page_image;
	private $page_slider;
	private $page_help;
	private $page_download;
	private $page_language;
	private $page_settings;
	private $image_product;
	private $page_product;
	private $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->db_schema = '`information_schema`';
		$this->db_name = $this->db->database;
		$this->page_home = "`page_home`";
		$this->page = "`page`";
		$this->page_menu = "`page_menu`";
		$this->page_content = "`page_content`";
		$this->page_related = "`page_related_content`";
		$this->page_comment = "`page_comment`";
		$this->page_form = "`page_form`";
		$this->page_category = "`page_category`";
		$this->page_tags = "`page_tags`";
		$this->page_category_join = "`page_category_join`";
		$this->page_image = "`page_image`";
		$this->page_slider = "`page_slider`";
		$this->page_help = "`page_help`";
		$this->page_download = "`page_download`";
		$this->page_language = "`page_language`";
		$this->page_settings = "`page_settings`";
		$this->image_product = "`image_product`";
		$this->page_product = "`page_product`";
		$this->field = NULL;
	}

	public function getTable($table, $type, $data)
	{
		$table_name = $table . '_' . $type;

		if ($this->db->table_exists($table_name)) {
			$new_fields = array();
			$add_fields = array();
			$drop_fields = array();

			$fields = $this->db->list_fields($table_name);

			if ( ! empty($data)) {
				foreach ($data as $key => $value) {
					if ($value['name']) {
						$field = str_replace(' ','_',$value['name']);
						array_push($new_fields,$field);

						if ( ! in_array($field, $fields) ) {
							array_push($add_fields, $data[$key]);
						}
					}
				}
				foreach ($fields as $key => $value) {
					if ( $value !== $type . '_' . 'id' && ! in_array($value, $new_fields) ) {
						array_push($drop_fields, $value);
					}
				}
			} else {
				foreach ($fields as $key => $value) {
					if ( $value !== $type . '_' . 'id') {
						array_push($drop_fields, $value);
					}
				}				
			}

			$result = array(
						'add'	=> $add_fields,
						'drop'	=> $drop_fields
					);

			return $result;
		}
	}

	public function createTable($table, $type, $data)
	{
		$table_name = $table . '_' . $type;

		$this->load->dbforge();

		if (is_array($data)) {
			$fields[$type . '_' . 'id'] = array(
										 'type'				=> 'INT',
										 'constraint'		=> 11, 
										 'auto_increment'	=> TRUE
									);

			foreach ($data as $key => $value) {
				if ($value['name'] && $value['type'] !== 'LABEL' && $value['type'] !== 'BREAK') {
					$field = str_replace(' ','_',$value['name']);
					switch ($value['type']) {
						case 'DATE'		: $data_type = 'DATE'; break;
						case 'EMAIL'	: $data_type = 'VARCHAR'; break;
						case 'COMBO'	: $data_type = 'VARCHAR'; break;
						case 'RADIO'	: $data_type = 'VARCHAR'; break;
						default 		: $data_type = $value['type']; break;
					}
					$fields[$field]['type'] = $data_type;
					if (isset($value['size']) && $value['size']) {
						$fields[$field]['constraint'] = $value['size'];
					}
				}
			}

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key($type . '_' . 'id',TRUE);
			$this->dbforge->create_table($table_name, TRUE);
		}
	}

	public function alterTable($table, $type, $data)
	{
		$table_name = $table . '_' . $type;

		$this->load->dbforge();

		if (isset($data['add']) && ! empty($data['add'])) {			
			foreach ($data['add'] as $key => $value) {
				if ($value['name'] && $value['type'] !== 'LABEL' && $value['type'] !== 'BREAK') {
					$field = str_replace(' ','_',$value['name']);
					switch ($value['type']) {
						case 'DATE'		: $data_type = 'DATE'; break;
						case 'EMAIL'	: $data_type = 'VARCHAR'; break;
						case 'COMBO'	: $data_type = 'VARCHAR'; break;
						case 'RADIO'	: $data_type = 'VARCHAR'; break;
						default 		: $data_type = $value['type']; break;
					}
					$fields[$field]['type'] = $data_type;
					if (isset($value['size']) && $value['size']) {
						$fields[$field]['constraint'] = $value['size'];
					}
				}
			}
			$this->dbforge->add_column($table_name, $fields);
		}

		if (isset($data['drop']) && ! empty($data['drop'])) {
			foreach ($data['drop'] as $key => $value) {
				$this->dbforge->drop_column($table_name, $value);
			}
		}
	}

	public function dropTable($table_name)
	{
		$this->load->dbforge();

		$this->dbforge->drop_table($table_name . '_' . 'form');
		$this->dbforge->drop_table($table_name . '_' . 'user');
	}

	public function getPageDetail($id, $page_id = TRUE)
	{
		if ($id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`user_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`is_featured`',
								$this->page . '.' . '`page_banner`',
								$this->page . '.' . '`page_maps`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%d/%m/%Y") AS date',

								$this->page_menu . '.' . '`page_menu_id`',
								$this->page_menu . '.' . '`parent_menu_id`',
								$this->page_menu . '.' . '`guid`',
								$this->page_menu . '.' . '`menu` AS `name`',
								$this->page_menu . '.' . '`order`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page);
			$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

			if ($page_id) {
				$this->db->where($this->page . '.' . '`page_id`',$id);
			} else {
				$this->db->where($this->page_menu . '.' . '`page_menu_id`',$id);
			}

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
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
				return $query->row_object();
			}
		}
	}

	public function getPageForm($id)
	{
		if ($id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`user_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`is_menu`',
								$this->page . '.' . '`is_featured`',
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

			$this->db->where($this->page . '.' . '`page_id`',$id);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageInquiry($table, $field)
	{
		if ($table && $field) {
			$this->db->select($field, FALSE);
			$this->db->from($table);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageCategory($parent, $group, $page_id = NULL)
	{
		if ($group) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`user_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

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

	public function getPageContent($id,$lang)
	{
		if ($id && $lang) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`user_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

								$this->page_content . '.' . '`page_content_id`',
								$this->page_content . '.' . '`menu`',
								$this->page_content . '.' . '`header`',
								$this->page_content . '.' . '`title`',
								$this->page_content . '.' . '`body`',
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

			$this->db->where($this->page . '.' . '`page_id`',$id);
			$this->db->where($this->page_language . '.' . '`page_language_id`',$lang);

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

	public function getPageComment($page_id, $parent = 'ALL', $publish = NULL)
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
								'DATE_FORMAT(' . $this->page_comment . '.' . '`date_created`' . ',"%W, %d %b %Y <br /> %h:%i:%s") AS created_date',
								$this->page_comment . '.' . '`publish`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page_comment);

			$this->db->where($this->page_comment . '.' . '`page_id`',$page_id);
			if ($parent !== 'ALL') {
				$this->db->where($this->page_comment . '.' . '`parent_comment_id`',$parent);
			}
			if ($publish !== NULL) {
				$this->db->where($this->page_comment . '.' . '`publish`',$publish);
			}

			$this->db->order_by('`date_created`','DESC');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageComments($page_id, $parent = 'ALL', $publish = NULL)
	{
		if ($page_id) {
			$this->field = array(
								'COUNT(*) AS count',
								$this->page_comment . '.' . '`publish`'
							);

			$this->db->select($this->field, FALSE);

			$this->db->from($this->page_comment);

			$this->db->where($this->page_comment . '.' . '`page_id`',$page_id);
			if ($parent !== 'ALL') {
				$this->db->where($this->page_comment . '.' . '`parent_comment_id`',$parent);
			}
			if ($publish !== NULL) {
				$this->db->where($this->page_comment . '.' . '`publish`',$publish);
			}

			$this->db->group_by('`page_id`');

			$this->db->order_by('`date_created`','DESC');

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->row_object();
			}
		}
	}

	public function getPageSetting($lang)
	{
		if ($lang) {
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

			$this->db->where($this->page_language . '.' . '`page_language_id`',$lang);

			$query = $this->db->get();

			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageData($id)
	{
		if ($id) {
			$this->field = array(
								$this->page . '.' . '`page_id`',
								$this->page . '.' . '`user_id`',
								$this->page . '.' . '`type`',
								$this->page . '.' . '`publish`',
								$this->page . '.' . '`date_created`',
								'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

								$this->page_content . '.' . '`page_content_id`',
								$this->page_content . '.' . '`menu`',
								$this->page_content . '.' . '`header`',
								$this->page_content . '.' . '`title`',
								$this->page_content . '.' . '`body`',
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

			$this->db->where($this->page . '.' . '`page_id`',$id);

			$query = $this->db->get();
			
			if ($query && $query->num_rows()) {
				return $query->result_object();
			}
		}
	}

	public function getPageSettingData($id)
	{
		if ($id) {
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

	public function getPageMenu($parent = NULL, $is_menu = TRUE, $lang = NULL)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`user_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

							$this->page_content . '.' . '`page_content_id`',
							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu` AS `name`',
							$this->page_menu . '.' . '`order`',

							$this->page_image . '.' . '`file_name` AS `image`',
							$this->page_image . '.' . '`name` AS `image_name`',
							$this->page_image . '.' . '`description` AS `image_description`',
							$this->page_language . '.' . '`page_language_id`',
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page);
		$this->db->join($this->page_content, $this->page_content . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_language, $this->page_language . '.' . '`page_language_id`' . ' = ' . $this->page_content . '.' . '`page_language_id`','',FALSE);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);
		$this->db->join($this->page_image, $this->page_image . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','left',FALSE);

		$this->db->where($this->page . '.' . '`is_menu`',$is_menu);
		$this->db->where($this->page_menu . '.' . '`parent_menu_id`',$parent);
		
		if($lang) $this->db->where($this->page_language . '.' . '`page_language_id`',$lang);

		$this->db->group_by($this->page . '.' . '`page_id`');

		$this->db->order_by('`order`','ASC');
		$this->db->order_by('`date_created`','DESC');

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function getPageByType($type, $is_menu = TRUE)
	{
		$this->field = array(
							$this->page . '.' . '`page_id`',
							$this->page . '.' . '`user_id`',
							$this->page . '.' . '`type`',
							$this->page . '.' . '`publish`',
							$this->page . '.' . '`date_created`',
							'DATE_FORMAT(' . $this->page . '.' . '`date_created`' . ',"%W, %d %M %Y") AS created_date',

							$this->page_menu . '.' . '`page_menu_id`',
							$this->page_menu . '.' . '`parent_menu_id`',
							$this->page_menu . '.' . '`guid`',
							$this->page_menu . '.' . '`menu` AS `name`',
							$this->page_menu . '.' . '`order`'
						);

		$this->db->select($this->field, FALSE);

		$this->db->from($this->page);
		$this->db->join($this->page_menu, $this->page_menu . '.' . '`page_id`' . ' = ' . $this->page . '.' . '`page_id`','',FALSE);

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

	public function getPageLanguage($active = FALSE)
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

		if ($active) {
			$this->db->where($this->page_language . '.' . '`active`',TRUE);
			$this->db->order_by($this->page_language . '.' . '`default`','DESC');
		}

		$this->db->order_by($this->page_language . '.' . '`order`','ASC');
		$this->db->order_by($this->page_language . '.' . '`active`','DESC');

		$query = $this->db->get();
		
		if ($query && $query->num_rows()) {
			return $query->result_object();
		}
	}

	public function updatePageLanguage($id, $data, $active = FALSE)
	{
		if ($id && $data) {
			if ($active) {
				$this->db->where_in('page_language_id', $id);
			} else {
				$this->db->where_not_in('page_language_id', $id);
			}
			$query = $this->db->update($this->page_language, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPage($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePage($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_id', $id);
			$query = $this->db->update($this->page, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePage($id)
	{
		if ($id) {
			$this->db->where('page_id', $id);
			$query = $this->db->delete($this->page);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}
	
	public function setPageRelated($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_related, $data);
	
			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageContent($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_content, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageContent($id, $lang, $data)
	{
		if ($id && $lang && $data) {
			$this->db->where('page_id', $id);
			$this->db->where('page_language_id', $lang);
			$query = $this->db->update($this->page_content, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageProduct($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_product, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageProduct($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_id', $id);
			$query = $this->db->update($this->page_product, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageComment($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_comment_id', $id);

			$query = $this->db->update($this->page_comment, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageSetting($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_home, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageSetting($lang, $data)
	{
		if ($lang && $data) {
			$this->db->where('page_language_id', $lang);
			$query = $this->db->update($this->page_home, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageForm($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_form, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageForm($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_form_id', $id);
			$query = $this->db->update($this->page_form, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageCategory($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_category, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageCategory($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_category_id', $id);
			$query = $this->db->update($this->page_category, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageCategory($id)
	{
		if ($id) {
			$this->db->where('page_category_id', $id);
			$query = $this->db->delete($this->page_category);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageCategoryJoin($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->page_category_join, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function clearPageCategoryJoin($id, $data)
	{
		if ($id) {
			$this->db->where('page_id', $id);
			if ($data) {
				$this->db->where_not_in('page_category_id',$data);
			}
			$query = $this->db->delete($this->page_category_join);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageTags($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->page_tags, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function clearPageTags($id, $data = NULL)
	{
		if ($id && $data) {
			$this->db->where('page_id', $id);
			if ($data) {
				$this->db->where_not_in('tags',$data);
			}
			$query = $this->db->delete($this->page_tags);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageImage($data, $batch = TRUE)
	{
		if ($data) {
			if ($batch) {
				$query = $this->db->insert_batch($this->page_image, $data);
			} else {
				$query = $this->db->insert($this->page_image, $data);
			}

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageImage($id, $data, $is_feature = FALSE)
	{
		if ($id && $data) {
			if ($is_feature) {
				$this->db->where('page_id',$id);
				$this->db->where('is_feature',$is_feature);
			} else {
				$this->db->where('page_image_id', $id);
			}
			$query = $this->db->update($this->page_image, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.', 'query' => $this->db->last_query());
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageImage($id)
	{
		if ($id) {
			$this->db->where('page_image_id', $id);
			$query = $this->db->delete($this->page_image);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setImageProduct($data, $batch = TRUE)
	{
		if ($data) {
			if ($batch) {
				$query = $this->db->insert_batch($this->image_product, $data);
			} else {
				$query = $this->db->insert($this->image_product, $data);
			}

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateImageProduct($id, $data, $is_feature = FALSE)
	{
		if ($id && $data) {
			$this->db->where('image_product_id', $id);
			$query = $this->db->update($this->image_product, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.', 'query' => $this->db->last_query());
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteImageProduct($id)
	{
		if ($id) {
			$this->db->where('image_product_id', $id);
			$query = $this->db->delete($this->image_product);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageSlider($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_slider, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageSlider($image_id, $language_id, $data)
	{
		if ($image_id && $language_id && $data) {
			$this->db->where('page_image_id', $image_id);
			$this->db->where('page_language_id', $language_id);
			$query = $this->db->update($this->page_slider, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageFeature($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->page_feature, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageFeature($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_feature_id', $id);
			$query = $this->db->update($this->page_feature, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageSpesification($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->page_spesification, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageSpesification($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_spesification_id', $id);
			$query = $this->db->update($this->page_spesification, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageSpesification($id)
	{
		if ($id) {
			$this->db->where('page_spesification_id', $id);
			$query = $this->db->delete($this->page_spesification);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageFeature($id)
	{
		if ($id) {
			$this->db->where('page_feature_id', $id);
			$query = $this->db->delete($this->page_feature);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageDownload($data)
	{
		if ($data) {
			$query = $this->db->insert_batch($this->page_download, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageDownload($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_download_id', $id);
			$query = $this->db->update($this->page_download, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageDownload($id)
	{
		if ($id) {
			$this->db->where('page_download_id', $id);
			$query = $this->db->delete($this->page_download);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageMenu($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_menu, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageMenu($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_id', $id);
			$query = $this->db->update($this->page_menu, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageHelp($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_help, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageHelp($id, $data)
	{
		if ($id && $data) {
			$this->db->where('page_help_id', $id);
			$query = $this->db->update($this->page_help, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageHelp($id)
	{
		if ($id) {
			$this->db->where('page_help_id', $id);
			$query = $this->db->delete($this->page_help);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function setPageSettings($data)
	{
		if ($data) {
			$query = $this->db->insert($this->page_settings, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'insert process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'insert process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updatePageSettings($type, $data, $guid = NULL)
	{
		if ($type && $data) {
			$this->db->where('type', $type);

			if ($guid) {
				$this->db->where('guid', $guid);
			}

			$query = $this->db->update($this->page_settings, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deletePageSettings($type, $guid = NULL)
	{
		if ($type) {
			$this->db->where('type', $type);
			
			if ($guid) {
				$this->db->where('guid', $guid);
			}

			$query = $this->db->delete($this->page_settings);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file pages_model.php */
/* Location: ./application/models/pages/pages_model.php */