<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportbot
 *
 * @author nut_channarong
 */
class Reportbot extends CI_Controller {

    //put your code here 2 5
    public $group_id = 2;
    public $menu_id = 5;
    public $per_page = 40;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportbot_model');
        $this->load->library('ajax_pagination');
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
        $this->renderView('reportbot_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'hook_project_id' => $this->input->post('hook_project_id'),
            'hook_platforms' => $this->input->post('hook_platforms'),
            'date_start_report' => $this->input->post('date_start_report'),
            'date_end_report' => $this->input->post('date_end_report'),
        );
        $count = $this->reportbot_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('reportbot/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','hook_project_id' : '" . $this->input->post('hook_project_id') . "','hook_platforms' : '" . $this->input->post('hook_platforms') . "','date_start_report' : '" . $this->input->post('date_start_report') . "','date_end_report' : '" . $this->input->post('date_end_report') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->reportbot_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/reportbot_pagination', $data);
    }

}
