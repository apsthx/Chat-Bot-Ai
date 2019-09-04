<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportstatistic
 *
 * @author nut_channarong
 */
class Reportstatistic extends CI_Controller {

    //put your code here 2 6
    public $group_id = 2;
    public $menu_id = 6;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportstatistic_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
        );
        $this->renderView('reportstatistic_view', $data);
    }

    public function ajax_page() {
        $filter = array(
//            'searchtext' => $this->input->post('searchtext'),
            'hook_project_id' => $this->input->post('hook_project_id'),
            'date_start_report' => $this->input->post('date_start_report'),
            'date_end_report' => $this->input->post('date_end_report'),
        );
        $data = array(
            'agents' => $this->reportstatistic_model->get_page($filter),
            'date_start_report' => $this->input->post('date_start_report'),
            'date_end_report' => $this->input->post('date_end_report'),
        );
        $this->load->view('ajax/reportstatistic_page', $data);
    }

}
