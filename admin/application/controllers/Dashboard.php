<?php

/*
 * Class Name : Dashboard
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Dashboard extends CI_Controller {

    public $menu_id = 1;
    public $group_id = 1;

    
    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('dashboard_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js')
        );
        $this->renderView('dashboard_view', $data);
    }

}
