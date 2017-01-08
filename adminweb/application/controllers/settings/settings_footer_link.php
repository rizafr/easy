<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Footer_Link extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('settings/footer_link_model');
	}

	public function index()
	{
		$data = array();

		$has_access = $this->is_super;

		if ( ! $has_access ) {
			$this->load->view('common/error_404');
			return FALSE;
		}

		$data['menu'] = 'settings-menu';

		$data['footer_link'] = $this->footer_link_model->get();

		$this->load->view('common/header',$data);
		$this->load->view('settings/footer_link/index');
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

		$data['menu'] = 'settings-menu';

		$this->load->view('common/header',$data);
		$this->load->view('settings/footer_link/add');
		$this->load->view('common/footer');
	}

	public function edit($id)
	{
		$data = array();

		$data['id'] = $id;
		$data['menu'] = 'settings-menu';

		$detail = $this->footer_link_model->get($id);

		if ($detail) {

			$has_access = $this->is_super;

			if ( ! $has_access ) {
				$this->load->view('common/error_404');
				return FALSE;
			}

			$data['detail'] = $detail;

			$this->load->view('common/header',$data);
			$this->load->view('settings/footer_link/edit');
			$this->load->view('common/footer');
		} else {
			$this->load->view('common/error_404');
		}
	}
}
