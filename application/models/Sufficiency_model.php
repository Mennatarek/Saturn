<?php

class Sufficiency_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Country_model');
        $this->load->model('Production_model');
        $this->load->model('Trade_model');
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
    function get_crop_sufficiency($crop_id,$country_id){
        $this->db->select("*");
        $this->db->where("crop_id",$crop_id);
        $this->db->where("country_id",$country_id);
        $this->db->from("Sufficiency");
        $query = $this->db->get();
        return $query->result()[0];
    }
    function calculate_latest_sufficiency($crop_id,$country_id){
        $this ->db-> select('value');
        $this ->db-> from('Production');
        $this ->db-> where('country_id', $country_id);
        $this ->db-> where('crop_id', $crop_id);
        $production_value = $this->db->get()->result_array()[0]['value']; 

        $export_value = $this->Trade_model->get_crop_latest_import_entity($crop_id,$country_id);
        $import_value = $this->Trade_model->get_crop_latest_export_entity($crop_id,$country_id);

        $usage = $production_value + $import_value ;
        $sufficiency_value = $production_value/$usage;

        $this ->Sufficiency_model-> insert_entry($country_id,$crop_id,$sufficiency_value,0);
        return $sufficiency_value;
    }
    function get_crop_latest_sufficiency_entity($crop_id,$country_id){
        $this->db->select("*");
        $this->db->where("crop_id",$crop_id);
        $this->db->where("country_id",$country_id);
        $this->db->from("Sufficiency");
        $query = $this->db->get();
        return end($query->result()[0]);
    }
}
?>