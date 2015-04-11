<?php

class Country_model extends CI_Model {

    var $name   = '';
    var $_tableName = "Country";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllCountries()
    {
        $query = $this->db->get("Country");
        return $query->result();
    }

    function insert_entry($name)
    {
        $this->name = $name;

        $this->db->insert($_tableName, $this);
    }

    function update_entry($name, $id)
    {
        $this->name = $name;

        $this->db->update('entries', $this, array('id' => $id));
    }

}
?>