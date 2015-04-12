<?php
require APPPATH.'/libraries/REST_Controller.php';

class Production extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Production_model');

    }
    function sufficiency_get(){
        $data = $this->Production_model->getAllEntries();
        $this->response($data);
    }

}

?>