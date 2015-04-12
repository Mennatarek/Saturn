<?php
require APPPATH.'/libraries/REST_Controller.php';

class Production extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Production_model');

    }
    function data_get(){
        $data = $this->Production_model->getAllEntries();
        $this->response($data);
    }
    function feed_post(){
        $data = $this->post();
        foreach($data as $elem){
            $this->Production_model->insert_entry($elem['country_id'],$elem['crop_id'],$elem['value']);
        }
        $this->response($data);
    }

}

?>