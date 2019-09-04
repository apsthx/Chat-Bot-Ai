<?php

require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Agent extends CI_Controller {

    public $group_id = '';
    public $menu_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('agent_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        redirect(base_url('main'));
//        $data = array(
//            'group_id' => $this->group_id,
//            'menu_id' => $this->menu_id,
//            'icon' => $this->accesscontrol->getIcon($this->group_id),
//            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
//            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
//            'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
//        );
//        $this->renderView('agent_view', $data);
    }

//    public function ajax_pagination() {
//        $per_page = 8;
//        $filter = array(
//            'searchtext' => $this->input->post('searchtext')
//        );
//        $count = $this->agent_model->count_pagination($filter);
//        $config['div'] = 'result-pagination';
//        $config['base_url'] = base_url('agent/ajax_pagination');
//        $config['total_rows'] = $count;
//        $config['per_page'] = $per_page;
//        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "'}";
//        $config['num_links'] = 4;
//        $config['uri_segment'] = 3;
//        $this->ajax_pagination->initialize($config);
//        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
//        $data = array(
//            'data' => $this->agent_model->get_pagination($filter, array('start' => $segment, 'limit' => $per_page)),
//            'count' => $count,
//            'segment' => $segment,
//            'links' => $this->ajax_pagination->create_links()
//        );
//        $this->load->view('ajax/agent_pagination', $data);
////        $this->load->view('ajax/agent_card_pagination', $data);
//    }
//
//    public function modaleditstatus() {
//        $data = array(
//            'agent_id' => $this->input->post('agent_id'),
//        );
//        $this->load->view('modal/agent_editstatus', $data);
//    }
//
//    public function editstatus() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_status_id' => 2, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        redirect(base_url('agent'));
//    }
//
//    public function editchangestatus() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_status_id' => 1, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        echo 1;
//    }
//
//    public function modaleditstatusfb() {
//        $data = array(
//            'agent_id' => $this->input->post('agent_id'),
//        );
//        $this->load->view('modal/agent_editstatusfb', $data);
//    }
//
//    public function editstatusfb() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_fb_status_id' => 2, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        redirect(base_url('agent'));
//    }
//
//    public function editchangestatusfb() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_fb_status_id' => 1, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        echo 1;
//    }
//
//    public function modaleditstatusline() {
//        $data = array(
//            'agent_id' => $this->input->post('agent_id'),
//        );
//        $this->load->view('modal/agent_editstatusline', $data);
//    }
//
//    public function editstatusline() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_line_status_id' => 2, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        redirect(base_url('agent'));
//    }
//
//    public function editchangestatusline() {
//        $this->agent_model->edit($this->input->post('agent_id'), array('agent_line_status_id' => 1, 'agent_update' => $this->misc->getdate()));
//        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
//        echo 1;
//    }
//
//    public function modaladd() {
//        $this->load->view('modal/agent_add');
//    }
//
//    public function modaledit() {
//        $id = $this->input->post('agent_id');
//        $data = array(
//            'data' => $this->agent_model->get_agent($id)->row(),
//        );
//        $this->load->view('modal/agent_edit', $data);
//    }
//
//    public function modalview() {
//        $data = array(
//            'agent_id' => $this->input->post('agent_id')
//        );
//        $this->load->view('ajax/agent_view', $data);
//    }

//    public function add() {
//        $data = array(
//            'agent_name' => $this->input->post('agent_name'),
//            'teams_id' => $this->session->userdata('teams_id'),
//            'agent_description' => $this->input->post('agent_description'),
//            'agent_status_id' => 0,
//            'agent_active_id' => 0,
//            'agent_fb_active_id' => 0,
//            'agent_line_active_id' => 0,
//            'agent_create' => $this->misc->getDate(),
//            'agent_update' => $this->misc->getDate()
//        );
//        $this->agent_model->add($data);
//        $setting = $this->accesscontrol->getSetting();
//        $line_token = $setting->line_token;
//        if ($line_token != '') {
//            $message = "มีการสร้าง Agent " . $this->input->post('agent_name');
//            $this->load->library('../controllers/line');
//            $this->line->line_notification($line_token, $message);
//        }
//
//        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลสำเร็จ');
//        redirect('agent');
//    }
//
//    public function edit() {
//        $agent_id = $this->input->post('agent_id');
//        if ($agent_id != null) {
//            $data = array(
//                //'agent_name' => $this->input->post('agent_name'),
//                'agent_description' => $this->input->post('agent_description'),
//                'agent_update' => $this->misc->getDate()
//            );
//            $this->agent_model->edit($agent_id, $data);
//            $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
//            redirect('agent');
//        } else {
//            redirect(base_url());
//        }
//    }

    public function auth($agent_file) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . FCPATH . 'admin/assets/upload/json/' . $agent_file);
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    public function checkactive() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $agents = $this->agent_model->get_agent($agent_id);
            if ($agents->num_rows() == 1) {
                $agent = $agents->row();
                $data = array(
                    'agent_active_id' => 2,
                );
                $this->agent_model->edit($agent_id, $data);
                // auth
                $httpClient = $this->auth($agent->agent_file);
                // request
                $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent');
                // response
                $decode = json_decode($response->getBody()->getContents());
                if (!empty($decode->parent)) {
                    $data = array(
                        'agent_active_id' => 1,
                    );
                    $this->agent_model->edit($agent_id, $data);
                    echo 1;
                } else if ($decode->error->status == 'PERMISSION_DENIED') {
                    echo 2;
                } else {
                    echo 0;
                }
                exit;
            }
        }
    }

