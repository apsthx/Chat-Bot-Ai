<?php

class Store extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,ไม่สามารถเข้าถึงข้อมูลได้');
        redirect(base_url());
    }

    public function image($file_name = null) {
        if ($file_name == NULL) {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,ไม่สามารถเข้าถึงข้อมูลได้');
            redirect(base_url());
        }

        $file = 'assets/upload/intent/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function user($file_name = null) {
        if ($file_name == NULL) {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,ไม่สามารถเข้าถึงข้อมูลได้');
            redirect(base_url());
        }

        $file = 'assets/upload/user/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function evidence($file_name = null) {
        if ($file_name == NULL) {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,ไม่สามารถเข้าถึงข้อมูลได้');
            redirect(base_url());
        }

        $file = 'assets/upload/evidence/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

}
