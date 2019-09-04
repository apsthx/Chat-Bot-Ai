<?php

// @tomtom

class Groupmenu_model extends CI_Model {

    // group menu
    public function get_groupmenu($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('a_group_menu.group_menu_sort');
        return $this->db->get('a_group_menu');
    }

    public function get_last_groupmenu() {
        $this->db->select('a_group_menu.group_menu_sort');
        $this->db->order_by('a_group_menu.group_menu_sort');
        return $this->db->get('a_group_menu');
    }

    public function checkgroupmenu($group_menu_id) {
        $this->db->from('a_menu');
        $this->db->where('a_menu.group_menu_id', $group_menu_id);
        return $this->db->count_all_results();
    }

    public function addgroupmenu($data) {
        $this->db->insert('a_group_menu', $data);
    }

    public function editgroupmenu($id, $data) {
        $this->db->where('a_group_menu.group_menu_id', $id);
        $this->db->update('a_group_menu', $data);
    }

    public function deletegroupmenu($id) {
        $this->db->where('a_group_menu.group_menu_id', $id);
        $this->db->delete('a_group_menu');
    }

    // menu
    public function get_menu($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->order_by('a_menu.menu_sort');
        return $this->db->get('a_menu');
    }

    public function get_menu_all($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('group_menu_id', $id);
        }
        $this->db->order_by('a_menu.menu_sort');
        return $this->db->get('a_menu');
    }

    public function get_last_menu($group_menu_id) {
        $this->db->select('a_menu.menu_sort');
        $this->db->where('a_menu.group_menu_id', $group_menu_id);
        $this->db->order_by('a_menu.menu_sort', 'desc');
        return $this->db->get('a_menu');
    }

    public function checkmenu($menu_id) {
        $this->db->from('a_map_menu_role');
        $this->db->where('a_map_menu_role.menu_id', $menu_id);
        return $this->db->count_all_results();
    }

    public function addmenu($data) {
        $this->db->insert('a_menu', $data);
    }

    public function editmenu($id, $data) {
        $this->db->where('a_menu.menu_id', $id);
        $this->db->update('a_menu', $data);
    }

    public function deletemenu($id) {
        $this->db->where('a_menu.menu_id', $id);
        $this->db->delete('a_menu');
    }

}
