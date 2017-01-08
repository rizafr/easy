<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->helper('download');
	}

	public function index($directory, $filename)
	{
		$fullpath = FCPATH . 'uploads\attachment\\' . $directory . '\\' . $filename;
		$fullpath = str_replace("\\", "/", $fullpath);

		if (file_exists($fullpath)) {
			$data = file_get_contents($fullpath); // Read the file's contents
			$name = $filename;

			force_download($name, $data);
		} else {
			echo 'file not found....';
		}
	}
}

/* End of file downloads.php */
/* Location: ./application/controllers/content/downloads.php */