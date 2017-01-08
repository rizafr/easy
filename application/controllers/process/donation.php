<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donation extends MY_Controller {

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('module/donate_model');
		$this->load->model('member/member_model');
		
		$this->load->helper('email');
		
		$this->load->library('MyFaspay');
		$this->devMIurl = 'http://faspaydev.mediaindonusa.com/pws/';
		$this->prodMIurl = 'https://faspay.mediaindonusa.com/pws/';
		$this->currency = 'IDR';
		$this->terminal ='10';
	}

	public function index($donate_id=null)
	{
		if (isset($_SESSION['login']['profile']['user_id'])) {
			$data['member_id'] = $_SESSION['login']['profile']['user_id'];
			$data['donate_id'] = $donate_id;

			$data['donate'] = $this->donate_model->getDonate($donate_id);

			$this->load->view('module/donate/donate',$data);

		} else {
			redirect(base_url() . 'home');
		} 
	}
	
	public function payment_signature()
	{
		$trxid  = isset($_GET["trx_id"])?$_GET["trx_id"]:"";
		$signature  = isset($_GET["signature"])?$_GET["signature"]:"";
		$gwt = $this->check_signature($trxid, $signature);
		echo $gwt;
		
	}

	private function check_signature($trxid, $signature)
	{
		$getsig = $this->donate_model->getDonateXml($trxid);
		if(is_numeric($signature)) {			
			if($getsig[0]->signature==$signature) {return 1;}
			else {return 0;}
		}
		else {
			if($getsig[0]->authkey==$signature) {return 1;}
			else {return 0;}
		}
	}

public function payment_notification()
	{
		$xml=urldecode(file_get_contents('php://input'));
		$notification = simplexml_load_string($xml);
		//print_r($xml);exit;
	
		$trx_id  = $notification->trx_id;
    		$merchant_id    = $notification->merchant_id;
	    	$merchant_name  = $notification->merchant;
    		$order_id       = $notification->bill_no;
    		$payment_reff   = $notification->payment_reff;
    		$payment_status = $notification->payment_status_code;
    		$signature      = $notification->signature;

    		$payment_date   = date('Y-m-d h:i:s');//waktu terima notification

    		$user_id= 'bot31342';//user id dari faspay;
    		$pass= 'G5lU3YLq';//passwor dari faspay
    
    		$sign=sha1(md5(($user_id.$pass.$order_id.$payment_status)));
    
   		//echo $sign;exit;

		if ($payment_status=='2' && $signature==$sign){

		//* put your code here for make update or insert to your database status
		$data = array("raw" => 'trx_id:'.$trx_id.' status:'.$payment_status.' order_id:'.$order_id.' reff:'.$payment_reff);
		$this->donate_model->setXml($data);

		//**response back to faspay
		$paymentdate=date('Y-m-d h:i:s');
		$xml ="<faspay>"."\n";
		$xml.="<response>Payment Notification</response>"."\n";
		$xml.="<trx_id>$trx_id</trx_id>"."\n";
		$xml.="<merchant_id>$merchant_id</merchant_id>"."\n";
		$xml.="<bill_no>$order_id</bill_no>"."\n";
		$xml.="<response_code>00</response_code>"."\n";
		$xml.="<response_desc>Sukses</response_desc>"."\n";
		$xml.="<response_date>$paymentdate</response_date>"."\n";
		$xml.="</faspay>"."\n";
		
		echo $xml;		
		
		}
	}
	
	public function bca_callback()
	{
		$trxid  = isset($_GET["trx_id"])?$_GET["trx_id"]:"";
		//$billno  = isset($_GET["pg"])?$_GET["pg"]:"";
	
		//$date = date('d M Y H:i:s', strtotime($olddate));
		$data = array (
				"trxid" => $trxid
		);
		$this->load->view('module/thankyou', $data);
	}

