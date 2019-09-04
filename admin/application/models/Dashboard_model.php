<?php

class Dashboard_model extends CI_Model {

    public function countAgent() {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        return $this->db->get()->num_rows();
    }

    public function countUser() {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where_in('user.user_status_id', array(1, 2));
        $this->db->group_by('user.user_id');
        return $this->db->get()->num_rows();
    }

    public function countTeam() {
        $this->db->select('teams.teams_id');
        $this->db->from('teams');
        $this->db->group_by('teams.teams_id');
        return $this->db->get()->num_rows();
    }
    
    public function countPayment() {
        $this->db->select('payment.payment_id');
        $this->db->from('payment');
        $this->db->where('payment.payment_status_id', 1);
        return $this->db->get()->num_rows();
    }

    public function getAgents($limit = NULL) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        $this->db->join('ref_agent_status', 'ref_agent_status.agent_status_id = agent.agent_status_id');
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $this->db->order_by('agent.agent_create', 'desc');
        return $this->db->get();
    }
    
    public function getPayments($limit = NULL) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('package', 'package.package_id = payment.package_id');
        $this->db->join('user', 'user.user_id = payment.user_id');
        $this->db->join('ref_bank', 'ref_bank.bank_id = payment.bank_id');
        $this->db->join('ref_payment_status', 'ref_payment_status.payment_status_id = payment.payment_status_id');
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $this->db->order_by('payment.payment_create', 'desc');
        return $this->db->get();
    }

    public function getUser($limit = NULL) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('teams', 'teams.teams_id = user.teams_id');
        $this->db->join('ac_role', 'ac_role.role_id = user.role_id');
        $this->db->join('ref_user_status', 'ref_user_status.user_status_id = user.user_status_id');
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $this->db->order_by('user.user_create', 'desc');
        return $this->db->get();
    }

    public function getTeams($limit = NULL) {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('package', 'package.package_id = teams.package_id');
        if ($limit != NULL) {
            $this->db->limit($limit);
        }
        $this->db->order_by('teams.teams_create', 'desc');
        return $this->db->get();
    }

}
