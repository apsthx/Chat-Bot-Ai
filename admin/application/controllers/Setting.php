<?php

class Setting extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 14;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('setting_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('jquery.Thailand.min.css'),
            'js' => array('thailand-db/dependencies/JQL.min.js', 'thailand-db/dependencies/typeahead.bundle.js', 'thailand-db/jquery.Thailand.min.js'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js')
        );
        $this->renderView('setting_view', $data);
    }

    public function editemail() {
        $data = array(
            'from_email' => $this->input->post('from_email'),
            'from_name' => $this->input->post('from_name'),
            'smtp_host' => $this->input->post('smtp_host'),
            'smtp_port' => $this->input->post('smtp_port'),
            'smtp_user' => $this->input->post('smtp_user'),
            'smtp_password' => $this->input->post('smtp_password'),
        );
        $this->setting_model->edit($data);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url() . 'setting');
    }

    public function editsms() {
        $data = array(
            'sms_tel' => $this->input->post('sms_tel'),
            'sms_username' => $this->input->post('sms_username'),
            'sms_password' => $this->input->post('sms_password'),
        );
        $this->setting_model->edit($data);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url() . 'setting');
    }

    public function line() {
        $code = $this->input->get('code');
        $postdata = http_build_query(
                array(
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'client_id' => $this->config->item('line_id'),
                    'client_secret' => $this->config->item('line_key'),
                    'redirect_uri' => base_url('setting/line'),
                )
        );
        $url = 'https://notify-bot.line.me/oauth/token';
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        $access_token_decode = json_decode($result);
        $access_token = $access_token_decode->{'access_token'};
        $data = array(
            'line_token' => $access_token,
        );
        $this->setting_model->edit($data);
        
        $message = "\nยินดีต้อนรับ เข้าสู่ระบบแจ้งเตือน " . $this->config->item('app_description') . "";
        $opts2 = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . 'Authorization: Bearer ' . $access_token,
                'content' => 'message=' . $message
            )
        );
        $context2 = stream_context_create($opts2);
        if (file_get_contents('https://notify-api.line.me/api/notify', false, $context2)) {
            $this->session->set_flashdata('flash_message', 'success,Success,บันทึกการเชื่อมต่อเรียบร้อยเเล้ว');
            redirect(base_url() . 'setting');
        } else {
            $this->session->set_flashdata('flash_message', 'success,Success,บันทึกการเชื่อมต่อเรียบร้อยเเล้ว');
            redirect(base_url() . 'setting');
        }
    }

    public function cancel() {
        $data = array(
            'line_token' => null,
        );
        $this->setting_model->edit($data);
        $this->session->set_flashdata('flash_message', 'success,Success,ยกเลิกการเชื่อมต่อเรียบร้อยเเล้ว');
        echo 1;
    }

}
