<?php

// @tomtom

class Acrole_model extends CI_Model {

    public function get_role($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('role_id', $id);
        }
        $this->db->order_by('role_sort');
        return $this->db->get('ac_role');
    }

    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->join('ac_group_menu', 'ac_group_menu.group_menu_id = ac_menu.group_menu_id');
        $this->db->order_by('ac_group_menu.group_menu_sort');
        $this->db->order_by('ac_menu.menu_sort');
        return $this->db->get('ac_menu');
    }

    public function check_status($role_id, $menu_id) {
        $this->db->where('ac_map_menu_role.role_id', $role_id);
        $this->db->where('ac_map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results('ac_map_menu_role');
    }

    public function addrole($data) {
        $this->db->insert('ac_map_menu_role', $data);
        return 1;
    }

    public function deleterole($role_id, $menu_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('ac_map_menu_role');
        return 1;
    }

}
