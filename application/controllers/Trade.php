<?php
require APPPATH.'/libraries/REST_Controller.php';

class Trade extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Trade_model');
        $this->load->model('Country_model');
        $this->load->model('Crop_model');

    }
    function data_get(){
        $data = $this->Trade_model->getAllEntries();
        $this->response($data);
    }
    function trade_post(){
        $country_id = $this->post('country_id');
        $receiver_id = $this->post('receiver_id');
        $crop_id = $this->post('crop_id');
        $amount = $this->post('amount');


        $country = $this->Country_model->get_entity($supplier_id);
        $receiver= $this->Country_model->get_entity($receiver_id);
        $crop= $this->Crop_model->get_entity($crop_id);

        $data = new stdClass();

        $data->supplier_id = $country->id;
        $data->receiver_id = $receiver->id;
        $data->crop_id = $crop->id;
        $data->amount = $amount;

        $this->db->insert("Trade", $data);

        $this->response($data);

    }

    function feed_post(){
        $data = $this->post();
        foreach($data as $elem){
            $this->Trade_model->insert_entry($elem['country_id'],$elem['type'],$elem['crop_id'],$elem['amount']);
        }
        $this->response($data);
    }
}

?>