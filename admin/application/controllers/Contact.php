<?php

class Contact extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 48;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('contact_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-navicon',
            'title' => 'รายการติดต่อสอบถาม',
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'css' => array(),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
            'js' => array()
        );
        $this->renderView('contact_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchdate' => $this->input->post('searchdate'),
            'contact_status_id' => $this->input->post('contact_status_id'),
            'searchtext' => $this->input->post('searchtext'),
        );
        $count = $this->contact_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('contact/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchdate' : '" . $this->input->post('searchdate') . "','contact_status_id' : '" . $this->input->post('contact_status_id') . "','searchtext' : '" . $this->input->post('searchtext') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->contact_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/contact_pagination', $data);
    }

    public function detail($contact_id = null) {
        if($contact_id != null){
            $contact_detail = $this->contact_model->get_contact_by_id($contact_id);
            if($contact_detail->num_rows() == 1) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'icon' => 'fa fa-navicon',
                    'title' => 'รายละเอียดติดต่อสอบถาม',
                    'data' => $contact_detail->row()
                );
                $this->renderView('contact_detail_view', $data);
            }else{
                $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถทำรายการได้');
                redirect(base_url('contact'));
            }
        }else{
            $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถทำรายการได้');
            redirect(base_url('contact'));
        }
    }

    public function edit()
    {
        $data = array(
            'contact_status_id' => $this->input->post("contact_status_id"),
            'contact_update' => $this->misc->getDate(),
        );
        $this->contact_model->update($this->input->post("contact_id") ,$data);

        $this->session->set_flashdata('flash_message', 'success,Success,บันทึกข้อมูลเรียบร้อย');
        redirect(base_url('contact/detail/'.$this->input->post("contact_id")));
    }

}
