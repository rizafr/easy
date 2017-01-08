<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('trim_text'))
{
	function trim_text($input, $length = 100, $ellipses = true, $strip_html = true) {
		//strip tags, if desired
		if ($strip_html) {
			$input = strip_tags($input);
		}

		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {
			return $input;
		}

		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);

		//add ellipses (...)
		if ($ellipses) {
			$trimmed_text .= '...';
		}

		return $trimmed_text;
	}
}

if ( ! function_exists('trimString')) 
{
	function trimString($string, $length)
	{
		if(strlen($string) > $length)
		{
			$temp[0] = substr($string, 0, $length);
			$temp[1] = substr($string, $length);
			$SpacePos = strpos($temp[1], ' ');
			if($SpacePos !== FALSE) {
				$string = $temp[0] . substr($temp[1], 0, $SpacePos) . '...';
			} else {
				$string = $temp[0];
			}
		}
		return $string;
	}
}

/* End of file custom_helper.php */
/* Location: ./system/helpers/custom_helper.php */