<?php

/*
 * Class Name : Dashboard
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Dashboard extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('dashboard_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css' => array('pages/dashboard3.css'), 
        );
        $this->renderView('dashboard_view', $data);
    }
//
//    public function version() {
//        $this->load->view('welcome_message');
//    }

}
