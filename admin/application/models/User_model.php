<?php

class User_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['user_status_id'] != '') {
            $this->db->where('user.user_status_id', $filter['user_status_id']);
        }
        if ($filter['role_id'] != '') {
            $this->db->where('user.role_id', $filter['role_id']);
        }
        if ($filter['teams_id'] != '') {
            $this->db->where('user.teams_id', $filter['teams_id']);
        }
        $this->db->group_by('user.user_id');
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['user_status_id'] != '') {
            $this->db->where('user.user_status_id', $filter['user_status_id']);
        }
        if ($filter['role_id'] != '') {
            $this->db->where('user.role_id', $filter['role_id']);
        }
        if ($filter['teams_id'] != '') {
            $this->db->where('user.teams_id', $filter['teams_id']);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->group_by('user.user_id');
        $this->db->order_by('user.user_id');
        return $this->db->get();
    }

    public function get_user($user_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($user_id != NULL) {
            $this->db->where('user.user_id', $user_id);
        }
        return $this->db->get();
    }

    public function update_user($user_id, $data) {
        $this->db->where('user.user_id', $user_id);
        $this->db->update('user', $data);
    }

    // get ref    
    public function get_ref_user_status($user_status_id = null) {
        if ($user_status_id != null) {
            $this->db->where('ref_user_status.user_status_id', $user_status_id);
        }
        return $this->db->get('ref_user_status');
    }

    public function get_role() {
        return $this->db->get('ac_role');
    }

    public function get_teams($teams_id = null) {
        $this->db->select('*');
        $this->db->from('teams');
        if ($teams_id != null) {
            $this->db->where('teams.teams_id', $teams_id);
        }
        $this->db->where('teams.teams_status_id', 1);
        return $this->db->get();
    }
    
}
