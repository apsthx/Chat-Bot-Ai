<?php

class Profile_model extends CI_Model {

    public function getUser($id = null) {
        $this->db->select('*');
        $this->db->join('ac_role' ,'ac_role.role_id = user.role_id');
        if ($id != NULL) {
            $this->db->where('user.user_id', $id);
        }
        return $this->db->get('user');
    }

    public function getLoglogin($id) {
        $this->db->select('log_user_login.*,user.user_fullname');
        $this->db->join('user', 'user.user_id = log_user_login.user_id');
        $this->db->where('log_user_login.user_id', $id);
        $this->db->limit(10);
        $this->db->order_by('log_user_login.log_time', 'DESC');
        return $this->db->get('log_user_login');
    }

    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }

    public function checkPassword($user_id, $password) {
        $this->db->where('user_id', $user_id);
        $this->db->where('password', $password);
        return $this->db->get('user');
    }

    public function getPhoto($user_id) {
        $this->db->select('user.user_image');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get('user')->row()->user_image;
    }

}
