<?php

class Payment extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 5;
    public $per_page = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('payment_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-money',
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('thbanklogos.css'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css', 'plugin/datepicker/datepicker.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker-thai.js', 'plugin/datepicker/bootstrap-datepicker.th.js')
        );
        $this->renderView('payment_view', $data);
    }

    public function ajax_pagination() {
        $filter = array(
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'payment_status_id' => $this->input->post('payment_status_id'),
            'package_type_id' => $this->input->post('package_type_id')
        );
        $count = $this->payment_model->count_pagination($filter);
        $config['div'] = 'result_pagination';
        $config['base_url'] = base_url('payment/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->per_page;
        $config['additional_param'] = "{'start_date' : '" . $this->input->post('start_date') . ",'end_date' : '" . $this->input->post('end_date') . ",'payment_status_id' : '" . $this->input->post('payment_status_id') . ",'package_type_id' : '" . $this->input->post('package_type_id') . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->payment_model->get_pagination($filter, array('start' => $segment, 'limit' => $this->per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/payment_pagination', $data);
    }

    public function check() {
        $payment_id = $this->input->post('payment_id');
        $check = $this->input->post('check');

        $data = array(
            'payment_status_id' => $check,
        );
        $this->payment_model->edit($payment_id, $data);

//        $shop = $this->payment_model->getShop($payment_id);
//        $package = $this->payment_model->getPackage($shop->package_id);
//        $setting = $this->payment_model->get_setting_email();
//
//        if ($package->package_type_id == 1) {
//            if ($check == 2) {
//                //$check_text = 'ผ่าน';            
//                $datashop1 = array(
//                    'shop_sms_all' => ($shop->shop_sms_all + $package->package_amount)
//                );
//                $data_setting1 = array(
//                    'sms_credit' => ($setting->sms_credit - $package->package_amount)
//                );
//
//                // ----- add log -----
//                $this->systemlog->log_sms_credit('+ เติมเครดิต ' . $package->package_amount . ' รวมคงเหลือ ' . ($shop->shop_sms_all + $package->package_amount), $shop->shop_id_pri);
//            } else {
//                //$check_text = 'ไม่ผ่าน';
//                $datashop1 = array(
//                    'shop_sms_all' => ($shop->shop_sms_all - $package->package_amount)
//                );
//                $data_setting1 = array(
//                    'sms_credit' => ($setting->sms_credit + $package->package_amount)
//                );
//                // ----- add log -----
//                $this->systemlog->log_sms_credit('- ลบเครดิต ' . $package->package_amount . ' รวมคงเหลือ ' . ($shop->shop_sms_all - $package->package_amount), $shop->shop_id_pri);
//            }
//            $this->payment_model->editShop($shop->shop_id_pri, $datashop1);
//            //------- Setting Credit -----------------
////            $this->payment_model->editSetting($data_setting1);
//        } else if ($package->package_type_id == 2) {
//            if ($check == 2) {
//                //$check_text = 'ผ่าน';            
//                $datashop2 = array(
//                    'shop_transport_all' => ($shop->shop_transport_all + $package->package_amount)
//                );
//                $data_setting2 = array(
//                    'trans_credit' => ($setting->trans_credit - $package->package_amount)
//                );
//                // ----- add log -----
//                $this->systemlog->log_trans_credit('+ เติมเครดิต ' . $package->package_amount . ' รวมคงเหลือ ' . ($shop->shop_transport_all + $package->package_amount), $shop->shop_id_pri);
//            } else {
//                //$check_text = 'ไม่ผ่าน';
//                $datashop2 = array(
//                    'shop_transport_all' => ($shop->shop_transport_all - $package->package_amount)
//                );
//                $data_setting2 = array(
//                    'trans_credit' => ($setting->trans_credit + $package->package_amount)
//                );
//                // ----- add log -----
//                $this->systemlog->log_trans_credit('- ลบเครดิต ' . $package->package_amount . ' รวมคงเหลือ ' . ($shop->shop_transport_all - $package->package_amount), $shop->shop_id_pri);
//            }
//            $this->payment_model->editShop($shop->shop_id_pri, $datashop2);
//            //------- Setting Credit -----------------
//            $this->payment_model->editSetting($data_setting2);
//        }
        echo $check;
    }

}
