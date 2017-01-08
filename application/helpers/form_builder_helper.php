<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('FBLabel'))
{
	function FBLabel($value, $label)
	{
		$return = '<h3>' . $label . '</h3>';
		return $return;
	}
}

if ( ! function_exists('FBBreak'))
{
	function FBBreak($value, $label)
	{
		$return = '<hr />';
		return $return;
	}
}

if ( ! function_exists('FBText'))
{
	function FBText($value, $label)
	{
		$return = 	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<input type="text" name="' . $value['name'] . '" placeholder="' . $label . '" class="form-control" id="form-' . $value['name'] . '"' . (isset($value['mandatory']) && $value['mandatory'] ? ' required' : '') . ' />' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
	}
}

if ( ! function_exists('FBTextarea'))
{
	function FBTextarea($value, $label)
	{
		$return = 	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<textarea name="' . $value['name'] . '" placeholder="' . $label . '" class="form-control" id="form-' . $value['name'] . '"' . (isset($value['mandatory']) && $value['mandatory'] ? ' required' : '') . ' rows="10"></textarea>' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
	}
}

if ( ! function_exists('FBDate'))
{
	function FBDate($value, $label)
	{
		$return = 	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<input type="text" name="' . $value['name'] . '" placeholder="' . $label . '" class="form-control datepicker" id="form-' . $value['name'] . '" readonly="readonly"' . (isset($value['mandatory']) && $value['mandatory'] ? ' required' : '') . ' />' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
	}
}

if ( ! function_exists('FBEmail'))
{
	function FBEmail($value, $label)
	{
		$return = 	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<input type="text" name="' . $value['name'] . '" placeholder="' . $label . '" class="form-control datepicker" id="form-' . $value['name'] . '"' . (isset($value['mandatory']) && $value['mandatory'] ? ' required' : '') . ' />' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
	}
}

if ( ! function_exists('FBSelect'))
{
	function FBSelect($value, $label)
	{
		$return =  	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<select name="' . $value['name'] . '" class="form-control">' .
					'			<option value=""> - ' . $label . ' - </option>';

		if ($value['value']) {
			foreach ($value['value'] as $item) {
				$return .= '<option value="' . $item . '">' . $item . '</option>';
			}
		}

		$return .= 	'		</select>' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
	}
}

if ( ! function_exists('FBRadio'))
{
	function FBRadio($value, $label)
	{
		$return =  	'<section>' .
					'	<div class="form-group">' .
					'		<label for="form-' . $value['name'] . '">' . $label . (isset($value['mandatory']) && $value['mandatory'] ? ' <span class="required">*</span>' : '') . '</label>' .
					'		<fieldset>' .
					'			<option value=""> - ' . $label . ' - </option>';

		if ($value['value']) {
			foreach ($value['value'] as $item) {
				$return .= 	'<label>' .
							'	<input type="radio" name="' . $value['name'] . '" value="' . $item . '" />' .
							'	' . $val .
							'</label>';
			}
		}

		$return .= 	'		</fieldset>' .
					'		<small class="error" id="error-' . $value['name'] . '"></small>' .
					'	</div>' .
					'</section>';
		return $return;
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

/* End of file form_builder_helper.php */
/* Location: ./system/helpers/form_builder_helper.php */