<?php
require APPPATH.'/libraries/REST_Controller.php';

class Sufficiency extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Sufficiency_model');
        $this->load->model('Crop_model');
        $this->load->model('Trade_model');

    }
    function data_get(){
        $data = $this->Sufficiency_model->getAllEntries();
        $this->response($data);
    }
    function world_current_sufficiency_post()
    {
        $world = $this->db->get('Country');
        foreach ($world->result() as $country) 
        {
            $this ->db-> select('crop_id');
            $this ->db-> from('Production');
            $this ->db-> where('country_id', $country->id);

            $crops_ids = $this ->db-> get() -> result_array();

            foreach ($crops_ids as $crop_id) 
            {
                $this ->db-> select('value');
                $this ->db-> from('Production');
                $this ->db-> where('country_id', $country->id);
                $this ->db-> where('crop_id', $crop_id['crop_id']);
                $production_value = $this->db->get()->result_array()[0]['value']; 

                $this ->db-> select('amount');
                $this ->db-> from('Trade');
                $this ->db-> where('country_id', $country->id);
                $this ->db-> where('crop_id', $crop_id['crop_id']);
                $this ->db-> where('type',0);
                $export_value = $this->db->get()->result_array()[0]['amount'];

                $this ->db-> select('amount');
                $this ->db-> from('Trade');
                $this ->db-> where('country_id', $country->id);
                $this ->db-> where('crop_id', $crop_id['crop_id']);
                $this ->db-> where('type',1);
                $import_value = $this->db->get()->result_array()[0]['amount'];

                $usage = $production_value + $import_value;
                $sufficiency_value = $production_value/$usage;

                $this ->Sufficiency_model-> insert_entry($country->id,$crop_id['crop_id'],$sufficiency_value,1);

            }
        }
    }

    function world_current_sufficiency_get()
    {
        $this ->db-> select("*");
        $this ->db-> from('Sufficiency');
        $this ->db-> where('current',1);

        $world_current_sufficiency = $this ->db-> get();
        $this -> response($world_current_sufficiency -> result());
    }

    function world_ideal_sufficiency_get()
    {
        $this ->db-> select("*");
        $this ->db-> from('Sufficiency');
        $this ->db-> where('current',0);

        $world_current_sufficiency = $this ->db-> get();
        $this -> response($world_current_sufficiency -> result());
    }
    function world_ideal_sufficiency_post()
    {
        $world = $this->db->get('Country');
        foreach ($world->result() as $country) 
        {
            $this ->db-> select('crop_id');
            $this ->db-> from('Production');
            $this ->db-> where('country_id', $country->id);

            $crops_ids = $this ->db-> get() -> result_array();
            foreach ($crops_ids as $crop_id) 
            {
                $crop = $this->Crop_model->get_entity($crop_id['crop_id']);
                if($crop->priority != 1)
                    continue;
                $crop_sufficiency = $this->Sufficiency_model->get_crop_sufficiency($crop->id,$country->id);
                if($crop_sufficiency->value < 1){
                    $replacing_crop = $this->Crop_model->get_replacing_crop($crop);
                    if ($replacing_crop){
                        $crop_trade = $this->Trade_model->get_crop_entity($crop->id,$country->id);
                        $export_value = $crop_trade[0]->amount;
                        $import_value = $crop_trade[1]->amount;
                        if ($export_value != 0 and $import_value != 0){
                            if ($export_value - $import_value > 0){
                                $this->Trade_model->insert_entry($country->id,0,$crop->id,$export_value - $import_value);
                                $this->Trade_model->insert_entry($country->id,1,$crop->id,0);
                            }else{
                                $this->Trade_model->insert_entry($country->id,0,$crop->id,0);
                                $this->Trade_model->insert_entry($country->id,1,$crop->id,$import_value - $export_value);
                            }
                        }
                        $new_sufficiency = $this->Sufficiency_model->calculate_latest_sufficiency($crop->id,$country->id);
                    }
                    else
                        print_r($replacing_crop);
                    
                }
            }
        }
    }
}

?>