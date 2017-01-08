<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('user/user_model');
		$this->load->model('pages/pages_model');
	}

	public function index()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['menu'] = 'user-menu';

		$data['user'] = $this->user_model->getAllUser();

		$this->load->view('common/header',$data);
		$this->load->view('user/user/index');
		$this->load->view('common/footer');
	}

	public function add()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['menu'] = 'user-menu';

		$data['level'] = $this->user_model->getAllUserLevel();

		$this->load->view('common/header',$data);
		$this->load->view('user/user/add');
		$this->load->view('common/footer');
	}

	public function edit($id)
	{
		$data = array();

		$data['id'] = $id;
		$data['menu'] = 'user-menu';

		$detail = $this->user_model->getUser($id);

		if ($detail) {

			$has_access = $id === $this->user_id;

			$has_access = $has_access || $this->is_super;

			if ( ! $has_access ) {
				$this->load->view('common/error_404');
				return FALSE;
			}

			$data['detail'] = $detail;
			$data['level'] = $this->user_model->getAllUserLevel();

			$this->load->view('common/header',$data);
			$this->load->view('user/user/edit');
			$this->load->view('common/footer');
		} else {
			$this->load->view('common/error_404');
		}
	}

	public function level()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['menu'] = 'user-menu';

		$data['user_level'] = $this->user_model->getAllUserLevel();

		$this->load->view('common/header',$data);
		$this->load->view('user/user_level/index');
		$this->load->view('common/footer');
	}

	public function add_level()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['user_menu'] = 'user-menu';

		$data['user_menu'] = array();
		$this->create_menu($data['user_menu'],NULL,NULL);

		$this->load->view('common/header',$data);
		$this->load->view('user/user_level/add');
		$this->load->view('common/footer');
	}

	public function edit_level($id)
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['id'] = $id;
		$data['user_menu'] = 'user-menu';

		$detail = $this->user_model->getUserLevel($id);

		if ($detail) {
			$data['detail'] = $detail;

			$data['user_menu'] = array();
			$this->create_menu($data['user_menu'],$id,NULL);

			$this->load->view('common/header',$data);
			$this->load->view('user/user_level/edit');
			$this->load->view('common/footer');
		} else {
			$this->load->view('common/error_404');
		}
	}

	private function create_menu(&$items, $id = NULL, $parent = NULL)
	{
		$menu = $this->user_model->getUserPageRelation($id,$parent);

		if (! empty($menu)) {
			foreach ($menu as $key => $value) {
				$item = array(
							'page_id'	=> $value->page_id,
							'publish'	=> $value->publish,
							'active'	=> $value->user_level,
							'menu_id'	=> $value->page_menu_id,
							'parent_id'	=> $value->parent_menu_id,
							'menu'		=> $value->name,
							'type'		=> $value->type,
							'children'	=> array()
						);

				$this->create_menu($item['children'],$id,$item['menu_id']);
				if (empty($item['children'])) {
					unset($item['children']);
				}
				array_push($items,$item);
			}
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user/user.php */