<?php
require APPPATH.'/libraries/REST_Controller.php';

class Replant extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Replant_model');
        $this->load->model('Country_model');
        $this->load->model('Crop_model');

    }
    function data_get(){
        $data = $this->Exchange_model->getAllEntries();
        $this->response($data);
    }
    function replant_post(){
        $new_crop_id = $this->post('new_crop_id');
        $old_crop_id = $this->post('old_crop_id');
        $country_id = $this->post('country_id');
        $amount = $this->post('amount');


        $new_crop = $this->Crop_model->get_entity($new_crop_id);
        $old_crop= $this->Crop_model->get_entity($old_crop_id);
        $country= $this->Country_model->get_entity($country_id);

        $data = new stdClass();

        $data->new_crop_id = $new_crop->id;
        $data->old_crop_id = $old_crop->id;
        $data->country_id = $country->id;
        $data->amount = $amount;

        $this->db->insert("Replant", $data);

        $this->response($data);

    }
}

?>