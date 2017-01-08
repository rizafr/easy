<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends UI_Controller {

	var $type_list, $content_list;

	public function __construct()
	{
		parent::__construct();

		$this->type_list = array('home','static','parent','division','product','product-item','form','article','gallery','nearby');
		$this->content_list = array('article','gallery');

		$this->load->model('pages/pages_model');
		$this->load->model('user/user_model');
	}

	public function add($parent_id = NULL)
	{
		$data = array();

		$content = 'add_parent';

		$data['menu'] = 'pages-menu';
		$data['parent_id'] = $parent_id;
		$data['language'] = $this->pages_model->getPageLanguage(TRUE);

		$this->create_menu($data['parent']);

		$has_access = FALSE;

		if ($parent_id !== NULL) {
			$content = 'add_children';
			$has_access = $this->user_model->getPageAccess($this->level_id,$parent_id);

			$data['detail_parent'] = $this->pages_model->getPageDetail($parent_id);
			$data['category'] = $this->pages_model->getPageCategory($data['detail_parent']->page_menu_id, $data['detail_parent']->type);
			$data['content'] = $this->pages_model->getPageMenu($data['detail_parent']->page_menu_id, FALSE);
// 			echo  json_encode($data['content']); exit();
		}

		$has_access = $has_access || $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$this->load->view('common/header',$data);
		$this->load->view('pages/' . $content);
		$this->load->view('common/footer');
	}

	public function edit($id = NULL)
	{
		$data = array();

		if ( ! $id ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$content = 'edit_parent';

		$data['id'] = $id;
		$data['menu'] = 'pages-menu';
		$data['parent_detail'] = NULL;
		$data['parent_id'] = NULL;
		$data['language'] = $this->pages_model->getPageLanguage(TRUE);
		$data['detail'] = $this->pages_model->getPageDetail($id);

		if ($data['detail'] && in_array($data['detail']->type, $this->type_list)) {

			if ($data['detail']->type == 'home') {
				//$content = 'home';
			}

			$data['product'] = $this->pages_model->getPageProduct($id);

			$get['show_home'] = $this->pages_model->getPageSettings('show_home', $data['detail']->guid);
			$data['detail']->show_home = $get['show_home'] && $get['show_home']->guid == $data['detail']->guid ? TRUE : FALSE;

			$get['home_center'] = $this->pages_model->getPageSettings('home_center');
			$data['detail']->home_center = $get['home_center'] && $get['home_center']->guid == $data['detail']->guid ? TRUE : FALSE;

			$get['home_left'] = $this->pages_model->getPageSettings('home_left');
			$data['detail']->home_left = $get['home_left'] && $get['home_left']->guid == $data['detail']->guid ? TRUE : FALSE;

			$get['home_right'] = $this->pages_model->getPageSettings('home_right');
			$data['detail']->home_right = $get['home_right'] && $get['home_right']->guid == $data['detail']->guid ? TRUE : FALSE;

			if ($data['detail']->parent_menu_id) {
				$data['parent_detail'] = $this->pages_model->getPageDetail($data['detail']->parent_menu_id,FALSE);
				$data['parent_id'] = $data['parent_detail']->page_id;
			}

			if ($data['detail']->is_menu) {
				$has_access = $this->user_model->getPageAccess($this->level_id,$id);
			} else {
				$has_access = $this->user_model->getParentAccess($this->level_id,$data['detail']->parent_menu_id);
			}

			$has_access = $has_access || $this->is_super;

			if ( ! $has_access ) {
				$this->load->view('common/error_404');
				return FALSE;
			}

			$data['current_page'] = $data['detail'];
			$data['tags'] = $this->pages_model->getPageTags($id);
			$data['download'] = $this->pages_model->getPageDownload($id);
			$data['image'] = $this->pages_model->getPageImage($id);
			$data['image_product'] = $this->pages_model->getImageProduct($id);

			if ($data['image']) {
				foreach ($data['image'] as $key => $value) {
					$slider = $this->pages_model->getPageSlider($value->page_image_id);
					if ($slider) {
						foreach ($slider as $k => $val) {
							$data['image'][$key]->slider[$val->page_language_id] = $val;
						}
					}
				}
			}

			$this->create_menu($data['parent'],$id);
			$this->create_menu($data['children'],$id,0,$id);

			$data['parent_limit'] = 4 - count($data['children']);

			if ($data['parent']) {
				ksort($data['parent']);
			}

			$page_data = $this->pages_model->getPageData($id);

			if ($page_data) {
				foreach ($page_data as $key => $value) {
					if ($value->default) {
						$data['data']['default'] = $value;
					}
					$data['data'][$value->page_language_id] = $value;
				}
			}
			// get page setting
			$page_setting = $this->pages_model->getPageSettingData($id);

			if ($page_setting) {
				foreach ($page_setting as $key => $value) {
					if ($value->default) {
						$data['setting']['default'] = $value;
					}
					$data['setting'][$value->page_language_id] = $value;
				}
			}

			if (in_array($data['detail']->type, $this->content_list)) {
				if ($data['detail']->is_menu) {
					$data['detail_content'] = $data['detail']->type;
					$data['detail_parent'] = $data['detail'];
					$data['content'] = $this->pages_model->getPageMenu($data['detail_parent']->page_menu_id, FALSE);
					if ($data['content']) {
						foreach ($data['content'] as $key => $value) {

							$page_data = $this->pages_model->getPageData($value->page_id);

							if ($page_data) {
								foreach ($page_data as $k => $val) {
									if ($val->default) {
										$data['content'][$key]->content['default'] = $val;
									}
								}
							}

							$data['content'][$key]->accessable = $this->is_super || ($this->user_id === $value->user_id);
							$data['content'][$key]->comment = $this->pages_model->getPageComments($value->page_id,'ALL');
						}
					}
				} else {
					$content = 'edit_children';
					$data['detail_parent'] = $data['parent_detail'];
					$data['category'] = $this->pages_model->getPageCategory($data['detail_parent']->page_menu_id, $data['detail_parent']->type,$id);
				}

				$data['current_page'] = $data['detail_parent'];
			}

			$data['comment'] = $this->pages_model->getPageComment($id,'ALL');

			$data['form'] = $this->pages_model->getPageForm($id);
			$data['inquiry'] = array();

			if ($data['form']) {
				$table = $data['form']->table_name;
				$form_table = $table . '_form';
				$form_data = json_decode($data['form']->data);
				$form_field = array('form_id');
				$form_column = array();
				$total_field = 0;

				if (is_array($form_data)) {
					foreach ($form_data as $key => $value) {
						$value = get_object_vars($value);
						$value['label'] = $value['label'] ? get_object_vars($value['label']) : array();
						if ($value['type'] === 'VARCHAR' && $total_field < 4) {
							array_push($form_field, $value['name']);
							array_push($form_column, $value['label']);
							$total_field++;
						}
					}

					if ( ! empty($form_field)) {
						$table_field = implode(', ', $form_field);
					}

					$data['inquiry']['table'] = $form_table;
					$data['inquiry']['column'] = $form_column;
					$data['inquiry']['field'] = $form_field;
					$data['inquiry']['item'] = $this->pages_model->getPageInquiry($form_table,$table_field);
				}
			}

			if (!$this->is_super && !$data['detail']->is_menu && $data['detail']->user_id !== $this->user_id) {
				$this->load->view('common/error_404');
			} else {
				$this->load->view('common/header',$data);
				$this->load->view('pages/' . $content);
				$this->load->view('common/footer');			
			}
		} else {
			$this->load->view('common/error_404');
		}
	}

	private function create_menu(&$items, $id = NULL, $level = 0, $parent = NULL)
	{
		$level++;
		$menu = $this->pages_model->getPageMenu($parent);

		if (! empty($menu)) {
			foreach ($menu as $key => $value) {
				$item = array(
							'page_id'	=> $value->page_id,
							'menu_id'	=> $value->page_menu_id,
							'parent_id'	=> $value->parent_menu_id,
							'name'		=> $value->name,
							'type'		=> $value->type
						);

				if ($id !== $value->page_id) {
					$this->create_menu($items,$id,$level,$item['menu_id']);
					$items[$level][] = $item;
				}
			}
		}
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages/pages.php */