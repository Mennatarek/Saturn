<?php
require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

    }
    function signin_post(){
        $username = $this->post("username");
        $password = $this->post("password");
        $data = $this->User_model->signin($username,$password);
        $this->response($data);
    }
    function signup_post(){
        $this->load->model('User_model');
        $username = $this->post("username");
        $password = $this->post("password");
        $email = $this->post("email");
        $this->User_model->signup($username,$password,$email);
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