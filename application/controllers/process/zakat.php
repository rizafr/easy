<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zakat extends MY_Controller {

	private $upload_path, $upload_dir;

	public function __construct()
	{	
		parent::__construct();

		$this->load->model('member/member_model');
		$this->load->model('module/donate_model');

		$this->upload_path = $this->path . 'uploads/';
		$this->upload_dir = $this->dir . 'uploads/';
	}

	public function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {

			$user_id = $this->input->post('memberid');

			$success = TRUE;
			$message = array();

			$this->db->trans_begin();

			if (isset($_SESSION['login']['profile']['user_id']) && $_SESSION['login']['profile']['user_id'] === $user_id) {
					
				$harga_emas = $this->input->post('harga_emas');
				$besar_nisab = $this->input->post('besar_nisab');
				$tabungan = $this->input->post('tabungan');

				$saham= $this->input->post('saham');
				$real_estate = $this->input->post('real_estate');
				$perhiasan = $this->input->post('perhiasan');
				$kendaraan = $this->input->post('kendaraan');
				$total_simpanan = $this->input->post('total_simpanan');
				
				$hutang_pribadi = $this->input->post('hutang_pribadi');
				$selisih_simpanan = $this->input->post('selisih_simpanan');
				$zakat_pribadi = $this->input->post('zakat_pribadi');
				
				$pendapatan = $this->input->post('pendapatan');
				$bonus= $this->input->post('bonus');
				$total_pendapatan = $this->input->post('total_pendapatan');
				$pengeluaran = $this->input->post('pengeluaran');
				$pengeluaran_lain = $this->input->post('pengeluaran_lain');
				$total_pengeluaran = $this->input->post('total_pengeluaran');
				$selisih_pendapatan = $this->input->post('selisih_pendapatan');
				$zakat_profesi = $this->input->post('zakat_profesi');
				
				$kekayaan_perusahaan = $this->input->post('kekayaan_perusahaan');
				$hutang_perusahaan = $this->input->post('hutang_perusahaan');
				$komposisi_kepemilikan = $this->input->post('komposisi_kepemilikan');
				$total_kekayaan_perusahaan = $this->input->post('total_kekayaan_perusahaan');
				$selisih_kekayaan_perusahaan = $this->input->post('selisih_kekayaan_perusahaan');
				$zakat_perusahaan = $this->input->post('zakat_perusahaan');
				
				$pribadi = $this->input->post('pribadi');
				$profesi = $this->input->post('profesi');
				$perusahaan = $this->input->post('perusahaan');
				$total = $this->input->post('total');

				if ($success) {
					$data['zakat'] = array(
										'member_id'	=> $user_id,
										'harga_emas' => $harga_emas,
										'besar_nisab' => $besar_nisab,
										'tabungan' => $tabungan,
										'saham'	=> $saham,
										'real_estate' => $real_estate,
										'perhiasan'	=> $perhiasan,
										'kendaraan'	=> $kendaraan,
										'total_simpanan' => $total_simpanan,
										'hutang_pribadi' => $hutang_pribadi,
										'selisih_simpanan' => $selisih_simpanan,
										'zakat_pribadi'	=> $zakat_pribadi,
										'pendapatan' => $pendapatan,
										'bonus'	=> $bonus,
										'total_pendapatan'	=> $total_pendapatan,							
										'pengeluaran' => $pengeluaran,
										'pengeluaran_lain' => $pengeluaran_lain,
										'total_pengeluaran' => $total_pengeluaran,
										'selisih_pendapatan'	=> $selisih_pendapatan,
										'zakat_profesi' => $zakat_profesi,
										'kekayaan_perusahaan'	=> $kekayaan_perusahaan,
										'hutang_perusahaan'	=> $hutang_perusahaan,
										'komposisi_kepemilikan' => $komposisi_kepemilikan,
										'total_kekayaan_perusahaan' => $total_kekayaan_perusahaan,
										'selisih_kekayaan_perusahaan' => $selisih_kekayaan_perusahaan,
										'zakat_perusahaan'	=> $zakat_perusahaan,
										'pribadi' => $pribadi,
										'profesi'	=> $profesi,
										'perusahaan'	=> $perusahaan,
										'total'	=> $total
									);
					
					if($total > 0)
					{
						$result['zakat'] = $this->donate_model->setZakatMember($data['zakat']);
						
						if ( ! $result['zakat']['success'] ) {
							$success = FALSE;
							$message['notify'][] = 'Telah terjadi kesalahan. #2';
						}
					}
					else {			
						$success = FALSE;
						$message['notify'][] = 'Zakat atas harta nihil';
					}					
				}
			} else {
				$success = FALSE;
			}

			if ($success) {
				$_SESSION['success'] = 'Data Zakat berhasil disimpan';
				$message['success'][] = 'Data Zakat berhasil disimpan';
				$this->db->trans_commit();
			} else {
				$message['notify'][] = 'Data Zakat gagal disimpan.';
				$this->db->trans_rollback();
			}

			$response = array('success' => $success, 'message' => $message);
			echo json_encode($response);

		}
	}

}