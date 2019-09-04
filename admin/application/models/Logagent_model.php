<?php

class Logagent_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('log_agent.log_id');
        $this->db->join('user', 'user.user_id = log_agent.user_id', 'left');
        if ($filter['searchdate'] != '') {
            $this->db->where("log_agent.log_time >=", $filter['searchdate'] . ' 00:00:00');
            $this->db->where("log_agent.log_time <=", $filter['searchdate'] . ' 23:59:59');
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.user_id LIKE '%" . $filter['searchtext'] . "%' OR 
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' OR 
                log_agent.log_text LIKE '%" . $filter['searchtext'] . "%'  
            ) ");
        }
        return $this->db->get('log_agent')->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('log_agent.*,user.user_fullname');
        $this->db->join('user', 'user.user_id = log_agent.user_id', 'left');
        if ($filter['searchdate'] != '') {
            $this->db->where("log_agent.log_time >=", $filter['searchdate'] . ' 00:00:00');
            $this->db->where("log_agent.log_time <=", $filter['searchdate'] . ' 23:59:59');
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                user.user_id LIKE '%" . $filter['searchtext'] . "%' OR 
                user.username LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_email LIKE '%" . $filter['searchtext'] . "%' OR 
                user.user_tel LIKE '%" . $filter['searchtext'] . "%' OR 
                log_agent.log_text LIKE '%" . $filter['searchtext'] . "%'  
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_agent.log_time', 'DESC');
        return $this->db->get('log_agent');
    }
}
