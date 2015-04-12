<?php
require APPPATH.'/libraries/REST_Controller.php';

class Country extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Country_model');

    }
    function countries_get(){
        $data = $this->Country_model->getAllEntries();
        $this->response($data);
    }

}

?>