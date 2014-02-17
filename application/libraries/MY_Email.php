<?php

class MY_Email extends CI_Email {

    var $CI;

    public function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
        $config = array(
            'useragent' => 'mail.' . $this->CI->config->item('site_name'),
            'validate' => TRUE,
            'mailtype' => 'html',
            'priority' => 1
        );
        $this->initialize($config);
        $this->from($this->CI->config->item('site_email_noreply'), $this->CI->config->item('site_email_name'));
    }
   
    function message_view($view, $data = array()) {
        $this->message($this->CI->parser->parse($view, $data, TRUE));
    }

    public function subject($subject) {
        $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
        $this->_set_header('Subject', $subject);
        return $this;
    }

}