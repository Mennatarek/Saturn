<?php

class Blog_model extends CI_Model {

    var $name   = '';
    const var $_tableName = "Countries";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function getAllCountries()
    {
        $query = $this->db->get($_tableName);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = "Test"; 
        $this->content = $this->input->post('id');
        $this->date    = "Ahmed";

        $this->db->insert($_tableName, $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}
?>