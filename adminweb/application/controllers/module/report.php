<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('module/report_model');
		$this->load->model('pages/pages_model');
	}

	public function index()
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['files'] = $this->report_model->getAllReport();

		$this->load->view('common/header',$data);
		$this->load->view('module/report/index');
		$this->load->view('common/footer');
	}

	public function add()
	{
		$data = array();

		$data['menu'] = 'module-menu';
		
		$data['language'] = $this->pages_model->getPageLanguage(TRUE);

		$this->load->view('common/header',$data);
		$this->load->view('module/report/add');
		$this->load->view('common/footer');
	}

	public function edit($id)
	{
		$data = array();

		$data['menu'] = 'module-menu';

		$data['id'] = $id;
		if ($id) {
			$data['report'] = $this->report_model->getReport($id);
			
			$this->load->view('common/header',$data);
			$this->load->view('module/report/edit');
			$this->load->view('common/footer');
		}
	}

}

/* End of file slider.php */
/* Location: ./application/controllers/module/slider.php */