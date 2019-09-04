<?php

/**
 * @author Phanuphong Duangjit
 */
require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Intents extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('intents_model');
    }

    public function index() {
        redirect(base_url('main'));
    }

    public function auth($agent_file) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . FCPATH . 'admin/assets/upload/json/' . $agent_file);
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    public function lists($agent_id = NULL) {
        if ($agent_id != NULL) {
            $get_agent = $this->intents_model->get_agent($agent_id);
            if ($get_agent->num_rows() == 1) {
                $agent = $get_agent->row();
                if ($agent->agent_status_id == 1 && $agent->agent_active_id == 1 && $agent->agent_file != "") {
                    $httpClient = $this->auth($agent->agent_file);
                    $query = array(
                        'languageCode' => 'th',
                        'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                        'pageSize' => 100,
                        'pageToken' => ''
                    );
                    $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
                    $intents = json_decode($response->getBody()->getContents());
                    $data = array(
                        'group_id' => $this->group_id,
                        'menu_id' => $this->menu_id,
                        'css_full' => array('plugin/switchery/dist/switchery.min.css'),
                        'js_full' => array('js/intents.js?version=1.2', 'plugin/switchery/dist/switchery.min.js', 'js/perfect-scrollbar.jquery.min.js'),
                        'agent_id' => $agent_id,
                        'project_id' => $agent->agent_project_id,
                        'intents' => $intents
                    );
                    $this->renderView('intents_view', $data);
                } else {
                    $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                    redirect(base_url('main'));
                }
            } else {
                $this->session->set_flashdata('flash_message', 'error,เกิดข้อผิดพลาด,แก้ไขข้อมูลไม่สำเร็จ');
                redirect(base_url('main'));
            }
        } else {
            redirect(base_url('main'));
        }
    }

    public function getIntent() {
        $agent_id = $this->input->post('agent_id');
        $get_agent = $this->intents_model->get_agent($agent_id);
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            $query = array(
                'languageCode' => 'th',
                'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
                'pageSize' => 100,
                'pageToken' => ''
            );
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
            $intents = json_decode($response->getBody()->getContents());
            $data = array(
                'agent_id' => $agent_id,
                'intents' => $intents
            );
            $this->load->view('ajax/intents_ajax', $data);
        } else {
            $this->load->view('ajax/intents_error_agent_ajax');
        }
    }

    public function addIntent() {
        $agent_id = $this->input->post('agent_id');
        $get_agent = $this->intents_model->get_agent($agent_id);
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array(),
                'js_full' => array(),
                'agent_id' => $agent->agent_id,
                'project_id' => $agent->agent_project_id
            );
            $this->load->view('ajax/intents_add_ajax', $data);
        } else {
            $this->load->view('ajax/intents_error_agent_ajax');
        }
    }

    public function addIntentProcess() {
        $get_agent = $this->intents_model->get_agent($this->input->post('agent_id'));
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            // set parameter
            $displayName = trim($this->input->post('displayName'));
            $trainingPhrase = $this->trainingPhrase($this->input->post('trainingPhrase'));
            $parameter = $this->parameter($this->input->post('parameterID'), $this->input->post('parameterName'), $this->input->post('parameterEntity'), $this->input->post('parameterPrompt'));
            $responseText = $this->responseText($this->input->post('responseText'));
            $responseImage = $this->responseImage($this->input->post('responseImage'));
            $responseCard = $this->responseCard($this->input->post('responseCard'));
            $responseQuickReplie = $this->responseQuickReplie($this->input->post('responseQuickReplie'));
            $response = array_merge($responseText, $responseImage, $responseCard, $responseQuickReplie);
            $inputContext = $this->inputContext($this->input->post('inputContext'), $agent->agent_project_id);
            $outputContext = $this->outputContext($this->input->post('outputContext'), $agent->agent_project_id);
            $endInteraction = !empty($this->input->post('endInteraction')) ? true : false;
            $post = array(
                'displayName' => $displayName,
                'trainingPhrases' => $trainingPhrase,
                'parameters' => $parameter,
                'messages' => $response,
                'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                'inputContextNames' => $inputContext,
                'outputContexts' => $outputContext,
                'endInteraction' => $endInteraction
            );
            // api post
            $response = $httpClient->post('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents', [GuzzleHttp\RequestOptions::JSON => $post]);
            if ($response->getStatusCode() == '200') {
                $intent = json_decode($response->getBody()->getContents());
                $expd = explode('/', $intent->name);
                $json = array(
                    'status' => 'success',
                    'title' => 'ทำรายการเรียบร้อย',
                    'message' => 'เพิ่มข้อมูลเรียบร้อยเเล้ว',
                    'intent_id' => $expd[4]
                );
            } else {
                $json = array(
                    'status' => 'error',
                    'title' => 'เกิดข้อผิดพลาด',
                    'message' => 'เพิ่มข้อมูลไม่สำเร็จ'
                );
            }
        } else {
            $json = array(
                'status' => 'error',
                'title' => 'เกิดข้อผิดพลาด',
                'message' => 'เพิ่มข้อมูลไม่สำเร็จ'
            );
        }
        echo json_encode($json);
    }

    public function editIntent() {
        $agent_id = $this->input->post('agent_id');
        $intent_id = $this->input->post('intent_id');
        $get_agent = $this->intents_model->get_agent($agent_id);
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id . '?intentView=INTENT_VIEW_FULL');
            $intent = json_decode($response->getBody()->getContents());
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array(),
                'js_full' => array(),
                'agent_id' => $agent->agent_id,
                'project_id' => $agent->agent_project_id,
                'intent_id' => $intent_id,
                'intent' => $intent
            );
            $this->load->view('ajax/intents_edit_ajax', $data);
        } else {
            $this->load->view('ajax/intents_error_agent_ajax');
        }
    }

    public function editIntentProcess() {
        $get_agent = $this->intents_model->get_agent($this->input->post('agent_id'));
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            // set parameter
            $displayName = trim($this->input->post('displayName'));
            $trainingPhrase = $this->trainingPhrase($this->input->post('trainingPhrase'));
            $parameter = $this->parameter($this->input->post('parameterID'), $this->input->post('parameterName'), $this->input->post('parameterEntity'), $this->input->post('parameterPrompt'));
            $responseText = $this->responseText($this->input->post('responseText'));
            $responseImage = $this->responseImage($this->input->post('responseImage'));
            $responseCard = $this->responseCard($this->input->post('responseCard'));
            $responseQuickReplie = $this->responseQuickReplie($this->input->post('responseQuickReplie'));
            $response = array_merge($responseText, $responseImage, $responseCard, $responseQuickReplie);
            $inputContext = $this->inputContext($this->input->post('inputContext'), $agent->agent_project_id);
            $outputContext = $this->outputContext($this->input->post('outputContext'), $agent->agent_project_id);
            $endInteraction = !empty($this->input->post('endInteraction')) ? true : false;
            $post = array(
                'displayName' => $displayName,
                'trainingPhrases' => $trainingPhrase,
                'parameters' => $parameter,
                'messages' => $response,
                'webhookState' => 'WEBHOOK_STATE_ENABLED_FOR_SLOT_FILLING',
                'inputContextNames' => $inputContext,
                'outputContexts' => $outputContext,
                'endInteraction' => $endInteraction
            );
            if ($this->input->post('isFallback') == 1) {
                $post['isFallback'] = true;
                $post['action'] = 'input.unknown';
            }
            if ($this->input->post('isWelcome') == 1) {
                $post['events'] = array('WELCOME');
                $post['action'] = 'input.welcome';
            }
            // api patch
            $response = $httpClient->patch('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $this->input->post('intent_id'), [GuzzleHttp\RequestOptions::JSON => $post]);
            if ($response->getStatusCode() == '200') {
                $json = array(
                    'status' => 'success',
                    'title' => 'ทำรายการเรียบร้อย',
                    'message' => 'แก้ไขข้อมูลเรียบร้อยเเล้ว'
                );
            } else {
                $json = array(
                    'status' => 'error',
                    'title' => 'เกิดข้อผิดพลาด',
                    'message' => 'แก้ไขข้อมูลไม่สำเร็จ'
                );
            }
        } else {
            $json = array(
                'status' => 'error',
                'title' => 'เกิดข้อผิดพลาด',
                'message' => 'แก้ไขข้อมูลไม่สำเร็จ'
            );
        }
        echo json_encode($json);
    }

    // delete
    public function deleteIntentModal() {
        $data = array(
            'agent_id' => $this->input->post('agent_id'),
            'intent_id' => $this->input->post('intent_id')
        );
        $this->load->view('modal/intents_delete_modal', $data);
    }

    public function deleteIntentProcess() {
        $get_agent = $this->intents_model->get_agent($this->input->post('agent_id'));
        if ($get_agent->num_rows() == 1) {
            $agent = $get_agent->row();
            $httpClient = $this->auth($agent->agent_file);
            $response = $httpClient->delete('https://dialogflow.googleapis.com/v2beta1/projects/' . $agent->agent_project_id . '/agent/intents/' . $this->input->post('intent_id'));
            if ($response->getStatusCode() == '200') {
                $json = array(
                    'status' => 'success',
                    'title' => 'ทำรายการเรียบร้อย',
                    'message' => 'ลบข้อมูลเรียบร้อยเเล้ว'
                );
            } else {
                $json = array(
                    'status' => 'error',
                    'title' => 'เกิดข้อผิดพลาด',
                    'message' => 'ลบข้อมูลไม่สำเร็จ'
                );
            }
        } else {
            $json = array(
                'status' => 'error',
                'title' => 'เกิดข้อผิดพลาด',
                'message' => 'ลบข้อมูลไม่สำเร็จ'
            );
        }
        echo json_encode($json);
    }

    public function getImage() {
        $search_image_text = $this->allowText($this->input->post('search_image_text'));
        $image = array();
        $getImage = $this->intents_model->get_image($search_image_text);
        if ($getImage->num_rows() > 0) {
            $image = $getImage->result();
        }
        echo json_encode($image);
    }

    // function
    public function inputContext($inputContext, $projectID) {
        $result = array();
        if (count($inputContext) > 0) {
            foreach ($inputContext as $key => $value) {
                $result[] = 'projects/' . $projectID . '/agent/sessions/-/contexts/' . $value;
            }
        }
        return $result;
    }

    public function outputContext($outputContext, $projectID) {
        $result = array();
        if (count($outputContext) > 0) {
            foreach ($outputContext as $key => $value) {
                $result[] = array(
                    'name' => 'projects/' . $projectID . '/agent/sessions/-/contexts/' . $value,
                    'lifespanCount' => 5
                );
            }
        }
        return $result;
    }

    public function trainingPhrase($trainingPhrase) {
        $result = array();
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
        return $result;
    }

    public function parameter($ipsPRM_id, $ipsPRM_name, $ipsPRM_entity, $ipsPRM_prompts) {
        $result = array();
        if (count($ipsPRM_id) > 0) {
            foreach ($ipsPRM_id as $value) {
                if (strlen($value) > 9) {
                    $result[] = array(
                        'name' => $ipsPRM_id[$value],
                        'displayName' => $ipsPRM_name[$value],
                        'entityTypeDisplayName' => $ipsPRM_entity[$value],
                        'value' => '$' . $ipsPRM_name[$value],
                        'prompts' => array(
                            $ipsPRM_prompts[$value]
                        ),
                        'mandatory' => true,
                        'isList' => true
                    );
                } else {
                    $result[] = array(
                        'displayName' => $ipsPRM_name[$value],
                        'entityTypeDisplayName' => $ipsPRM_entity[$value],
                        'value' => '$' . $ipsPRM_name[$value],
                        'prompts' => array(
                            $ipsPRM_prompts[$value]
                        ),
                        'mandatory' => true,
                        'isList' => true
                    );
                }
            }
        }
        return $result;
    }

    public function responseText($responseText) {
        $result = array();
        if (count($responseText) > 0) {
            foreach ($responseText as $value) {
                $result[] = array(
                    'platform' => 'PLATFORM_UNSPECIFIED',
                    'text' => array(
                        'text' => $value
                    )
                );
                $result[] = array(
                    'platform' => 'FACEBOOK',
                    'text' => array(
                        'text' => $value
                    )
                );
                $result[] = array(
                    'platform' => 'LINE',
                    'text' => array(
                        'text' => $value
                    )
                );
            }
        }
        return $result;
    }

    public function responseImage($responseImage) {
        $result = array();
        if (count($responseImage) > 0) {
            foreach ($responseImage as $value) {
                $result[] = array(
                    'platform' => 'FACEBOOK',
                    'image' => array(
                        'imageUri' => $value
                    )
                );
                $result[] = array(
                    'platform' => 'LINE',
                    'image' => array(
                        'imageUri' => $value
                    )
                );
            }
        }
        return $result;
    }

    public function responseCard($responseCard) {
        $result = array();
        if (count($responseCard['imageUri']) > 0) {
            foreach ($responseCard['imageUri'] as $key => $value) {
                if ($responseCard['title'][$key] != '' && $responseCard['imageUri'][$key] != '') {
                    $buttons = array();
                    foreach ($responseCard['text'][$key] as $key_ => $value_) {
                        if ($responseCard['text'][$key][$key_] != '' && $responseCard['postback'][$key][$key_] != '') {
                            $buttons[] = array(
                                'text' => $responseCard['text'][$key][$key_],
                                'postback' => $responseCard['postback'][$key][$key_]
                            );
                        }
                    }
                    $result[] = array(
                        'platform' => 'FACEBOOK',
                        'card' => array(
                            'title' => $responseCard['title'][$key],
                            'subtitle' => $responseCard['subtitle'][$key],
                            'imageUri' => $responseCard['imageUri'][$key],
                            'buttons' => $buttons
                        )
                    );
                    $result[] = array(
                        'platform' => 'LINE',
                        'card' => array(
                            'title' => $responseCard['title'][$key],
                            'subtitle' => $responseCard['subtitle'][$key],
                            'imageUri' => $responseCard['imageUri'][$key],
                            'buttons' => $buttons
                        )
                    );
                }
            }
        }
        return $result;
    }

    public function responseQuickReplie($responseQuickReplie) {
        $result = array();
        if ($responseQuickReplie['title'] != '' && (!empty($responseQuickReplie['quickReplies']) && count($responseQuickReplie['quickReplies']) > 0)) {
            $result[] = array(
                'platform' => 'FACEBOOK',
                'quickReplies' => array(
                    'title' => $responseQuickReplie['title'],
                    'quickReplies' => $responseQuickReplie['quickReplies']
                )
            );
            $result[] = array(
                'platform' => 'LINE',
                'quickReplies' => array(
                    'title' => $responseQuickReplie['title'],
                    'quickReplies' => $responseQuickReplie['quickReplies']
                )
            );
        }
        return $result;
    }

    public function uploadImageProcess() {
        if (!empty($_FILES['file_image']['name'])) {
            $this->load->library('upload');
            $cnf = array(
                'upload_path' => 'assets/upload/intent/',
                'allowed_types' => 'jpg|jpeg|gif|png',
                'max_size' => 8192,
                'file_name' => 'intent_' . $this->session->userdata('teams_id') . '_' . date('YmdHis')
            );
            $this->upload->initialize($cnf);
            if ($this->upload->do_upload('file_image')) {
                $uploadData = $this->upload->data();
                $image_url = base_url() . 'store/image/' . $uploadData['file_name'];
                $image_path = $uploadData['file_name'];
                $image_data = array(
                    'teams_id' => $this->session->userdata('teams_id'),
                    'image_name' => 'image_' . $this->session->userdata('teams_id') . '_' . date('dmyHis'),
                    'image_url' => $image_url,
                    'image_path' => $image_path,
                    'image_modify' => date('Y-m-d H:i:s')
                );
                $this->intents_model->insert_image($image_data);
                $json = array(
                    'status' => 'success',
                    'title' => 'ทำรายการเรียบร้อย',
                    'message' => 'อับโหลดรูปภาพเรียบร้อยเเล้ว',
                    'imageURI' => $image_url
                );
            } else {
                $json = array(
                    'status' => 'error',
                    'title' => 'เกิดข้อผิดพลาด1',
                    'message' => 'อับโหลดรูปภาพไม่สำเร็จ',
                    'imageURI' => ''
                );
            }
        } else {
            $json = array(
                'status' => 'error',
                'title' => 'เกิดข้อผิดพลาด2',
                'message' => 'อับโหลดรูปภาพไม่สำเร็จ',
                'imageURI' => ''
            );
        }
        echo json_encode($json);
    }

    public function allowText($text) {
        $allow = "/([^a-zA-Z0-9ก-๙เ ])/";
        return preg_replace($allow, '', $text);
    }

    //Test chat
    public function chat($agent_id) {
        $agents = $this->intents_model->get_agent($agent_id);
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
            $this->renderView('intentschat_view', $data);
        }
    }

    //Test chat
    public function chattest() {
        $chattext = $this->input->post('chattext');
        $agent_id = $this->input->post('agent_id');
        $sessions_id = $this->input->post('sessions_id');
        $agents = $this->intents_model->get_agent($agent_id);
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
