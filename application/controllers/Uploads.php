<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uploads
 *
 * @author nut
 */
class Uploads extends CI_Controller {

    public $group_id = '';
    public $menu_id = '';
    public $per_page = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('uploads_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'package' => $this->accesscontrol->getPackage()
        );
        $this->renderView('uploads_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext')
        );
        $count = $this->uploads_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('uploads/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->uploads_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/uploads_pagination', $data);
    }

    public function deleteuploadsmodal() {
        if ($this->input->post('image_id') != null) {
            $data = array(
                'image_id' => $this->input->post('image_id'),
            );
            $this->load->view('modal/uploads_delete_modal', $data);
        } else {
            redirect(base_url('uploads'));
        }
    }

    public function deleteuploads() {
        if ($this->input->post('image_id') != null) {
            $image_id = $this->input->post('image_id');
            $image = $this->uploads_model->get_image($image_id)->row();
            $patch_file = './' . $image->image_path;
            @unlink($patch_file);
            $this->uploads_model->delete_image($image_id);
            $json = array(
                'status' => 'success',
                'title' => 'ทำรายการเรียบร้อย',
                'message' => 'ลบข้อมูลเรียบร้อยเเล้ว'
            );
        } else {
            $json = array(
                'status' => 'error',
                'title' => 'เกิดข้อผิดพลาด',
                'message' => 'ลบข้อมูลไม่สำเร็จ'
            );
        }
        echo json_encode($json);
    }

}
