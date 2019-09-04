<?php

class Role extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 9;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('role_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->role_model->get_role(),
        );
        $this->renderView('role_view', $data);
    }

    public function setrole() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
        );
        $this->load->view('modal/set_role_modal', $data);
    }

    public function add() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
            'menu_id' => $this->input->post('menu_id'),
        );
        $this->role_model->addrole($data);
    }

    public function delete() {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');
        $this->role_model->deleterole($role_id, $menu_id);
    }

}
