<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends IO_Controller {

	private $image_path, $image_dir, $content_path, $content_dir;

	public function __construct()
	{
		parent::__construct();

		$this->image_path = $this->path . 'uploads/images/';
		$this->image_dir = $this->dir . 'uploads/images/';
		$this->content_path = $this->path . 'uploads/images/content/';
		$this->content_dir = $this->dir . 'uploads/images/content/';
	}

	public function read()
	{
		$items = array();
		$path = glob($this->image_path . '*');

		if ($path) {
			foreach ($path as $directory) {
				$folder = glob($this->image_path . basename($directory) . '/full/' . '*');
				if ($folder) {
					foreach ($folder as $dir) {
						$name = basename($dir);
						$ext = pathinfo($name,PATHINFO_EXTENSION);
						if($ext) {
							$full = $this->image_dir . basename($directory) . '/' . 'full/' . $name;
							if (file_exists($this->image_path . basename($directory) . '/' . 'thumb/' . $name)) {
								$thumb = $this->image_dir . basename($directory) . '/' . 'thumb/' . $name;
							} else {
								$thumb = $this->image_dir . basename($directory) . '/' . 'full/' . $name;
							}
							$item = array(
										'image'		=> $full,
										'thumb'		=> $thumb,
										'title'		=> $name
									);
							array_push($items, $item);
						}
					}
				}
			}
		}

		echo json_encode($items);
	}

	public function upload()
	{
		$error = "";
		$type = strtolower($_FILES['file']['type']);

		if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/gif' || $type == 'image/jpeg' || $type == 'image/pjpeg') {
			
			$this->load->library('upload');
			$this->load->library('image_lib'); 

			$info = pathinfo($_FILES['file']['name']);

			$name = $info['filename'];
			$ext = $info['extension'];
			$base = $info['basename'];

			$width = 400;
			$height = 400;

			// init upload config

			if ( ! is_dir($this->content_path . 'full/')) {
				mkdir($this->content_path . 'full/',0777,TRUE);
			}

			if ( ! is_dir($this->content_path . 'thumb/')) {
				mkdir($this->content_path . 'thumb/',0777,TRUE);
			}

			$config['upload']['upload_path'] = $this->content_path . 'full/';
			$config['upload']['allowed_types'] = 'png|jpg|gif|jpeg|pjpeg';
			$config['upload']['max_size'] = '8000';
			$config['upload']['max_width'] = '1366';
			$config['upload']['max_height'] = '768';
			$config['upload']['file_name'] = $base;

			$this->upload->initialize($config['upload']);

			if ( ! $this->upload->do_upload('file') ) {

				$error = $this->upload->display_errors('','');

			} else {
				
				$upload_data = $this->upload->data();

				$image_path = $this->content_path . 'full/' . $upload_data['file_name'];

				$master_dim = 'auto';
				$original = file_exists($image_path) ? $this->_get_size($image_path) : NULL;
				if ($original) {
					$original_aspect = $original['width'] / $original['height'];
					$thumb_aspect = $width / $height;
					$master_dim = $original_aspect >= $thumb_aspect ? 'height' : 'width';
				}

				$thumb_path = $this->content_path  . 'thumb/' . $upload_data['file_name'];

				// init resize config

				$config['resize']['image_library'] = 'gd2';
				$config['resize']['source_image'] = $image_path;
				$config['resize']['new_image'] = $thumb_path;
				$config['resize']['maintain_ratio'] = TRUE;
				$config['resize']['master_dim'] = $master_dim;
				$config['resize']['width'] = $width;
				$config['resize']['height'] = $height;

				$this->image_lib->initialize($config['resize']);

				$this->image_lib->resize();

				$this->image_lib->clear();

				$resize = $this->_get_size($thumb_path);

				$y_axis = floor(($resize['height'] - $height) / 2);
				$x_axis = floor(($resize['width'] - $width) / 2);

				$config['crop']['image_library'] = 'gd2';
				$config['crop']['source_image'] = $thumb_path;
				$config['crop']['new_image'] = $thumb_path;
				$config['crop']['maintain_ratio'] = FALSE;
				$config['crop']['width'] = $width;
				$config['crop']['height'] = $height;
				$config['crop']['y_axis'] = $y_axis;
				$config['crop']['x_axis'] = $x_axis;

				$this->image_lib->initialize($config['crop']);
				$this->image_lib->crop();

				$this->image_lib->clear();

				$response = array(
								'filelink'	=> $this->content_dir . 'full/' . $upload_data['file_name']
							);

				echo json_encode($response);

			}

		}
	}

	 private function _get_size($image)
	 {
		 $img = getimagesize($image);
		 if( ! empty($img) ) {
		 	return array('width' => $img['0'], 'height' => $img['1']);
		 }
	}
	
}

/* End of file images.php */
/* Location: ./application/controllers/uploads/images.php */