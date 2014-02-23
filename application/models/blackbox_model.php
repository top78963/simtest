<?php

/**
 * Description of blackbox_model
 *
 * @author lojorider
 */
class blackbox_model extends CI_Model {

    var $type = 'blackbox';

    public function __construct() {
        parent::__construct();
        $this->load->config('expected');
    }

    function get_quest_data($req_id) {

        $this->db->where('req_id', $req_id);
        $q = $this->db->get('quest_requirement');

        $r = $q->row_array();


        $this->db->where('quest_id', $r['quest_id']);
        $q2 = $this->db->get('quest');

        $r = array_merge($r, $q2->row_array());
        $r['expected_skip'] = explode(',', $r['expected_skip']);
        $r['exp_options'] = array('' => '');
        $r['exp_options'] = array_merge($r['exp_options'], $this->config->item('exp_options_' . $r['quest_id']));
        foreach ($r['expected_skip'] as $sk) {
            unset($r['exp_options'][$sk]);
        }
        return $r;
    }

}