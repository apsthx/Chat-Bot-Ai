<?php

/**
 * Created by PhpStorm.
 * User: sorasak tonken
 * Date: 4/9/2018
 * Time: 20:07
 */
class Logadminlogin_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('log_admin_login.log_id');
        $this->db->join('admin', 'admin.admin_id = log_admin_login.admin_id');
        if ($filter['searchdate'] != '') {
            $this->db->where("log_admin_login.log_time >=", $filter['searchdate'] . ' 00:00:00');
            $this->db->where("log_admin_login.log_time <=", $filter['searchdate'] . ' 23:59:59');
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                admin.admin_id LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_username LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_text LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_ip_address LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_browser LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        return $this->db->get('log_admin_login')->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('
                    log_admin_login.log_text,
                    log_admin_login.log_ip_address,
                    log_admin_login.log_browser,
                    log_admin_login.log_time,
                    admin.admin_fullname
        ');
        $this->db->join('admin', 'admin.admin_id = log_admin_login.admin_id');
        if ($filter['searchdate'] != '') {
            $this->db->where("log_admin_login.log_time >=", $filter['searchdate'] . ' 00:00:00');
            $this->db->where("log_admin_login.log_time <=", $filter['searchdate'] . ' 23:59:59');
        }
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                admin.admin_id LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_username LIKE '%" . $filter['searchtext'] . "%' OR 
                admin.admin_fullname LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_text LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_ip_address LIKE '%" . $filter['searchtext'] . "%' OR 
                log_admin_login.log_browser LIKE '%" . $filter['searchtext'] . "%'
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_admin_login.log_time', 'DESC');
        return $this->db->get('log_admin_login');
    }

}
