<?php

class Trade_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Trade");
        return $query->result();
    }

    function insert_entry($supplier_id , $reciever_id , $crop_id , $amount)
    {
        $this->country_id = $supplier_id;
        $this->crop_id = $reciever_id;
        $this->value = $crop_id;
        $this->value = $amount;
        $this->db->insert("Trade", $this);
    }
    function get_entity($id){
        $query = $this->db->select("*")->where("id",$id)->from("Trade");
        return $query->result();
    }

}
?>