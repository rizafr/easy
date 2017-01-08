<?php
/**
 *
 * @author  Ismail <is.tmdg86@gmail.com>
 * @package faspay
 * @version 0.1
 *
 * MyFaspay class
 *
 */
class MyFaspay {

	public $devMIurl = 'http://faspaydev.mediaindonusa.com/pws/';
	public $prodMIurl = 'https://faspay.mediaindonusa.com/pws/';
	public $currency = 'IDR';
	public $terminal ='10';

	public function __construct($config = array()) {
		//
	}

	public function paymentTransaction($payChannel) {
		
		switch ($payChannel) {
			case 301:
				break;
			case 302:
				break;
			case 303:
				break;
			case 304:
				break;
			case 400:
				break;
			case 401:
				{
					$url = $this->devMIurl.'100003/0830000010100000/'.sha1(md5('bot31342G5lU3YLq31342001')).'?trx_id=123456&merchant_id=31342&bill_no=31342001';
					echo $url;
			        $ch = curl_init();
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			        $output = curl_exec($ch);
			        curl_close($ch); 					
				}
				break;
			case 402:
				break;
			case 405:
				break;
			case 406:
					$postData = $this->postDataTransaction('31342', 'Yayasan Inisiatif Zakat Indonesia', '31342001', '12345678', date('Y-m-d g:i:s'), date("Y-m-d g:i:s", strtotime("+1 day")), 'Tes Bayar Zakat', $this->currency, '100000', $payChannel, '1', 'is.tmdg86@gmail.com', $this->terminal, '1', 'Zakat Profesi', '1', '1', '1', '06', NULL, 'bot31342', 'G5lU3YLq');
					echo $postData;
				break;
			case 408:
				break;
			case 500:
				break;
		}
	}
	
	public function inqueryPayment($url, $merchantID, $merchantName, $userID, $password)
	{	
		$body = '<faspay>';
		$body .= '<request>Request List of Payment Gateway</request>';
		$body .= '<merchant_id>'.$merchantID.'</merchant_id>';
		$body .= '<merchant>'.$merchantName.'</merchant>';
		$body .= '<signature>'.sha1(md5($userID.$password)).'</signature>';
		$body .= '</faspay>';

// 		$url = $this->devMIurl.'100001/182xx00010100000';
		
		return $this->sendData($url, $body);
	}
	
	public function postDataTransaction($merchantID,$merchantName,$bill_no,
		$bill_ref, $bill_date, $bill_expired, $bill_desc, $bill_currency,
		$bill_total, $payment_channel, $pay_type,$email, $terminal, 
		$numofitem, $product, $amount, $qty, $payment_plan, $tenor, 
		$merchant_id, $userID, $password)
	{
		$body = '<faspay>';
		$body .= '<request>Post Data Transaksi</request>';
		$body .= '<merchant_id>'.$merchantID.'</merchant_id>';
		$body .= '<merchant>'.$merchantName.'</merchant>';
		$body .= '<bill_no>'.$bill_no.'</bill_no>';
		$body .= '<bill_reff>'.$bill_ref.'</bill_reff>';
		$body .= '<bill_date>'.$bill_date.'</bill_date>';
		$body .= '<bill_expired>'.$bill_expired.'</bill_expired>';
		$body .= '<bill_desc>'.$bill_desc.'</bill_desc>';
		$body .= '<bill_currency>'.$bill_currency.'</bill_currency>';
		$body .= '<bill_total>'.$bill_total.'</bill_total>';
		$body .= '<payment_channel>'.$payment_channel.'</payment_channel>';
		$body .= '<pay_type>'.$pay_type.'</pay_type>';
		$body .= '<email>'.$email.'</email>';
		$body .= '<terminal>'.$terminal.'</terminal>';
		
		for($idx=0;$idx<=$numofitem;$idx++)
		{
			$body .= '<item>';
			$body .= '<product>'.$product.'</product>';
			$body .= '<qty>'.$qty.'</qty>';
			$body .= '<amount>'.$amount.'</amount>';
			$body .= '<payment_plan>'.$payment_plan.'</payment_plan>';
			$body .= '<tenor>'.$tenor.'</tenor>';
			$body .= '<merchant_id>'.$merchant_id.'</merchant_id>';
			$body .= '</item>';
		}	
			
		$body .= '<signature>'.sha1(md5($userID.$password)).'</signature>';
		$body .= '</faspay>';
		
		$url = $this->devMIurl.'300002/183xx00010100000';
		
		return $this->sendData($url, $body);
	}
	
	private function sendData($url, $body)
	{
		$c = curl_init ($url);
		curl_setopt ($c, CURLOPT_POST, true);
		curl_setopt ($c, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt ($c, CURLOPT_POSTFIELDS, $body);
		curl_setopt ($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($c, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec ($c);
		curl_close ($c);
		
		return $response;
	}
	
}