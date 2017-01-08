<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Model extends MY_Model {

	private $product, $user, $field;

	public function __construct()
	{
		parent::__construct();
		
		$this->product = "`zakatku`";
		$this->user = "`member`";
		$this->field = NULL;
	}

	public function getProduct($id = NULL, $user = NULL, $page = NULL, $limit = NULL)
	{
		$this->field = array(
							$this->product . '.' . '`zakat_id`',
							$this->product . '.' . '`member_id`',
							$this->product . '.' . '`harga_emas`',
							$this->product . '.' . '`besar_nisab`',
							$this->product . '.' . '`tabungan`',
							$this->product . '.' . '`saham`',
							$this->product . '.' . '`real_estate`',
							$this->product . '.' . '`perhiasan`',
							$this->product . '.' . '`kendaraan`',
							$this->product . '.' . '`total_simpanan`',
							$this->product . '.' . '`hutang_pribadi`',
							$this->product . '.' . '`selisih_simpanan`',
							$this->product . '.' . '`zakat_pribadi`',
							$this->product . '.' . '`pendapatan`',
							$this->product . '.' . '`bonus`',
							$this->product . '.' . '`total_pendapatan`',
							$this->product . '.' . '`pengeluaran`',
							$this->product . '.' . '`selisih_pendapatan`',
							$this->product . '.' . '`zakat_profesi`',
							$this->product . '.' . '`kekayaan_perusahaan`',
							$this->product . '.' . '`hutang_perusahaan`',
							$this->product . '.' . '`komposisi_kepemilikan`',
							$this->product . '.' . '`total_kekayaan_perusahaan`',
							$this->product . '.' . '`selisih_kekayaan_perusahaan`',
							$this->product . '.' . '`zakat_perusahaan`',
							$this->product . '.' . '`pribadi`',
							$this->product . '.' . '`perusahaan`',
							$this->product . '.' . '`profesi`',
							$this->product . '.' . '`total`',
							$this->product . '.' . '`status`',
				
							$this->product . '.' . '`date_created`',

							'DATE_FORMAT(' . $this->product . '.' . '`date_created`,"%d %M %Y %H:%i:%s") AS `date_created_format`',
							'DATE_FORMAT(' . $this->product . '.' . '`date_created`,"%d %M %Y") AS `date_created_short`',
							'DATE_FORMAT(' . $this->product . '.' . '`date_created`,"%d/%m/%Y") AS `date_created_shorts`',
							'DATE_FORMAT(' . $this->product . '.' . '`date_created`,"%W, %d %M %Y %H:%i:%s") AS `date_created_long`'
						);
		$this->db->select($this->field, FALSE);

		$this->db->from($this->product);
		$this->db->join($this->user, $this->product . '.' . '`member_id`' . ' = ' . $this->user . '.' . '`member_id`', '', FALSE);

		if ($id) {
			$this->db->where($this->product . '.' . '`zakat_id`', $id);
		}

		if ($user) {
			$this->db->where($this->product . '.' . '`member_id`', $user);
			$this->db->where($this->product . '.' . '`status` = 0');
		}

		if ($page && $limit) {
			$start = ($page - 1) * $limit;
			$this->db->limit($limit,$start);
		}

		$query = $this->db->get();

		if ($query && $query->num_rows()) {
			return $id ? $query->row_object() : $query->result_object();
		}
	}

	public function setProduct($data)
	{
		if ($data) {
			$query = $this->db->insert($this->product, $data);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'add process successful.', 'insert_id' => $this->db->insert_id());
			} else {
				return array('success' => FALSE, 'message' => 'add process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function updateProduct($id,$data)
	{
		if ($id && $data) {
			$this->db->where('product_id', $id);
			$query = $this->db->update($this->product, $data);

			if($query) {
				return array('success' => TRUE, 'message' => 'update process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'update process failed.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

	public function deleteProduct($id)
	{
		if ($id) {
			$this->db->where_in('product_id',$id);
			$query = $this->db->delete($this->product);

			if($query && $this->db->affected_rows()) {
				return array('success' => TRUE, 'message' => 'delete process successful.');
			} else {
				return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
			}
		}
	}

}

/* End of file product_model.php */
/* Location: ./application/models/member/product_model.php */