<?php

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

class Dialogflow extends CI_Controller {

    public function __construct() {
        parent::__construct();
        require APPPATH . '/third_party/Dialogflow/vendor/autoload.php';
    }

    public function index() {
        $this->detect_intent_texts('tombot-cf40a', 'สิริอ้วนไหม', '123456');
    }

    public function detect_intent_texts($projectId, $text, $sessionId, $languageCode = 'en-US') {

        // new session
        $test = array('credentials' => APPPATH . 'third_party/Dialogflow/tombot-cf40a-4c1c6566c766.json');
        $sessionsClient = new SessionsClient($test);
        $session = $sessionsClient->sessionName($projectId, $sessionId ?: uniqid());

        // create text input
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        // create query input
        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        // get response and relevant info
        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();
        $queryText = $queryResult->getQueryText();
        $intent = $queryResult->getIntent();
        $displayName = $intent->getDisplayName();
        $confidence = $queryResult->getIntentDetectionConfidence();
        $fulfilmentText = $queryResult->getFulfillmentText();

        // output relevant info
        echo "Session path: $session<br>";
        echo "Query text: $queryText<br>";
        echo "Detected intent: $displayName ( confidence: $confidence )<br>";
        echo "Fulfilment text: $fulfilmentText<br>";

        $sessionsClient->close();
    }

}
