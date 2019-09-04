<?php

/**
 * @author Phanuphong Duangjit
 */
require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Intents extends CI_Controller {

    public $group_id = 1;
    public $menu_id = 2;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('intents_model');
    }

    public function index() {
        redirect(base_url('error404'));
    }

    public function auth($agent_file) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . FCPATH . 'assets/upload/json/' . $agent_file);
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    public function lists($agent_id) {
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
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
            $intents = json_decode($response->getBody()->getContents());
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css_full' => array(),
                'js_full' => array(),
                'agent_id' => $agent_id,
                'project_id' => $agent->agent_project_id,
                'intents' => $intents
            );
            $this->renderView('intents_view', $data);
        } else {
            redirect(base_url('error404'));
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
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents?' . http_build_query($query));
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
                'icon' => $this->accesscontrol->getIcon($this->group_id),
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
            $parameter = $this->parameter($this->input->post('parameterKey'), $this->input->post('parameterName'), $this->input->post('parameterEntity'), $this->input->post('parameterPrompt'));
            $responseText = $this->responseText($this->input->post('responseText'));
            $responseImage = $this->responseImage($this->input->post('responseImage'));
            $responseCard = $this->responseCard($this->input->post('responseCard'));
            $responseQuickReplie = $this->responseQuickReplie($this->input->post('responseQuickReplie'));
            $response = array_merge($responseText, $responseImage, $responseCard, $responseQuickReplie);
            $post = array(
                'displayName' => $displayName,
                'trainingPhrases' => $trainingPhrase,
                'parameters' => $parameter,
                'messages' => $response
            );
            // api post
            $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents', [GuzzleHttp\RequestOptions::JSON => $post]);
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
            $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents/' . $intent_id . '?intentView=INTENT_VIEW_FULL');
            $intent = json_decode($response->getBody()->getContents());
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
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
            $parameter = $this->parameter($this->input->post('parameterKey'), $this->input->post('parameterName'), $this->input->post('parameterEntity'), $this->input->post('parameterPrompt'));
            $responseText = $this->responseText($this->input->post('responseText'));
            $responseImage = $this->responseImage($this->input->post('responseImage'));
            $responseCard = $this->responseCard($this->input->post('responseCard'));
            $responseQuickReplie = $this->responseQuickReplie($this->input->post('responseQuickReplie'));
            $response = array_merge($responseText, $responseImage, $responseCard, $responseQuickReplie);
            $post = array(
                'displayName' => $displayName,
                'trainingPhrases' => $trainingPhrase,
                'parameters' => $parameter,
                'messages' => $response
            );
            // api patch
            $response = $httpClient->patch('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents/' . $this->input->post('intent_id'), [GuzzleHttp\RequestOptions::JSON => $post]);
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
            $response = $httpClient->delete('https://dialogflow.googleapis.com/v2/projects/' . $agent->agent_project_id . '/agent/intents/' . $this->input->post('intent_id'));
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

    // function
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

    public function parameter($ipsPRM_key, $ipsPRM_name, $ipsPRM_entity, $ipsPRM_prompts) {
        $result = array();
        if (count($ipsPRM_key) > 0) {
            foreach ($ipsPRM_key as $value) {
                if (strlen($value) > 9) {
                    $result[] = array(
                        'name' => $ipsPRM_key[$value],
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
            $result[] = array(
                'platform' => 'PLATFORM_UNSPECIFIED',
                'text' => array(
                    'text' => $responseText
                )
            );
            $result[] = array(
                'platform' => 'FACEBOOK',
                'text' => array(
                    'text' => $responseText
                )
            );
            $result[] = array(
                'platform' => 'LINE',
                'text' => array(
                    'text' => $responseText
                )
            );
        }
        return $result;
    }

    public function responseImage($responseImage) {
        $result = array();
        if ($responseImage != '') {
            $result[] = array(
                'platform' => 'FACEBOOK',
                'image' => array(
                    'imageUri' => $responseImage
                )
            );
            $result[] = array(
                'platform' => 'LINE',
                'image' => array(
                    'imageUri' => $responseImage
                )
            );
        }
        return $result;
    }

    public function responseCard($responseCard) {
        $result = array();
        if ($responseCard['title'] != '' && $responseCard['imageUri'] != '') {
            $result[] = array(
                'platform' => 'FACEBOOK',
                'card' => array(
                    'title' => $responseCard['title'],
                    'imageUri' => $responseCard['imageUri'],
                    'buttons' => array(
                        array(
                            'text' => $responseCard['text'],
                            'postback' => $responseCard['postback']
                        )
                    )
                )
            );
            $result[] = array(
                'platform' => 'LINE',
                'card' => array(
                    'title' => $responseCard['title'],
                    'imageUri' => $responseCard['imageUri'],
                    'buttons' => array(
                        array(
                            'text' => $responseCard['text'],
                            'postback' => $responseCard['postback']
                        )
                    )
                )
            );
        }
        return $result;
    }

    public function responseQuickReplie($responseQuickReplie) {
        $result = array();
        if ($responseQuickReplie['title'] != '' && count($responseQuickReplie['quickReplies']) > 0) {
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

}
