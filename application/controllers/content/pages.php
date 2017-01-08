<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('pages/pages_model');
		$this->load->model('member/user_model');
		$this->load->model('member/product_model');
		$this->load->model('module/donate_model');
		$this->load->model('module/slider_model');
		$this->load->model('member/member_model');
		$this->load->model('member/branch_model');
		$this->load->model('member/report_model');
		
		$this->load->library('MyFaspay');
	}

	public function image($width, $height, $dir, $file)
	{
		$data['width'] = $width;
		$data['height'] = $height;
		$data['file'] = base_url() . 'uploads/images/' . $dir . '/full/' . $file;

		$this->load->view('content/image',$data);
	}

	public function search($keyword, $pagination = 1)
	{
		$data = array();

		$data['type'] = 'static';
		$keyword = urldecode($keyword);
		$data['keyword'] = $keyword;
		$data['pagination'] = $pagination;
		$data['page_menu'] = $this->get_page_menu();
		$data['page_language'] = $this->pages_model->getPageLanguage();
		$data['popular_footer'] = $this->get_popular(FALSE,5);
		$data['not_found'] = 'Search';

		if (isset($_SESSION['login']['profile']['user_id'])) {
			$data['user'] = $this->user_model->getUser($_SESSION['login']['profile']['user_id']);
			if ($data['user']) {
				$data['profile'] = $this->profile_model->getprofile($data['user']->profile_id);
			}
		}

		$data['page_detail'] = new stdClass();

		$data['page_detail']->content['default'] = new stdClass();
		$data['page_detail']->content['default']->title = 'Search';
		$data['page_detail']->content['default']->header = '';
		$data['page_detail']->content['default']->menu = 'Search Result';

		$data['current'] = $keyword;

		$data['search_list'] = $this->pages_model->getPageSearch($keyword,$this->language_id,$pagination,5);
		if ($data['search_list']) {
			foreach ($data['search_list'] as $key => $value) {
				$data['search_list'][$key]->content = $this->get_content($value->page_id);
			}
		}
		
		$total_search = $this->get_total_search($keyword,$this->language_id);
		$data['total_page'] = ceil($total_search / 5);


		$data['language_id'] = isset($data['page_detail']->content[$this->language_id]) ? $this->language_id : 'default';

		$this->load->view('common/header',$data);
		$this->load->view('content/search');
		$this->load->view('common/footer');
	}

	public function index($guid = 'home', $pagination = NULL)
	{
		$data = array();
		
		if($guid === 'verify') {
			
			$guid = 'myaccount';
			$email  = isset($_GET["email"])?$_GET["email"]:"";
			$code = isset($_GET["code"])?$_GET["code"]:"";
			
			if($email && $code)
			{
				$email = mysql_real_escape_string($email);
				$code = mysql_real_escape_string($code);
					
				$verified = $this->member_model->checkAccount($email, $code);
				if($verified)
				{
					if($verified->active < 1) {
						$result = $this->member_model->updateMember($verified->member_id, array("active"=>1));
							
						if($result['success'] > 0)
						{
							$_SESSION['login']['profile']['user_id'] = $verified->member_id;
						}
					}
					else {
						$guid = 'home';
					}
				}
				else {
					$guid = 'home';
				}
			}
			else {
				$guid = 'home';
			}
		}
		
		if($guid === 'myaccount')
		{
			if (!isset($_SESSION['login']['profile']['user_id'])) {
				$guid = 'home';
			}
		} 
		
		$data['guid'] = $guid;
		$data['pagination'] = $pagination;
		$data['page_menu'] = $this->get_page_menu();
		$data['page_language'] = array();

		$get['page_language'] = $this->pages_model->getPageLanguage();
		if ($get['page_language']) {
			$lang_index = 1;
			foreach ($get['page_language'] as $key => $value) {
				if ($this->language_id == $value->page_language_id) {
					$data['page_language'][0] = $value;
				} else {
					$data['page_language'][$lang_index++] = $value;
				}
			}
		}

		ksort($data['page_language']);
		
		if($guid == 'donate-now')
		{
			$type  = isset($_GET["type"])?$_GET["type"]:"";
			$get_zakat  = isset($_GET["get_zakat"])?$_GET["get_zakat"]:"";
			$method  = isset($_GET["method"])?$_GET["method"]:"";
			$idonate  = isset($_GET["idm"])?$_GET["idm"]:"";
			$fcalc = array(
				'type' => $type,
				'value' => $get_zakat,
				'method' => $method,
				'donate_id' => $idonate
			);
			$data['calculated'] = $fcalc;
		}
		
		$data['page_detail'] = $this->pages_model->getPageDetail('guid',$guid);
		$data['popular_footer'] = $this->get_popular(FALSE,5);
		$data['not_found'] = 'Page Not Found';

		if (isset($_SESSION['login']['profile']['user_id'])) {
			$data['user'] = $this->member_model->getMember($_SESSION['login']['profile']['user_id']);
			if ($data['user']) {
				$data['zakat'] = $this->donate_model->getDonate($data['user']->member_id);
				$form_url = "https://api.c27g.com/donor/v1/donations?access-token=".$data['user']->izitoken;
				// Initialize cURL
				$curl = curl_init();		
				curl_setopt($curl,CURLOPT_URL, $form_url);
				curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
				$mydonation = curl_exec($curl);
				curl_close($curl);
				$data['mydonation'] = $mydonation;
// 				echo json_encode($mydonation);exit();
			}
		}

		if (! empty($data['page_detail'])) {
			$id = $data['page_detail']->page_id;

			$data['page_id'] = $data['page_detail']->page_id;
			$data['menu_id'] = $data['page_detail']->page_menu_id;
			$data['parent_menu_id'] = $data['page_detail']->parent_menu_id;
			$data['parent_id'] = $data['parent_menu_id'];

			$data['current'] = $data['guid'];
			$this->get_current($data['parent_menu_id'],$data['current']);

			$data['breadcrumbs'] = $this->get_breadcrumbs($data['menu_id']);
			
			$data['attachments'] = $this->pages_model->getPageDownload($data['page_id']);

			$data['page_detail']->content = $this->get_content($data['page_id']);

			$data['language_id'] = isset($data['page_detail']->content[$this->language_id]) ? $this->language_id : 'default';
			
			$this->site_title .= ' - ' . $data['page_detail']->content[$data['language_id']]->menu;

			$data['parent_detail'] = $this->pages_model->getPageDetail('menu_id',$data['parent_menu_id']);

			if (! empty($data['parent_detail'])) {
				$data['parent_page_id'] = $data['parent_detail']->page_id;
				$data['parent_detail']->content = $this->get_content($data['parent_page_id']);
				if (! $data['page_detail']->is_menu) {
					$data['parent_id'] = $data['parent_detail']->parent_menu_id;
				}
			}

			$data['parent_child'] = $this->get_page_menu($data['parent_id'],'1');

			$data['sharepost'] = $this->load->view('common/share',$data,TRUE);

			$this->pages_model->setPageCounter($id);
			
			switch ($data['page_detail']->type) {				
				case 'home'			: $this->home_page($id,$data); break;
				case 'static'		: $this->static_page($id,$data); break;
				case 'product'		: $this->product_page($id,$data); break;
				case 'product-item'	: $this->product_item_page($id,$data); break;
// 				case 'parent'		: $data['page_detail']->display ? $this->parent_page($id,$data) : $this->default_page($data); break;
				case 'article'		: $data['page_detail']->is_menu ? $this->article_page($id,$data) : $this->article_detail($id,$data); break;
				case 'form'			: $this->form_page($id,$data); break;
				case 'gallery'		: $this->gallery_page($id,$data); break;
				case 'nearby'		: $this->nearby_page($id,$data); break;
				case 'team'			: $this->team_page($id,$data); break;
				case 'register'		: $this->register_page($id,$data); break;
				case 'myaccount'	: $this->myaccount_page($id, $data); break;
				default 			: $this->default_page($data); break;
			}
		} else {
			//$this->default_page($data);
		}
	}

	public function archive($guid, $month, $year, $pagination = NULL)
	{
		$data = array();

		$data['guid'] = $guid;
		$data['month'] = $month;
		$data['year'] = $year;
		$data['pagination'] = $pagination;
		$data['page_menu'] = $this->get_page_menu();
		$data['page_language'] = $this->pages_model->getPageLanguage();
		$data['page_detail'] = $this->pages_model->getPageDetail('guid',$guid);
		$data['popular_footer'] = $this->get_popular(FALSE,5);
		$data['not_found'] = 'Page Not Found';
		
		if (! empty($data['page_detail'])) {
			$id = $data['page_detail']->page_id;

			$data['page_id'] = $data['page_detail']->page_id;
			$data['menu_id'] = $data['page_detail']->page_menu_id;
			$data['parent_menu_id'] = $data['page_detail']->parent_menu_id;
			$data['parent_id'] = $data['parent_menu_id'];

			$data['current'] = $data['guid'];
			$this->get_current($data['parent_menu_id'],$data['current']);

			$data['breadcrumbs'] = $this->get_breadcrumbs($data['menu_id']);
			
			$data['attachments'] = $this->pages_model->getPageDownload($data['page_id']);

			$data['page_detail']->content = $this->get_content($data['page_id']);

			$data['language_id'] = isset($data['page_detail']->content[$this->language_id]) ? $this->language_id : 'default';
			$this->site_title .= ' - ' . $data['page_detail']->content[$data['language_id']]->menu;

			$data['parent_detail'] = $this->pages_model->getPageDetail('menu_id',$data['parent_menu_id']);

			if (! empty($data['parent_detail'])) {
				$data['parent_page_id'] = $data['parent_detail']->page_id;
				$data['parent_detail']->content = $this->get_content($data['parent_page_id']);
				if (! $data['page_detail']->is_menu) {
					$data['parent_id'] = $data['parent_detail']->parent_menu_id;
				}
			}

			$data['parent_child'] = $this->get_page_menu($data['parent_id'],'1');

			$data['sharepost'] = $this->load->view('common/share',$data,TRUE);

			$this->pages_model->setPageCounter($id);

			switch ($data['page_detail']->type) {
				case 'home'			: $this->home_page($id,$data); break;
				case 'static'		: $this->static_page($id,$data); break;
				case 'product'		: $this->product_page($id,$data); break;
				case 'product-item'	: $this->product_item_page($id,$data); break;
				case 'parent'		: $data['page_detail']->display ? $this->parent_page($id,$data) : $this->default_page($data); break;
				case 'article'		: $data['page_detail']->is_menu ? $this->article_page($id,$data) : $this->article_detail($id,$data); break;
				case 'form'			: $this->form_page($id,$data); break;
				case 'gallery'		: $this->gallery_page($id,$data); break;
				case 'nearby'		: $this->nearby_page($id,$data); break;
				case 'team'			: $this->team_page($id,$data); break;
				case 'register'		: $this->register_page($id,$data); break;
				case 'myaccount'	: $this->myaccount_page($id, $data); break;
				default 			: $this->default_page($data); break;
			}
		} else {
			$this->default_page($data);
		}
	}

	private function default_page($data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/default');
		$this->load->view('common/footer');
	}

	private function home_page($id, $data)
	{
		// get home_center
		$home_center = $this->pages_model->getPageSettings('home_center');
		if ($home_center) {
			$data['home_center'] = $this->pages_model->getPageDetail('guid', $home_center->guid);
			if ($data['home_center']) {
				$data['home_center']->content = $this->get_content($data['home_center']->page_id);
				if (in_array($data['home_center']->type, array('article', 'gallery'))) {
					$data['home_center']->article = $this->get_latest($data['home_center']->page_menu_id,6,'0');
				}
			}
		}

		// get home_left
		$home_left = $this->pages_model->getPageSettings('home_left');
		if ($home_left) {
			$data['home_left'] = $this->pages_model->getPageDetail('guid', $home_left->guid);
			if ($data['home_left']) {
				$data['home_left']->content = $this->get_content($data['home_left']->page_id);
				if (in_array($data['home_left']->type, array('article', 'gallery'))) {
					$data['home_left']->article = $this->get_latest($data['home_left']->page_menu_id,2,'0');
				}
			}
		}

		// get home_right
		$home_right = $this->pages_model->getPageSettings('home_right');
		if ($home_right) {
			$data['home_right'] = $this->pages_model->getPageDetail('guid', $home_right->guid);
			if ($data['home_right']) {
				$data['home_right']->content = $this->get_content($data['home_right']->page_id);
				if (in_array($data['home_right']->type, array('article', 'gallery'))) {
					$data['home_right']->article = $this->get_latest($data['home_right']->page_menu_id,2,'0');
					
				}
			}
		}

		// get show_home
		$show_home = $this->pages_model->getPageSettings('show_home');
		if ($show_home) {
			$data['show_home'] = array();
			foreach ($show_home as $key => $value) {
				$get['show_home'] = $this->pages_model->getPageDetail('guid', $value->guid);
				if ($get['show_home']) {
					$get['show_home']->content = $this->get_content($get['show_home']->page_id);
					array_push($data['show_home'], $get['show_home']);
				}
			}
		}

		$data['slider'] = $this->slider_model->getAllSlider();

		$this->load->view('common/header',$data);
		$this->load->view('content/slider');
		$this->load->view('content/home');
		$this->load->view('common/footer');
	}
	
	private function register_page($id, $data)
	{
		$data['cabang'] = $this->branch_model->get_branch();
		$this->load->view('common/header',$data);
		$this->load->view('module/register/register');
		$this->load->view('common/footer');
	}
	
	private function myaccount_page($id, $data)
	{
		$data['report'] = $this->report_model->getAllReport();
		$this->load->view('common/header',$data);
		$this->load->view('member/profile');
		$this->load->view('common/footer');

	}

	private function nearby_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/nearby');
		$this->load->view('common/footer');
	}

	private function team_page($id, $data)
	{
		$this->load->view('common/header',$data);
		$this->load->view('content/team');
		$this->load->view('common/footer');
	}

	private function static_page($id, $data)
	{
		if($id=='81') {
			$data['cabang'] = $this->branch_model->get_branch();
		}
		$data['page_image'] = $this->pages_model->getPageImage($id);
		$data['page_download'] = $this->pages_model->getPageDownload($id);
		
		$data['nisab'] = $this->donate_model->getNisab();

		$sidebar_product = $this->pages_model->getPageDetail('guid','sejarah');
		if ($sidebar_product) {
			$data['sidebar_product'] = $this->get_list($sidebar_product->page_menu_id, 1, 2);
		}
// 		echo json_encode($data); exit();
		$this->load->view('common/header',$data);
		$this->load->view('content/static');
		$this->load->view('common/footer');
	}

	private function product_page($id, $data)
	{
		$data['product_list'] = $this->get_list($data['page_detail']->page_menu_id);
		if ($data['product_list']) {
			foreach ($data['product_list'] as $key => $value) {
				$value->product_detail = $this->pages_model->getPageProduct($value->page_id);
			}
		}

		$this->load->view('common/header',$data);
		$this->load->view('content/product');
		$this->load->view('common/footer');
	}

	private function product_item_page($id, $data)
	{
		$data['product_detail'] = $this->pages_model->getPageProduct($id);
		$data['page_image'] = $this->pages_model->getPageImage($id);
		$data['image_product'] = $this->pages_model->getImageProduct($id);
		$data['page_download'] = $this->pages_model->getPageDownload($id);

		$sidebar_product = $this->pages_model->getPageDetail('guid','apartement');
		if ($sidebar_product) {
			$data['sidebar_product'] = $this->get_list($sidebar_product->page_menu_id);
		}

		$this->load->view('common/header',$data);
		$this->load->view('content/product_item');
		$this->load->view('common/footer');
	}

	private function article_page($id, $data)
	{
		$parent_id = $data['page_detail']->page_menu_id;
		$data['page_download'] = $this->pages_model->getPageDownload($id);
		//$data['pagination'] = $data['pagination'] ? $data['pagination'] : 1;

		$archive = NULL;
		if (isset($data['month']) && $data['month'] && isset($data['year']) && $data['year']) {
			$archive = $data['month'] . '-' . $data['year'];
			$data['pagination_archive'] = '/archive/' . $data['month'] . '/' . $data['year'];
			$data['article_list'] = $this->get_archive($parent_id,$data['month'] . '-' . $data['year'],$data['pagination'],5,'0');
		} else {
			$data['article_list'] = $this->get_list($parent_id,$data['pagination'],5,'0');
		}

		$data['page_image'] = $this->pages_model->getPageImage($id);
		$data['article_category'] = $this->pages_model->getPageCategory($parent_id,'article');
		$data['tags'] = $this->pages_model->getPageTags();

		$total_article = $this->get_total_data($parent_id,$this->language_id,$archive);
		//$data['total_page'] = ceil($total_article / 5);

		//$data['page_archive'] = $this->pages_model->getPageArchive($parent_id);
// 		$data['counter'] = $this->get_total_data($parent_id,$this->language_id,$archive);
		$data['latest_article'] = $this->get_latest($parent_id,5,'0');
		$data['popular_article'] = $this->get_popular($parent_id,5,'0');

// 		echo json_encode($data['latest_article']); exit();
		$this->load->view('common/header',$data);
		if($id=="52") $this->load->view('content/program');
		elseif ($id=="46") $this->load->view('content/faq');
		else $this->load->view('content/article');
		$this->load->view('common/footer');
	}

	private function article_detail($id, $data)
	{
		$parent_id = $data['page_detail']->page_menu_id;
		$data['page_download'] = $this->pages_model->getPageDownload($id);
		$data['article_category'] = $this->pages_model->getPageCategory($parent_id,'article');
		$data['content_category'] = $this->pages_model->getPageCategory($parent_id,'article',$id);
		$data['tags'] = $this->pages_model->getPageTags();
		$data['content_tags'] = $this->pages_model->getPageTags($id);
		$data['page_image'] = $this->pages_model->getPageImage($id);
		$data['page_related'] = $this->pages_model->getPageRelated($data['page_detail']->content['default']->page_content_id);
// 		echo json_encode($data['page_related']); exit();
// 		echo json_encode($data['page_detail']->content['default']->page_content_id); exit();
		$data['latest_article'] = $this->get_latest($data['page_detail']->parent_menu_id,5,'0');
		$data['popular_article'] = $this->get_popular($data['page_detail']->parent_menu_id,5,'0');

// 		echo json_encode($data['latest_article']); exit();
		$data['page_archive'] = $this->pages_model->getPageArchive($data['page_detail']->parent_menu_id);

		$data['comment'] = array();

		$this->get_comment($data['comment'],$id);

		$this->load->view('common/header',$data);
		$this->load->view('content/article_detail');
		$this->load->view('common/footer');
	}

	private function form_page($id, $data, $content = 'form')
	{
		$data['page_download'] = $this->pages_model->getPageDownload($id);
		$data['page_form'] = $this->pages_model->getPageForm($id);

		$data['page_image'] = $this->pages_model->getPageImage($id);
// 		$data['form_signed_up'] =  !$data['page_form']->signed_up || ($data['page_form']->signed_up && $is_super);
		$data['cabang'] = $this->branch_model->get_branch();
		
		$this->load->view('common/header',$data);
		if($id=="60") {
			
			$url = 'https://faspay.mediaindonusa.com/pws/100001/382xx00010100000';
			$payment['inquery'] = $this->myfaspay->inqueryPayment($url, '31342', 'Yayasan Inisiatif Zakat Indonesia', 'bot31342', 'G5lU3YLq'); echo json_encode($payment['inquery']);exit();
			$this->load->view('module/donate/donate',$payment);
		}
		else $this->load->view('content/' . $content);
		$this->load->view('common/footer');

	}

	private function gallery_page($id, $data)
	{
		$data['type'] = 'static';
		$parent_id = $data['page_detail']->page_menu_id;
		$data['image_list'] = $this->get_list($parent_id);
		if ($data['image_list']) {
			foreach ($data['image_list'] as $key => $value) {
				$image_download = $this->pages_model->getPageDownload($value->page_id);
				$data['image_list'][$key]->download = $image_download;

				$images = $this->pages_model->getPageImage($value->page_id);
				$data['image_list'][$key]->images = $images;
			}
		}
echo json_encode($data); exit();
		$data['image_category'] = $this->pages_model->getPageCategory($parent_id,'gallery');

		$this->load->view('common/header',$data);
		$this->load->view('content/gallery');
		$this->load->view('common/footer');
	}

	private function get_content($id)
	{
		if ($id) {
			$content['default'] = NULL;
			$page_data = $this->pages_model->getPageData($id);

			if ($page_data) {
				foreach ($page_data as $key => $value) {
					if ($value->default) {
						$content['default'] = $value;
					}
					$content[$value->page_language_id] = $value;
				}
				return $content;
			}
		}
	}

	private function get_total_data($parent_id, $language_id, $archive = NULL)
	{
		$result = $this->pages_model->getPageCount($parent_id,$language_id,$archive);

		if ($result) {
			return $result->total;
		}
	}

	private function get_total_search($keyword, $language_id)
	{
		$result = $this->pages_model->getPageSearchCount($keyword,$language_id);

		if ($result) {
			return $result->total;
		}
	}

	private function get_list($parent_id, $pagination = NULL, $rows = 5, $is_menu = NULL)
	{
		$result = $this->pages_model->getPageChild($parent_id,'list',$pagination,$rows,$is_menu);
		if ($result) {
			foreach ($result as $key => $value) {
				$result[$key]->content = $this->get_content($value->page_id);
			}
		}
		return $result;
	}

	private function get_archive($parent_id, $archive, $pagination = NULL, $rows = 5, $is_menu = NULL)
	{
		$result = $this->pages_model->getPageArchiveChild($parent_id,$archive,$pagination,$rows,$is_menu);
		if ($result) {
			foreach ($result as $key => $value) {
				$result[$key]->content = $this->get_content($value->page_id);
			}
		}
		return $result;
	}

	private function get_latest($parent_id, $limit = 5, $is_menu = NULL)
	{		
		$result = $this->pages_model->getPageChild($parent_id,'latest',1,$limit,$is_menu);
		if ($result) {
// 			echo json_encode($result); exit();
			foreach ($result as $key => $value) {
				
// 				$result[$key]->counter = $this->get_total_data($parent_id,$this->language_id,NULL);
				$result[$key]->content = $this->get_content($value->page_id);
			}
		}
		return $result;
	}

	private function get_popular($parent_id, $limit = 5, $is_menu = NULL)
	{
		$result = $this->pages_model->getPageChild($parent_id,'popular',1,$limit,$is_menu);
		if ($result) {
			foreach ($result as $key => $value) {
				$result[$key]->content = $this->get_content($value->page_id);
			}
		}
		return $result;
	}

	private function get_featured($language_id, $limit = NULL)
	{
		$result = $this->pages_model->getFeatured($language_id,$limit);
		if ($result) {
			foreach ($result as $key => $value) {
				$result[$key]->content = $this->get_content($value->page_id);
			}
		}
		return $result;
	}

	private function get_page_menu($parent_id = FALSE, $is_menu = NULL)
	{
		/*
		$response = array();

		$this->create_menu($response,$parent_id,TRUE);

		return $response;
		*/
		$menu = array();

		$data = $this->pages_model->getPageMenus($parent_id,NULL,$this->language_id);

		$parent = $parent_id ? $parent_id : NULL;

		$this->generate_menu($data,$menu,$parent,$is_menu);

		return $menu;
	}

	private function generate_menu($data, &$menu, $parent, $is_menu)
	{
		if ( ! empty($data)) {
			foreach ($data as $key => $value) {
				if ($value->parent_menu_id === $parent) {
					$valid = TRUE;
					if ($is_menu !== NULL && $is_menu !== $value->is_menu) {
						$valid = FALSE;
					}

					if ($valid) {
						$item = array(
									'page_id'	=> $value->page_id,
									'is_menu'	=> $value->is_menu,
									'menu_type'	=> $value->menu_type,
									'mega_menu'	=> $value->mega_menu,
									'publish'	=> $value->publish,
									'menu_id'	=> $value->page_menu_id,
									'parent_id'	=> $value->parent_menu_id,
									'image_dir'	=> $value->type,
									'image'		=> $value->image,
									'guid'		=> $value->guid,
									'menu'		=> $value->content_menu,
									'title'		=> $value->content_title,
									'header'	=> $value->content_header,
									'body'		=> $value->content_body,
									'type'		=> $value->type,
									'children'	=> array()
								);
						$value->children = array();
						$this->generate_menu($data,$item['children'],$value->page_menu_id,$is_menu);

						if (empty($item['children'])) {
							unset($item['children']);
						}

						$push = TRUE;

						if ($value->type == 'gallery' && ! $value->is_menu) {
							$push = FALSE;
						}

						if ($push) {
							array_push($menu, $item);
						}
					}
				}
			}
		}
	}

	private function create_menu(&$items, $parent = NULL, $is_menu = TRUE)
	{
		$menu = $this->pages_model->getPageMenu($parent,$is_menu,$this->language_id);

		if (! empty($menu)) {
			foreach ($menu as $key => $value) {
				// get page data
				$page_data = $this->pages_model->getPageData($value->page_id);

				$menu_item[$value->page_id]['default'] = '';
				$body_item[$value->page_id]['default'] = '';

				if ($page_data) {
					foreach ($page_data as $k => $val) {
						if ($val->default) {
							$menu_item[$value->page_id]['default'] = $val->menu;
							$body_item[$value->page_id]['default'] = $val->body;
						}
						$menu_item[$value->page_id][$val->page_language_id] = $val->menu;
						$body_item[$value->page_id][$val->page_language_id] = $val->body;
					}
				}


				$item = array(
							'page_id'	=> $value->page_id,
							'is_menu'	=> $value->is_menu,
							'mega_menu'	=> $value->mega_menu,
							'publish'	=> $value->publish,
							'menu_id'	=> $value->page_menu_id,
							'parent_id'	=> $value->parent_menu_id,
							'image_dir'	=> $value->type,
							'image'		=> $value->image,
							'guid'		=> $value->guid,
							'menu'		=> isset($menu_item[$value->page_id][$this->language_id]) ? $menu_item[$value->page_id][$this->language_id] : $menu_item[$value->page_id]['default'],
							'body'		=> isset($body_item[$value->page_id][$this->language_id]) ? $body_item[$value->page_id][$this->language_id] : $body_item[$value->page_id]['default'],
							'type'		=> $value->type,
							'children'	=> array()
						);

				$show_menu = $is_menu === NULL || $item['mega_menu'] ? NULL : TRUE;

				$this->create_menu($item['children'],$item['menu_id'],$show_menu);
				if (empty($item['children'])) {
					unset($item['children']);
				}
				array_push($items,$item);
			}
		}
	}

	private function get_comment(&$items, $page_id, $parent = NULL)
	{
		$comment = $this->pages_model->getPageComment($page_id,$parent);

		if (! empty($comment)) {
			foreach ($comment as $key => $value) {
				// get page data
				$item = array(
							'page_id'		=> $value->page_id,
							'comment_id'	=> $value->page_comment_id,
							'name'			=> $value->name,
							'email'			=> $value->email,
							'message'		=> $value->message,
							'created_date'	=> $value->created_date,
							'publish'		=> $value->publish,
							'children'		=> array()
						);
				$this->get_comment($item['children'],$page_id,$value->page_comment_id);
				if (empty($item['children'])) {
					unset($item['children']);
				}
				array_push($items,$item);
			}
		}
	}

	private function get_current($parent_id, &$current)
	{
		$parent = $this->pages_model->getPageParent($parent_id,$this->language_id);
		if ($parent) {
			$current = $parent->guid;
			if ($parent->parent_menu_id) {
				$this->get_current($parent->parent_menu_id,$current);
			}
		}
	}

	private function get_breadcrumbs($menu_id)
	{
		$response = array();

		do {
			$menu = $this->pages_model->getPageParent($menu_id,$this->language_id);
			if ($menu) {
				$menu->menu = $menu->content_menu ? $menu->content_menu : $menu->menu;
				$menu_id = $menu->parent_menu_id;
				array_push($response, $menu);
			} else {
				$menu_id = NULL;
			}

		} while ($menu_id);

		if ($response) {
			krsort($response);
		}

		return $response;
	}

	private function _get_size($image)
	{
		$img = getimagesize($image);
		if( ! empty($img) ) {
			return array('width' => $img['0'], 'height' => $img['1']);
		}
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/content/pages.php */
