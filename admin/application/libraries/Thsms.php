<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Thsms
 *
 * @author nut_channarong
 */

class Thsms {
    //put your code here
    public $api_url = 'http://www.thsms.com/api/rest';
    public $username = null;
    public $password = null;

    public function getCredit() {
        $params['method'] = 'credit';
        $params['username'] = $this->username;
        $params['password'] = $this->password;

        $result = $this->curl($params);

        $xml = @simplexml_load_string($result);

        if (!is_object($xml)) {
            return array(FALSE, 'Respond error');
        } else {

            if ($xml->credit->status == 'success') {
                return array(TRUE, $xml->credit->credit,$xml->credit->status);
            } else {
                return array(FALSE, $xml->credit->message);
            }
        }
    }

    public function send($from = '0000', $to = null, $message = null) {
        $params['method'] = 'send';
        $params['username'] = $this->username;
        $params['password'] = $this->password;

        $params['from'] = $from;
        $params['to'] = $to;
        $params['message'] = $message;

        if (is_null($params['to']) || is_null($params['message'])) {
            return FALSE;
        }

        $result = $this->curl($params);
        $xml = @simplexml_load_string($result);
        if (!is_object($xml)) {
            return array(FALSE, 'Respond error');
        } else {
            if ($xml->send->status == 'success') {
                return array(TRUE,$xml->send->message, $xml->send->uuid, $xml->send->credit, $xml->send->status);
            } else {
                return array(FALSE, $xml->send->message);
            }
        }
    }

    private function curl($params = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $lastError = curl_error($ch);
        $lastReq = curl_getinfo($ch);
        curl_close($ch);

        return $response;
    }

}
