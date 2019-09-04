<?php

class Facebookapp extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 18;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('facebookapp_model');
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
            'js_full' => array()
        );
        $this->renderView('facebookapp_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'app_facebook_use' => $this->input->post('app_facebook_use')
        );
        $count = $this->facebookapp_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('facebookapp/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','app_facebook_use' : '" . $this->input->post('app_facebook_use') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->facebookapp_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/facebookapp_pagination', $data);
    }

    public function modaladd() {
        $this->load->view('modal/facebookapp_add');
    }

    public function add() {
        $data = array(
            'app_facebook_id' => $this->input->post('app_facebook_id'),
            'app_facebook_name' => $this->input->post('app_facebook_name'),
            'app_facebook_use' => 0,
            'app_facebook_create' => $this->misc->getdate(),
            'app_facebook_update' => $this->misc->getdate()
        );
        $this->facebookapp_model->add($data);
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('facebookapp'));
    }

    public function modaledit() {
        $app_facebook_id = $this->input->post('app_facebook_id');
        if ($app_facebook_id != '') {
            $data = array(
                'data' => $this->facebookapp_model->get_app_facebook($app_facebook_id)->row()
            );
            $this->load->view('modal/facebookapp_edit', $data);
        }
    }

    public function edit() {
        $data = array(
            'app_facebook_id' => $this->input->post('app_facebook_id'),
            'app_facebook_name' => $this->input->post('app_facebook_name'),
            'app_facebook_update' => $this->misc->getdate()
        );

        $this->facebookapp_model->edit($this->input->post('app_facebook_id_pri'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('facebookapp'));
    }

    public function status_facebookapp_modal() {
        $data = array(
            'data' => $this->facebookapp_model->get_app_facebook($this->input->post('app_facebook_id_pri'))->row(),
        );
        $this->load->view('modal/facebookapp_status_modal', $data);
    }

    public function status_facebookapp() {
        $data = array(
            'app_facebook_use' => 0,
            'app_facebook_update' => $this->misc->getdate()
        );
        $this->facebookapp_model->edit($this->input->post('app_facebook_id_pri'), $data);
        $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,แก้ไขผู้ใช้ระบบเรียบร้อยแล้ว');
        redirect(base_url('facebookapp'));
    }

}
