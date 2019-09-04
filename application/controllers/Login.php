<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('islogin') == 1 && $this->accesscontrol->checkLogin($this->session->userdata('user_id'), $this->session->userdata('regenerate_login')) == 1) {
            redirect(base_url());
        }
        $data = array(
            'title' => 'เข้าสู่ระบบ'
        );
        $this->renderFormView('login_view', $data);
    }

    public function doLogin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($username == '' || $password == '') {
            redirect(base_url('login'));
        }
        $result = $this->accesscontrol->getUser($username, hash('sha256', $username . $password));
        if ($result->num_rows() == 1) {  //ตรวจสอบ Username Password ผู้ใช้งานระบบ
            $row = $result->row();
            if ($row->user_status_id == 1) { //ตรวจสอบสถานะผู้ใช้งาน
                $sessiondata = array(
                    'islogin' => 1,
                    'user_id' => $row->user_id,
                    'role_id' => $row->role_id,
                    'teams_id' => $row->teams_id,
                    'regenerate_login' => rand(100000, 999999)
                );
                $this->session->set_userdata($sessiondata);
                $this->systemlog->addUserLogin($row->user_id, 'Login');
                if ($this->systemlog->checkAddLogin($row->user_id) == 1) {
                    $this->systemlog->updateLoginCheck($row->user_id, $this->session->userdata('regenerate_login'));
                } else {
                    $this->systemlog->addLoginCheck($row->user_id, $this->session->userdata('regenerate_login'));
                }
                redirect(base_url());
            } else {
                $text = 'User ถูกระงับการใช้งาน';
                $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;' . $text . '</div>');
                redirect(base_url() . 'login');
            }
        } else {
            $text = 'Username หรือ Password ไม่ถูกต้อง';
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;' . $text . '</div>');
            redirect(base_url() . 'login');
        }
    }

    public function logout() {
        if ($this->session->userdata('islogin') == 1) {
            $this->systemlog->addUserLogin($this->session->userdata('user_id'), 'Logout');
            $this->systemlog->deleteLoginCheck($this->session->userdata('user_id'));
        }
        $this->session->sess_destroy();
//        $this->session->unset_userdata(array('islogin', 'user_id', 'role_id', 'regenerate_login'));
        redirect(base_url('login'));
    }

}
