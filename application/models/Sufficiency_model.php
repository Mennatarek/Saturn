<?php

class Sufficiency_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Sufficiency");
        return $query->result();
    }

    function insert_entry($country_id , $crop_id , $value)
    {
        $this->country_id = $country_id;
        $this->crop_id = $crop_id;
        $this->value = $value;
        $this->db->insert("Sufficiency", $this);
    }

}
?>