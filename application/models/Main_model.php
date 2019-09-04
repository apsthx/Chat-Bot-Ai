<?php

class Main_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        $this->db->join('ref_agent_status', 'ref_agent_status.agent_status_id = agent.agent_status_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                agent.agent_name LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%'                 
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        $this->db->join('ref_agent_status', 'ref_agent_status.agent_status_id = agent.agent_status_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                agent.agent_name LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_code LIKE '%" . $filter['searchtext'] . "%' OR 
                teams.teams_name LIKE '%" . $filter['searchtext'] . "%'                 
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
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
    public function editAppFacebook($id, $data) {
        $this->db->where('app_facebook.app_facebook_id_pri', $id);
        $this->db->update('app_facebook', $data);
    }

    public function get_agent($agent_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        if ($agent_id != null) {
            $this->db->where('agent.agent_id', $agent_id);
        }
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        return $this->db->get();
    }

    public function get_agent_other($agent_id, $agent_name) {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');        
        $this->db->where('agent.agent_name', $agent_name);
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        $this->db->where_not_in('agent.agent_id', array($agent_id));        
        return $this->db->get()->num_rows();
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
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('package', 'teams.package_id = package.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get();
    }

    public function check_agent() {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        return $this->db->get()->num_rows();
    }

    public function get_ref_agent_types() {
        return $this->db->get('ref_agent_type');
    }

    public function getAppFacebook()
    {
        $this->db->select('*');
        $this->db->from('app_facebook');
        $this->db->where('app_facebook.app_facebook_use' , 0);
        $this->db->limit(1);
        $this->db->order_by('app_facebook.app_facebook_id_pri','ASC');
        return $this->db->get();
    }

}
