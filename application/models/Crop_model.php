<?php

class Crop_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_crop($id)
    {
        $this->db-> from('Crop');
        $this->db-> where('id', $id);
        $this->db-> limit(1);
        $query = $this->db->get();
        return $query->result()[0];
    }
    
}
?>