public function after_payment()
	{
		$trxid  = isset($_GET["trx_id"])?$_GET["trx_id"]:"";
		$billno  = isset($_GET["bill_no"])?$_GET["bill_no"]:"";
		$billtotal  = isset($_GET["bill_total"])?$_GET["bill_total"]:"";
		$olddate  = isset($_GET["payment_date"])?$_GET["payment_date"]:"";
		$username  = isset($_GET["bank_user_name"])?$_GET["bank_user_name"]:"";
		$status  = isset($_GET["status"])?$_GET["status"]:"";
		
		$date = date('d M Y H:i:s', strtotime($olddate)); 
		$data = array (
			"trxid" => $trxid,
			"bill_no" => $billno,
			"bill_total" => $billtotal,
			"date" => $date,
			"username" => $username,
			"status" => $status
		);		
		$this->load->view('module/thankyou', $data);
	}

	public function confirm($donate_member_id = NULL) {
		if ($this->input->server ( 'REQUEST_METHOD' ) === 'POST') {
			
			$success = TRUE;
			$message = '';
			$position = '';
			$other = '';
			
			date_default_timezone_set ( 'Asia/Jakarta' );
			$getdate = date ( "Y-m-d" );
			
			
			$member_id = $this->input->post ( 'member_id' );
			$pembayaran = $this->input->post ( 'pembayaran' );
			$email = $this->input->post ( 'email' );
			$name = $this->input->post ( 'name' );
			$nokontak = $this->input->post ( 'nokontak' );
			$frombank = $this->input->post ( 'frombank' );
			$tobank = $this->input->post ( 'tobank' );
			$amount = $this->input->post ( 'amount' );
			$date = $this->input->post ( 'date' );
// 			$branch = $this->input->post ( 'cabang' );
			$note = $this->input->post ( 'note' );
			$captcha = $this->input->post ( 'captcha' );

			if ($success) {
				if ($pembayaran && $pembayaran === 0) {
					$success = FALSE;
					$message = 'Silahkan pilih jenis pembayaran.';
					$position = 'jpayment';
				}
			}
			
			if ($success) {
				if($email) {
					if (! valid_email ( $email )) {
						$success = FALSE;
						$message = 'Format Email salah. Silahkan periksa format Email.';
						$position = 'email';
					}
				}
				else {
					$success = FALSE;
					$message = 'Email harus diisi';
					$position = 'email';
				}
			}
			
			if ($success) {
				if (!$name) {
					$success = FALSE;
					$message = 'Nama harus diisi';
					$position = 'name';
				} 
			}
			
			if ($success) {
				if (! $nokontak) {
					$success = FALSE;
					$message = 'Silahkan isi no kontak yang dapat dihubungi.';
					$position = 'nokontak';
				}
			}
			
			if ($success) {
				if (! $frombank) {
					$success = FALSE;
					$message = 'Silahkan isi bank asal pengiriman.';
					$position = 'frombank';
				}
			}
			
			if ($success) {
				if ($tobank && $tobank === 0) {
					$success = FALSE;
					$message = 'Silahkan pilih  bank tujuan pengiriman.';
					$position = 'tobank';
				}
			}
			
			if ($success) {
				if (! $amount) {
					$success = FALSE;
					$message = 'Silahkan isi jumlah dana.';
					$position = 'amount';
				}
			}
			
			if (! $date) {
				$success = FALSE;
				$message = 'Date required';
				$position = 'date';
			} else if (count ( explode ( '/', $date ) ) !== 3) {
				$success = FALSE;
				$message = 'Date invalid';
				$position = 'date';
			}
			
			if ($success) {
				$date = date_create($date);
				$date = date_format($date,"Y-m-d");
			}
			if ($success) {
				if ($captcha) {
					if ($captcha && isset ( $_SESSION ['captcha_confirm'] ) && strtolower ( $captcha ) === strtolower ( $_SESSION ['captcha_confirm'] )) {
						;
						if (isset ( $_SESSION ['captcha_confirm'] )) {
							unset ( $_SESSION ['captcha_confirm'] );
						}
					} else {
						$success = FALSE;
						$message = 'Captcha invalid';
						$position = 'ptcha';
					}
				} else {
					$success = FALSE;
					$message = 'Captcha invalid';
					$position = 'ptcha';
				}
				
				if ($success) {
					$data = array (
							'jenis' => $pembayaran,
							'email' => $email,
							'member_id' => $member_id,
							'name' => $name,
							'amount' => $amount,
							'contact' => $nokontak,
							'frombank' => $frombank,
							'tobank' => $tobank,
							'date' => $date,
							'postdate' => $getdate,
// 							'branch_id' => $branch,
							'note' => $note 
					);
					
					$other = $name;
					$result = $this->donate_model->setConfirm ( $data );
					
					if (! $result ['success']) {
						$success = FALSE;
						$message = 'data konfirmasi gagal disimpan';
						$position = 'other';
						$other = 'failed';
					}					
				}				
			}
			if($success){
				$zakat_descr = "";
				 switch ($pembayaran) {
				case 1: $zakat_descr = "Zakat Harta";
				break;
				case 3: $zakat_descr = "Zakat Profesi";
				break;
				case 4: $zakat_descr = "Zakat Fitrah";
				break;
				case 7: $zakat_descr = "Infaq & Shadaqoh";
				break;
				case 13: $zakat_descr = "Fidyah/Kafarat";
				break;
				case 14: $zakat_descr = "Qurban";
				break;
				}
				$izibank = "";
				switch ($tobank) {
				case 1: $izibank = "BCA -	5395.500.900";
				break;
				case 2: $izibank = "Mandiri - 122.002.80000.68";
				break;
				case 3: $izibank = "Syariah	Mandiri - 789.789.1217";
				break;
				case 4: $izibank = "BNI Syariah - 121.555.3331";
				break;
				case 5: $izibank = "BNI - 5000.121.00";
				break;
				case 6: $izibank = "Muamalat - 301.01.666.14";
				break;
				case 7: $izibank = "Permata - 121.873.2727";
				break;
				case 8: $izibank = "BJB - 523.0102.000.127";
				break;
				case 9: $izibank = "BCA - 5395.100.600";
				break;
				case 10: $izibank = "Mandiri - 122.002.70000.10";
				break;
				case 11: $izibank = "Syariah - Mandiri - 777.888.1211";
				break;
				case 12: $izibank = "BNI Syariah - 121.555.4448";
				break;
				case 13: $izibank = "BNI - 700.121.009";
				break;
				case 14: $izibank = "Muamalat - 301.01.666.15";
				break;
				case 15: $izibank = "Permata - 121.873.2700";
				break;
				}
				$emailbody="<h4>Konfirmasi Pembayaran IZI</h4><p /> Tanggal: ".$date."<br />Nama: ".$name."<br />Kontak: ".$nokontak."<br />Email: ".$email."<br />Jumlah: <b>Rp.".number_format($amount, 0, ',', '.')."</b><br />Untuk Pembayaran: <b>".$zakat_descr."</b><br />Rekening asal: ".$frombank."<br />Rekening Tujuan: ".$izibank;
				$this->sendMail ('salam@izi.or.id', $emailbody, 'Konfirmasi Donasi'); 
			}
			
			$response = array (
					'success'  => $success,
					'message'  => $message,
					'position' => $position,
					'other'    => $other
			);
			
			echo json_encode ( $response );
		}
	}

	public function send()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$message = '';
			$position = '';
			$other = '';

			$member_id = $this->input->post('member_id');
			$pembayaran = $this->input->post('pembayaran');
			$setoran = $this->input->post('setoran');
			$metode = $this->input->post('metode');
			$time = $this->input->post('waktu');
			$date = $this->input->post('time');

			if ( $success && ($time < 1)) {
				$success = FALSE;
				$message = 'Pilih reminder pembayaran';
				$position = 'mreminder';
			}
			
			if ( $success && ! $setoran) {
				$success = FALSE;
				$message = 'Jumlah setoran tidak valid';
				$position = 'jsetoran';
			}

			if ( $success && ! $pembayaran) {
				$success = FALSE;
				$message = 'Jenis pembayaran tidak boleh kosong';
				$position = 'jpayment';
			}
			
			if ( $success && ! $metode) {
				$success = FALSE;
				$message = 'Tentukan metode pembayaran';
				$position = 'mpayment';
			}
			
			if ( $success && ! $date) {
				$success = FALSE;
				$message = 'Hari/Tanggal tidak boleh kosong';
				$position = 'remindformat';
			}
			
			if ( $success && ($time == 2)) {
				if (count(explode('/', $date)) !== 3) {
					$success = FALSE;
					$message =  'Date invalid';
					$position = 'remindformat';
				}
				
				if ($success) {
					$date = date_create($date);
					$date = date_format($date,"Y-m-d");
				}
			}
			

			if ($success) {
				$data = array(
							'transfer_amount'=> $setoran,
							'member_id'		=> $member_id,
							'payment_pupose'=> $pembayaran,
							'status'		=> 0,
							'transfer_method'	=> $metode
// 							'date'	=> $date
						);
				if ( $success && ($time == 2)) {
					$data['date'] = $date;
				}
				if ( $success && ($time == 1)) {
					$data['day'] = $date;
				}
				
				if($success) {
					$izimember = $this->member_model->getMember($member_id);
					if($izimember) {
						$other = $izimember->first_name.' '.$izimember->last_name;
						$data['firstname'] = $izimember->first_name;
						$data['lastname'] = $izimember->last_name;
						$data['email'] = $izimember->email;
					}
				}
				
				$result = $this->donate_model->setDonate($data);

				if ( ! $result['success']) {
					$success = FALSE;
					$position = 'other';
					$other = 'failed';
				}
			}

			$response = array(
							'success'	=> $success,
							'message'	=> $message,
							'position' => $position,
							'other'    => $other
						);
			
			echo json_encode($response);
		}
	}

