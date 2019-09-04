<?php

class Agent_model extends CI_Model {
 
    public function count_pagination($filter) {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                agent.agent_name LIKE '%" . $filter['searchtext'] . "%' OR 
                agent.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%'                 
            ) ");
        }
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                agent.agent_name LIKE '%" . $filter['searchtext'] . "%' OR 
                agent.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%'                 
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->order_by('agent.agent_id', 'DESC');
        return $this->db->get();
    }

    public function add($data) {
        $this->db->insert('agent', $data);
        return $this->db->insert_id();
    }

    public function edit($id, $data) {
        $this->db->where('agent.agent_id', $id);
        $this->db->update('agent', $data);
    }

    public function get_agent($agent_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        if ($agent_id != null) {
            $this->db->where('agent.agent_id', $agent_id);
        }
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get();
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

    public function check_package() {
        $this->db->select('package.package_agent');
        $this->db->from('teams');
        $this->db->join('package', 'teams.package_id = package.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get()->row()->package_agent;
    }

    public function check_agent() {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get()->num_rows();
    }

}
