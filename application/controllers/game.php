<?php

/**
 * @property game_model $game_model
 */
class game extends CI_Controller {

    var $expected_option;

    public function __construct() {
        parent::__construct();
        $this->load->model('game_model');

        if (!$this->auth->is_login()) {
            redirect('');
        }
    }

    function index() {
        redirect('game/quest_black');
    }

    //Login-----------------------------------------------------
    function quest_black($quest_id = 1) {

        $quest_data = $this->game_model->get_quest_data($quest_id);


//$quest_data = expected_skip
        $data = array(
            'command' => $quest_data['command'],
            'requirement' => $quest_data['requirement'],
            'exp_options' => $quest_data['exp_options'],
            'score' => $this->load->view('game/black_awards', array('score' => $this->game_model->get_score()), TRUE),
        );
        $script_var = array(
            'sent_test_url' => site_url('game/ajax_send_black_test'),
            'quest_id' => array('value' => $quest_data['quest_id'])
        );
        $this->template->script_var($script_var);

        $this->template->write_view('game/black_main', $data);
        $this->template->render();
    }

    function ajax_send_black_test() {
        $p = $this->input->post();
        $result_data = $this->game_model->send_test($p);

        $a = array(
            'result' => $this->load->view('game/black_result', $result_data, TRUE),
            'feedback' => $this->load->view('game/black_feedback', $result_data, TRUE),
            'log' => $this->load->view('game/black_log', array(), TRUE),
            'awards' => $this->load->view('game/black_awards', array('score' => $this->game_model->get_score()), TRUE),
            'p' => $p,
            'result_data' => $result_data,
        );
        echo json_encode($a);
    }

    function ajax_get_black_test() {
        $post = $this->input->post();
        $a['exp_options'] = $this->game_model->get_expected_options($post['quest_id']);
        echo json_encode($a);
    }

}
