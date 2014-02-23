<?php

/**
 * @property blackbox_model $blackbox_model
 */
class blackbox extends CI_Controller {

    var $expected_option;

    public function __construct() {
        parent::__construct();
        $this->load->model('blackbox_model');
        $this->load->helper('requirement_helper');
    }

    //Login-----------------------------------------------------
    function quest($req_id = 1) {

        $quest_data = $this->blackbox_model->get_quest_data($req_id);


//$quest_data = expected_skip
        $data = array(
            'command' => $quest_data['command'],
            'requirement' => $quest_data['requirement'],
            'exp_options' => $quest_data['exp_options'],
            'sent_test_url' => site_url('blackbox/ajax_send_test')
        );

        $this->template->write_view('blackbox/b_main', $data);
        $this->template->render();
    }

    function ajax_send_test() {
        $p = $_POST;
        $result_data = array();
        $a = array(
            'result' => $this->load->view('blackbox/b_result', $result_data, TRUE),
            'feedback' => $this->load->view('blackbox/b_feedback', array(), TRUE),
            'log' => $this->load->view('blackbox/b_log', array(), TRUE),
            'awards' => $this->load->view('blackbox/b_awards', array(), TRUE),
            'p' => $p
        );
        echo json_encode($a);
    }

}