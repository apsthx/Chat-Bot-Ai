<?php

class Package_model extends CI_Model {

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

    public function getBank($id = null) {
        $this->db->join('ref_bank_icon', 'ref_bank_icon.bank_icon_id = ref_bank.bank_icon_id');
        if ($id != NULL) {
            $this->db->where('ref_bank.bank_id', $id);
        }
        $this->db->where('ref_bank.bank_check', 1);
        return $this->db->get('ref_bank');
    }

    public function add_payment($data) {
        $this->db->insert('payment', $data);
        return $this->db->insert_id();
    }

    public function edit_payment($id, $data) {
        $this->db->where('payment.payment_id', $id);
        $this->db->update('payment', $data);
    }

}
