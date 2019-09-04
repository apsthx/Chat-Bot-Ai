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
            'icon' => 'fa fa-user-circle',
            'title' => 'ประวัติส่วนตัว',
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
            'data' => $this->profile_model->getAdmin($this->session->userdata('admin_id'))->row(),
        );
        $this->renderView('profile_view', $data);
    }

    public function edit() {
        $data = array(
            'admin_fullname' => $this->input->post('admin_fullname'),
            'admin_modify' => $this->misc->getdate()
        );
        $this->profile_model->edit($this->input->post('admin_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url() . 'profile');
    }

    public function profileeditpassword() {
        $data = array(
            'admin_username' => $this->input->post('admin_username')
        );
        $this->load->view('modal/profile_editpassword', $data);
    }

    public function editpassword() {
        $admin_id = $this->session->userdata('admin_id');
        $admin_username = $this->input->post('admin_username');
        $newpassword = $this->input->post('newpassword');
        
        $password = hash('sha256', $admin_username . $this->input->post('oldpassword'));
        $checkpassword = $this->profile_model->checkPassword($admin_id, $password);
        if ($checkpassword->num_rows() == 1) {
            if ($newpassword == $this->input->post('confirmpassword')) {
                $data = array(
                    'admin_password' => hash('sha256', $admin_username . $newpassword),
                );
                $this->profile_model->edit($admin_id, $data);
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
        $admin_id = $this->session->userdata('admin_id');
        $config = array(
            'upload_path' => "./assets/upload/admin/",
            'allowed_types' => 'gif|jpg|jpeg|png',
            'overwrite' => 1,
            'max_size' => 8192,
            'file_name' => 'profile_' . $admin_id . '_' . date('YmdHis')
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
                $photo = $this->profile_model->getPhoto($admin_id);
                if ($photo != 'none.png') {
                    @unlink('assets/upload/admin/' . $photo);
                }
                $data = $this->upload->data();

                $data_admin = array(
                    'admin_image' => $data['file_name'],
                    'admin_modify' => $this->misc->getDate()
                );
                $this->profile_model->edit($admin_id, $data_admin);

                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function save_theme() {
        $data = array(
            'admin_style' => $this->input->post('style_theme'),
            'admin_modify' => $this->misc->getDate()
        );
        $this->profile_model->edit($this->session->userdata('admin_id'), $data);
        echo 1;
    }

}
