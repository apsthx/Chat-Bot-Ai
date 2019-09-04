<?php

/*
 * Class Name : Broadcast
 * Author : Sakchai Kantada
 * Email : sakchaiwebmaster@gmail.com
 */

class Broadcast extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css' => array('pages/dashboard3.css'), 
        );
        $this->renderView('broadcast_view', $data);
    }

}
