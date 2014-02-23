<?php

class page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        if($this->auth->is_login()){
            redirect('game');
        }
        $data = array(
            'form_action' => site_url('user/login')
        );
        $this->template->write_view('user/login_form', $data);
        $this->template->application_script('css/login_form.css');
        $this->template->render();
    }

    function about_game() {

        $this->template->write_view('page/about_game');
        $this->template->render();
    }

}
