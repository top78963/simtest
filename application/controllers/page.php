<?php

class page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    function index(){
        $data = array(
            'form_action'=>  site_url('blackbox/quest')
        );
        $this->template->write_view('signin',$data);
        $this->template->application_script('css/signin.css');
        $this->template->render();
    }
}