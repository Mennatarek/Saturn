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

    function insert_entry($country_id , $type , $crop_id , $amount)
    {
        $this->country_id = $country_id;
        $this->type = $type;
        $this->crop_id = $crop_id;
        $this->amount = $amount;
        $this->db->insert("Trade", $this);
    }
    function get_entity($id){
        $query = $this->db->select("*")->where("id",$id)->from("Trade");
        return $query->result()[0];
    }
    function get_crop_entity($crop_id,$country_id){
        $this->db->select("*");
        $this->db->where("crop_id",$crop_id);
        $this->db->where("country_id",$country_id);
        $this->db->order_by("type",'ASC');
        $this->db->from("Trade");
        $query = $this->db->get();
        return $query->result();
    }
    function get_crop_latest_import_entity($crop_id,$country_id){
        $this->db->select("*");
        $this->db->where("crop_id",$crop_id);
        $this->db->where("country_id",$country_id);
        $this->db->where("type",1);
        $this->db->from("Trade");
        $query = $this->db->get();
        return end($query->result()[0]);
    }
    function get_crop_latest_export_entity($crop_id,$country_id){
        $this->db->select("*");
        $this->db->where("crop_id",$crop_id);
        $this->db->where("country_id",$country_id);
        $this->db->where("type",0);
        $this->db->from("Trade");
        $query = $this->db->get();
        return end($query->result()[0]);
    }

}
?>