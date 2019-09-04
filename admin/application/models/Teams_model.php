<?php

/**
 * Description of Teams_model
 * @author nut_channarong
 */
class Teams_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('teams.teams_id');
        $this->db->from('teams');
        $this->db->join('user', 'user.teams_id = teams.teams_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_id LIKE '%" . $filter['searchtext'] . "%' OR 
                user.username LIKE '%" . $filter['searchtext'] . "%' OR                 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        $this->db->where('user.role_id', 1);
        if ($filter['package_id'] != '') {
            $this->db->where('teams.package_id', $filter['package_id']);
        }
        if ($filter['teams_status_id'] != '') {
            $this->db->where('teams.teams_status_id', $filter['teams_status_id']);
        }
        $this->db->group_by('teams.teams_id');
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('user', 'user.teams_id = teams.teams_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_id LIKE '%" . $filter['searchtext'] . "%' OR 
                user.username LIKE '%" . $filter['searchtext'] . "%' OR                 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        $this->db->where('user.role_id', 1);
        if ($filter['package_id'] != '') {
            $this->db->where('teams.package_id', $filter['package_id']);
        }
        if ($filter['teams_status_id'] != '') {
            $this->db->where('teams.teams_status_id', $filter['teams_status_id']);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->group_by('teams.teams_id');
        $this->db->order_by('teams.teams_id');
        return $this->db->get();
    }

    public function getpackage($package_id = null) {
        $this->db->select('*');
        $this->db->from('package');
        if ($package_id != null) {
            $this->db->where('package.package_id', $package_id);
            $this->db->limit(1);
        } else {
            $this->db->where('package.package_check', 1);
        }
        return $this->db->get();
    }

    public function edit($id, $data) {
        $this->db->where('teams.teams_id', $id);
        $this->db->update('teams', $data);
    }

    public function get_teams($teams_id) {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('user', 'user.teams_id = teams.teams_id');
        $this->db->where('user.role_id', 1);
        $this->db->where('teams.teams_id', $teams_id);
        return $this->db->get();
    }

    public function getuser($teams_id, $role_id = null) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->where('user.teams_id', $teams_id);
        if ($role_id != null) {
            $this->db->where('user.role_id', $role_id);
            $this->db->limit(1);
        }
        return $this->db->get();
    }

    public function edituser($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }

    public function getuserid($id) {
        $this->db->where('user.user_id', $id);
        $this->db->limit(1);
        return $this->db->get('user')->row();
    }

    public function getrole() {
        return $this->db->get('role');
    }

    public function checkteams($teams_id) {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->where('teams.teams_id', $teams_id);
        $this->db->limit(1);
        return $this->db->get();
    }

    //เพิ่ม
    public function addTeams($data) {
        $this->db->insert('teams', $data);
        return $this->db->insert_id();
    }

    public function editTeams($id, $data) {
        $this->db->where('teams.teams_id', $id);
        $this->db->update('teams', $data);
    }

    public function addUser($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function checkUsername($username = null) {
        $this->db->select('username');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }

    public function addDocsetting($data) {
        $this->db->insert('doc_setting', $data);
        //return $this->db->insert_id();
    }

}
