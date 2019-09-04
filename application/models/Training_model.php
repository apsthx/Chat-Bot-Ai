<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Training_model
 *
 * @author nut_channarong
 */
class Training_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('training.training_id');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->join('training', 'training.hook_id = hook.hook_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                training.training_text LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['hook_project_id'] != '') {
            $this->db->where("agent.agent_id", $filter['hook_project_id']);
        }
        if ($filter['hook_platforms'] != '') {
            $this->db->where("hook.hook_platforms", $filter['hook_platforms']);
        }
        if ($filter['training_status'] != '') {
            $this->db->where("training.training_status", $filter['training_status']);
        }
        $this->db->group_by('training.training_status');
        $this->db->group_by('training.training_text');
        $this->db->group_by('hook.hook_project_id');
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->join('training', 'training.hook_id = hook.hook_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                training.training_text LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['hook_project_id'] != '') {
            $this->db->where("agent.agent_id", $filter['hook_project_id']);
        }
        if ($filter['hook_platforms'] != '') {
            $this->db->where("hook.hook_platforms", $filter['hook_platforms']);
        }
        if ($filter['training_status'] != '') {
            $this->db->where("training.training_status", $filter['training_status']);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->group_by('training.training_status');
        $this->db->group_by('training.training_text');
        $this->db->group_by('hook.hook_project_id');
        $this->db->order_by('COUNT(training.training_id)', 'DESC');
        $this->db->order_by('training.training_create', 'DESC');
        return $this->db->get();
    }

    public function count_training($training_text,$training_status) {
        $this->db->select('COUNT(training.training_id) AS requests');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->join('training', 'training.hook_id = hook.hook_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where('training.training_text', $training_text);
        $this->db->where('training.training_status', $training_status);
        $this->db->group_by('hook.hook_project_id');
        return $this->db->get()->row();
    }

    public function get_agent() {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        $this->db->order_by('agent.agent_id', 'DESC');
        return $this->db->get();
    }

    public function get_training($training_id) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->join('training', 'training.hook_id = hook.hook_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where('training.training_id', $training_id);
        return $this->db->get();
    }

    public function update_training($training_id, $data) {
        $this->db->where('training.training_id', $training_id);
        $this->db->update('training', $data);
    }

    public function get_training_text($training_text, $agent_id) {
        $this->db->select('*');
        $this->db->from('hook');
        $this->db->join('agent', 'agent.agent_project_id = hook.hook_project_id');
        $this->db->join('training', 'training.hook_id = hook.hook_id');
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where('agent.agent_id', $agent_id);
        $this->db->where('training.training_text', $training_text);
        $this->db->where('training.training_status', 1);
        return $this->db->get();
    }

}
