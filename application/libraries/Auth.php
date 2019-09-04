<?php

class Auth {

    public function isLoginNull() {
        $CI = & get_instance();
        if ($CI->session->userdata('islogin') != 1 || $CI->accesscontrol->checkLogin($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
            redirect(base_url() . 'login');
        }
    }

    public function isLogin($menu_id = NULL) {
        $CI = & get_instance();
        if ($CI->session->userdata('islogin') != 1 || $CI->accesscontrol->checkLogin($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
            redirect(base_url() . 'login');
        }
        if ($CI->accesscontrol->accessMenu($CI->session->userdata('role_id'), $menu_id) == 0) {
            $CI->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถเข้าถึงเมนูนี้ได้');
            redirect(base_url());
        }
    }

}
