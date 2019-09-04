<?php

require APPPATH . '/third_party/GoogleAPIClient/vendor/autoload.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . APPPATH . 'third_party/Credentials/tombot-cf40a-02fa0919ad4d.json');

class Dialogflow extends CI_Controller {

    public $sessionId;
    public $projectId;

    public function __construct() {
        parent::__construct();
        // new session
        $this->sessionId = '123456789';
        $this->projectId = 'tombot-cf40a';
    }

    public function index() {
        
    }

    // auth
    public function auth() {
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope('https://www.googleapis.com/auth/cloud-platform');
        $httpClient = $client->authorize();
        return $httpClient;
    }

    /*     * ** intents *** */

    // Method: projects.agent.intents.batchDelete -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/batchDelete
    public function intentsBatchDelete() {
        
    }

    // Method: projects.agent.intents.batchUpdate -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/batchUpdate
    public function intentsBatchUpdate() {
        
    }

    // Method: projects.agent.intents.create -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/create
    public function intentsCreate() {
        // auth
        $httpClient = $this->auth();
        // request
        $query = array(
            "languageCode" => "th",
            "intentView" => "INTENT_VIEW_FULL", // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
        );
        $post = array(
            "displayName" => "test03"
        );
        $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent/intents?' . http_build_query($query), [
            GuzzleHttp\RequestOptions::JSON => $post
        ]);
        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.intents.delete -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/delete
    public function intentsDelete() {
        // auth
        $httpClient = $this->auth();
        // request
        $intentID = '2b2c0e00-f2a6-4ee2-bf35-2f97ca2fcab3';
        $response = $httpClient->delete('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent/intents/' . $intentID);
        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.intents.get -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/get
    public function intentsGet() {
        // auth
        $httpClient = $this->auth();
        // request
        $intentID = '67bf5c7b-646a-4c28-8669-38f83e0736fc';
        $query = array(
            'languageCode' => 'th',
            'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
        );
        $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent/intents/' . $intentID . '?' . http_build_query($query));
        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.intents.list -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/list
    public function intentsList() {
        // auth
        $httpClient = $this->auth();
        // request
        $query = array(
            'languageCode' => 'th',
            'intentView' => 'INTENT_VIEW_FULL', // INTENT_VIEW_UNSPECIFIED, INTENT_VIEW_FULL
            'pageSize' => 100,
            'pageToken' => ''
        );
        $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent/intents?' . http_build_query($query));
        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.intents.patch -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent.intents/patch
    public function intentsPatch() {
        
    }

    /*     * ** agent *** */

    // Method: projects.getAgent -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects/getAgent
    public function agentGet() {
        // auth
        $httpClient = $this->auth();

        // request
        $response = $httpClient->get('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent');

        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.export -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent/export
    public function agentExport() {
        // auth
        $httpClient = $this->auth();

        // request
        $post = array(
            'agentUri' => ''
        );
        $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent:export', [GuzzleHttp\RequestOptions::JSON => $post]);

        // response
        echo '<pre>';
        print_r($response->getBody()->getContents());
        echo '</pre>';
        exit;
    }

    // Method: projects.agent.import -> https://cloud.google.com/dialogflow-enterprise/docs/reference/rest/v2/projects.agent/import
//    public function agentImport() {
//        // auth
//        $httpClient = $this->auth();
//
//        // request
//        $post = array(
//            'agentUri' => '',
//            'agentContent' => ''
//        );
//        $response = $httpClient->post('https://dialogflow.googleapis.com/v2/projects/' . $this->projectId . '/agent:import', [GuzzleHttp\RequestOptions::JSON => $post]);
//
//        // response
//        echo '<pre>';
//        print_r($response->getBody()->getContents());
//        echo '</pre>';
//        exit;
//    }
}