//    public function checkactives($agent_id) {
//        if ($agent_id != null) {
//            $agents = $this->agent_model->get_agent($agent_id);
//            if ($agents->num_rows() == 1) {
//                $agent = $agents->row();
//                $data = array(
//                    'agent_active_id' => 2,
//                );
//                $this->agent_model->edit($agent_id, $data);
//                // auth
//                $httpClient = $this->auth($agent->agent_file);
//                // request
//                $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent');
//                // response
//                $decode = json_decode($response->getBody()->getContents());
//                echo '<pre>';
//                print_r($decode);
//                echo '</pre>';
//                if (!empty($decode->parent)) {
//                    $data = array(
//                        'agent_active_id' => 1,
//                    );
//                    $this->agent_model->edit($agent_id, $data);
//                    echo 1;
//                } else if ($decode->error->status == 'PERMISSION_DENIED') {
//                    echo 2;
//                } else {
//                    echo 0;
//                }
//                exit;
//            }
//        }
//    }

    public function detail($agent_id) {
        $agents = $this->agent_model->get_agent($agent_id);
        if ($agents->num_rows() == 1) {
            $agent = $agents->row();
            $httpClient = $this->auth($agent->agent_file);
            $query = array(
                //'languageCode' => 'th',
                'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                'pageSize' => 100,
                'pageToken' => ''
            );
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
            $decode = json_decode($response->getBody()->getContents());
//            if (!empty($decode->intents)) {
//                $length = sizeof($decode->intents);
//                foreach ($decode->intents as $key => $value) {
//                    echo $value->displayName . '</br>';
//                }
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
                'agent_id' => $agent_id,
                'datas' => $decode,
            );
            $this->renderView('agentdetail_view', $data);
//            }
//            echo '<pre>';
//            print_r($decode->intents);
//            echo '</pre>';
//            exit;
        } else {
            redirect(base_url());
        }
    }

    public function details($agent_id) {
        $agents = $this->agent_model->get_agent($agent_id);
        if ($agents->num_rows() == 1) {
            $agent = $agents->row();
            $httpClient = $this->auth($agent->agent_file);
            $query = array(
                //'languageCode' => 'th',
                'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                'pageSize' => 100,
                'pageToken' => ''
            );
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
            //$decode = json_decode($response->getBody()->getContents());
            echo '<pre>';
            print_r($response->getBody()->getContents());
            echo '</pre>';
            exit;
        } else {
            redirect(base_url());
        }
    }

    public function fb($active) {
        $agent_id = $this->input->post('agent_id');
        $data = array(
            'agent_fb_active_id' => $active,
        );
        $this->agent_model->edit($agent_id, $data);
    }

    public function line($active) {
        $agent_id = $this->input->post('agent_id');
        $data = array(
            'agent_line_active_id' => $active,
        );
        $this->agent_model->edit($agent_id, $data);
    }

//    public function detectIntent($agent_id) {
//        // auth
//        $agents = $this->agent_model->get_agent($agent_id);
//        if ($agents->num_rows() == 1) {
//            $agent = $agents->row();
//            $httpClient = $this->auth($agent->agent_file);
//            // request
//            $post = array(
//                'queryInput' => array(
//                    'text' => array(
//                        'text' => 'สอบถาม',
//                        'languageCode' => 'th',
//                    ),
//                ),
//            );
//            $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/botclinic/agent/sessions/123456789:detectIntent?', [GuzzleHttp\RequestOptions::JSON => $post]);
//            // response
//            echo '<pre>';
//            print_r($response->getBody()->getContents());
//            echo '</pre>';
//            exit;
//        }
//    }

    public function chat($agent_id) {
        $agents = $this->agent_model->get_agent($agent_id);
        if ($agents->num_rows() == 1) {
            $agent = $agents->row();
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
                'agent_id' => $agent_id,
                'agent_name' => $agent->agent_name,
            );
            $this->renderView('agentchat_view', $data);
        }
    }

    public function chattest() {
        // auth
        $chattext = $this->input->post('chattext');
        $agent_id = $this->input->post('agent_id');
        $sessions_id = $this->input->post('sessions_id');
        $agents = $this->agent_model->get_agent($agent_id);
        if ($agents->num_rows() == 1) {
            $agent = $agents->row();
            if ($chattext == '' || $chattext == null) {
                $chattext = 'สวัสดี';
            }
            $httpClient = $this->auth($agent->agent_file);
            // request
            $post = array(
                'queryInput' => array(
                    'text' => array(
                        'text' => $chattext,
                        'languageCode' => 'th',
                    ),
                ),
            );
            $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/sessions/' . $sessions_id . ':detectIntent?', [GuzzleHttp\RequestOptions::JSON => $post]);
            // response
//            echo '<pre>';
//            print_r($response->getBody()->getContents());
//            echo '</pre>';
//            exit;
            $decode = json_decode($response->getBody()->getContents());
            $data = array(
                'chattext' => $chattext,
                'data' => $decode,
            );
            $this->load->view('ajax/chattest_page', $data);
        } else {
            redirect(base_url());
        }
    }

}
