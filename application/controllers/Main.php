<?php

require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Main extends CI_Controller {

    public $group_id = '';
    public $menu_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('main_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id
        );
        $this->renderView('main_view', $data);
    }

    public function ajax_pagination() {
        $per_page = 12;
        $filter = array(
            'searchtext' => $this->input->post('searchtext')
        );
        $count = $this->main_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('main/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->main_model->get_pagination($filter, array('start' => $segment, 'limit' => $per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/main_pagination', $data);
    }

    public function setting($agent_id = NULL, $tab = 'facebook') {
        if ($agent_id != NULL) {
            $agents = $this->main_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $agent = $agents->row();
                if ($agent->agent_status_id == 1) {
                    $data = array(
                        'group_id' => $this->group_id,
                        'menu_id' => $this->menu_id,
                        'agent_id' => $agent_id,
                        'data' => $agents->row(),
                        'tab' => $tab
                    );
                    $this->renderView('main_setting_view', $data);
                } else {
                    $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                    redirect(base_url('main'));
                }
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
            redirect(base_url('main'));
        }
    }

    public function setting_edit() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $agents = $this->main_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $agent = $agents->row();
                if ($agent->agent_name != $this->input->post('agent_name')) {
                    if ($this->main_model->get_agent_other($agent_id, $this->input->post('agent_name')) == 0) {
                        $data = array(
                            'agent_name' => $this->input->post('agent_name')
                        );
                        $this->main_model->edit($agent_id, $data);
                        $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
                    } else {
                        $this->session->set_flashdata('flash_message', 'warning,Warning,มีการใช้งานชื่อ Chatbot นี้เเล้ว');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถบันทึกได้ เป็นชื่อเดิม');
                }
                $data = array(
                    'agent_description' => $this->allowText($this->input->post('agent_description')),
                    'agent_type_id' => $this->input->post('agent_type_id'),
                    'agent_update' => $this->misc->getDate()
                );
                $this->main_model->edit($agent_id, $data);
                redirect(base_url() . 'main/setting/' . $agent_id);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
            redirect(base_url('main'));
        }
    }

    public function setting_facebook() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $agents = $this->main_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $data = array(
                    'agent_fb_name' => $this->input->post('agent_fb_name'),
                    'agent_fb_app' => $this->input->post('agent_fb_app'),
                    'agent_update' => $this->misc->getDate()
                );
                $this->main_model->edit($agent_id, $data);
                $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
                redirect(base_url() . 'main/setting/' . $agent_id);
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
            redirect(base_url('main'));
        }
    }

    public function changeActiveFacebook()
    {
        $agent_id = $this->input->post('agent_id');
        $app_facebook_id_pri = $this->input->post('app_facebook_id_pri');

        $data = array(
            'agent_fb_active_id' => 1,
            'agent_fb_app' => $this->input->post('app_facebook_id'),
            'agent_update' => $this->misc->getDate()
        );
        $this->main_model->edit($agent_id, $data);

        $dataAppfacebook = array(
            'app_facebook_use' => 1,
            'app_facebook_update' => $this->misc->getDate()
        );
        $this->main_model->editAppFacebook($app_facebook_id_pri, $dataAppfacebook);
       echo 1;
    }

    public function setting_line() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $agents = $this->main_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $data = array(
                    'agent_line_name' => $this->input->post('agent_line_name'),
                    'agent_line_channel_id' => $this->input->post('agent_line_channel_id'),
                    'agent_update' => $this->misc->getDate()
                );
                $this->main_model->edit($agent_id, $data);
                $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
                redirect(base_url() . 'main/setting/' . $agent_id . '/line');
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
            redirect(base_url('main'));
        }
    }

    public function modaladd() {
        $this->load->view('modal/agent_add');
    }

    public function modaldelete() {
        $id = $this->input->post('agent_id');
        $data = array(
            'data' => $this->main_model->get_agent($id)->row(),
        );
        $this->load->view('modal/agent_delete', $data);
    }

    public function add() {
        $result = $this->main_model->check_package();
        if ($result->num_rows() == 1) {
            $row = $result->row();
            if ($row->package_agent > $this->main_model->check_agent() && $row->teams_package_expire >= date('Y-m-d')) {
                $agent_name = $this->input->post('agent_name');
                $data = array(
                    'agent_name' => $agent_name,
                    'teams_id' => $this->session->userdata('teams_id'),
                    'agent_description' => $this->allowText($this->input->post('agent_description')),
                    'agent_type_id' => $this->input->post('agent_type_id'),
                    'agent_status_id' => 0,
                    'agent_active_id' => 0,
                    'agent_fb_active_id' => 0,
                    'agent_line_active_id' => 0,
                    'agent_create' => $this->misc->getDate(),
                    'agent_update' => $this->misc->getDate()
                );
                $this->main_model->add($data);

                $setting = $this->accesscontrol->getSetting();
                $line_token = $setting->line_token;
                if ($line_token != '') {
                    $message = "มีการสร้าง ChatBot " . $agent_name;
                    $this->load->library('../controllers/line');
                    $this->line->line_notification($line_token, $message);
                }

                // add log 
                $this->systemlog->log_agent($this->session->userdata('user_id'), 'สร้าง ChatBot : ' . $agent_name);

                $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลสำเร็จ');
                redirect('main');
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,เพิ่มข้อมูลไม่สำเร็จ');
                redirect('main');
            }
        }
    }

    public function delete() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $agents = $this->main_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $agent = $agents->row();
                if ($agent->agent_status_id < 2) {
                    $data = array(
                        'agent_status_id' => 2,
                        'agent_update' => $this->misc->getDate()
                    );
                    $this->main_model->edit($agent_id, $data);

                    $setting = $this->accesscontrol->getSetting();
                    $line_token = $setting->line_token;
                    if ($line_token != '') {
                        $message = 'แจ้งลบ ChatBot : ' . $agent->agent_name;
                        $this->load->library('../controllers/line');
                        $this->line->line_notification($line_token, $message);
                    }

                    // add log 
                    $this->systemlog->log_agent($this->session->userdata('user_id'), 'แจ้งลบ ChatBot : ' . $agent->agent_name);

                    $this->session->set_flashdata('flash_message', 'success,Success,แจ้งลบรายการเรียบร้อยเเล้ว');
                    redirect(base_url('main'));
                } else {
                    $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แจ้งลบรายการไม่สำเร็จ');
                    redirect(base_url('main'));
                }
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แจ้งลบรายการไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แจ้งลบรายการไม่สำเร็จ');
            redirect(base_url('main'));
        }
    }

    public function allowText($text) {
        $allow = "/([^a-zA-Z0-9ก-๙เ .\/,+*])/";
        return preg_replace($allow, '', $text);
    }

}
