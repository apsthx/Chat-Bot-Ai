<?php

class Profile_model extends CI_Model {

    public function getAdmin($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('admin.admin_id', $id);
        }
        return $this->db->get('admin');
    }

    public function checkPassword($admin_id, $password) {
        $this->db->where('admin.admin_id', $admin_id);
        $this->db->where('admin.admin_password', $password);
        return $this->db->get('admin');
    }

    public function edit($admin_id, $data) {
        $this->db->where('admin.admin_id', $admin_id);
        $this->db->update('admin', $data);
    }

    public function getPhoto($user_id) {
        $this->db->select('admin.admin_image');
        $this->db->where('admin.admin_id', $user_id);
        return $this->db->get('admin')->row()->admin_image;
    }

}
