<?php

/**
 * Description of game_model
 *
 * @author lojorider
 */
class game_model extends CI_Model {

    var $game_data;

    public function __construct() {
        parent::__construct();
        $this->load->config('expected');
        $this->load->helper('requirement_helper');
    }

    function get_quest_data($quest_id) {
        $this->db->where('quest_id', $quest_id);
        $q = $this->db->get('quest');
        $r = $q->row_array();
        $this->set_quest_requirement($quest_id);
        $r['exp_options'] = $this->get_expected_options($quest_id);
        return $r;
    }

    function set_quest_requirement($quest_id) {
        $this->db->where('quest_id', $quest_id);
        $q = $this->db->get('quest_requirement');
        $rq_data = $q->result_array();
        foreach ($rq_data as $k => $v) {
            $rq_data[$k]['pass'] = FALSE;
        }
        $_SESSION['rq_data'] = $rq_data;
        return TRUE;
    }

    function get_expected_options($quest_id) {

        return $this->config->item('exp_options_' . $quest_id);
    }

    function send_test($data) {
        $result = array();
        $quest_id = $data['quest_id'];
        $b_exp = (int) $data['b_exp'];
        $exp_options = $this->config->item('exp_options_' . $quest_id);


        $fn_name = 'program_quest_' . $quest_id;
        $result_fn = $fn_name($data['b_tc']);
        if ($result_fn == '') {
            $actual_result = '';
        } else {
            $actual_result = (int) array_search($result_fn, $exp_options);
        }


        $result = array(
            'expected' => $b_exp,
            'actual' => $actual_result,
            'expected_text' => $exp_options[$b_exp],
            'actual_text' => @$exp_options[$actual_result],
            'input'=>$data['b_tc']
        );
        $result['debug'] = $result_fn;
        if ($actual_result == $b_exp) {
            $result['message'] = 'YES';
            $result['win'] = TRUE;

            $this->set_score(10);
        } else {
            $result['message'] = 'NO';
            $result['win'] = FALSE;
            $this->set_score(-10);
        }

        $this->add_log($result);
        $result['logs'] = $this->get_log();
        $result['awards'] = $this->get_score();
        return $result;
    }

    function set_score($score) {
        $_SESSION['score'] += $score;
    }

    function get_score() {
        return $_SESSION['score'];
    }

    function add_log($data) {
       // if (isset($_SESSION['logs'])) {
            $_SESSION['logs'][] = $data;
       // }else{
            
        //}
    }

    function reset_log() {
        $_SESSION['logs'] = array();
    }

    function get_log() {
//        if (!isset($_SESSION['logs'])) {
//            $_SESSION['logs'] = array();
//        }
        return $_SESSION['logs'];
    }

}
