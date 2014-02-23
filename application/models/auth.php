<?php

/**
 * Description of Auth
 * @author lojorider
 * @copyright educasy.com
 */
class Auth extends CI_Model {

//permis
    var $permis_setting = 1;
    var $permis_permission = 2;
    var $start_score = 1000;

    public function __construct() {
        parent::__construct();
        $this->make_money = $this->config->item('make_money');

        date_default_timezone_set('Asia/Bangkok');

        ini_set('session.gc_maxlifetime', 86400000000); //เวลาที่ เก็บ session
        session_start();

        if ($this->input->cookie('remember_me')) {
            if (!$this->is_login()) {
                $this->login_bypass($this->input->cookie('UserID'));
            }
        }
        if (!isset($_SESSION['score'])) {
            $_SESSION['score'] = $this->start_score;
        }
    }

    /**
     * Login
     * @param String $name
     * @param String $pass
     * @return boolean 
     */
    function login($username) {
        if ($username) {
            $user_data = array('username' => $username);
            $this->set_userdata($user_data);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Logout
     * @return boolean 
     */
    function logout() {
        session_destroy();
        $user_data = array();
        $this->set_userdata($user_data);
        $_SESSION['score'] = $this->start_score;

        return TRUE;
    }

    /**
     * ตรวจเช็คว่ากำลัง Login อยู่หรือไม่
     * @return boolean 
     */
    function is_login() {
        if (!isset($_SESSION['user_data']['username'])) {
            return FALSE;
        }
        if ($_SESSION['user_data']['username'] != '') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * ตั้งค่า session
     * @param type $user_data
     */
    private function set_userdata($user_data) {

        $_SESSION['user_data'] = $user_data;
    }

    function get_username() {
        if (isset($_SESSION['user_data']['username'])) {
            return $_SESSION['user_data']['username'];
        }
        return FALSE;
    }

    function get_display_name() {
        if (isset($_SESSION['user_data']['username'])) {
            return $_SESSION['user_data']['username'];
        }
        return FALSE;
    }

}

/* End of file auth.php */