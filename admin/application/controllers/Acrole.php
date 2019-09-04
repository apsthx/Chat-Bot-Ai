<?php

class Acrole extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 6;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('acrole_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->acrole_model->get_role(),
        );
        $this->renderView('acrole_view', $data);
    }

    public function setrole() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
        );
        $this->load->view('modal/set_acrole_modal', $data);
    }

    public function add() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
            'menu_id' => $this->input->post('menu_id'),
        );
        $this->acrole_model->addrole($data);
    }

    public function delete() {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');
        $this->acrole_model->deleterole($role_id, $menu_id);
    }

}
