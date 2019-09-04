<?php

/**
 * @author Phanuphong Duangjit
 */
class Intents_model extends CI_Model {

    public function get_agent($agent_id) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.agent_id', $agent_id);
        $this->db->where('agent.teams_id', $this->session->userdata('teams_id'));
        $this->db->where('agent.agent_status_id', 1);
        return $this->db->get();
    }

    public function get_image($search_image_text = '') {
        $this->db->select('
            image.image_id,
            image.image_name,
            image.image_url
        ');
        $this->db->from('image');
        $this->db->where('image.teams_id', $this->session->userdata('teams_id'));
        if ($search_image_text != '') {
            $this->db->where(" (
                image.image_name LIKE '%" . $search_image_text . "%' OR 
                image.image_url LIKE '%" . $search_image_text . "%'
            ) ");
        }
        return $this->db->get();
    }

    public function insert_image($data) {
        $this->db->insert('image', $data);
    }

}
