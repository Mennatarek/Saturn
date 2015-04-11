<?php
require APPPATH.'/libraries/REST_Controller.php';

class Learn extends REST_Controller{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Country_model');

    }
    function countries_get(){
        $data = $this->Country_model->getAllCountries();
        $this->response($data);
    }
    function user_post(){
        $this->load->model('Blog_model');
        $this->Blog_model->insert_entry();
        $data = array('returned: '. $this->post('id'));
        $this->response($data);
    }
    function user_put(){
        $data = array('returned: '. $this->put('id'));
        $this->response($data);
    }
    function user_delete(){
        $data = array('returned: '. $this->delete('id'));
        $this->response($data);
    }

}

?>