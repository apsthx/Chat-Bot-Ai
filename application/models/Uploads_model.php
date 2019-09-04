<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uploads_model
 *
 * @author nut
 */
class Uploads_model extends CI_Model {

    //put your code here
    public function count_pagination($filter) {
        $this->db->select('image.image_id');
        $this->db->from('image');
        $this->db->join('teams', 'teams.teams_id = image.teams_id');
        $this->db->where('image.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                image.image_name LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        return $this->db->get()->num_rows();
    }

    public function get_pagination($filter, $params = array()) {
        $this->db->select('*');
        $this->db->from('image');
        $this->db->join('teams', 'teams.teams_id = image.teams_id');
        $this->db->where('image.teams_id', $this->session->userdata('teams_id'));
        if ($filter['searchtext'] != '') {
            $this->db->where(" (
                image.image_name LIKE '%" . $filter['searchtext'] . "%' 
            ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('image.image_id', 'DESC');
        return $this->db->get();
    }

    public function get_image($image_id = null) {
        $this->db->select('*');
        $this->db->from('image');
        $this->db->join('teams', 'teams.teams_id = image.teams_id');
        $this->db->where('image.teams_id', $this->session->userdata('teams_id'));
        if ($image_id != NULL) {
            $this->db->where('image.image_id', $image_id);
        }
        return $this->db->get();
    }

    public function delete_image($image_id) {
        $this->db->where('image.image_id', $image_id);
        $this->db->delete('image');
    }

}
