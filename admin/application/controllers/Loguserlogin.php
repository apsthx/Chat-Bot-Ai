<?php

class Loguserlogin extends CI_Controller {

    public $group_id = 5;
    public $menu_id = 12;
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('loguserlogin_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'css' => array(),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
            'js' => array()
        );
        $this->renderView('loguserlogin_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchdate' => $this->input->post('searchdate'),
            'searchtext' => $this->input->post('searchtext')
        );
        $count = $this->loguserlogin_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('loguserlogin/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','searchdate' : '" . $this->input->post('searchdate') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->loguserlogin_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/loguserlogin_pagination', $data);
    }

}
