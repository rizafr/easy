<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends UI_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('pages/pages_model');
	}

	public function index($parent_id, $page_id)
	{
		$data = array();

		$data['language'] = $this->pages_model->getPageLanguage(TRUE);

		$data['id'] = $page_id;
		$data['parent_id'] = $parent_id;
		$data['menu'] = 'pages-menu';
		$data['page'] = $this->pages_model->getPageDetail($page_id);
		$content = 'edit';

		$data['comment'] = $this->pages_model->getPageComment($page_id,'ALL',FALSE);

		if ($data['comment']) {
		}

		$this->load->view('common/header',$data);
		$this->load->view('comment/index');
		$this->load->view('common/footer');
	}

}

/* End of file comment.php */
/* Location: ./application/controllers/comment/comment.php */