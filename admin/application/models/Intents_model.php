<?php

/**
 * @author Phanuphong Duangjit
 */
class Intents_model extends CI_Model {

    public function get_agent($agent_id) {
        $this->db->select('*');
        $this->db->from('agent');
        $this->db->where('agent.agent_id', $agent_id);
        return $this->db->get();
    }

}
