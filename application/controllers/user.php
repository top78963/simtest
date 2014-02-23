<?php

class user extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function login() {
        echo $this->input->post('username');
        if($this->auth->login($this->input->post('username'))){
            redirect('game'); 
        }else{
            redirect(); 
        }
    }

    function logout() {
        $this->auth->logout();
        redirect(); 
    }

}
