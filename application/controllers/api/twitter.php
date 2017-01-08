<?php
class Twitter extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function timeline()
	{
		$response = 'failed';
		if (function_exists("curl_init")) {

			$url = 'http://api.getmytweets.co.uk/?screenname=catoto&limit=5';

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

			curl_setopt($ch, CURLOPT_URL, $url);
			$response = curl_exec($ch);
			
			if ($response) {
				$data = json_decode($response);

				$data->screen_name = 'Nurul Hayat';

				$response = json_encode($data);
				
				if(isset($data->tweets)) {
				
					$fp = fopen('./document/twitter/timeline.json', 'w');
					fwrite($fp, $response);
					fclose($fp);
					
				}
			}
		}

		echo $response;

	}

	public function limit()
	{
		$url = 'http://api.twitter.com/1/account/rate_limit_status.json';
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);

		$data = json_decode($response);
		
		if(isset($data->reset_time)) {
			$data->active_at = date('d M Y H:i:s',strtotime($data->reset_time));
		}
		
		echo json_encode($data);
	}

}