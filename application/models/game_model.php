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
        $quest_id = $data['quest_id'];
        $fn_quest = 'quest' . $quest_id;
        $a_var = $fn_quest($data['b_tc']);
        $data['b_exp'] = (int)$data['b_exp'];

        $exp_options = $this->config->item('exp_options_' . $quest_id);

        foreach ($_SESSION['rq_data'] as $v) {
            $fn_name = 'rq' . $v['req_id'];
            $result = $fn_name($a_var, $exp_options, $data['b_exp']);
            if ($result['discover_bug']) { // เดาถูก 
                $result['expected_text'] = $exp_options[$result['expected']];
                $result['actual_text'] = $exp_options[$result['actual']];
                if ($result['predictable']) {
                    $this->set_score(10);
                } else {
                    $this->set_score(-10);
                }
                return $result;
            }
        }

        $data = array(
            'expected' => $data['b_exp'],
            'actual' => 0,
            'predictable' => FALSE,
            'message' => 'ไม่พบบัค',
            'input' => $a_var
        );
         $this->set_score(-10);
        $data['expected_text'] = $exp_options[$data['expected']];
        $data['actual_text'] = $exp_options[$data['actual']];


        return $data;
    }

    function set_score($score) {
        $_SESSION['score'] += $score;
    }

    function get_score() {
        return $_SESSION['score'];
    }

}
