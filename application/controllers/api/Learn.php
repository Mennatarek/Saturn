<?php
require APPPATH.'/libraries/REST_Controller.php';

class Learn extends REST_Controller{
	function user_get(){
		$data = array('returned: '. $this->get('id'));

		$this->load->model('Blog_model');
		$data = $this->Blog_model->get_last_ten_entries();
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