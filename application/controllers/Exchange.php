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

    function exchange_get()
    {
        $world = $this->db->get('Country');
        foreach ($world->result() as $country) 
        {
            $this -> db -> select('crop_id');
            $this -> db -> from('Trade');
            $this -> db -> where('country_id', $country->id);
            $this -> db -> where('type',1);

            $imported_crops = $this -> db -> get() -> result_array();

            foreach ($imported_crops as $imported_crop) 
            {

                $this -> db -> select('country_id');
                $this -> db -> from('Trade');
                $this -> db -> where('crop_id', $imported_crop['crop_id']);
                $this -> db -> where('type',0);

                $exporting_countries = $this -> db -> get() -> result_array();
                foreach ($exporting_countries as $exporting_country)
                {
                    $this -> db -> select('crop_id');
                    $this -> db -> from('Trade');
                    $this -> db -> where('country_id', $exporting_country['country_id']);
                    $this -> db -> where('type',1);
                    
                    $exchange_crops = $this -> db -> get() -> result_array();

                    foreach ($exchange_crops as $exchange_crop) 
                    {
                        $this -> db -> select('*');
                        $this -> db -> from('Trade');
                        $this -> db -> where('crop_id', $exchange_crop['crop_id']);
                        $this -> db -> where('country_id', $country->id);
                        $this -> db -> where('type',0);

                        $useful_export = $this -> db -> get() -> result_array();

                        if ($useful_export != null) 
                        {
                            $this -> db -> select('amount');
                            $this -> db -> from('Trade');
                            $this -> db -> where('country_id', $country->id);
                            $this -> db -> where('crop_id', $imported_crop['crop_id']);
                            $this -> db -> where('type',1);

                            $my_import_amount = $this -> db -> get() -> result_array()[0];

                            $this -> db -> select('amount');
                            $this -> db -> from('Trade');
                            $this -> db -> where('country_id', $country->id);
                            $this -> db -> where('crop_id', $exchange_crop['crop_id']);
                            $this -> db -> where('type',0);

                            $my_export_amount = $this -> db -> get() -> result_array()[0];

                            $this -> db -> select('amount');
                            $this -> db -> from('Trade');
                            $this -> db -> where('country_id', $exporting_country['country_id']);
                            $this -> db -> where('crop_id', $imported_crop['crop_id']);
                            $this -> db -> where('type',0);

                            $their_import_amount = $this -> db -> get() -> result_array()[0];


                            $this -> db -> select('amount');
                            $this -> db -> from('Trade');
                            $this -> db -> where('country_id', $exporting_country['country_id']);
                            $this -> db -> where('crop_id', $exchange_crop['crop_id']);
                            $this -> db -> where('type',1);

                            $their_export_amount = $this -> db -> get() -> result_array()[0];

                            $amount = min($my_import_amount,$my_export_amount,$their_import_amount,$their_export_amount);
                            $this -> Exchange_model ->insert_entry($exporting_country['country_id'],$country->id,$imported_crop['crop_id'],$amount);
                            $this -> Exchange_model ->insert_entry($country->id,$exporting_country['country_id'],$exchange_crop['crop_id'],$amount);

                        }

                    }
                }
            }
        }  
    }
}

?>