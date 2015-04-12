<?php

class Sufficiency_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Country_model');
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Sufficiency");
        return $query->result();
    }

    function insert_entry($country_id , $crop_id , $value,$current)
    {
        $this->country_id = $country_id;
        $this->crop_id = $crop_id;
        $this->value = $value;
        $this->current = $current;
        $this->db->insert("Sufficiency", $this);
    }
    function get_entity($id){
        $query = $this->db->select("*")->where("id",$id)->from("Sufficiency");
        return $query->result()[0];
    }
}
?>