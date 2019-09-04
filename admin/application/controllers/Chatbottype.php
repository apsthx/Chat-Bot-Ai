<?php

class Chatbottype extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 19;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('chatbottype_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'group_id' => $this->group_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->chatbottype_model->get_chatbottype(),
            'css' => array('parsley.min.css'),
            'css_full' => array(),
            'js' => array('parsley.min.js'),
            'js_full' => array()
        );
        $this->renderView('chatbottype_view', $data);
    }

    public function getchatbottype() {
        $chatbottype = $this->chatbottype_model->get_chatbottype($this->input->post('agent_type_id'))->row();
        echo json_encode($chatbottype);
    }

    public function addchatbottype() {
        $data = array(
            'agent_type_name' => $this->input->post('agent_type_name')
        );
        $this->chatbottype_model->addchatbottype($data);
        redirect(base_url('chatbottype'));
    }

    public function editchatbottype() {
        $data = array(
            'agent_type_name' => $this->input->post('agent_type_name')
        );
        $this->chatbottype_model->editchatbottype($this->input->post('agent_type_id'), $data);
        redirect(base_url('chatbottype'));
    }

    public function deletechatbottype($id) {
        $this->chatbottype_model->deletechatbottype($id);
        redirect(base_url('chatbottype'));
    }
    
}
