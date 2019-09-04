<?php

class Payment_model extends CI_Model {

    public function count_pagination($filter) {
        $this->db->select('payment.payment_id');
        $this->db->from('payment');
        $this->db->join('package', 'package.package_id = payment.package_id');
        $this->db->join('ref_payment_status', 'ref_payment_status.payment_status_id = payment.payment_status_id');
        $this->db->join('ref_bank', 'ref_bank.bank_id = payment.bank_id');
        $this->db->join('ref_bank_icon', 'ref_bank_icon.bank_icon_id = ref_bank.bank_icon_id');
        $this->db->join('user', 'user.user_id = payment.user_id');
        if ($filter['start_date'] != '') {
            $this->db->where("payment.payment_create >=", $filter['start_date'] . ' 00:00:00');
        }
        if ($filter['end_date'] != '') {
            $this->db->where("payment.payment_create <=", $filter['end_date'] . ' 23:59:59');
        }
        $this->db->where("payment.user_id", $this->session->userdata('user_id'));
        $this->db->order_by('payment.payment_create', 'desc');
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('package', 'package.package_id = payment.package_id');
        $this->db->join('ref_payment_status', 'ref_payment_status.payment_status_id = payment.payment_status_id');
        $this->db->join('ref_bank', 'ref_bank.bank_id = payment.bank_id');
        $this->db->join('ref_bank_icon', 'ref_bank_icon.bank_icon_id = ref_bank.bank_icon_id');
        $this->db->join('user', 'user.user_id = payment.user_id');
        if ($filter['start_date'] != '') {
            $this->db->where("payment.payment_create >=", $filter['start_date'] . ' 00:00:00');
        }
        if ($filter['end_date'] != '') {
            $this->db->where("payment.payment_create <=", $filter['end_date'] . ' 23:59:59');
        }
        $this->db->where("payment.user_id", $this->session->userdata('user_id'));
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('payment.payment_create', 'desc');
        return $this->db->get();
    }
    
}
