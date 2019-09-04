<?php

class Payment extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 11;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('payment_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-money',
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('thbanklogos.css'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css', 'plugin/datepicker/datepicker.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js')
        );
        $this->renderView('payment_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        );
        $count = $this->payment_model->count_pagination($filter);
        $config['div'] = 'result_pagination';
        $config['base_url'] = base_url('payment/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'start_date' : '" . $this->input->post('start_date') . ",'end_date' : '" . $this->input->post('end_date') . "}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->payment_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/payment_pagination', $data);
    }

}
