<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportstatistic_model
 *
 * @author nut_channarong
 */
class Reportstatistic_model extends CI_Model {

    //put your code here
    public function get_page($filter) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
//        if ($filter['searchtext'] != '') {
//            $this->db->where(" (
//                hook.hook_text LIKE '%" . $filter['searchtext'] . "%' 
//            ) ");
//        }
        if ($filter['hook_project_id'] != '') {
            $this->db->where("agent.agent_id", $filter['hook_project_id']);
        }
        if ($filter['date_start_report'] != '') {
            $this->db->where("hook.hook_modify >=", $filter['date_start_report'] . ' 00:00:00');
        }
        if ($filter['date_end_report'] != '') {
            $this->db->where("hook.hook_modify <=", $filter['date_end_report'] . ' 23:59:59');
        }
        $this->db->group_by('hook.hook_project_id');
        $this->db->order_by('COUNT(hook.hook_id)', 'DESC');
        return $this->db->get();
    }

    public function get_agent($agent_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        $this->db->order_by('agent.agent_id', 'DESC');
        if ($agent_id != null) {
            $this->db->where("agent.agent_id", $agent_id);
        }
        return $this->db->get();
    }

    public function get_hook_intents($hook_project_id, $date_start_report = null, $date_end_report = null) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->where('hook.hook_project_id', $hook_project_id);
        if ($date_start_report != null) {
            $this->db->where("hook.hook_modify >=", $date_start_report . ' 00:00:00');
        }
        if ($date_end_report != null) {
            $this->db->where("hook.hook_modify <=", $date_end_report . ' 23:59:59');
        }
        $this->db->group_by('hook.hook_intents_id');
        $this->db->order_by('COUNT(hook.hook_id)', 'DESC');
        return $this->db->get();
    }

    public function count_hook($hook_platforms, $hook_project_id, $hook_intents_id = null, $date_start_report = null, $date_end_report = null) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->where('hook.hook_platforms', $hook_platforms);
        $this->db->where('hook.hook_project_id', $hook_project_id);
        if ($hook_intents_id != null) {
            $this->db->where('hook.hook_intents_id', $hook_intents_id);
        }
        if ($date_start_report != null) {
            $this->db->where("hook.hook_modify >=", $date_start_report . ' 00:00:00');
        }
        if ($date_end_report != null) {
            $this->db->where("hook.hook_modify <=", $date_end_report . ' 23:59:59');
        }
        return $this->db->get()->num_rows();
    }

}
