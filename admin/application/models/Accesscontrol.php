<?php

class Accesscontrol extends CI_Model {

    public function getGroupMenuByRole($role_id) {
        $this->db->select('a_group_menu.group_menu_id,
                            a_group_menu.group_menu_name,
                            a_group_menu.group_menu_icon,
                            a_group_menu.group_menu_sort,
                            a_group_menu.group_menu_update');
        $this->db->join('a_menu', 'a_menu.group_menu_id = a_group_menu.group_menu_id');
        $this->db->join('a_map_menu_role', 'a_map_menu_role.menu_id = a_menu.menu_id');
        $this->db->where('a_map_menu_role.role_id', $role_id);
        $this->db->group_by('a_group_menu.group_menu_id');
        $this->db->order_by('a_group_menu.group_menu_sort');
        return $this->db->get('a_group_menu');
    }

    public function getMenuByGroup($group_menu_id, $role_id) {
        $this->db->select('a_menu.menu_id,a_menu.menu_link,a_menu.menu_name,a_menu.menu_status_id,a_menu.menu_openlink');
        $this->db->from('a_group_menu');
        $this->db->join('a_menu', 'a_menu.group_menu_id = a_group_menu.group_menu_id');
        $this->db->join('a_map_menu_role', 'a_map_menu_role.menu_id = a_menu.menu_id');
        $this->db->where('a_group_menu.group_menu_id', $group_menu_id);
        $this->db->where('a_map_menu_role.role_id', $role_id);
        $this->db->where_in('a_menu.menu_status_id', array(1, 3));
        $this->db->order_by('a_menu.menu_sort');
        return $this->db->get();
    }

    public function getNameTitle($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุเมนู';
        } else {
            $this->db->select('menu_name');
            $this->db->from('a_menu');
            $this->db->where('a_menu.menu_id', $id);
            $row = $this->db->get()->row();
            return $row->menu_name;
        }
    }

    public function getNameGroup($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุกลุ่มเมนู';
        } else {
            $this->db->select('group_menu_name, group_menu_icon');
            $this->db->from('a_group_menu');
            $this->db->where('a_group_menu.group_menu_id', $id);
            return $this->db->get()->row();
        }
    }

    public function getIcon($id = NULL) {
        $this->db->select('group_menu_icon');
        $this->db->from('a_group_menu');
        $this->db->where('a_group_menu.group_menu_id', $id);
        $row = $this->db->get()->row();
        return $row->group_menu_icon;
    }

    public function checkLoginAdmin($admin_id, $regenerate_login) {
        $this->db->select('admin_check_login.login_id');
        $this->db->from('admin_check_login');
        $this->db->where('admin_check_login.admin_id', $admin_id);
        $this->db->where('admin_check_login.regenerate_login', $regenerate_login);
        $this->db->where('admin_check_login.ip_address', $this->input->ip_address());
        return $this->db->get()->num_rows();
    }

    public function accessMenu($role_id, $menu_id) {
        $this->db->select('a_menu.menu_id');
        $this->db->from('a_menu');
        $this->db->join('a_map_menu_role', 'a_map_menu_role.menu_id = a_menu.menu_id');
        $this->db->where('a_map_menu_role.role_id', $role_id);
        $this->db->where('a_menu.menu_id', $menu_id);
        $this->db->where('a_menu.menu_status_id', 1);
        return $this->db->get()->num_rows();
    }

    public function getLogin($user, $password) {
        $this->db->select('*');
        $this->db->where('admin.admin_username', $user);
        $this->db->where('admin.admin_password', $password);
        $this->db->limit(1);
        return $this->db->get('admin');
    }

    public function getAdmin($id) {
        $this->db->where('admin_id', $id);
        $this->db->limit(1);
        return $this->db->get('admin')->row();
    }

    public function getPayment() {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('package', 'package.package_id = payment.package_id');
        $this->db->join('user', 'user.user_id = payment.user_id');
        $this->db->join('ref_bank', 'ref_bank.bank_id = payment.bank_id');
        $this->db->where('payment.payment_status_id', 1);
        return $this->db->get();
    }

    public function getAgent($agent_status_id = null) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->join('teams', 'teams.teams_id = agent.teams_id');
        $this->db->join('ref_agent_status', 'ref_agent_status.agent_status_id = agent.agent_status_id');
        if ($agent_status_id != null) {
            $this->db->where('agent.agent_status_id', $agent_status_id);
        } else {
            $this->db->where_in('agent.agent_status_id', array(0, 1, 2));
        }
        return $this->db->get();
    }

    public function getSetting() {
        $this->db->select('*');
        $this->db->limit(1);
        return $this->db->get('setting')->row();
    }

}
