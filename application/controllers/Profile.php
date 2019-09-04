<?php

class Profile extends CI_Controller {

    public $menu_id = '';
    public $group_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('profile_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js', 'plugin/styleswitcher/jQuery.style.switcher.js'),
            'data' => $this->profile_model->getUser($this->session->userdata('user_id'))->row(),
            'data_loglogin' => $this->profile_model->getLoglogin($this->session->userdata('user_id')),
        );
        $this->renderView('profile_view', $data);
    }

    public function save_theme() {
        $data = array(
            'user_style' => $this->input->post('style_theme'),
            'user_update' => $this->misc->getDate()
        );
        $this->profile_model->edit($this->session->userdata('user_id'), $data);
        echo 1;
    }

    public function edit() {
        $data = array(
            'user_fullname' => $this->input->post('user_fullname'),
            'user_address' => $this->allowText($this->input->post('user_address')),
            'user_comment' => $this->allowText($this->input->post('user_comment')),
            'user_update' => $this->misc->getdate()
        );
        // update session lang
        $this->profile_model->edit($this->session->userdata('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,บันทึกข้อมูลเรียบร้อยแล้ว');
        redirect(base_url() . 'profile');
    }

    public function modalEditPassword() {
        $data = array(
            'username' => $this->input->post('username')
        );
        $this->load->view('modal/profile_edit_password_modal', $data);
    }

    public function editPassword() {
        $user_id = $this->session->userdata('user_id');
        $username = $this->input->post('username');
        $newpassword = $this->input->post('newpassword');

        $password = hash('sha256', $username . $this->input->post('oldpassword'));
        $checkpassword = $this->profile_model->checkPassword($user_id, $password);
        if ($checkpassword->num_rows() == 1) {
            if ($newpassword == $this->input->post('confirmpassword')) {
                $data = array(
                    'password' => hash('sha256', $username . $newpassword),
                );
                $this->profile_model->edit($user_id, $data);
                echo 1;
            } else {
                echo 3;
            }
        } else {
            echo 2;
        }
    }

    public function upload_image() {
        $this->load->library('upload');
        $user_id = $this->session->userdata('user_id');
        $config = array(
            'upload_path' => "./assets/upload/user/",
            'allowed_types' => 'jpg|jpeg|gif|png',
            'overwrite' => 1,
            'max_size' => 8192,
            'file_name' => 'profile_' . $user_id . '_' . date('YmdHis')
        );
        $this->upload->initialize($config);

        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $json = array();
            if ($this->upload->do_upload('image')) {
                $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
                $config_resize['maintain_ratio'] = TRUE;
                $config_resize['width'] = 400;
                $config_resize['height'] = 400;
                $this->load->library('image_lib', $config_resize);
                if ($this->upload->image_width > 400 || $this->upload->image_height > 400) {
                    $this->image_lib->resize();
                }
                $photo = $this->profile_model->getphoto($user_id);
                if ($photo != 'none.png') {
                    @unlink('assets/upload/user/' . $photo);
                }
                $data = $this->upload->data();

                $data_user = array(
                    'user_image' => $data['file_name'],
                    'user_update' => $this->misc->getDate()
                );
                $this->profile_model->edit($user_id, $data_user);

                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function allowText($text) {
        $allow = "/([^a-zA-Z0-9ก-๙เ .\/,+*])/";
        return preg_replace($allow, '', $text);
    }

}
