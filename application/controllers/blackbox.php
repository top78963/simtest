<?php

/**
 * @property blackbox_model $blackbox_model
 */
class blackbox extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('blackbox_model');
    }

    //Login-----------------------------------------------------
    function quest($number = 0) {
        $quest_data = $this->blackbox_model->get_quest_data($number);
        $exp_options = array(
            '' => '',
            'Invalid input value(s)' => 'Invalid input value(s)',
            'Not a Triangle' => 'Not a Triangle',
            'Equilateral' => 'Equilateral',
            'Isosceles' => 'Isosceles',
            'Scalene' => 'Scalene'
        );
        $data = array(
            'command' => $quest_data['command'],
            'requirement' => $quest_data['requirement'],
            'exp_options' => $exp_options,
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