<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial_Model extends MY_Model {

	private $table, $field;

	public function __construct()
	{
        parent::__construct();
        
        $this->table = "message_testimonial";
        $this->field = array(
                            'id',
                            'name',
                            'company',
                            'message',
                            'date_created',
                            'DATE_FORMAT(date_created,"%W, %d %M %Y %H:%i:%s") AS created_date',
                            'status'
                        );
	}

    public function getAllTestimonial($param = NULL)
    {
        $this->db->select($this->field, FALSE);

        $this->db->from($this->table);

        if ($param) {
            $this->setParam($param);
        }

        $query = $this->db->get();

        if ($query && $query->num_rows()) {
            return $query->result_object();
        }
    }

    public function getTestimonial($param = NULL)
    {
        $this->db->select($this->field, FALSE);

        $this->db->from($this->table);

        if ($param) {
            $this->setParam($param);
        }

        $query = $this->db->get();

        if ($query && $query->num_rows()) {
            return $query->row_object();
        }
    }

    public function update($id,$data)
    {
        if ($id && $data) {
            $this->db->where('id', $id);
            $query = $this->db->update($this->table, $data);

            if($query) {
                return array('success' => TRUE, 'message' => 'update process successful.');
            } else {
                return array('success' => FALSE, 'message' => 'update process failed.' . $this->db->last_query(), 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
            }
        }
    }

    public function delete($id)
    {
        if ($id) {
            $this->db->where_in('id',$id);
            $query = $this->db->delete($this->table);

            if($query && $this->db->affected_rows()) {
                return array('success' => TRUE, 'message' => 'delete process successful.');
            } else {
                return array('success' => FALSE, 'message' => 'delete process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
            }
        }
    }

}

/* End of file testimonial_model.php */
/* Location: ./application/models/message/testimonial_model.php */