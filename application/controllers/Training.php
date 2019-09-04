<?php

require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Training extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('training_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'css' => array('parsley.min.css'),
            'js' => array('parsley.min.js'),
            'css_full' => array('plugin/datepicker/datepicker.css'),
            'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
        );
        $this->renderView('training_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'hook_project_id' => $this->input->post('hook_project_id'),
            'hook_platforms' => $this->input->post('hook_platforms'),
            'date_start_report' => $this->input->post('date_start_report'),
            'date_end_report' => $this->input->post('date_end_report'),
            'training_status' => $this->input->post('training_status'),
        );
        $count = $this->training_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('training/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','hook_project_id' : '" . $this->input->post('hook_project_id') . "','hook_platforms' : '" . $this->input->post('hook_platforms') . "','date_start_report' : '" . $this->input->post('date_start_report') . "','date_end_report' : '" . $this->input->post('date_end_report') . "','training_status' : '" . $this->input->post('training_status') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->training_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/training_pagination', $data);
    }

    public function auth($agent_file) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . FCPATH . 'admin/assets/upload/json/' . $agent_file);
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    public function training_modal() {
        $training_id = $this->input->post('training_id');
        $trainings = $this->training_model->get_training($training_id);
        if ($trainings->num_rows() > 0) {
            $training = $trainings->row();
            $httpClient = $this->auth($training->agent_file);
            $query = array(
                'languageCode' => 'th',
                'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                'pageSize' => 100,
                'pageToken' => ''
            );
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $training->agent_project_id . '/agent/intents?' . http_build_query($query));
            $intents = json_decode($response->getBody()->getContents());
            $data = array(
                'agent_id' => $training->agent_id,
                'intents' => $intents,
                'training_id' => $training_id,
                'data' => $training,
            );
            $this->load->view('modal/training_modal', $data);
        } else {
            redirect(base_url('training'));
        }
    }

    public function intents() {
        $agent_id = $this->input->post('agent_id');
        $intent_id = $this->input->post('intent_id');
        $training_id = $this->input->post('training_id');
        $training_text = $this->input->post('training_text');
        $get_agent = $this->training_model->get_training($training_id);
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id . '?intentView=INTENT_VIEW_FULL');
            $intent = json_decode($response->getBody()->getContents());
            $result = array();
            if (!empty($intent->trainingPhrases)) {
                foreach ($intent->trainingPhrases as $row) {
                    //echo $row->parts[0]->text;
                    //echo '</br>';
                    $trainingPhrase[$row->name] = $row->parts[0]->text;
                }
                $result[] = array(
                    'parts' => array(
                        'text' => $training_text
                    )
                );
                if (count($trainingPhrase) > 0) {
                    foreach ($trainingPhrase as $key => $value) {
                        if (strlen($key) > 9) {
                            $result[] = array(
                                'name' => $key,
                                'parts' => array(
                                    'text' => $value
                                )
                            );
                        } else {
                            $result[] = array(
                                'parts' => array(
                                    'text' => $value
                                )
                            );
                        }
                    }
                }
            } else {
                $result[] = array(
                    'parts' => array(
                        'text' => $training_text
                    )
                );
            }
//            $displayName = trim($this->input->post('displayName'));
//            $trainingPhrase = $this->trainingPhrase($this->input->post('trainingPhrase'));
//            $parameter = $this->parameter($this->input->post('parameterID'), $this->input->post('parameterName'), $this->input->post('parameterEntity'), $this->input->post('parameterPrompt'));
//            $responseText = $this->responseText($this->input->post('responseText'));
//            $responseImage = $this->responseImage($this->input->post('responseImage'));
//            $responseCard = $this->responseCard($this->input->post('responseCard'));
//            $responseQuickReplie = $this->responseQuickReplie($this->input->post('responseQuickReplie'));
//            $response = array_merge($responseText, $responseImage, $responseCard, $responseQuickReplie);
//            $inputContext = $this->inputContext($this->input->post('inputContext'), $agent->agent_project_id);
//            $outputContext = $this->outputContext($this->input->post('outputContext'), $agent->agent_project_id);
//            $endInteraction = !empty($this->input->post('endInteraction')) ? true : false;
            $WELCOME = 0;
            if (!empty($intent->events)) {
                if ($intent->events[0] == "WELCOME") {
                    $WELCOME = 1;
                }
            }
            if ($WELCOME == 1) {
                $post = array(
                    'displayName' => $intent->displayName,
                    'trainingPhrases' => $result,
                    'parameters' => (!empty($intent->parameters)) ? $intent->parameters : array(),
                    'messages' => $intent->messages,
                    'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                    'inputContextNames' => (!empty($intent->inputContextNames)) ? $intent->inputContextNames : array(),
                    'outputContexts' => (!empty($intent->outputContexts)) ? $intent->outputContexts : array(),
                    'endInteraction' => (!empty($intent->endInteraction)) ? true : false,
                    'events' => (!empty($intent->events)) ? $intent->events : array(),
                    'action' => (!empty($intent->action)) ? $intent->action : array(),
                );
            } else {
                $post = array(
                    'displayName' => $intent->displayName,
                    'trainingPhrases' => $result,
                    'parameters' => (!empty($intent->parameters)) ? $intent->parameters : array(),
                    'messages' => $intent->messages,
                    'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                    'inputContextNames' => (!empty($intent->inputContextNames)) ? $intent->inputContextNames : array(),
                    'outputContexts' => (!empty($intent->outputContexts)) ? $intent->outputContexts : array(),
                    'endInteraction' => (!empty($intent->endInteraction)) ? true : false,
                );
            }
//            echo '<pre>';
//            print_r($post);
//            echo '</pre>';
            // api patch
            $response1 = $httpClient->patch('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id, [GuzzleHttp\RequestOptions::JSON => $post]);
            if ($response1->getStatusCode() == '200') {
//                $json = array(
//                    'status' => 'success',
//                    'title' => 'ทำรายการเรียบร้อย',
//                    'message' => 'แก้ไขข้อมูลเรียบร้อยเเล้ว'
//                );
                $trainings = $this->training_model->get_training_text($training_text, $agent_id);
                if ($trainings > 0) {
                    foreach ($trainings->result() as $training) {
                        $data = array(
                            'training_intents_id' => $this->input->post('training_intents_id'),
                            'training_intents_name' => $this->input->post('training_intents_name'),
                            'training_status' => 2,
                            'user_id' => $this->session->userdata('user_id'),
                            'training_update' => $this->misc->getdate()
                        );
                        $this->training_model->update_training($training->training_id, $data);
                    }
                }
                $this->session->set_flashdata('flash_message', 'success,ทำรายการเรียบร้อย,Training ข้อมูลเรียบร้อยเเล้ว');
            } else {
//                $json = array(
//                    'status' => 'error',
//                    'title' => 'เกิดข้อผิดพลาด',
//                    'message' => 'แก้ไขข้อมูลไม่สำเร็จ'
//                );
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,Training ข้อมูลไม่สำเร็จ');
            }
//            $response2 = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id . '?intentView=INTENT_VIEW_FULL');
//            $intentupdate = json_decode($response2->getBody()->getContents());
//            echo '</br><pre>';
//            print_r($intentupdate);
//            echo '</pre>';
//            echo '</br><pre>';
//            print_r($json);
//            echo '</pre>';
        } else {
            $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,Training ข้อมูลไม่สำเร็จ');
        }
        redirect(base_url('training'));
    }

}
