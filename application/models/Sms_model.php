<?php

class Sms_model extends CI_Model {

//    public function getPackage($package_type_id) {
//        $this->db->where('package_check', 1);
//        $this->db->where('package.package_type_id', $package_type_id);
//        return $this->db->get('package');
//    }
//
//    public function getPackageByID($package_id) {
//        $this->db->where('package_check', 1);
//        $this->db->where('package.package_type_id', 1);
//        $this->db->where('package.package_id', $package_id);
//        return $this->db->get('package');
//    }
//
//    public function getBank($id = null) {
//        $this->db->join('ref_bank_icon', 'ref_bank_icon.bank_icon_id = ref_bank.bank_icon_id');
//        if ($id != NULL) {
//            $this->db->where('ref_bank.bank_id', $id);
//        }
//        $this->db->where('ref_bank.bank_check', 1);
//        return $this->db->get('ref_bank');
//    }
//
//    public function add($data) {
//        $this->db->insert('payment', $data);
//        return $this->db->insert_id();
//    }
//
//    public function edit($id, $data) {
//        $this->db->where('payment.payment_id', $id);
//        $this->db->update('payment', $data);
//    }
//
//    // SMS
//
//    public function getSetting() {
//        $this->db->select('*');
//        $this->db->limit(1);
//        return $this->db->get('setting');
//    }
//
//    public function editSettingSms($data) {
//        $this->db->update('setting', $data);
//    }
//
//    public function get_sms_email() {
//        $this->db->join('customer', 'advt.customer_id_pri = customer.customer_id_pri');
//        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
//        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
//        $this->db->order_by('advt.date_modify', 'desc');
//        return $this->db->get('advt');
//    }
//
//    public function get_tel($username) {
//        $this->db->select('user_tel');
//        $this->db->where('username', $username);
//        $this->db->limit(1);
//        return $this->db->get('user')->row()->user_tel;
//    }
//
//    public function getUser($username = null) {
//        $this->db->select('*');
//        $this->db->where('user.username', $username);
//        return $this->db->get('user');
//    }
//
//    public function editUser($username, $data) {
//        $this->db->where('username', $username);
//        $this->db->update('user', $data);
//    }

}
