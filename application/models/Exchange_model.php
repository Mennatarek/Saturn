<?php

class Exchange_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Exchange");
        return $query->result();
    }

    function insert_entry($supplier_id , $reciever_id , $crop_id , $amount)
    {
        $this->supplier_id = $supplier_id;
        $this->reciever_id = $reciever_id;
        $this->crop_id = $crop_id;
        $this->amount = $amount;
        $this->db->insert("Exchange", $this);
    }
    function get_entity($id){
        $query = $this->db->select("*")->where("id",$id)->from("Exchange");
        return $query->result()[0];
    }

}
?>