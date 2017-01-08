<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inquiry extends UI_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('pages/pages_model');
		$this->load->model('user/user_model');
		$this->load->model('inquiry/inquiry_model');
	}

	public function detail($id,$inquiry_id)
	{
		$data = array();

		$data['language'] = $this->pages_model->getPageLanguage(TRUE);

		$data['inquiry_id'] = $inquiry_id;
		$data['parent_id'] = $id;
		$data['menu'] = 'pages-menu';

		$data['form'] = $this->pages_model->getPageForm($id);
		$data['inquiry'] = NULL;

		if ($data['form']) {
			$data['inquiry'] = $this->inquiry_model->getDetailInquiry($data['form']->table_name . '_form',$inquiry_id);
		}

		$this->load->view('common/header',$data);
		$this->load->view('inquiry/detail');
		$this->load->view('common/footer');
	}

	public function download($id, $type = 'excel')
	{
		$data['language'] = $this->pages_model->getPageLanguage(TRUE);

		$data['form'] = $this->pages_model->getPageForm($id);

		$data['inquiry'] = NULL;

		if ($data['form']) {
			$data['field'] = json_decode($data['form']->data);
			$data['inquiry'] = $this->inquiry_model->getAllInquiry($data['form']->table_name . '_form');

			if ($data['field']) {
				foreach ($data['field'] as $key => $value) {
					$data['field'][$key] = get_object_vars($data['field'][$key]);
					$data['field'][$key]['label'] = $data['field'][$key]['label'] ? get_object_vars($data['field'][$key]['label']) : array();
				}
			}

			switch ($type) {
				case 'excel'	: $this->export_excel($data); break;
				case 'mysql'	: $this->export_mysql($data); break;
			}
		}
	}

	private function export_mysql($data)
	{
		$replace = array(' ','.',',','-');

		$is_label = FALSE;
		$no_label = 0;

		$header_label = '';
		$field_label = '';

			$query = "
/* DATA INQUIRY " . $data['form']->form_name . " */


";

		$label_header = array();
		$label_field = array();
		$content_field = $data['inquiry'];

		foreach ($data['field'] as $key => $value) {
			foreach ($data['language'] as $k => $val) {
				if (isset($value['label']['_' . $val->page_language_id])) {
					$field_label = $value['label']['_' . $val->page_language_id];
				}
			}

			if ($value['type'] === 'LABEL') {
				$header_label = $field_label;
				$header_name = $value['name'];
				$field_label = '';
				$no_label++;

				$label_header[$no_label] = array(
												'index'		=> strtolower($header_label),
												'colspan'	=> 0
											);

			}

			if ($value['type'] === 'BREAK') {
				$header_label = '';
				$field_label = '';
				$no_label++;
			}

			if ($field_label) {
				$field = array(
								'name'		=> $value['name'],
								'type'		=> $value['type'],
								'index'		=> strtolower($field_label),
								'desc'		=> strtolower($field_label),
								'number'	=> $no_label
							);

				array_push($label_field, $field);
			}

		}

		if ($label_field) {

			$email = 1;
			$combo = 1;
			$radio = 1;
			$varchar = 1;
			$text = 1;
			$date = 1;
			$default = 1;

			$table_name = str_replace($replace, ' ', $data['form']->table_name);

			$query = "
CREATE TABLE IF NOT EXISTS `" . $table_name . "_form` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT,";

    		$columns = array();

			foreach ($label_field as $key => $value) {
				$description = $label_field[$key]['index'];

				if (array_key_exists($value['number'], $label_header)) {
					$description = $label_header[$value['number']]['index'] . ' ' . $label_field[$key]['index'];
					$label_header[$value['number']]['colspan']++;
				}

				switch ($value['type']) {
					case 'EMAIL'	: $value['type'] .= $email++; $type = 'VARCHAR(200)'; break;
					case 'COMBO'	: $value['type'] .= $combo++; $type = 'VARCHAR(200)'; break;
					case 'RADIO'	: $value['type'] .= $radio++; $type = 'VARCHAR(200)'; break;
					case 'VARCHAR'	: $value['type'] .= $varchar++; $type = 'VARCHAR(200)'; break;
					case 'TEXT'		: $value['type'] .= $text++;  $type = 'TEXT'; break;
					case 'DATE'		: $value['type'] .= $date++; $type = 'DATE';break;
					default 		: $value['type'] .= $default++; $type = 'VARCHAR(200)'; break;
				}

				$label_field[$key]['desc'] = $description;

				$length = 30 - (strlen($value['type']) + strlen($type));

				$query .= "
    `" . $value['type'] . "` " . $type . " NOT NULL,";

    			if ($length > 0) {
	    			for ($i=0; $i < $length; $i++) { 
	    				$query .= ' ';
	    			}
	    		}

    			$query .= "/* " . $description . " */";

    			array_push($columns, "`" . $value['type'] . "`");

			}

			$query .= "
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			
			if ( ! empty($content_field) ) {

				$query .= "

INSERT INTO `" . $table_name . "_form`";

				$query .= "
    (";
				$query .= implode(', ', $columns);
    			$query .= ")
VALUES";

				$start = TRUE;

				foreach ($content_field as $key => $value) {
					if ($start === FALSE) {
						$query .= ",";
					}
					$query .= "
    (";
    				$items = array();
					foreach ($label_field as $k => $val) {
						array_push($items, "'" . $value->{$val['name']} . "'");
						//$query .= "'" . $value->{$val['name']} . "', ";
					}
					$query .= implode(', ', $items);
					$query .= ")";

					$start = FALSE;
				}
			}

			$query .= "

			";

		}

		header("Content-type: text/sql");
		header("Content-Disposition: attachment; filename=laporan " . $data['form']->form_name . ".sql");
		header("Pragma: no-cache");
		header("Expires: 0");

		echo $query;
	}

	private function export_excel($data)
	{	
		$is_label = FALSE;
		$no_label = 0;

		$header_label = '';
		$field_label = '';

		$label_header = array();
		$label_field = array();
		$content_field = $data['inquiry'];

		foreach ($data['field'] as $key => $value) {
			foreach ($data['language'] as $k => $val) {
				if (isset($value['label']['_' . $val->page_language_id])) {
					$field_label = $value['label']['_' . $val->page_language_id];
				}
			}

			if ($value['type'] === 'LABEL') {
				$header_label = $field_label;
				$header_name = $value['name'];
				$field_label = '';
				$no_label++;

				$label_header[$no_label] = array(
												'index'		=> $header_label,
												'colspan'	=> -1
											);

			}

			if ($value['type'] === 'BREAK') {
				$header_label = '';
				$field_label = '';
				$no_label++;
			}

			if ($field_label) {
				$field = array(
								'name'		=> $value['name'],
								'index'		=> $field_label,
								'number'	=> $no_label
							);

				array_push($label_field, $field);
			}

		}
		

		if ($label_field) {
			foreach ($label_field as $key => $value) {
				if (array_key_exists($value['number'], $label_header)) {
					$label_header[$value['number']]['colspan']++;
				}
			}
		}

		//load our new PHPExcel library
		$this->load->library('excel');

		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->setShowGridLines(FALSE);

		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Laporan ' . $data['form']->form_name);

		$col_name = range('A','Z');
		$row_title_header = 2;
		$col_header = 1;
		$row_header = $row_title_header + 1;
		$cols = ! empty($label_field) ? $col_header + count($label_field) - 1 : $col_header;

		if($col_header > 0) {
			for ($i = $col_name[0]; $i < $col_name[$col_header]; $i++) {
				$this->excel->getActiveSheet()->getColumnDimension($i)->setWidth(3);
			}
		}

		for ($i = $col_name[$col_header]; $i <= ($cols > 25 ? 'A' . $col_name[$cols - 25] : $col_name[$cols]); $i++) {
			$this->excel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
		}

		$styleArray = array(
						'borders' => array(
										'bottom' => array(
															'style' => PHPExcel_Style_Border::BORDER_DOUBLE
														)
									),
						'font' => array(
									'bold' 	=> TRUE
								)
					);

		$row_title = $row_title_header;
		$this->excel
				->getActiveSheet()
				->setCellValue($col_name[$col_header] . $row_title, 'Laporan ' . $data['form']->form_name)
				->mergeCells($col_name[$col_header] . $row_title . ':' . ($cols > 25 ? 'A' . $col_name[$cols - 25] : $col_name[$cols]) . $row_title)
				->getStyle($col_name[$col_header] . $row_title . ':' . ($cols > 25 ? 'A' . $col_name[$cols - 25] : $col_name[$cols]) . $row_title)->applyFromArray($styleArray);

		$col = $col_header;
		$row = $row_header;

		$col_index = array();

		$row++;

		$styleArray = array(
						'fill' => array(
									'type' 	=> PHPExcel_Style_Fill::FILL_SOLID,
									'color'	=> array(
													'rgb'=>'e2e2e2'
												)
								),
						'borders' => array(
										'outline' => array(
															'style' => PHPExcel_Style_Border::BORDER_THIN
														)
									),
						'alignment' => array(
									'horizontal' 	=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
									'vertical' 		=> PHPExcel_Style_Alignment::VERTICAL_CENTER,
									'indent'		=> 1
								),
						'font' => array(
									'bold' 	=> TRUE
								)
					);

		if( ! empty($label_header) ) {
			foreach ($label_header as $key => $value) {
				if ($value['colspan'] !== -1) {
					$curcol = $col > 25 ? 'A' . $col_name[$col - 25] : $col_name[$col];
					$mercol = $col + $value['colspan'] > 25 ? 'A' . $col_name[$col + $value['colspan'] - 25] : $col_name[$col + $value['colspan']];

					$this->excel
							->getActiveSheet()
							->setCellValue($curcol . $row, $value['index'])
							->mergeCells($curcol . $row . ':' . $mercol . $row)
							->getStyle($curcol . $row . ':' . $mercol . $row)->applyFromArray($styleArray);

					$col = $col + $value['colspan'] + 1;
				}
			}

			$col = $col_header;
			$row++;
		}

		if( ! empty($label_field) ) {
			foreach ($label_field as $key => $value) {
				$curcol = $col > 25 ? 'A' . $col_name[$col - 25] : $col_name[$col];

				$this->excel
						->getActiveSheet()
						->setCellValue($curcol . $row, $value['index'])
						->getStyle($curcol . $row)->applyFromArray($styleArray);

				$col_index[$value['name']] = $curcol;

				$col = $col + 1;
			}

			$col = $col_header;
			$row++;		
		}

		$first_content = $row;

		if ( ! empty($content_field) && ! empty($col_index) ) {
			foreach ($content_field as $key => $value) {
				foreach ($col_index as $k => $val) {
					$this->excel
						->getActiveSheet()
						->setCellValue($val . $row, $value->{$k});
				}
				$row++;
			}
		}

		$last_content = $row - 1;

		$styleArray = array(
							'borders' => array(
											'allborders' => array(
																'style' => PHPExcel_Style_Border::BORDER_THIN
															)
										)
							);

		$this->excel->getActiveSheet()->getStyle($col_name[$col_header] . $first_content . ':' . ($cols > 25 ? 'A' . $col_name[$cols - 25] : $col_name[$cols]) . $last_content)->applyFromArray($styleArray);

		//$this->excel->getActiveSheet()->getStyle($col_name[$col_header] + 1)->getAlignment()->setWrapText(TRUE);

		$filename='laporan ' . $data['form']->form_name . '.xlsx'; //save our workbook as this file name

		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

}

/* End of file inquiry.php */
/* Location: ./application/controllers/inquiry/inquiry.php */