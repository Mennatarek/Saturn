<?php

class Country_model extends CI_Model {

    var $name   = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllEntries()
    {
        $query = $this->db->get("Country");
        return $query->result();
    }

    function get_country($id)
    {
        $this->db->where('id', $id); 
        $this->db->from("Country");
        $this->db-> limit(1);
        $query = $this ->db ->get();
        return $query->result()[0];
    }

    function insert_entry($name)
    {
        $this->name = $name;

        $this->db->insert("Country", $this);
    }

    function update_entry($name, $id)
    {
        $this->name = $name;

        $this->db->update("Country", $this, array('id' => $id));
    }

}
?>