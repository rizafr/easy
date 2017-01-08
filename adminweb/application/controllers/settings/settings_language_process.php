<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Language_Process extends IO_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('pages/pages_model');
	}

	public function update()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$language = $this->input->post('language');

			$data = array(
						'active'	=> TRUE
					);
			$this->pages_model->updatePageLanguage($language,$data,TRUE);

			$data = array(
						'active'	=> FALSE
					);
			$this->pages_model->updatePageLanguage($language,$data,FALSE);

			$response = array(
							'success' => TRUE,
							'message' => array(
											'success' => array(
															'update process successful.'
														)
										)
						);
			echo json_encode($response);
		}
	}
}

/* End of file settings_language_process.php */
/* Location: ./application/controllers/settings/settings_language_process.php */