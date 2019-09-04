<?php

class Package extends CI_Controller {

    public $group_id = 3;
    public $menu_id = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('package_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('pages/pricing-page.css'),
            'datas' => $this->package_model->getPackage(),
        );
        $this->renderView('package_view', $data);
    }

    public function payment($package_id = NULL) {
        if ($package_id != NULL) {
            $packages = $this->package_model->getPackage($package_id);
            if ($packages->num_rows() == 1) {
                $data = array(
                    'group_id' => $this->group_id,
                    'menu_id' => $this->menu_id,
                    'css' => array('thbanklogos.css'),
                    'css_full' => array('plugin/datepicker/datepicker.css'),
                    'js_full' => array('plugin/datepicker/bootstrap-datepicker.js', 'plugin/datepicker/bootstrap-datepicker.th.js'),
                    'package_id' => $package_id,
                    'package' => $packages->row()
                );
                $this->renderView('package_payment_view', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถทำรายการนี้ได้');
                redirect(base_url('sms'));
            }
        } else {
            $this->session->set_flashdata('flash_message', 'warning,Warning,ไม่สามารถทำรายการนี้ได้');
            redirect(base_url('sms'));
        }
    }

    public function addPayment() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
            'bank_id' => $this->input->post('bank_id'),
            'user_id' => $this->session->userdata('user_id'),
            'payment_by' => $this->input->post('payment_by'),
            'payment_cost' => $this->input->post('payment_cost'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_time' => $this->input->post('payment_time'),
            'payment_status_id' => 1,
            'payment_create' => $this->misc->getDate(),
            'payment_update' => $this->misc->getDate(),
        );
        $payment_id = $this->package_model->add_payment($data);

        $data_evidence['payment_number'] = 'PT' . sprintf('%04d', $payment_id);
        if ($_FILES['payment_evidence']['name'] != '') {
            $payment_evidence = $this->uploadEvidence($payment_id);
            if ($payment_evidence != NULL) {
                $data_evidence['payment_evidence'] = $payment_evidence;
            }
        }
        $this->package_model->edit_payment($payment_id, $data_evidence);
        $this->session->set_flashdata('flash_message', 'success,Success,แจ้งชำระเงินเรียบร้อยแล้ว');
        redirect(base_url('payment'));
    }

    public function uploadEvidence($payment_id) {
        $this->load->library('upload');

        $path = "./assets/upload/evidence";
        $file_name = 'payment_evidence_' . $payment_id . '_' . date('YmdHis');

        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => (5 * 1024),
            'file_name' => $file_name,
            'file_ext_tolower' => TRUE
        );
        $max_width = 1000;
        $max_height = 1000;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('payment_evidence')) {
            $upload = $this->upload->data();
            $link = $upload['file_name'];
            //resize
            $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $config_resize['maintain_ratio'] = TRUE;
            $config_resize['width'] = $max_width;
            $config_resize['height'] = $max_height;
            $this->load->library('image_lib', $config_resize);
            if ($upload['image_width'] > $max_width or $upload['image_height'] > $max_height) {
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors('', '');
                }
            }
            return $link;
        } else {
            return NULL;
        }
    }

}
