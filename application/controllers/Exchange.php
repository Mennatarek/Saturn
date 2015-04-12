<?php
require APPPATH.'/libraries/REST_Controller.php';

class Exchange extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Exchange_model');
        $this->load->model('Country_model');
        $this->load->model('Crop_model');

    }
    function data_get(){
        $data = $this->Exchange_model->getAllEntries();
        $this->response($data);
    }
    function exchange_post(){
        $supplier_id = $this->post('supplier_id');
        $receiver_id = $this->post('receiver_id');
        $crop_id = $this->post('crop_id');
        $amount = $this->post('amount');


        $supplier = $this->Country_model->get_entity($supplier_id);
        $receiver= $this->Country_model->get_entity($receiver_id);
        $crop= $this->Crop_model->get_entity($crop_id);

        $data = new stdClass();

        $data->supplier_id = $supplier->id;
        $data->receiver_id = $receiver->id;
        $data->crop_id = $crop->id;
        $data->amount = $amount;

        $this->db->insert("Exchange", $data);

        $this->response($data);

    }
}

?>