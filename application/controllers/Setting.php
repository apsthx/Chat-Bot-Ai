<?php

class Setting extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 9;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('setting_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
            'data' => $this->setting_model->getTeams()->row(),
        );
        $this->renderView('setting_view', $data);
    }

    public function edit() {
        $row = $this->setting_model->getTeams()->row();
        if ($row->teams_name != $this->input->post('teams_name')) {
            if ($this->setting_model->getTeamsOther($this->input->post('teams_name')) == 0) {
                $data = array(
                    'teams_name' => $this->input->post('teams_name'),
                    'teams_update' => $this->misc->getDate()
                );
                $this->setting_model->updateTeams($data);
                $this->session->set_flashdata('flash_message', 'success,Success,บันทึกข้อมูลเรียบร้อยแล้ว');
            } else {
                $this->session->set_flashdata('flash_message', 'warning,Warning,มีการใช้งานชื่อทีมนี้เเล้ว');
            }
        } else {
            $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถบันทึกได้ เป็นชื่อเดิม');
        }
        redirect(base_url() . 'setting');
    }

}
