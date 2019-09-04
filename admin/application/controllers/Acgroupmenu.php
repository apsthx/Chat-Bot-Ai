<?php

class Acgroupmenu extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 7;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('acgroupmenu_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->acgroupmenu_model->get_groupmenu(),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('acgroupmenu_view', $data);
    }

    public function getgroupmenu() {
        $groupmenu = $this->acgroupmenu_model->get_groupmenu($this->input->post('group_menu_id'))->row();
        echo json_encode($groupmenu);
    }

    public function addgroupmenu() {
        $data = array(
            'group_menu_name' => $this->input->post('group_menu_name'),
            'group_menu_icon' => $this->input->post('group_menu_icon'),
            'group_menu_sort' => $this->acgroupmenu_model->get_last_groupmenu()->row()->group_menu_sort + 1,
            'group_menu_update' => $this->misc->getdate()
        );
        $this->acgroupmenu_model->addgroupmenu($data);
        redirect(base_url('acgroupmenu'));
    }

    public function editgroupmenu() {
        $data = array(
            'group_menu_name' => $this->input->post('group_menu_name'),
            'group_menu_icon' => $this->input->post('group_menu_icon'),
            'group_menu_update' => $this->misc->getdate()
        );
        $this->acgroupmenu_model->editgroupmenu($this->input->post('group_menu_id'), $data);
        redirect(base_url('acgroupmenu'));
    }

    public function deletegroupmenu($id) {
        $this->acgroupmenu_model->deletegroupmenu($id);
        redirect(base_url('acgroupmenu'));
    }

    public function sortgroupmenu() {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => 'fa fa-gears',
            'title' => 'จัดการเรียงกลุ่มเมนู',
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js')
        );
        $this->renderView('acgroupmenu_sort_view', $data);
    }

    public function editsortgroupmenu() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'group_menu_sort' => $count
            );
            $this->acgroupmenu_model->editgroupmenu($row['id'], $data);
            $count++;
        }
    }

    // menu
    public function menu($group_menu_id = null) {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => 'fa fa-gear',
            'title' => 'จัดการเมนู',
            'group_menu_id' => $group_menu_id,
            'group_menu' => $this->acgroupmenu_model->get_groupmenu($group_menu_id)->row(),
            'datas' => $this->acgroupmenu_model->get_menu_all($group_menu_id),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('acmenu_view', $data);
    }

    public function getmenu() {
        $menu = $this->acgroupmenu_model->get_menu($this->input->post('menu_id'))->row();
        echo json_encode($menu);
    }

    public function addmenu() {
        $group_menu_id = $this->input->post('group_menu_id');
        $data = array(
            'group_menu_id' => $group_menu_id,
            'menu_name' => $this->input->post('menu_name'),
            'menu_link' => $this->input->post('menu_link'),
            'menu_status_id' => 1,
            'menu_openlink' => 0,
            'menu_sort' => $this->acgroupmenu_model->get_last_menu($group_menu_id)->row()->menu_sort + 1,
            'menu_update' => $this->misc->getdate()
        );
        $this->acgroupmenu_model->addmenu($data);
        redirect(base_url('acgroupmenu/menu/' . $group_menu_id));
    }

    public function editmenu() {
        $group_menu_id = $this->input->post('group_menu_id');
        $data = array(
            'menu_name' => $this->input->post('menu_name'),
            'menu_link' => $this->input->post('menu_link'),
            'menu_status_id' => $this->input->post('menu_status_id'),
            'menu_openlink' => $this->input->post('menu_openlink'),
            'menu_update' => $this->misc->getdate()
        );
        $this->acgroupmenu_model->editmenu($this->input->post('menu_id'), $data);
        redirect(base_url('acgroupmenu/menu/' . $group_menu_id));
    }

    public function deletemenu($group_menu_id, $id) {
        $this->acgroupmenu_model->deletemenu($id);
        redirect(base_url('acgroupmenu/menu/' . $group_menu_id));
    }

    public function sortmenu($group_menu_id) {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => 'fa fa-gear',
            'title' => 'จัดการเรียงเมนู',
            'group_menu_id' => $group_menu_id,
            'group_menu' => $this->acgroupmenu_model->get_groupmenu($group_menu_id)->row(),
            'css' => array(),
            'css_full' => array('plugin/nestable/nestable.css'),
            'js' => array(),
            'js_full' => array('plugin/nestable/jquery.nestable.js')
        );
        $this->renderView('acmenu_sort_view', $data);
    }

    public function editsortmenu() {
        $count = 1;
        foreach ($this->input->post('list') as $row) {
            $data = array(
                'menu_sort' => $count
            );
            $this->acgroupmenu_model->editmenu($row['id'], $data);
            $count++;
        }
    }

}
