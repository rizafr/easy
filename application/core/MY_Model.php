<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

		$this->db->query("SET lc_time_names = 'id_ID'");
	}

    public function setParam($param)
    {
        foreach ($param as $key => $value) {
            switch ($value['condition']) {
                case 'where'            : $this->db->where( $value['field'] , $value['value'] ); break;
                    
                case 'or_where'         : $this->db->or_where( $value['field'] , $value['value'] ); break;
                
                case 'where_in'         : $this->db->where_in( $value['field'] , $value['value'] ); break;
                
                case 'or_where_in'      : $this->db->or_where_in( $value['field'] , $value['value'] ); break;
                
                case 'where_not_in'     : $this->db->where_not_in( $value['field'] , $value['value'] ); break;
                
                case 'or_where_not_in'  : $this->db->or_where_not_in( $value['field'] , $value['value'] ); break;
                
                case 'like'             : $this->db->like( $value['field'] , $value['value'] ); break;
                
                case 'or_like'          : $this->db->or_like( $value['field'] , $value['value'] ); break;
                
                case 'not_like'         : $this->db->not_like( $value['field'] , $value['value'] ); break;
                
                case 'or_not_like'      : $this->db->or_not_like( $value['field'] , $value['value'] ); break;
                
                case 'group_by'         : $this->db->group_by( $value['field'] ); break;
                
                case 'distinct'         : $this->db->distinct( $value['field'] ); break;
                
                case 'having'           : $this->db->having( $value['field'] , $value['value'] ); break;
                
                case 'or_having'        : $this->db->or_having( $value['field'] , $value['value'] ); break;
                
                case 'order_by'         : $this->db->order_by( $value['field'] , $value['value'] ); break;
                
                case 'limit'            : $this->db->limit( $value['rows'] , $value['count'] ); break;
            }
        }
    }

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
