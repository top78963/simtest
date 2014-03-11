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
        $check_var = $b_exp . $data['b_tc'];



        $exp_options = $this->config->item('exp_options_' . $quest_id);
        $fn_name = 'program_quest_' . $quest_id;
        $result_fn = $fn_name($data['b_tc']);
        if ($result_fn['output_program_bug'] == '') {
            $actual_result = '';
        } else {
            $actual_result = (int) array_search($result_fn['output_program_bug'], $exp_options);
        }


        $result = array(
            'expected' => $b_exp,
            'actual' => $actual_result,
            'expected_text' => $exp_options[$b_exp],
            'actual_text' => @$exp_options[$actual_result],
            'input' => $data['b_tc'],
            'bug' => $result_fn['bug']
        );
        $result['debug'] = $result_fn['output_program_normal'];

        $check_var_result = $this->pair_check_var($check_var);

        // เริ่มตรวจ
        if ($check_var_result) {
            $result['message'] = 'NO แสรดคิดจะโกงเหรอ จุ๊ๆๆๆ อย่าๆๆๆ ลบ '.($this->count_cheat()*100).' คะแนนเลยมุง';
            $result['win'] = FALSE;
            $this->set_score(-100*$this->count_cheat());
            $this->add_cheat();
        } else {
            if ($actual_result == $b_exp) { //เดาถูก
                if ($result_fn['bug']) {
                    $result['message'] = 'NO มันเป็น BUG คุณยังเสือกตอบถูกอีกนะ';
                    $result['win'] = FALSE;
                    $this->set_score(-10);
                } else {
                    $result['message'] = 'YES โอ้ TEST CASE นี้เยี่ยมไปเลย';
                    $result['win'] = TRUE;
                    $this->set_score(10);
                }
            } else { //เดาผิด
                if ($result_fn['bug']) { // ได้คะแนนได้ต่อเมื่อ คำตอบเหมือนโปรแกรมที่แก้แล้ว
                    if ($exp_options[$b_exp] == $result_fn['output_program_normal']) {
                        $result['message'] = 'YES คุณค้นหา BUG เจอแล้ว คุณนี่แม่ง เมพขิง';
                        $result['win'] = TRUE;
                        $this->set_score(10);
                    } else {
                        // ไม่ตรงทั้ง บัค และ จริง คาดหวังไม่ตรง ไม่ตรงกับโปรแกรมที่มีบัค และจริง
                        $result['message'] = 'NO คุณเจอบัคน่ะ แต่ว่า การคาดเดาของคุณมันยังดูมึนๆ ไปหน่อย';
                        $result['win'] = FALSE;
                        $this->set_score(-10);
                    }
                } else {
                    //ไม่มีบัค คาดหวังไม่ถูก
                    $result['message'] = 'NO test case ของคุณนี่มันมั่วสาด โง่สาด';
                    $result['win'] = FALSE;
                    $this->set_score(-10);
                }
            }
            $this->add_log($result);
        }
        // สิ้นสุดการตรวจ
        $this->add_check_var($check_var);
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
        if (!isset($_SESSION['logs'])) {
            $_SESSION['logs'] = array();
        }
        return $_SESSION['logs'];
    }

    function add_check_var($var) {
        $_SESSION['check_var'][] = $var;
    }

    function pair_check_var($needle) {
        if (!isset($_SESSION['check_var'])) {
            $_SESSION['check_var'] = array();
            return FALSE;
        }
        return in_array($needle, $_SESSION['check_var']);
    }

    function count_cheat() {
        if (!isset($_SESSION['cheat'])) {
            $_SESSION['cheat'] = 1;
        }
        return $_SESSION['cheat'];
    }

    function add_cheat() {
        if (!isset($_SESSION['cheat'])) {
            $_SESSION['cheat'] = 1;
        } else {
            $_SESSION['cheat'] ++;
        }
    }

}
