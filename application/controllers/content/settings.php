<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('pages/pages_model');
	}

	public function language($id)
	{
		$result = $this->pages_model->getPageLanguage($id);
		if ($result) {
			$_SESSION['language_id'] = $id;
			echo 'success';
		}
	}

	public function set_language($id, $guid = NULL)
	{
		$redirect = base_url();
		if ($id) {
			$result = $this->pages_model->getPageLanguage($id);
			if ($result) {
				$_SESSION['language_id'] = $id;
			}
			$redirect .= $guid;
		}

		redirect($redirect);
	}

	public function index($guid = 'home')
	{
		$data = array();

		$data['page_menu'] = $this->get_page_menu();
		$data['page_language'] = $this->pages_model->getPageLanguage();

		$data['page_detail'] = $this->pages_model->getPageDetail($guid);

		if ($data['page_detail']) {
			$id = $data['page_detail']->page_id;
			$type = $data['page_detail']->type;
			$is_menu = $data['page_detail']->is_menu;

			// get page data
			$page_data = $this->pages_model->getPageData($id);

			if ($page_data) {
				foreach ($page_data as $key => $value) {
					if ($value->default) {
						$data['page_content']['default'] = $value;
					}
					$data['page_content'][$value->page_language_id] = $value;
				}
			}

			switch ($type) {
				case 'home'		: $this->home_page($id,$data); break;
				case 'static'	: $this->static_page($id,$data); break;
				case 'form'		: $this->form_page($id,$data); break;
				case 'division'	: $is_menu ? $this->division_page($id,$data) : $this->product_page($id,$data); break;
				case 'article'	: $is_menu ? $this->article_page($id,$data) : $this->article_detail($id,$data); break;
				default 		: $this->home_page($id,$data); break;
			}
		}
	}

	private function home_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/home');
		$this->load->view('common/footer');
	}

	private function static_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/static');
		$this->load->view('common/footer');
	}

	private function form_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/form');
		$this->load->view('common/footer');
	}

	private function division_page($id, $data)
	{
		$data['page_download'] = $this->pages_model->getPageDownload($id);

		$this->load->view('common/header',$data);
		$this->load->view('content/division');
		$this->load->view('common/footer');
	}

	private function product_page($id, $data)
	{
		$data['page_image'] = $this->pages_model->getPageImage($id);
		$data['page_image_feature'] = $this->pages_model->getPageImage($id,TRUE);
		$data['page_feature'] = $this->pages_model->getPageFeature($id);

		$this->load->view('common/header',$data);
		$this->load->view('content/product');
		$this->load->view('common/footer');
	}

	private function article_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/article');
		$this->load->view('common/footer');
	}

	private function article_detail($id, $data)
	{
		$data['page_image'] = $this->pages_model->getPageImage($id);

		$this->load->view('common/header',$data);
		$this->load->view('content/article_detail');
		$this->load->view('common/footer');
	}

	private function get_page_menu()
	{
		$response = array();

		$this->create_menu($response);

		return $response;
	}

	private function create_menu(&$items, $parent = NULL)
	{
		$menu = $this->pages_model->getPageMenu($parent,TRUE,$this->language_id);

		if (! empty($menu)) {
			foreach ($menu as $key => $value) {
				$item = array(
							'page_id'	=> $value->page_id,
							'publish'	=> $value->publish,
							'menu_id'	=> $value->page_menu_id,
							'parent_id'	=> $value->parent_menu_id,
							'guid'		=> $value->guid,
							'menu'		=> $value->content_menu ? $value->content_menu : $value->menu,
							'type'		=> $value->type,
							'children'	=> array()
						);
				$this->create_menu($item['children'],$item['menu_id']);
				if (empty($item['children'])) {
					unset($item['children']);
				}
				array_push($items,$item);
			}
		}
	}

}

/* End of file settings.php */
/* Location: ./application/controllers/content/settings.php */