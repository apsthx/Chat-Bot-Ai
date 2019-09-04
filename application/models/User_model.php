<?php

class User_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        $this->db->join('teams', 'teams.teams_id = user.teams_id');
        $this->db->where('user.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('user.user_status_id', array(1, 2));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        $this->db->join('teams', 'teams.teams_id = user.teams_id');
        $this->db->where('user.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('user.user_status_id', array(1, 2));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('user.user_id');
        return $this->db->get();
    }

    public function get_user($user_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        $this->db->join('teams', 'teams.teams_id = user.teams_id');
        $this->db->where('user.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('user.user_status_id', array(1, 2));
        if ($user_id != NULL) {
            $this->db->where('user.user_id', $user_id);
        }
        return $this->db->get();
    }

    public function insert_user($data) {
        $this->db->insert('user', $data);
    }

    public function update_user($user_id, $data) {
        $this->db->where('user.user_id', $user_id);
        $this->db->update('user', $data);
    }

    public function get_ref_user_status($user_status_id = null) {
        if ($user_status_id != null) {
            $this->db->where('ref_user_status.user_status_id', $user_status_id);
        }
        return $this->db->get('ref_user_status');
    }

    public function check_package() {
        $this->db->select('package.package_user');
        $this->db->from('teams');
        $this->db->join('package', 'teams.package_id = package.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get()->row()->package_user;
    }

    public function check_user() {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('user.user_status_id', array(1, 2));
        return $this->db->get()->num_rows();
    }
    
    public function check_username($username) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.username', $username);
        return $this->db->get()->num_rows();
    }

    public function check_email($email) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.user_email', $email);
        return $this->db->get()->num_rows();
    }

    public function check_tel($tel) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.user_tel', $tel);
        return $this->db->get()->num_rows();
    }

    
}
