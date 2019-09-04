<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Package_model
 *
 * @author nut
 */
class Package_model extends CI_Model {

    //put your code here
    public function getPackage($id = null) {
        if ($id != NULL) {
            $this->db->where('package.package_id', $id);
        }
        return $this->db->get('package');
    }

    public function addPackage($data) {
        $this->db->insert('package', $data);
    }

    public function editPackage($id, $data) {
        $this->db->where('package.package_id', $id);
        $this->db->update('package', $data);
    }

    public function getTeamsPackage($id = null) {
        $this->db->select('*');
        $this->db->from('teams');
        $this->db->join('user', 'user.teams_id = teams.teams_id');
        $this->db->where('user.role_id', 1);
        $this->db->where('teams.package_id', $id);
        return $this->db->get();
    }

    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('ac_menu.menu_id', $id);
        }
        $this->db->join('ac_group_menu', 'ac_menu.group_menu_id = ac_group_menu.group_menu_id');
        return $this->db->get('ac_menu');
    }

    public function check_StetusPackage($package_id, $menu_id) {
        $this->db->where('ac_map_menu_package.package_id', $package_id);
        $this->db->where('ac_map_menu_package.menu_id', $menu_id);
        return $this->db->count_all_results('ac_map_menu_package');
    }

    public function addlimit($data) {
        $this->db->insert('ac_map_menu_package', $data);
        //return 1;
    }

    public function deletelimit($package_id, $menu_id) {
        $this->db->where('package_id', $package_id);
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('ac_map_menu_package');
        //return 1;
    }

}
