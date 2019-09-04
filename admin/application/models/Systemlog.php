<?php

/*
 * Class name : Systemlog
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 * Date Time : 25 ก.ย. 2559 14:30:26
 */

class Systemlog extends CI_Model {

    public function getAgent() {
        $this->load->library('user_agent');
        $agent = $this->agent->browser() . '/' . $this->agent->version();
        $agent = $agent . ' ' . $this->agent->platform();
        $agent = $agent . ' ' . $this->agent->mobile();
        return $agent;
    }

    public function addUserLogin($user_id, $text) {
        $data = array(
            'user_id' => $user_id,
            'log_text' => $text,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_user_login', $data);
    }

    //------ check Login------------------------------------------------------------
    public function checkAddLoginAdmin($admin_id) {
        $this->db->select('admin_check_login.login_id');
        $this->db->from('admin_check_login');
        $this->db->where('admin_check_login.admin_id', $admin_id);
        return $this->db->count_all_results();
    }

    //------ add Login Check-----------------
    public function addLoginCheckAdmin($admin_id, $regenerate_login) {
        $data = array(
            'admin_id' => $admin_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->insert('admin_check_login', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheckAdmin($admin_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->where('admin_check_login.admin_id', $admin_id);
        $this->db->update('admin_check_login', $data);
    }

    //------ update Login Check-----------------
    public function deleteLoginCheckAdmin($admin_id) {
        $this->db->where('admin_check_login.admin_id', $admin_id);
        $this->db->delete('admin_check_login');
    }

    public function addAdminLogin($admin_id, $text) {
        $data = array(
            'admin_id' => $admin_id,
            'log_text' => $text,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_admin_login', $data);
    }

    // ---------- log ------------------------------

    public function log_sms_credit($text, $shop_id_pri) {
        $data = array(
            'log_text' => $text,
            'shop_id_pri' => $shop_id_pri,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_sms_credit', $data);
    }

    public function log_send_sms($text, $shop_id_pri, $user_id) {
        $data = array(
            'log_text' => $text,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $user_id,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_send_sms', $data);
    }

    public function log_trans_credit($text, $shop_id_pri) {
        $data = array(
            'log_text' => $text,
            'shop_id_pri' => $shop_id_pri,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_trans_credit', $data);
    }

    public function log_package($package_id, $teams_id) {
        $data = array(
            'package_id' => $package_id,
            'teams_id' => $teams_id,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_package', $data);
    }

}
