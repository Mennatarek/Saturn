<?php
require APPPATH.'/libraries/REST_Controller.php';

class Sufficiency extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Sufficiency_model');

    }
    function sufficiency_get(){
        $data = $this->Sufficiency_model->getAllEntries();
        $this->response($data);
    }

}

?>