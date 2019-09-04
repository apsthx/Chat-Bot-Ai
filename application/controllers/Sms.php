<?php

class Sms extends CI_Controller {

    public $group_id = '';
    public $menu_id = '';

    public function __construct() {
        parent::__construct();
        $this->load->library('thsms');
        $this->load->model('sms_model');
    }

    public function sendSMSOTP() {
        $sms = new thsms();
        $datasms = $this->accesscontrol->getSetting();
        $sms->username = $datasms->sms_username;
        $sms->password = $datasms->sms_password;
        
        $telcheck = $this->session->userdata('tel');
        $refotp = $this->input->post('refotp');
        $otp = $this->session->userdata('otp');
        
        $tel = $telcheck;
        $text = 'รหัส OTP คือ ' . $otp . ' (Ref No. ' . $refotp . ')';
        $creditsend = $sms->send($datasms->sms_tel, $tel, $text);
        
        if ($creditsend[1] == 'OK') {
            $action_text = '(SMS OTP ระบบส่ง) ' . $text . ' ส่งไปยัง ' . $tel;
            $this->systemlog->log_send_sms(NULL, $action_text);
            echo 1;
        } else {
            echo 0;
        }
    }

//    public function sendPassword() {
//        $username = $this->input->post('username');
//        $user = $this->sms_model->getUsername($username);
//        if ($user->num_rows() > 0) {
//            $user = $user->row();
//            $shop = $this->accesscontrol->getShop($user->shop_id_pri)->row();
//            $shopowner = $this->accesscontrol->getShopownerShop($shop->shop_owner_id_pri)->row();
//            $shop_sms_all = $shopowner->shop_sms_all;
//            if ($shop_sms_all > 0) {
//                $shop_id_pri = $shopowner->shop_id_pri;
//                $user_id = $shopowner->user_id;
//                $tel = $this->sms_model->get_tel($username);
//                $password = $this->input->post('text');
//                //$this->sendmail->sendEmailpassword($username, $password);
//                $datauser = array(
//                    'password' => hash('sha256', $username . $password),
//                    'user_update' => $this->misc->getDate()
//                );
//                $this->sms_model->edituser($username, $datauser);
//
//                $sms = new thsms();
//                $datasms = $this->accesscontrol->getSetting();
//                $sms->username = $datasms->sms_username;
//                $sms->password = $datasms->sms_password;
//                $text = $username . ' รหัสผ่านใหม่คือ ' . $password;
//                $text_sms = $username . ' ลืมรหัสผ่าน ส่งรหัสผ่านใหม่ไปยัง';
//                $creditsend = $sms->send($datasms->sms_tel, $tel, $text);
//                if ($creditsend[1] == 'OK') {
//                    $data = array(
//                        'sms_credit' => $creditsend[3],
//                    );
//                    $this->accesscontrol->editSetting($data);
//                    $action_text = '(SMSSendPassword ระบบส่ง) ' . $text_sms . ' ' . $tel;
//
//                    $this->systemlog->log_send_sms($action_text, $shop_id_pri, $user_id);
//                    $shop = $this->accesscontrol->getShop($shop_id_pri)->row();
//                    $data_shop = array(
//                        'shop_sms_sum' => $shop->shop_sms_sum + 1,
//                        'shop_sms_all' => $shop->shop_sms_all - 1,
//                    );
//                    $this->accesscontrol->updateshop($shop_id_pri, $data_shop);
//                    $this->systemlog->log_sms_credit('- ลบเครดิต 1', $shop_id_pri);
//                    echo 1;
//                } else {
//                    echo 0;
//                }
//            } else {
//                echo 3;
//            }
//        } else {
//            echo 2;
//        }
//    }
//
//    public function sendSMS() {
//        $tel = $this->input->post('tel');
//        $text = $this->input->post('text');
//        $shop_id_pri = $this->input->post('shop_id_pri');
//        $user_id = $this->input->post('user_id');
//        $echo = $this->input->post('echo');
//        $sms = new thsms();
//        $datasms = $this->accesscontrol->getSetting();
//        $sms->username = $datasms->sms_username;
//        $sms->password = $datasms->sms_password;
//        $creditsend = $sms->send($datasms->sms_tel, $tel, $text);
//        if ($creditsend[1] == 'OK') {
//            $data = array(
//                'sms_credit' => $creditsend[3],
//            );
//            $this->accesscontrol->editSettingSms($data);
//            $action_text = $text . ' ส่งไปยัง ' . $tel;
//            $shop = $this->accesscontrol->getShop($shop_id_pri)->row();
//            $shop_id_pri = $shop->shop_id_pri;
//            $this->systemlog->log_send_sms($action_text, $shop_id_pri, $user_id);
//            $data_shop = array(
//                'shop_sms_sum' => $shop->shop_sms_sum + 1,
//                'shop_sms_all' => $shop->shop_sms_all - 1,
//            );
//            $this->accesscontrol->updateshop($shop_id_pri, $data_shop);
//            $this->systemlog->log_sms_credit('- ลบเครดิต 1', $shop_id_pri);
//            if ($echo == NULL) {
//                echo 1;
//            }
//        } else {
//            if ($echo == NULL) {
//                echo 0;
//            }
//        }
//    }

}
