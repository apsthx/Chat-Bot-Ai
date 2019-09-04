<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index() {
        $data = array(
            'title' => 'สมัครสมาชิก'
        );
        $this->renderFormView('register_view', $data);
    }

    public function modalsendsms() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password_confirm = $this->input->post('password_confirm');
        $email = $this->input->post('email');
        $telcheck = $this->input->post('telcheck');

        $input = array(
            'username' => $username,
            'password' => $password,
            'password_confirm' => $password_confirm,
            'email' => $email,
        );

        $check_form_valid = $this->check_form_valid($input);
        if ($check_form_valid == '0') {
            $tels = $this->register_model->getUserTel($telcheck);
            if ($tels->num_rows() > 0) {
                echo 1;
            } else {
                $otp = sprintf("%06d", mt_rand(1, 999999));
                $sessiondata = array(
                    'tel' => $telcheck,
                    'otp' => $otp,
                );
                $this->session->set_userdata($sessiondata);
                $data = array(
                    'telcheck' => $telcheck,
                    'refotp' => $this->input->post('refotp'),
                    'otp' => $otp,
                );
                $this->load->view('modal/register_sendsms', $data);
            }
        } else {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;' . $check_form_valid . '</div>');
            echo 0;
        }
    }

    public function add() {
        $tel = $this->input->post('telcheck');
        $otp = $this->input->post('otp');

        if ($tel != $this->session->userdata('tel')) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เบอร์โทรถูกแก้ไข!</div>');
            redirect(base_url() . 'register');
        } else {
            if ($otp != $this->session->userdata('otp')) {
                $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;รหัส OTP ถูกแก้ไข!</div>');
                redirect(base_url() . 'register');
            } else {

                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $password_confirm = $this->input->post('password_confirm');
                $fullname = $this->input->post('fullname');
                $email = $this->input->post('email');
                $team = $this->input->post('team');
                $input = array(
                    'username' => $username,
                    'password' => $password,
                    'password_confirm' => $password_confirm,
                    'email' => $email,
                    'team' => $team
                );
                $check_form_valid = $this->check_form_valid($input);

                if ($check_form_valid == '0') {
                    $package = 1;
                    $packages = $this->register_model->getPackage($package);
                    if ($packages->num_rows() == 1) {
                        $package_r = $packages->row();
                        $day_package = date('Y-m-d', strtotime(date('Y-m-d') . "+ $package_r->package_date day"));
                    } else {
                        $day_package = date('Y-m-d', strtotime(date('Y-m-d') . "+30 day"));
                    }

                    $datateams = array(
                        'teams_code' => NULL,
                        'teams_name' => $team,
                        'teams_status_id' => 1,
                        'package_id' => $package,
                        'teams_package_date' => date('Y-m-d'),
                        'teams_package_expire' => $day_package,
                        'teams_create' => $this->misc->getDate(),
                        'teams_update' => $this->misc->getDate()
                    );
                    $teams_id = $this->register_model->addTeams($datateams);
                    $this->register_model->editTeams($teams_id, array('teams_code' => 'T' . sprintf('%03d', $teams_id)));

                    $password_conv = hash('sha256', $username . $password);
                    $datauser = array(
                        'username' => $username,
                        'password' => $password_conv,
                        'user_fullname' => $fullname,
                        'user_email' => $email,
                        'user_tel' => $tel,
                        'user_image' => 'none.png',
                        'teams_id' => $teams_id,
                        'role_id' => 1,
                        'user_status_id' => 1,
                        'user_create' => $this->misc->getDate(),
                        'user_update' => $this->misc->getDate()
                    );
                    $this->register_model->addUser($datauser);

                    $text = 'สมัครสมาชิกสำเร็จ Login เพื่อเข้าสู่ระบบ';
                    $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid green;"><i class="fa fa-check" style="color: green;"></i>&nbsp;' . $text . '</div>');
                    redirect(base_url() . 'login');
                } else {
                    $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;' . $check_form_valid . '</div>');
                    redirect(base_url() . 'register');
                }
            }
        }
    }

    private function check_form_valid($input) {
        $error_text = "";
        if ($this->check_username($input['username']) == '1') {
            $error_text = 'Username นี้มีผู้ใช้งานแล้ว';
        } elseif ($this->check_email($input['email']) == '1') {
            $error_text = 'Email นี้มีผู้ใช้งานแล้ว';
        } elseif ($this->check_team($input['team']) == '1') {
            $error_text = 'ชื่อทีมนี้มีการใช้งานแล้ว';
        } elseif (!preg_match("/^[_a-zA-Z0-9]{4,20}$/", $input['username'])) {
            $error_text = 'Username ไม่ถูกต้อง สามารถกรอกได้ _ a-zA-Z0-9 จำนวน 4-20 ตัวอักษร';
        } elseif (!preg_match("/^[a-zA-Z0-9]{6,20}$/", $input['password'])) {
            $error_text = 'Password ไม่ถูกต้อง สามารถกรอกได้ a-zA-Z0-9 จำนวน 6-20 ตัวอักษร';
        } elseif ($input['password'] != $input['password_confirm']) {
            $error_text = 'Password ไม่ตรงกัน';
        } elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $input['email'])) {
            $error_text = 'Email ไม่ถูกต้อง';
        }
        if ($error_text != "") {
            return $error_text;
        } else {
            return 0;
        }
    }

    public function check_username($username = null) {
        if ($username == NULL) {
            $username = $this->input->post('username');
        }
        $count = $this->register_model->checkUsername($username);
        if ($count > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    public function check_email($email = null) {
        if ($email == NULL) {
            $email = $this->input->post('email');
        }
        $count = $this->register_model->checkEmail($email);
        if ($count > 0) {
            return '1';
        } else {
            return '0';
        }
    }
    
    public function check_team($team = null) {
        if ($team == NULL) {
            $team = $this->input->post('team');
        }
        $count = $this->register_model->checkTeam($team);
        if ($count > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    public function checkConfirm() {
        $tel = $this->input->post('telcheck');
        $otp = $this->input->post('checkotp');
        if ($tel != $this->session->userdata('tel')) {
            echo 2;
        } else {
            if ($otp != $this->session->userdata('otp')) {
                echo 3;
            } else {
                echo 1;
            }
        }
    }

}