public function submit($donate_member_id=NULL)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$success = TRUE;
			$message = '';
			$position = '';
			$other = '';

			date_default_timezone_set('Asia/Jakarta');
			$getdate = date("Y-m-d g:i:s");
			
			$member_id = $this->input->post('member_id');
			$pembayaran = $this->input->post('pembayaran');
			$setoran = $this->input->post('setoran');
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$nokontak = $this->input->post('nokontak');
			$address = $this->input->post('address');
			$email = $this->input->post('email');
			$method = $this->input->post('metode');
			//$branch = $this->input->post('cabang');

			$exist = $this->input->post('exist');
			
			if ($success) {
				if ($pembayaran && $pembayaran === 0) {
					$success = FALSE;
					$message = 'Silahkan periksa jenis pembayaran.';
					$position = 'jpayment';
				}
			}
			
			if ($success) {
				if ($setoran && $setoran === 0) {
					$success = FALSE;
					$message = 'Silahkan isi jumlah setoran.';
					$position = 'jsetoran';
				}
			}
			
			if ($success) {
					if($firstname) {
						$success = TRUE;
					}
					else {
						$success = FALSE;
						$message = 'Nama depan harus diisi';
						$position = 'firstname';
					}
				}
					
				if ($success) {
					if($lastname) {
						$success = TRUE;
					}
					else {
						$success = FALSE;
						$message = 'Nama belakang harus diisi';
						$position = 'lastname';
					}
				}
				
				if ($success) {
					if (!valid_email($email)) {
						$success = FALSE;
						$message = 'Format Email salah. Silahkan periksa format Email.';
						$position = 'email';
					}
				}				
				
				if ($success) {
					if (! $nokontak) {
						$success = FALSE;
						$message = 'Silahkan isi no kontak yang dapat dihubungi.';
						$position = 'nokontak';
					}
				}
				
				if ($success) {
					if ($method < 1) {
						$success = FALSE;
						$message = 'Silahkan pilih metode pembayaran.';
						$position = 'mpayment';
					}
				}
				
				if($success){					
					if($method > 3) { 					
						$zakat_descr = "";
						switch ($pembayaran) {
						case 1: $zakat_descr = "Zakat Harta";
						break;
						case 2: $zakat_descr = "Zakat Perniagaan";
						break;
						case 3: $zakat_descr = "Zakat Profesi";
						break;
						case 4: $zakat_descr = "Zakat Pertanian";
						break;
						case 5: $zakat_descr = "Zakat Lainnya (hadiah/temuan)";
						break;
						case 6: $zakat_descr = "Total Akumulasi Zakat";
						break;
						case 7: $zakat_descr = "Infaq & Shadaqoh";
						break;
						case 8: $zakat_descr = "Kemanusiaan";
						break;
						case 9: $zakat_descr = "Dana Penyaluran Fasum";
						break;
						case 10: $zakat_descr = "Wakaf";
						break;
						case 11: $zakat_descr = "Yatim & Janda";
						break;
						case 12: $zakat_descr = "Kesehatan";
						break;
						case 13: $zakat_descr = "Zakat Fitrah";
						break;
						case 14: $zakat_descr = "Qurban";
						break;
						}	
						//$payChannel, $zakatType, $billNumber, $msisdn, $email, $amountPrice			
						$billno = "31342".mt_rand(1000, 9999);
						$this->paymentTransaction($method, $zakat_descr, $billno, $nokontak, $email, $setoran); exit();
					}
					else {
						$success = TRUE;
					}
				}

				if ($success) {
					$other = $firstname.' '.$lastname;					
					$data = array(
								//'member_id'			=> $member_id,
								'date_transfer'		=> $getdate,
								'branch_id'			=> '1',
								'transfer_amount'	=> $setoran,
								'firstname'			=> $firstname,
								'lastname'			=> $lastname,
								'contact'			=> $nokontak,
								'email'				=> $email,
								'address'			=> $address,
								'transfer_method'	=> $method,
								'payment_pupose'	=> $pembayaran,
								'status'	=> '1'
					);
					if($exist==false){
						//if(!$member_id) $member_id = 0;	
						$data['member_id'] = 0;
						$result = $this->donate_model->setDonate($data);
						if (!$result['success']) {
							$success = FALSE;
							$message = 'data konfirmasi gagal disimpan';
							$position = 'other';
							$other = 'failed';
						}
						else {
							$success = TRUE;
							$message = 'terima Kasih <b>'.$other.'</b>, atas pembayaran yang anda lakukan.';
							$position = 'other';
						}
					}
					if($exist && $exist > 0){
						$data['member_id'] = $member_id;
						$data['status'] = '1';
						$result = $this->donate_model->updateDonate($exist, $data);
						if (!$result['success']) {
							$success = FALSE;
							$message = 'data konfirmasi gagal disimpan';
							$position = 'other';
							$other = 'failed';
						}
						else {
							$success = TRUE;
							$message = 'terima Kasih <b>'.$other.'</b>, atas pembayaran yang anda lakukan.';
							$position = 'other';
						}
					}
				}
				$response = array(
								'success'	=> $success,
								'message'	=> $message,
								'position'	=> $position,
								'other'    => $other
							);

			echo json_encode($response);
		}
	}
	
	private function paymentTransaction($payChannel, $zakatType, $billNumber, $msisdn, $email, $amountPrice) {
		$postData = $this->postDataTransaction($billNumber, $zakatType, $this->currency, $amountPrice, $payChannel, $msisdn, $email);
		if($postData) {
			$list = new SimpleXMLElement($postData);
			if($payChannel==405) {
				date_default_timezone_set ( 'Asia/Jakarta' );
				$trxdate = date('d/m/Y H:i:s');//date('d/m/Y g:i:s');
				$dirbca = "http://faspaydev.mediaindonusa.com/redirectbca";
				$keyID = $this->genKeyId('KlikPayYukTraDev');
				$genauthkey = $this->genAuthKey('UATYUK', $list->trx_id, $this->currency, $trxdate, $keyID);
				$sig = $this->genSignature('UATYUK', $trxdate, $list->trx_id, $amountPrice, $this->currency, $keyID);
				$post = array (
						"klikPayCode" => 'UATYUK',
						"transactionNo" => $list->trx_id,
						"totalAmount" => $amountPrice.'.00',
						"currency" => $this->currency,
						"payType" => '01',
						"callback" => base_url()."thankbca?trx_id=".$list->trx_id,
						"transactionDate" => $trxdate,
						"descp" => $zakatType,
						"signature" => $sig
				);
				$data = array("trx_id" => $list->trx_id, 'signature'=>$sig, 'authkey'=>$genauthkey);
				$this->donate_model->setXml($data);
				$string = '<form  method="post" action="'.$dirbca.'" id="BCAForm" name="form">';
				if ($post != null) {
					foreach ($post as $name=>$value) {
						$string .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
					}
				}
				$string .= '</form>';
				$string .= '<script>document.getElementById("BCAForm").submit();</script>';
				echo $string; //exit();
				//$this->sendBCAData($dirbca, $post); exit();
			}
			else {
				if($list->response_code == '00') {
					/*$directlink = array(
					 'success'  => TRUE,
							'message'  => 'faspay',
							'position' => $this->devMIurl.'100003/0830000010100000/'.sha1(md5('bot31342G5lU3YLq'.$billNumber)).'?trx_id='.$list->trx_id.'&merchant_id=31342&bill_no='.$billNumber);
					echo json_encode($directlink);*/
					$fasurl = $this->prodMIurl.'100003/2830000010100000/'.sha1(md5('bot31342G5lU3YLq'.$billNumber));
					$post = array (
							"trx_id" => $list->trx_id,
							"merchant_id" => '31342',
							"bill_no" => $billNumber
					);
					$string = '<form  method="get" action="'.$fasurl.'" id="FasForm" name="form">';
					if ($post != null) {
						foreach ($post as $name=>$value) {
							$string .= '<input type="hidden" name="'.$name.'" value="'.$value.'">';
						}
					}
					$string .= '</form>';
					$string .= '<script>document.getElementById("FasForm").submit();</script>';
					echo $string;
				}
			}
		}
	}
	
	private function postDataTransaction($bill_noreff, $desc, $bill_currency,
			$amount, $payment_channel, $msisdn,$email)
	{
		$body = '<faspay>';
		$body .= '<request>Post Data Transaksi</request>';
		$body .= '<merchant_id>31342</merchant_id>';
		$body .= '<merchant>Yayasan Inisiatif Zakat Indonesia</merchant>';
		$body .= '<bill_no>'.$bill_noreff.'</bill_no>';
		$body .= '<bill_reff>'.$bill_noreff.'</bill_reff>';
		$body .= '<bill_date>'.date('Y-m-d g:i:s').'</bill_date>';
		$body .= '<bill_expired>'.date("Y-m-d g:i:s", strtotime("+1 day")).'</bill_expired>';
		$body .= '<bill_desc>Bayar '.$desc.'</bill_desc>';
		$body .= '<bill_currency>'.$bill_currency.'</bill_currency>';
		$body .= '<bill_total>'.$amount.'00'.'</bill_total>';
		$body .= '<payment_channel>'.$payment_channel.'</payment_channel>';
		$body .= '<pay_type>1</pay_type>';
		$body .= '<msisdn>'.$msisdn.'</msisdn>';
		$body .= '<email>'.$email.'</email>';
		$body .= '<terminal>10</terminal>';
		$body .= '<item>';
		$body .= '<product>'.$desc.'</product>';
		$body .= '<qty>1</qty>';
		$body .= '<amount>'.$amount.'</amount>';
		$body .= '<payment_plan>1</payment_plan>';
		$body .= '<tenor>03</tenor>';
		$body .= '<merchant_id></merchant_id>';
		$body .= '</item>';
		$body .= '<signature>'.sha1(md5('bot31342G5lU3YLq'.$bill_noreff)).'</signature>';
		$body .= '</faspay>';
	
		$url = $this->prodMIurl.'300002/383xx00010100000';
	
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
	
	private function genKeyId($clearKey)
	{
		return strtoupper(bin2hex($this->str2bin($clearKey)));
	}
	
	private function genSignature($klikPayCode, $transactionDate, $transactionNo, $amount, $currency, $keyId) {
		$tempKey1 = $klikPayCode . $transactionNo . $currency . $keyId;
		$hashKey1 = $this->getHash($tempKey1);
		//echo "tempKey1 : " . $tempKey1;
		//echo " hasKey1 : " . $hashKey1 . "<br>";
		$expDate = explode("/",substr($transactionDate,0,10));
		$strDate = $this->intval32bits($expDate[0] . $expDate[1] . $expDate[2]);
		$amt = $this->intval32bits($amount);
		$tempKey2 = $strDate + $amt;
		$hashKey2 = $this->getHash((string)$tempKey2);
		//echo "tempKey2 : " . $tempKey2;
		//echo " hashKey2 : " . $hashKey2 . "<br>";
		$signature = abs($hashKey1 + $hashKey2);
		return $signature;
	}
	
	private function genAuthKey($klikPayCode, $transactionNo, $currency, $transactionDate, $keyId) {
		$klikPayCode = str_pad($klikPayCode, 10, "0");
		$transactionNo = str_pad($transactionNo, 18, "A");
		$currency = str_pad($currency, 5, "1");
		
		$value_1 = $klikPayCode . $transactionNo . $currency . $transactionDate . $keyId;
			
		$hash_value_1 = strtoupper(md5($value_1));
			
		if (strlen($keyId) == 32) $key = $keyId . substr($keyId,0,16);
		else if (strlen($keyId) == 48) $key = $keyId;
		// hex encode the return value
		return strtoupper(bin2hex(mcrypt_encrypt(MCRYPT_3DES, $this->hex2bin($key), $this->hex2bin($hash_value_1), MCRYPT_MODE_ECB)));
	}
	
	private function hex2bin($data) {
		$len = strlen($data);
		return pack("H" . $len, $data);
	}
	
	private function str2bin($data) {
		$len = strlen($data);
		return pack("a" . $len, $data);
	}
	
	private function intval32bits($value) {
		if ($value > 2147483647) $value = ($value - 4294967296);
		else if ($value < -2147483648) $value = ($value + 4294967296);
		return $value;
	}
	
	private function getHash($value) {
		$h = 0;
		for ($i = 0;$i < strlen($value);$i++) {
		$h = $this->intval32bits($this->add31T($h) + ord($value{$i}));
		}
		return $h;
	}
	
	private function add31T($value) {
		$result = 0;
		for($i=1;$i <= 31;$i++) {
		$result = $this->intval32bits($result + $value);
		}
		return $result;
	}
	
	private function sendMail($to, $message, $subject, $attached=NULL)
	{
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',//'ssl://cyberpkpu.gugahnurani.com',
				'smtp_port' => 465,
				'smtp_user' => 'iziorg2016@gmail.com',//'hi@izi.or.id',
				'smtp_pass' => '@1nisiatif',//'@1zi123',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'priority' => '2',
				'wordwrap' => TRUE
		);
	
		$this->load->library('email', $config);
		$this->email->clear(TRUE);
		$this->email->set_newline("\r\n");
		$this->email->from('salam@izi.or.id','noreply@izi.or.id'); // change it to yours
		$this->email->to($to);// change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		if($attached) $this->email->attach($attached);
		if($this->email->send())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
						//show_error($this->email->print_debugger());
		}
	
	}

}

/* End of file donate.php */
/* Location: ./application/controllers/module/donate/donate.php */
