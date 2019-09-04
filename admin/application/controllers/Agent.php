<?php

require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Agent extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 2;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('agent_model');
        $this->load->library('ajax_pagination');
    }

    public function index($status = null) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
            'status' => $status
        );
        $this->renderView('agent_view', $data);
    }

    public function ajax_pagination() {
        $per_page = $this->input->post('per_page');
        $filter = array(
            'agent_status_id' => $this->input->post('agent_status_id'),
            'agent_type_id' => $this->input->post('agent_type_id'),
            'teams_id' => $this->input->post('teams_id'),
            'searchtext' => $this->input->post('searchtext')
        );
        $count = $this->agent_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('agent/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['additional_param'] = "{'agent_status_id' : '" . $this->input->post('agent_status_id') . "','agent_type_id' : '" . $this->input->post('agent_type_id') . "','teams_id' : '" . $this->input->post('teams_id') . "','searchtext' : '" . $this->input->post('searchtext') . "','per_page' : '" . $per_page . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->agent_model->get_pagination($filter, array('start' => $segment, 'limit' => $per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/agent_pagination', $data);
    }

    public function modaleditstatus() {
        $data = array(
            'agent_id' => $this->input->post('agent_id'),
        );
        $this->load->view('modal/agent_editstatus', $data);
    }

    public function editstatus() {
        $this->agent_model->edit($this->input->post('agent_id'), array('agent_status_id' => 3, 'agent_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('agent'));
    }

    public function editchangestatus() {
        $this->agent_model->edit($this->input->post('agent_id'), array('agent_status_id' => 1, 'agent_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function modaladd() {
        $this->load->view('modal/agent_add');
    }

    public function modaledit() {
        $id = $this->input->post('agent_id');
        $data = array(
            'data' => $this->agent_model->get_agent($id)->row(),
        );
        $this->load->view('modal/agent_edit', $data);
    }

    public function modalview() {
        $data = array(
            'agent_id' => $this->input->post('agent_id')
        );
        $this->load->view('ajax/agent_view', $data);
    }

    public function add() {
        $data = array(
            'agent_name' => $this->input->post('agent_name'),
            'agent_description' => $this->input->post('agent_description'),
            'teams_id' => $this->input->post('teams_id'),
            'agent_type_id' => $this->input->post('agent_type_id'),
            'agent_project_id' => $this->input->post('agent_project_id'),
            'agent_service_account' => $this->input->post('agent_service_account'),
            'agent_client_access_token' => $this->input->post('agent_client_access_token'),
            'agent_developer_access_token' => $this->input->post('agent_developer_access_token'),
            'agent_status_id' => 1,
            'agent_active_id' => 0,
            'agent_fb_active_id' => 0,
            'agent_fb_app' => $this->input->post('agent_fb_app'),
            'agent_fb_name' => $this->input->post('agent_fb_name'),
            'agent_fb_callback_url' => $this->input->post('agent_fb_callback_url'),
            'agent_fb_verify_token' => $this->input->post('agent_fb_verify_token'),
            'agent_fb_access_token' => $this->input->post('agent_fb_access_token'),
            'agent_line_active_id' => 0,
            'agent_line_name' => $this->input->post('agent_line_name'),
            'agent_line_channel_id' => $this->input->post('agent_line_channel_id'),
            'agent_line_channel_secret' => $this->input->post('agent_line_channel_secret'),
            'agent_line_access_token' => $this->input->post('agent_line_access_token'),
            'agent_line_webhook_url' => $this->input->post('agent_line_webhook_url'),
            'agent_create' => $this->misc->getDate(),
            'agent_update' => $this->misc->getDate()
        );
        $agent_id = $this->agent_model->add($data);
        $json_file = '';
        if (!empty($_FILES['json_file']['name'])) {
            $config = array(
                'upload_path' => 'assets/upload/json/',
                'allowed_types' => '*',
                'max_size' => 10240,
                'file_name' => $_FILES['json_file']['name'],
            );
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('json_file')) {
                $upload = $this->upload->data();
                $json_file = $upload['file_name'];
            }
        }
        if ($json_file != '') {
            $json_data = array(
                'agent_file' => $json_file,
            );
            $this->agent_model->edit($agent_id, $json_data);
        }
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลสำเร็จ');
        redirect('agent');
    }

    public function edit() {
        $agent_id = $this->input->post('agent_id');
        if ($agent_id != null) {
            $data = array(
                'agent_name' => $this->input->post('agent_name'),
                'agent_description' => $this->input->post('agent_description'),
                'teams_id' => $this->input->post('teams_id'),
                'agent_type_id' => $this->input->post('agent_type_id'),
                'agent_project_id' => $this->input->post('agent_project_id'),
                'agent_service_account' => $this->input->post('agent_service_account'),
                'agent_client_access_token' => $this->input->post('agent_client_access_token'),
                'agent_developer_access_token' => $this->input->post('agent_developer_access_token'),
                'agent_fb_app' => $this->input->post('agent_fb_app'),
                'agent_fb_name' => $this->input->post('agent_fb_name'),
                'agent_fb_callback_url' => $this->input->post('agent_fb_callback_url'),
                'agent_fb_verify_token' => $this->input->post('agent_fb_verify_token'),
                'agent_fb_access_token' => $this->input->post('agent_fb_access_token'),
                'agent_line_name' => $this->input->post('agent_line_name'),
                'agent_line_channel_id' => $this->input->post('agent_line_channel_id'),
                'agent_line_channel_secret' => $this->input->post('agent_line_channel_secret'),
                'agent_line_access_token' => $this->input->post('agent_line_access_token'),
                'agent_line_webhook_url' => $this->input->post('agent_line_webhook_url'),
                'agent_status_id' => $this->input->post('agent_status_id'),
                'agent_update' => $this->misc->getDate()
            );
            $this->agent_model->edit($agent_id, $data);
            $json_file = '';
            if (!empty($_FILES['json_file']['name'])) {
                $config = array(
                    'upload_path' => 'assets/upload/json/',
                    'allowed_types' => '*',
                    'max_size' => 10240,
                    'file_name' => $_FILES['json_file']['name'],
                );
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('json_file')) {
                    $upload = $this->upload->data();
                    $json_file = $upload['file_name'];
                    if ($this->input->post('agent_file') != '' || $this->input->post('agent_file') != null) {
                        @unlink('./assets/upload/json/' . $this->input->post('agent_file'));
                    }
                }
            }
            if ($json_file != '') {
                $json_data = array(
                    'agent_file' => $json_file,
                );
                $this->agent_model->edit($agent_id, $json_data);
            }
            $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
            redirect('agent');
        } else {
            redirect(base_url());
        }
    }

    public function auth($agent_file) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . FCPATH . 'assets/upload/json/' . $agent_file);
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    public function checkactive($agents = null) {
        if ($agents != null) {
            $agent_id = $agents;
        } else {
            $agent_id = $this->input->post('agent_id');
        }
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
                    $check = 1;
                    //update
                    $httpClient = $this->auth($agent->agent_file);
                    $query = array(
                        'languageCode' => 'th',
                        'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                        'pageSize' => 100,
                        'pageToken' => ''
                    );
                    $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
                    $intents = json_decode($response->getBody()->getContents());
//                    echo '<pre>';
//                    print_r($intents);
//                    echo '</pre>';
                    if (!empty($intents->intents)) {
                        foreach ($intents->intents as $row) {
                            $isFallback = !empty($row->isFallback) ? 1 : 0;
                            $WELCOME = 0;
                            if (!empty($row->events)) {
                                if ($row->events[0] == "WELCOME") {
                                    $WELCOME = 1;
                                }
                            }
                            $name = explode('/', $row->name);
                            if ($isFallback == 1 || $WELCOME == 1) {
                                $intent_id = $name[4];
                                //echo $row->displayName . '<br>';
                                $httpClient = $this->auth($agent->agent_file);
                                $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id . '?intentView=INTENT_VIEW_FULL');
                                $intent = json_decode($response->getBody()->getContents());
//                            echo '<pre>';
//                            print_r($intent);
//                            echo '</pre>';
                                if ($isFallback == 1) {
                                    $post = array(
                                        'displayName' => $intent->displayName,
                                        'trainingPhrases' => (!empty($intent->trainingPhrases)) ? $intent->trainingPhrases : array(),
                                        'parameters' => (!empty($intent->parameters)) ? $intent->parameters : array(),
                                        'messages' => $intent->messages,
                                        'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                                        'inputContextNames' => (!empty($intent->inputContextNames)) ? $intent->inputContextNames : array(),
                                        'outputContexts' => (!empty($intent->outputContexts)) ? $intent->outputContexts : array(),
                                        'endInteraction' => (!empty($intent->endInteraction)) ? true : false,
                                        'isFallback' => true,
                                        'action' => (!empty($intent->action)) ? $intent->action : array(),
                                    );
                                }
                                if ($WELCOME == 1) {
                                    $post = array(
                                        'displayName' => $intent->displayName,
                                        'trainingPhrases' => (!empty($intent->trainingPhrases)) ? $intent->trainingPhrases : array(),
                                        'parameters' => (!empty($intent->parameters)) ? $intent->parameters : array(),
                                        'messages' => $intent->messages,
                                        'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                                        'inputContextNames' => (!empty($intent->inputContextNames)) ? $intent->inputContextNames : array(),
                                        'outputContexts' => (!empty($intent->outputContexts)) ? $intent->outputContexts : array(),
                                        'endInteraction' => (!empty($intent->endInteraction)) ? true : false,
                                        'events' => $intent->events,
                                        'action' => (!empty($intent->action)) ? $intent->action : array(),
                                    );
                                }
                                $response1 = $httpClient->patch('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id, [GuzzleHttp\RequestOptions::JSON => $post]);
                                if ($response1->getStatusCode() == '200') {
                                    $data = array(
                                        'agent_active_id' => 1,
                                    );
                                    $this->agent_model->edit($agent_id, $data);
                                    $check = 1;
                                } else {
                                    $check = 3;
                                }
                            } else {
                                $check = 1;
                            }
                        }
                    } else {
                        $check = 2;
                    }
                    echo $check;
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
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
                'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
                'agent_id' => $agent_id,
                'agent_name' => $agent->agent_name,
            );
            $this->renderView('agentchat_view', $data);
        }
    }

    public function chatbot() {
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
            $this->load->view('ajax/agentchat_page', $data);
        } else {
            redirect(base_url());
        }
    }

    public function webhook() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            $requestBody = file_get_contents('php://input');
            $json = json_decode($requestBody);

            $text = $json->queryResult->queryText;

//            $setting = $this->accesscontrol->getSetting();
//            $line_token = $setting->line_token;
//            if ($line_token != '') {
//                $message = $text;
//                $this->load->library('../controllers/line');
//                $this->line->line_notification($line_token, $message);
//            }

            switch ($text) {
                case 'สอบถาม':
                    $speech = "Hi, Nice to meet you";
                    break;

                case 'bye':
                    $speech = "Bye, good night";
                    break;

                case 'anything':
                    $speech = "Yes, you can type anything here.";
                    break;

                default:
                    $speech = "Sorry, I didnt get that. Please ask me something else.";
                    break;
            }

            $response = new \stdClass();
            $response2 = new \stdClass();
            $response2->text = array('text response');
            $response->fulfillmentText = 'fulfillmentText';
            $response->fulfillmentMessages = array(
                $response2,
            );
            $response->source = "webhook";

//            $setting = $this->accesscontrol->getSetting();
//            $line_token = $setting->line_token;
//            if ($line_token != '') {
//                $message = $text;
//                $this->load->library('../controllers/line');
//                $this->line->line_notification($line_token, $message);
//            }

            echo json_encode($response);
        } else {
            echo "Method not allowed";
        }
    }

}
