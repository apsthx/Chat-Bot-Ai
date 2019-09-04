<?php

class User extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 3;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('user_model');
        $this->load->library('ajax_pagination');
    }

    public function index($status = null) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array(),
            'status' => $status
        );
        $this->renderView('user_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'user_status_id' => $this->input->post('user_status_id'),
            'teams_id' => $this->input->post('teams_id'),
            'role_id' => $this->input->post('role_id')
        );
        $count = $this->user_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('user/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','user_status_id' : '" . $this->input->post('user_status_id') . "','role_id' : '" . $this->input->post('role_id') . "','teams_id' : '" . $this->input->post('teams_id') . "'}";
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

    public function edit_user_modal() {
        $data = array(
            'data' => $this->user_model->get_user($this->input->post('user_id'))->row(),
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

    public function edit_user() {
        $data = array(
            'user_email' => $this->input->post('user_email'),
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->input->post('user_address'),
            'user_tel' => $this->input->post('user_tel'),
            'role_id' => $this->input->post('role_id'),
            'user_comment' => $this->input->post('user_comment'),
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

}
