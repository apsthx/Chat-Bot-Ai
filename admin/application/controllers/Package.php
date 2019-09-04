<?php

class Package extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 4;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('package_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
            'datas' => $this->package_model->getPackage(),
        );
        $this->renderView('package_view', $data);
    }

    public function modalPackageAdd() {
        $this->load->view('modal/package_add');
    }

    public function addpackage() {
        $data = array(
            'package_name' => $this->input->post('package_name'),
            'package_cost' => $this->input->post('package_cost'),
            'package_agent' => $this->input->post('package_agent'),
            'package_user' => $this->input->post('package_user'),
            'package_date' => $this->input->post('package_date'),
            'package_check' => 1,
            'package_modify' => $this->misc->getDate()
        );
        $this->package_model->addPackage($data);
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('package'));
    }

    public function modalPackageEdit() {
        $id = $this->input->post('package_id');
        $data = array(
            'data' => $this->package_model->getPackage($id)->row(),
        );
        $this->load->view('modal/package_edit', $data);
    }

    public function editpackage() {
        if ($this->input->post('package_onoff') == 'on') {
            $package_onoff = 1;
        } else {
            $package_onoff = 0;
        }
        $data = array(
            'package_name' => $this->input->post('package_name'),
            'package_cost' => $this->input->post('package_cost'),
            'package_agent' => $this->input->post('package_agent'),
            'package_user' => $this->input->post('package_user'),
            'package_date' => $this->input->post('package_date'),
            'package_modify' => $this->misc->getDate()
        );
        $this->package_model->editPackage($this->input->post('package_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('package'));
    }

    public function modalEditStatus() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
        );
        $this->load->view('modal/package_editstatus', $data);
    }

    public function editStatus() {
        $this->package_model->editPackage($this->input->post('package_id'), array('package_check' => 0, 'package_modify' => $this->misc->getDate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('package'));
    }

    public function EditChangeStatus() {
        $this->package_model->editPackage($this->input->post('package_id'), array('package_check' => 1, 'package_modify' => $this->misc->getDate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function packageView() {
        $id = $this->input->post('package_id');
        $data = array(
            'datas' => $this->package_model->getTeamsPackage($id),
        );
        $this->load->view('modal/packageuser_view', $data);
    }

    public function limitmenu() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
        );
        $this->load->view('modal/package_limit', $data);
    }

    public function addlimit() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
            'menu_id' => $this->input->post('menu_id'),
        );
        $this->package_model->addlimit($data);
    }

    public function deletelimit() {
        $package_id = $this->input->post('package_id');
        $menu_id = $this->input->post('menu_id');
        $this->package_model->deletelimit($package_id, $menu_id);
    }

}
