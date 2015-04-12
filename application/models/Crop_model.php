<?php

class Crop_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_entity($id)
    {
        $this->db-> from('Crop');
        $this->db-> where('id', $id);
        $this->db-> limit(1);
        $query = $this->db->get();
        return $query->result()[0];
    }
    
    
    function get_replacing_crop($crop)
    {
        $soil = $crop->soil_type;
        $ph = $crop->soil_ph;
        $priority = $crop->priority;
        $this->db-> from('Crop');
        $this->db-> where('soil_type', $soil);
        $this->db-> where('soil_ph', $ph);
        $this->db-> where('priority >' , $priority);
        $this->db->order_by('priority', 'DSC');
        $this->db-> limit(1);
        $query = $this->db->get();
        if (!empty($query->result()[0]))
            return $query->result()[0];
        return false;
    }
    

}
?>