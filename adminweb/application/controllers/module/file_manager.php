<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_Manager extends UI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_dir($dir = NULL)
	{
		$root = $this->path . 'uploads/images/' . ($dir ? $dir . '/' : '');
		$root_dir = glob($root . '*');

		$response = array();

		foreach ($root_dir as $key => $value) {
			if (is_dir($value)) {
				array_push($response, $value);
			}
		}

		//echo json_encode($response);
	}

}