<?php

/**
 * Description of user_model
 *
 * @author lojorider
 */
class user_model extends CI_Model {

    var $form_error;
    var $form_data;
    var $user_data;
    var $INT_ProjectData = array(
        array(
            'Name' => 'Program 1',
            'ProcessID' => '1',
        ), array(
            'Name' => 'Program 2',
            'ProcessID' => '3',
        ), array(
            'Name' => 'Program 3',
            'ProcessID' => '5',
        ), array(
            'Name' => 'Program 4',
            'ProcessID' => '6',
        ), array(
            'Name' => 'Program 5',
            'ProcessID' => '6',
        ), array(
            'Name' => 'Program 6',
            'ProcessID' => '6',
        ), array(
            'Name' => 'Program 7',
            'ProcessID' => '6',
        ),
    );

    public function __construct() {
        parent::__construct();
    }

    function init_course() {
        $this->db->set('ProjectData', json_encode($this->INT_ProjectData));
        $this->db->where('CourseID', 1);
        $this->db->update('Course');
    }

    function register($data) {

        $data['RoleID'] = 2;
        $data['Active'] = 1;
        if ($this->check_register_data($data)) {
            $CourseID = 1;
            //บันทึกข้อมูลลง Users
            $this->db->set($data);
            $this->db->insert('Users');
            $UserID = $this->db->insert_id();
            //บันทึกข้อมูล CourseRegister
            $this->db->set('UserID', $UserID);
            $this->db->set('CourseID', $CourseID);
            $this->db->insert('CourseRegister');
            //บันทึกข้อมูล ลง Projects
            $this->db->where('CourseID', $CourseID);
            $q1 = $this->db->get('Course');
            $q1_row = $q1->row_array();
            $ProjectData = json_decode($q1_row['ProjectData']);
            foreach ($ProjectData as $v) {
                $this->db->set($v);
                $this->db->set('UserID', $UserID);
                $this->db->insert('Projects');
               
            }

            //บันทึกข้อมูล Project
            return TRUE;
        } else {
            $this->session->set_flashdata('form_error', $this->form_error);
            $this->session->set_flashdata('form_data', $this->form_data);
            return FALSE;
        }
    }

    function check_register_data($data) {
        $valid = TRUE;
        $this->form_data = $data;
        if ($data['Username'] == '') {
            $this->form_error[] = 'ไม่ได้กรอกข้อมูล Username';
            $valid = FALSE;
        }
        if ($data['FirstName'] == '') {
            $this->form_error[] = 'ไม่ได้กรอกข้อมูล ชื่อ';
            $valid = FALSE;
        }
        if ($data['LastName'] == '') {
            $this->form_error[] = 'ไม่ได้กรอกข้อมูล นามสกุล';
            $valid = FALSE;
        }
        if ($data['StudentNumber'] == '') {
            $this->form_error[] = 'ไม่ได้กรอกข้อมูล รหัสนักศึกษา';
            $valid = FALSE;
        }

        return $valid;
    }

    function get_user_data() {
        $this->db->where('UserID', $this->auth->UserID());
        $q = $this->db->get('Users');

        return $q->row_array();
    }

}