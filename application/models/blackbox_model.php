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
    }

    function get_quest_data($number = 0) {
        $this->db->where('type', $this->type);
        $this->db->where('number', $number);
        $q = $this->db->get('quest');
        
        $r = $q->row_array();
        return $r;
    }

}