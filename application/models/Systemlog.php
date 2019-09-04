<?php

/*
 * Class name : Systemlog
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
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
    public function checkAddLogin($user_id) {
        $this->db->select('user_check_login.login_id');
        $this->db->from('user_check_login');
        $this->db->where('user_check_login.user_id', $user_id);
        return $this->db->get()->num_rows();
    }

    //------ add Login Check-----------------
    public function addLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'user_id' => $user_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->insert('user_check_login', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->misc->getDate()
        );
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->update('user_check_login', $data);
    }

    //------ delete Login Check-----------------
    public function deleteLoginCheck($user_id) {
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->delete('user_check_login');
    }

    //------- Log -----------------
    public function log_send_sms($user_id, $text) {
        $data = array(
            'user_id' => $user_id,
            'log_text' => $text,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_send_sms', $data);
    }

    public function log_agent($user_id, $text) {
        $data = array(
            'user_id' => $user_id,
            'log_text' => $text,
            'log_time' => $this->misc->getDate()
        );
        $this->db->insert('log_agent', $data);
    }

}
