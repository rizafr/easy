<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slideshow_Model extends MY_Model {

	private $table, $field;

	public function __construct()
	{
        parent::__construct();
        
        $this->table = "slideshow";
        $this->field = array(
                            'id',
                            'image',
                            'x_pos',
                            'y_pos',
                            'title',
                            'content',
                            'footer_link',
                            'footer_label',
                            'button_active',
                            'button_link',
                            'button_label_1',
                            'button_label_2',
                            'button_label_3',
                            'status'
                        );
	}

    public function getSlideshows($param = NULL)
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

    public function getSlideshow($param = NULL)
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

    public function insert($data)
    {
        if ($data) {
            $query = $this->db->insert($this->table, $data);

            if($query && $this->db->affected_rows()) {
                return array('success' => TRUE, 'message' => 'add process successful.');
            } else {
                return array('success' => FALSE, 'message' => 'add process failed.', 'query' => $this->db->last_query(), 'errno' => $this->db->_error_number(), 'error' => $this->db->_error_message());
            }
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

/* End of file slideshow_model.php */
/* Location: ./application/models/setting/slideshow_model.php */