<?php

/*
 * Class name : Auth
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 * Date Time : 25 ก.ย. 2559 14:27:26
 */

class Auth {

    public function isLoginNull() {
        $CI = & get_instance();
        if ($CI->session->userdata('is_admin_login') != 1 || $CI->accesscontrol->checkLoginAdmin($CI->session->userdata('admin_id'), $CI->session->userdata('regenerate_admin_login')) == 0) {
            redirect(base_url() . 'login');
        }
    }

    public function isLogin($menu_id = NULL) {
        $CI = & get_instance();
        if ($CI->session->userdata('is_admin_login') != 1 || $CI->accesscontrol->checkLoginAdmin($CI->session->userdata('admin_id'), $CI->session->userdata('regenerate_admin_login')) == 0) {
            redirect(base_url() . 'login');
        }
        if ($CI->accesscontrol->accessMenu($CI->session->userdata('role_id'), $menu_id) == 0) {
            $CI->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถเข้าถึงเมนูนี้ได้');
            if ($CI->session->userdata('role_id') == 1) {
                redirect(base_url() . 'dashboard');
            } else if ($CI->session->userdata('role_id') == 2) {
                redirect(base_url() . 'main');
            } else {
                redirect(base_url() . 'login');
            }
        }
    }

}
