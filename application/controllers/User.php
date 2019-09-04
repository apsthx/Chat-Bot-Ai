<?php

class User extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 8;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('user_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array(),
            'package' => $this->accesscontrol->getPackage()
        );
        $this->renderView('user_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext')
        );
        $count = $this->user_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('user/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->user_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/user_pagination', $data);
    }

    public function add_user_modal() {
        $this->load->view('modal/user_add_modal');
    }

    public function edit_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row()
        );
        $this->load->view('modal/user_edit_modal', $data);
    }

    public function status_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row(),
            'type' => $this->input->post('type')
        );
        $this->load->view('modal/user_status_modal', $data);
    }

    public function password_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row()
        );
        $this->load->view('modal/user_password_modal', $data);
    }

    public function check_username() {
        if ($this->user_model->check_username($this->input->post('username')) == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function check_email() {
        if ($this->user_model->check_email($this->input->post('email')) == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function check_tel() {
        if ($this->user_model->check_tel($this->input->post('tel')) == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_user() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => hash('sha256', $this->input->post('username') . $this->input->post('password')),
            'user_email' => $this->input->post('user_email'),
            'user_fullname' => $this->input->post('user_fullname'),
            'user_tel' => $this->input->post('user_tel'),
            'user_image' => 'none.png',
            'role_id' => 2,
            'user_status_id' => 1,
            'user_address' => $this->allowText($this->input->post('user_address')),
            'user_comment' => $this->allowText($this->input->post('user_comment')),
            'teams_id' => $this->session->userdata('teams_id'),
            'user_create' => $this->misc->getdate(),
            'user_update' => $this->misc->getdate()
        );
        $this->user_model->insert_user($data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,บันทึกผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function edit_user() {
        $data = array(
            'user_email' => $this->input->post('user_email'),
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->allowText($this->input->post('user_address')),
            'user_comment' => $this->allowText($this->input->post('user_comment')),
            'user_update' => $this->misc->getdate()
        );
        $this->user_model->update_user($this->input->post('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function password_user() {
        if ($this->input->post('password_new') == $this->input->post('password_confirm')) {
            $data = array(
                'password' => hash('sha256', $this->input->post('username') . $this->input->post('password_new')),
                'user_update' => $this->misc->getdate()
            );
            $this->user_model->update_user($this->input->post('user_id'), $data);
            $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,เปลี่ยน Password เรียบร้อยแล้ว');
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,ระบุ Password ( ยืนยัน ) ไม่ถูกต้อง ลองใหม่อีกครั้ง');
        }
        redirect(base_url('user'));
    }

    public function status_user() {
        $data = array(
            'user_status_id' => $this->input->post('user_status_id'),
            'user_update' => $this->misc->getdate()
        );
        $this->user_model->update_user($this->input->post('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('user'));
    }

    public function allowText($text) {
        $allow = "/([^a-zA-Z0-9ก-๙เ .\/,+*])/";
        return preg_replace($allow, '', $text);
    }
    
}
