<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportbot_model
 *
 * @author nut_channarong
 */
class Reportbot_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('hook.hook_id');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                hook.hook_text LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['hook_project_id'] != '') {
            $this->db->where("agent.agent_id", $filter['hook_project_id']);
        }
        if ($filter['hook_platforms'] != '') {
            $this->db->where("hook.hook_platforms", $filter['hook_platforms']);
        }
        if ($filter['date_start_report'] != '') {
            $this->db->where("hook.hook_modify >=", $filter['date_start_report'] . ' 00:00:00');
        }
        if ($filter['date_end_report'] != '') {
            $this->db->where("hook.hook_modify <=", $filter['date_end_report'] . ' 23:59:59');
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                hook.hook_text LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['hook_project_id'] != '') {
            $this->db->where("agent.agent_id", $filter['hook_project_id']);
        }
        if ($filter['hook_platforms'] != '') {
            $this->db->where("hook.hook_platforms", $filter['hook_platforms']);
        }
        if ($filter['date_start_report'] != '') {
            $this->db->where("hook.hook_modify >=", $filter['date_start_report'] . ' 00:00:00');
        }
        if ($filter['date_end_report'] != '') {
            $this->db->where("hook.hook_modify <=", $filter['date_end_report'] . ' 23:59:59');
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('hook.hook_id', 'DESC');
        return $this->db->get();
    }

    public function get_agent() {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        $this->db->order_by('agent.agent_id', 'DESC');
        return $this->db->get();
    }

}
