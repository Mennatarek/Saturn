<?php

class Replant_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Replant");
        return $query->result();
    }

    function insert_entry($new_crop_id , $old_crop_id , $country_id , $amount)
    {
        $this->new_crop_id = $new_crop_id;
        $this->old_crop_id = $old_crop_id;
        $this->country_id = $country_id;
        $this->amount = $amount;
        $this->db->insert("Replant", $this);
    }
    function get_entry($id){
        $query = $this->db->select("*")->where("id",$id)->from("Replant");
        return $query->result()[0];
    }

}
?>