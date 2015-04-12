<?php
require APPPATH.'/libraries/REST_Controller.php';

class Sufficiency extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Sufficiency_model');

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
            $this -> db -> select('crop_id');
            $this -> db -> from('Production');
            $this -> db -> where('country_id', $country->id);

            $crops_ids = $this -> db -> get();

            foreach ($crops_ids as $crop_id) 
            {
                $this -> db -> select('value');
                $this -> db -> from('Production');
                $this -> db -> where('country_id', $country->id);
                $this -> db -> where('crop_id', $crop_id);
                $production_value = $this->db->get()->result_array()[0]; 

                $this -> db -> select('value');
                $this -> db -> from('Trade');
                $this -> db -> where('country_id', $country->id);
                $this -> db -> where('crop_id', $crop_id);
                $this -> db -> where('type',0);
                $export_value = $this->db->get()->result_array()[0];

                $this -> db -> select('value');
                $this -> db -> from('Trade');
                $this -> db -> where('country_id', $country->id);
                $this -> db -> where('crop_id', $crop_id);
                $this -> db -> where('type',1);
                $import_value = $this->db->get()->result_array()[0];

                $usage = $production_value + $import_value - $export_value;
                $sufficiency_value = $production_value/$usage

                $this->Sufficiency_model->insert_entry($country->id,$crop_id,$sufficiency_value,1);

            }
        }
    }

    function world_current_sufficiency_get()
    {
        $this -> db -> select("*");
        $this -> db -> from('Sufficiency');
        $this -> db -> where('current',1);

        $world_current_sufficiency = $this -> db -> get();
        $this->response($world_current_sufficiency);
    }
}

?>