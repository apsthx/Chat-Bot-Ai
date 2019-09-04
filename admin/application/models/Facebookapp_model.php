<?php

class Facebookapp_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('app_facebook.app_facebook_id_pri');
        $this->db->from('app_facebook');
        $this->db->join('agent', 'agent.agent_fb_app = app_facebook.app_facebook_id', 'left');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                app_facebook.app_facebook_id LIKE '%" . $filter['searchtext'] . "%' OR 
                app_facebook.app_facebook_name LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['app_facebook_use'] != '') {
            $this->db->where('app_facebook.app_facebook_use', $filter['app_facebook_use']);
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('app_facebook');
        $this->db->join('agent', 'agent.agent_fb_app = app_facebook.app_facebook_id', 'left');
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                app_facebook.app_facebook_id LIKE '%" . $filter['searchtext'] . "%' OR 
                app_facebook.app_facebook_name LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if ($filter['app_facebook_use'] != '') {
            $this->db->where('app_facebook.app_facebook_use', $filter['app_facebook_use']);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('app_facebook.app_facebook_id_pri');
        return $this->db->get();
    }

    public function get_app_facebook($app_facebook_id_pri = null) {
        $this->db->select('*');
        $this->db->from('app_facebook');
        if ($app_facebook_id_pri != NULL) {
            $this->db->where('app_facebook.app_facebook_id_pri', $app_facebook_id_pri);
        }
        return $this->db->get();
    }

    public function add($data) {
        $this->db->insert('app_facebook', $data);
    }

    public function edit($id, $data) {
        $this->db->where('app_facebook.app_facebook_id_pri', $id);
        $this->db->update('app_facebook', $data);
    }

}
