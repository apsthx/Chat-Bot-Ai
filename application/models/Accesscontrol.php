<?php

class Accesscontrol extends CI_Model {

    public function getGroupMenuByRole($role_id) {
        $this->db->select('
            ac_group_menu.group_menu_id,
            ac_group_menu.group_menu_name,
            ac_group_menu.group_menu_icon,
            ac_group_menu.group_menu_sort,
            ac_group_menu.group_menu_update
        ');
        $this->db->from('ac_group_menu');
        $this->db->join('ac_menu', 'ac_menu.group_menu_id = ac_group_menu.group_menu_id');
        $this->db->join('ac_map_menu_role', 'ac_map_menu_role.menu_id = ac_menu.menu_id');
        $this->db->where('ac_map_menu_role.role_id', $role_id);
        $this->db->group_by('ac_group_menu.group_menu_id');
        $this->db->order_by('ac_group_menu.group_menu_sort');
        return $this->db->get();
    }

    public function getMenuByGroup($group_menu_id, $role_id) {
        $this->db->select('
            ac_menu.menu_id,
            ac_menu.menu_link,
            ac_menu.menu_name,
            ac_menu.menu_status_id,
            ac_menu.menu_openlink
        ');
        $this->db->from('ac_group_menu');
        $this->db->join('ac_menu', 'ac_menu.group_menu_id = ac_group_menu.group_menu_id');
        $this->db->join('ac_map_menu_role', 'ac_map_menu_role.menu_id = ac_menu.menu_id');
        $this->db->where('ac_group_menu.group_menu_id', $group_menu_id);
        $this->db->where('ac_map_menu_role.role_id', $role_id);
        $this->db->where_in('ac_menu.menu_status_id', array(1, 3));
        $this->db->order_by('ac_menu.menu_sort');
        return $this->db->get();
    }

    public function getUser($user, $password) {
        $this->db->select('
            user.user_id,
            user.role_id,
            user.user_status_id,
            user.teams_id
        ');
        $this->db->from('user');
        $this->db->where('user.username', $user);
        $this->db->where('user.password', $password);
        return $this->db->get();
    }

    public function getUserID($user_id = null) {
        $this->db->select('*');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get('user');
    }

    public function getUserFull($user_id) {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.user_id', $user_id);
        return $this->db->get()->row();
    }

    public function accessMenu($role_id, $menu_id) {
        $this->db->select('ac_menu.menu_id');
        $this->db->from('ac_menu');
        $this->db->join('ac_map_menu_role', 'ac_map_menu_role.menu_id = ac_menu.menu_id');
        $this->db->where('ac_map_menu_role.role_id', $role_id);
        $this->db->where('ac_menu.menu_id', $menu_id);
        $this->db->where('ac_menu.menu_status_id', 1);
        return $this->db->get()->num_rows();
    }

    public function checkLogin($user_id, $regenerate_login) {
        $this->db->select('user_check_login.login_id');
        $this->db->from('user_check_login');
        $this->db->where('user_check_login.user_id', $user_id);
        $this->db->where('user_check_login.regenerate_login', $regenerate_login);
        $this->db->where('user_check_login.ip_address', $this->input->ip_address());
        return $this->db->get()->num_rows();
    }

    public function getNameTitle($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุเมนู';
        } else {
            $this->db->select('ac_menu.menu_name');
            $this->db->from('ac_menu');
            $this->db->where('ac_menu.menu_id', $id);
            $row = $this->db->get()->row();
            return $row->menu_name;
        }
    }

    public function getNameGroup($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุกลุ่มเมนู';
        } else {
            $this->db->select('
                ac_group_menu.group_menu_name,
                ac_group_menu.group_menu_icon
            ');
            $this->db->from('ac_group_menu');
            $this->db->where('ac_group_menu.group_menu_id', $id);
            return $this->db->get()->row();
        }
    }

    public function getIcon($id = NULL) {
        $this->db->select('ac_group_menu.group_menu_icon');
        $this->db->from('ac_group_menu');
        $this->db->where('ac_group_menu.group_menu_id', $id);
        $row = $this->db->get()->row();
        return $row->group_menu_icon;
    }

    public function getSetting() {
        $this->db->select('*');
        $this->db->limit(1);
        return $this->db->get('setting')->row();
    }

    public function editSetting($data) {
        $this->db->update('setting', $data);
    }

    public function getPackage() {
        $this->db->select('*');
        $this->db->join('teams', 'teams.package_id = package.package_id');
        $this->db->where('teams.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get('package')->row();
    }

    public function get_agent($agent_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        if ($agent_id != null) {
            $this->db->where('agent.agent_id', $agent_id);
        }
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        return $this->db->get();
    }

    public function addhook($data) {
        $this->db->insert('hook', $data);
        return $this->db->insert_id();
    }
    
    public function addtraining($data) {
        $this->db->insert('training', $data);          
    }

}
