<?php

class Register_model extends CI_Model {

    public function getUserTel($tel = null) {
        $this->db->select('*');
        if ($tel != NULL) {
            $this->db->where('user.user_tel', $tel);
        }
        return $this->db->get('user');
    }

    public function addUser($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function addTeams($data) {
        $this->db->insert('teams', $data);
        return $this->db->insert_id();
    }

    public function editTeams($id, $data) {
        $this->db->where('teams.teams_id', $id);
        $this->db->update('teams', $data);
    }

    public function getPackage($id = null) {
        $this->db->where('package.package_id', $id);
        return $this->db->get('package');
    }

    // check 

    public function checkUsername($username = null) {
        $this->db->select('user.user_id');
        $this->db->where('user.username', $username);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }

    public function checkEmail($email) {
        $this->db->select('user.user_id');
        $this->db->where('user.user_email', $email);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }

    public function checkTeam($team) {
        $this->db->select('teams_id');
        $this->db->where('teams.teams_name', $team);
        $this->db->limit(1);
        return $this->db->get('teams')->num_rows();
    }

}
