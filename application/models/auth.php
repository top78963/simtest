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
        $this->lang->load('psp', 'english');
    }

    /**
     * Login
     * @param String $name
     * @param String $pass
     * @return boolean 
     */
    function login($Username, $Password, $remember = FALSE) {

        $where = array(
            'Username' => $Username,
            'Password' => $this->encode_Password($Password),
            'Active' => 1
        );
        $this->db->where($where);
        $query = $this->db->get('Users');
        if ($query->num_rows() > 0) {
            $this->set_userdata($query->row_array());
            if ($remember) {
                $this->remember_me($_SESSION['user_data']['UserID'], $remember);
            }
            return TRUE;
        }
        return FALSE;
    }

    function login_bypass($UserID) {
        $where = array(
            'UserID' => $UserID,
            'active' => 1
        );
        $this->db->where($where);

        $query = $this->db->get('Users');
        if ($query->num_rows() > 0) {
            $this->set_userdata($query->row_array());
            $this->remember_me($_SESSION['user_data']['UserID'], TRUE);
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
        $this->forget_me();

        return TRUE;
    }

    /**
     * ตรวจเช็คว่ากำลัง Login อยู่หรือไม่
     * @return boolean 
     */
    function is_login() {
        if (!isset($_SESSION['user_data']['UserID'])) {
            return FALSE;
        }
        if ($_SESSION['user_data']['UserID'] != '') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * ตั้งค่า session
     * @param type $user_data
     */
    private function set_userdata($user_data) {
        if (isset($user_data['UserID'])) {
            $this->db->select('first_name,last_name,affiliate_type_id');
            $this->db->where('UserID', $user_data['UserID']);
        }
        $_SESSION['user_data'] = $user_data;
    }

    /**
     * เรียกดู ขอมูล userdata
     * @return Array
     */
    public function get_user_data() {
        if (isset($_SESSION['user_data'])) {
            return $_SESSION['user_data'];
        }
        return FALSE;
    }

    /**
     * เรียกดูชื่อที่แสดง
     * @return boolean
     */
    function get_display_name() {

        if (isset($_SESSION['user_data']['first_name'])) {

            return $_SESSION['user_data']['first_name'] . ' ' . $_SESSION['user_data']['last_name'];
        }
        return '';
    }

    /**
     * เปลี่ยน ชื่อแสดงทันที
     * @param type $first_name
     * @param type $last_name
     */
    function froce_set_display_name($first_name, $last_name) {
        $_SESSION['user_data']['first_name'] = $first_name;
        $_SESSION['user_data']['last_name'] = $last_name;
    }

    /**
     * เรียกดูเลขที่ประเพทผู้ใช้
     * @return boolean
     */
    function rid() {
        if (isset($_SESSION['user_data']['rid'])) {
            return $_SESSION['user_data']['rid'];
        }
        return FALSE;
    }

    /**
     * เป็นผู้ดูแลระบบหรือเปล่า
     * @return boolean
     */
    function is_admin() {
        return ($this->rid() == 1) ? TRUE : FALSE;
    }

    /**
     * เรียกดูเลขที่ผู้ใช้
     * @return boolean
     */
    function UserID() {
        if (isset($_SESSION['user_data']['UserID'])) {
            return $_SESSION['user_data']['UserID'];
        }

        return FALSE;
    }

    /**
     * เช็คว่า user คนนี้มีสิทธิใน module ที่ต้องการหรือไม่
     * @param Sting $permission
     * @return boolean 
     */
    function can_access($mid) {
        if (!$this->is_login()) {
            return FALSE;
        } else {
            // Check Module for Role
            $this->db->where('rid', $this->get_role());
            $this->db->where('mid', $mid);
            $q1 = $this->db->get('p_role_module');
            if ($q1->num_rows() > 0) {
                $row = $q1->row_array();
                if ($row['active'] == 1) {
                    return TRUE;
                }
                return FALSE;
            }
            return FALSE;
        }
    }

    /**
     * เช็คว่า user คนนี้มีสิทธิใน module ที่ต้องการหรือไม่
     * @param Sting $permission
     * @return boolean 
     */
    function access_limit($mid) {
        if (!$this->is_login()) {
            return redirect('notpermission');
            ;
        } else {
            // Check Module for Role
            $this->db->where('rid', $this->get_role());
            $this->db->where('mid', $mid);
            $q1 = $this->db->get('p_role_module');
            if ($q1->num_rows() > 0) {
                $row = $q1->row_array();
                if ($row['active'] == 1) {
                    return TRUE;
                }
                return redirect('notpermission');
                ;
            }
            return redirect('notpermission');
            ;
        }
    }

    /**
     * จำการเข้าใช้ไว้
     * @param type $UserID
     * @param type $remember
     */
    public function remember_me($UserID, $remember) {
        $c1 = array(
            'name' => 'UserID',
            'value' => $UserID,
            'domain' => HTTP_HOST,
            'path' => '/',
            'expire' => '31536000'
        );
        $this->input->set_cookie($c1);
        $c2 = array(
            'name' => 'remember_me',
            'value' => $remember,
            'domain' => HTTP_HOST,
            'path' => '/',
            'expire' => '31536000'
        );
        $this->input->set_cookie($c2);
    }

    /**
     * ยกเลิกการจำการเข้าใช้
     */
    public function forget_me() {
        $c1 = array(
            'name' => 'UserID',
            'value' => FALSE,
            'domain' => HTTP_HOST,
            'path' => '/',
            'expire' => '-31536000'
        );
        $this->input->set_cookie($c1);
        $c2 = array(
            'name' => 'remember_me',
            'value' => FALSE,
            'domain' => HTTP_HOST,
            'path' => '/',
            'expire' => '-31536000'
        );
        $this->input->set_cookie($c2);
    }

    /**
     * เข้ารหัส Password
     * @param type $Password
     * @return type
     */
    function encode_Password($Password) {
        return $Password;
        //return md5($Password);
    }

    /**
     * เรียกดู usermenu
     * @return type
     */
    function get_array_user_menu() {
        if (isset($_SESSION['user_menu'])) {
            return $_SESSION['user_menu'];
        }
        return array();
    }

    /* เมนูหลัก
     * ***********************************************************
     */

    function get_top_menu() {
        $top_menu = array();
        if ($this->is_login()) {


            $top_menu = array(
                array(
                    'text' => 'เมนูหลัก',
                    'title' => '',
                    'href' => '#',
                    'sub_menu' => array(
                        array(
                            'text' => 'จัดการโปรแกรม',
                            'title' => 'จัดการโปรแกรม',
                            'href' => site_url('project/')
                        ),
                        array(
                            'text' => 'Coding Standard',
                            'title' => 'Coding Standard',
                            'href' => site_url('project/coding_standard')
                        ),
                        array(
                            'text' => 'โปรไฟล์',
                            'title' => 'โปรไฟล์',
                            'href' => site_url('user/profile')
                        )
                    )
                ),
            );
        } else {
//            $top_menu = array(
//                array(
//                    'text' => 'ลงทะเบียน',
//                    'title' => 'ลงทะเบียน',
//                    'href' => site_url('user/register'),
//                )
//            );
        }
        return $top_menu;
    }

}

/* End of file auth.php */