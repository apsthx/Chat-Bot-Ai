<?php

/*
 * Class Name : Bank
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Bank extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 27;
    public $per_page = 10;


    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('bank_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('thbanklogos.css'),
            'datasbank' => $this->bank_model->getBank(),
        );
        $this->renderView('bank_view', $data);
    }

    public function modalBankAdd() {
        $this->load->view('modal/bank_add');
    }

    public function addBank() {
        $data = array(
            'bank_icon_id' => $this->input->post('bank_icon_id'),
            'bank_name' => $this->input->post('bank_name'),
            'bank_branch' => $this->input->post('bank_branch'),
            'bank_account_name' => $this->input->post('bank_account_name'),
            'bank_account_number' => $this->input->post('bank_account_number'),
            'bank_check' => 1,
            'bank_modify' => $this->misc->getDate()
        );
        $this->bank_model->addBank($data);
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('bank'));
    }

    public function modalBankEdit() {
        $id = $this->input->post('bank_id');
        $data = array(
            'data' => $this->bank_model->getBank($id)->row(),
        );
        $this->load->view('modal/bank_edit', $data);
    }

    public function editBank() {
        $data = array(
            'bank_icon_id' => $this->input->post('bank_icon_id'),
            'bank_name' => $this->input->post('bank_name'),
            'bank_branch' => $this->input->post('bank_branch'),
            'bank_account_name' => $this->input->post('bank_account_name'),
            'bank_account_number' => $this->input->post('bank_account_number'),
            'bank_modify' => $this->misc->getDate()
        );
        $this->bank_model->editBank($this->input->post('bank_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('bank'));
    }

    public function bankEditStatus() {
        $data = array(
            'bank_id' => $this->input->post('bank_id'),
        );
        $this->load->view('modal/bank_edit_status', $data);
    }

    public function editStatusBank() {
        $this->bank_model->editBank($this->input->post('bank_id'), array('bank_check' => 0, 'bank_modify' => $this->misc->getDate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('bank'));
    }

    public function editChangeStatusBank() {
        $this->bank_model->editBank($this->input->post('bank_id'), array('bank_check' => 1, 'bank_modify' => $this->misc->getDate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function bankIcon($bank_icon_id) {
        $row = $this->bank_model->getBankIcon($bank_icon_id)->row();
        $this->returnJSON($row);
    }

    
}
