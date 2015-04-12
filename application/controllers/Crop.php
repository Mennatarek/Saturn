<?php
require APPPATH.'/libraries/REST_Controller.php';

class Crop extends REST_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Crop_model');

    }
    function crop_get(){
        $id = $this->post("id");
        $data = $this->Crop_model->getCrops($id);
        $this->response($data);
    }

}

?>