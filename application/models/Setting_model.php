<?php

class Setting_model extends CI_Model {

    public function getTeams() {
        $this->db->select('*');
        $this->db->join('package', 'package.package_id = teams.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        $this->db->limit(1);
        return $this->db->get('teams');
    }

    public function updateTeams($data) {
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        $this->db->update('teams', $data);
    }
    
    public function getTeamsOther($teams_name) {
        $this->db->select('teams.teams_id');
        $this->db->where('teams.teams_name', $teams_name);
        $this->db->where_not_in('teams.teams_id', array($this->session->userdata('teams_id')));
        return $this->db->get('teams')->num_rows();
    }
    
}
