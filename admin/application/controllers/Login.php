<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('is_admin_login') == 1 && $this->accesscontrol->checkLoginAdmin($this->session->userdata('admin_id'), $this->session->userdata('regenerate_admin_login')) == 1) {
            redirect(base_url());
        }
        $data = array(
            'title' => 'เข้าสู่ระบบ',
        );
        $this->load->view('login_view', $data);
    }

    public function doLogin() {
        $username = $this->input->post('username');
        $password = hash('sha256', $this->input->post('username') . $this->input->post('password'));
        $admins = $this->accesscontrol->getLogin($username, $password);
        if ($admins->num_rows() > 0) {
            $admin = $admins->row();
            if ($admin->user_status_id == 1) {
                $sessiondata = array(
                    'admin_id' => $admin->admin_id,
                    'role_id' => $admin->role_id,
                    'is_admin_login' => 1,
                    'regenerate_admin_login' => rand(100000, 999999)
                );
                $this->session->set_userdata($sessiondata);
                if ($this->systemlog->checkAddLoginAdmin($admin->admin_id) == 1) {
                    $this->systemlog->updateLoginCheckAdmin($admin->admin_id, $this->session->userdata('regenerate_admin_login'));
                } else {
                    $this->systemlog->addLoginCheckAdmin($admin->admin_id, $this->session->userdata('regenerate_admin_login'));
                }
                $this->systemlog->addAdminLogin($admin->admin_id, 'Login');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;Username นี้ถูกระงับการใช้งาน</div>');
                redirect(base_url() . 'login');
            }
        } else {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;Username or Password ไม่ถูกต้อง</div>');
            redirect(base_url() . 'login');
        }
    }

    public function logout() {
        if ($this->session->userdata('is_admin_login') == 1) {
            $this->systemlog->deleteLoginCheckAdmin($this->session->userdata('admin_id'));
            $this->systemlog->addAdminLogin($this->session->userdata('admin_id'), 'Loout');
        }
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
    }

}
