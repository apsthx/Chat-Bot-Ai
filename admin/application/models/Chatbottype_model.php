<?php

class Chatbottype_model extends CI_Model {

    // group menu
    public function get_chatbottype($id = NULL) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('ref_agent_type.agent_type_id', $id);
        }
        return $this->db->get('ref_agent_type');
    }

    public function checkchatbottype($agent_type_id) {
        $this->db->select('agent.agent_id');
        $this->db->from('agent');
        $this->db->where('agent.agent_type_id', $agent_type_id);
        return $this->db->get()->num_rows();
    }

    public function addchatbottype($data) {
        $this->db->insert('ref_agent_type', $data);
    }

    public function editchatbottype($id, $data) {
        $this->db->where('ref_agent_type.agent_type_id', $id);
        $this->db->update('ref_agent_type', $data);
    }

    public function deletechatbottype($id) {
        $this->db->where('ref_agent_type.agent_type_id', $id);
        $this->db->delete('ref_agent_type');
    }

}
