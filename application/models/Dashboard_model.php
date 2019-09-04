<?php

class Dashboard_model extends CI_Model {

    public function countAgent() {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        return $this->db->get()->num_rows();
    }

    public function countUser() {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('user.user_status_id', array(1, 2));
        return $this->db->get()->num_rows();
    }

    public function getTeamPackage() {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('package', 'package.package_id = teams.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get();
    }

    public function reportbot() {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->order_by('hook.hook_id', 'DESC');
        $this->db->limit(5);
        return $this->db->get();
    }

    public function reportstatistic() {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->group_by('hook.hook_project_id');
        $this->db->order_by('hook.hook_id', 'DESC');
        $this->db->limit(10);
        return $this->db->get();
    }

    public function get_agent($agent_project_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->order_by('agent.agent_id', 'DESC');
        if ($agent_project_id != null) {
            $this->db->where("agent.agent_project_id", $agent_project_id);
        }
        return $this->db->get();
    }

    public function get_hook_intents() {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->group_by('hook.hook_project_id');
        $this->db->group_by('hook.hook_intents_id');
        $this->db->order_by('COUNT(hook.hook_id)', 'DESC');
        $this->db->limit(10);
        return $this->db->get();
    }

    public function count_hook($hook_platforms, $hook_project_id, $hook_intents_id = null) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->where('hook.hook_platforms', $hook_platforms);
        $this->db->where('hook.hook_project_id', $hook_project_id);
        if ($hook_intents_id != null) {
            $this->db->where('hook.hook_intents_id', $hook_intents_id);
        }
        return $this->db->get()->num_rows();
    }

}
