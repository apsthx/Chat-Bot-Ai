<?php

class Administrator_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('admin.admin_id');
        $this->db->from('admin');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = admin.user_status_id');
        $this->db->join('a_role', 'a_role.role_id = admin.role_id');
        if ($filter['user_status_id'] != '') {
            $this->db->where("admin.user_status_id", $filter['user_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                admin.admin_username LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_fullname LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = admin.user_status_id');
        $this->db->join('a_role', 'a_role.role_id = admin.role_id');
        if ($filter['user_status_id'] != '') {
            $this->db->where("admin.user_status_id", $filter['user_status_id']);
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                admin.admin_username LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_fullname LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('admin.admin_id');
        return $this->db->get();
    }

    public function getAdmin($admin_id = NULL) {
        $this->db->select('*');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = admin.user_status_id');
        if ($admin_id != NULL) {
            $this->db->where('admin.admin_id', $admin_id);
        }
        $this->db->order_by('admin.admin_id');
        return $this->db->get('admin');
    }

    public function edit($id, $data) {
        $this->db->where('admin.admin_id', $id);
        $this->db->update('admin', $data);
    }

    public function checkAdminUsername($admin_username = null) {
        if ($admin_username != NULL) {
            $this->db->where('admin_username', $admin_username);
        }
        return $this->db->get('admin');
    }

    public function add($data) {
        $this->db->insert('admin', $data);
    }
    
    public function getAdminStatus() {
        return $this->db->get('ref_user_status');
    }

    public function getAdminByID($admin_id) {
        $this->db->select('*');
        $this->db->where('admin.admin_id', $admin_id);
        return $this->db->get('admin')->row();
    }

    public function get_role() {
        return $this->db->get('a_role');
    }
    
}
