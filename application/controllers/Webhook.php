<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Webhook
 *
 * @author nut
 */
require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

class Webhook extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
//        $method = $_SERVER['REQUEST_METHOD'];
//        if ($method == 'POST') {
        $hook_id = 'not request';
        $requestBody = file_get_contents('php://input');
        if (!empty($requestBody)) {
            $json = json_decode($requestBody);
            $session = explode("/", $json->session);
            $projects_id = $session[1];
            $platforms = 'ai-aps';
            $intents_id = '';
            $intents_name = '';
            if (!empty($json->originalDetectIntentRequest->source)) {
                $platforms = $json->originalDetectIntentRequest->source;
            }
            if (!empty($json->queryResult->intent->name)) {
                $intents = explode("/", $json->queryResult->intent->name);
                $intents_id = $intents[4];
                $intents_name = $json->queryResult->intent->displayName;
            }
            $datahook = array(
                'hook_project_id' => $projects_id,
                'hook_intents_id' => $intents_id,
                'hook_intents_name' => $intents_name,
                'hook_platforms' => $platforms,
                'hook_text' => $requestBody,
                'hook_modify' => $this->misc->getdate(),
            );
            $hook_id = $this->accesscontrol->addhook($datahook);
            if (!empty($json->queryResult->intent->isFallback)) {
                if ($json->queryResult->intent->isFallback == true) {
                    $datatraining = array(
                        'hook_id' => $hook_id,
                        'training_text' => $json->queryResult->queryText,
                        'training_create' => $this->misc->getdate(),
                        'training_update' => $this->misc->getdate(),
                    );
                    $this->accesscontrol->addtraining($datatraining);
                }
            }
        }
    }

}
