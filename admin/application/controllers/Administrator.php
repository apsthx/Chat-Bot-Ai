<?php

class Administrator extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 8;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('administrator_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
        );
        $this->renderView('administrator_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'user_status_id' => $this->input->post('user_status_id')
        );
        $count = $this->administrator_model->count_pagination($filter);
        $config['div'] = 'result_pagination';
        $config['base_url'] = base_url('administrator/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','user_status_id' : '" . $this->input->post('user_status_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->administrator_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/administrator_pagination', $data);
    }

    
    public function modaleditpassword() {
        $data = array(
            'admin_id' => $this->input->post('admin_id'),
            'admin_username' => $this->input->post('admin_username'),
        );
        $this->load->view('modal/administrator_editpassword', $data);
    }

    public function editpassword() {
        $this->administrator_model->edit($this->input->post('admin_id'), array('admin_password' => hash('sha256', $this->input->post('admin_username') . '1234'), 'admin_modify' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('administrator'));
    }

    public function checkadminusername() {
        $check = $this->administrator_model->checkAdminUsername($this->input->post('admin_username'));
        if ($check->num_rows() > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function modaladd() {
        $this->load->view('modal/administrator_add');
    }

    public function add() {
        $data = array(
            'admin_username' => $this->input->post('admin_username'),
            'admin_password' => hash('sha256', $this->input->post('admin_username') . $this->input->post('admin_password')),
            'admin_fullname' => $this->input->post('admin_fullname'),
            'admin_image' => 'none.png',
            'user_status_id' => 1,
            'role_id' => $this->input->post('role_id'),
            'admin_modify' => $this->misc->getdate()
        );
        $this->administrator_model->add($data);
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('administrator'));
    }

    public function modaledit($id) {
        $data = array(
            'data' => $this->administrator_model->getAdminByID($id)
        );
        $this->load->view('modal/administrator_edit', $data);
    }

    public function edit() {
        if ($this->input->post('admin_password') != '') {
            $data = array(
                'admin_fullname' => $this->input->post('admin_fullname'),
                'admin_password' => hash('sha256', $this->input->post('admin_username') . $this->input->post('admin_password')),
                'role_id' => $this->input->post('role_id'),
                'admin_modify' => $this->misc->getdate()
            );
        } else {
            $data = array(
                'admin_fullname' => $this->input->post('admin_fullname'),
                'role_id' => $this->input->post('role_id'),
                'admin_modify' => $this->misc->getdate()
            );
        }

        $this->administrator_model->edit($this->input->post('admin_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('administrator'));
    }

    public function modaleditstatus() {
        $data = array(
            'admin_id' => $this->input->post('admin_id'),
        );
        $this->load->view('modal/administrator_editstatus', $data);
    }

    public function editstatus() {
        $this->administrator_model->edit($this->input->post('admin_id'), array('user_status_id' => 2, 'admin_modify' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('administrator'));
    }

    public function editchangestatus() {
        $this->administrator_model->edit($this->input->post('admin_id'), array('user_status_id' => 1, 'admin_modify' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

}
