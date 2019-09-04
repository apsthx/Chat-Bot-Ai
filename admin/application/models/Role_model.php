<?php

// @tomtom

class Role_model extends CI_Model {

    public function get_role($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('role_id', $id);
        }
        $this->db->order_by('role_sort');
        return $this->db->get('a_role');
    }

    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->join('a_group_menu', 'a_group_menu.group_menu_id = a_menu.group_menu_id');
        $this->db->order_by('a_group_menu.group_menu_sort');
        $this->db->order_by('a_menu.menu_sort');
        return $this->db->get('a_menu');
    }

    public function check_status($role_id, $menu_id) {
        $this->db->where('a_map_menu_role.role_id', $role_id);
        $this->db->where('a_map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results('a_map_menu_role');
    }

    public function addrole($data) {
        $this->db->insert('a_map_menu_role', $data);
        return 1;
    }

    public function deleterole($role_id, $menu_id) {
        $this->db->where('role_id', $role_id);
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('a_map_menu_role');
        return 1;
    }

}
