<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teams
 *
 * @author nut_channarong
 */
class Teams extends CI_Controller {

    //put your code here
    public $group_id = 1;
    public $menu_id = 15;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('teams_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/styleswitcher/jQuery.style.switcher.js', 'plugin/fancybox/dist/jquery.fancybox.js'),
        );
        $this->renderView('teams_view', $data);
    }

    public function ajax_pagination() {
        $per_page = $this->input->post('per_page');
        $filter = array(
            'searchtext' => $this->input->post('searchtext'),
            'package_id' => $this->input->post('package_id'),
            'teams_status_id' => $this->input->post('teams_status_id')
        );
        $count = $this->teams_model->count_pagination($filter);
        $config['div'] = 'result-pagination';
        $config['base_url'] = base_url('teams/ajax_pagination');
        $config['total_rows'] = $count;
        $config['per_page'] = $per_page;
        $config['additional_param'] = "{'searchtext' : '" . $this->input->post('searchtext') . "','package_id' : '" . $this->input->post('package_id') . "','teams_status_id' : '" . $this->input->post('teams_status_id') . "','per_page' : '" . $per_page . "'}";
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'data' => $this->teams_model->get_pagination($filter, array('start' => $segment, 'limit' => $per_page)),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links()
        );
        $this->load->view('ajax/teams_pagination', $data);
    }

    public function addteams() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            //'js' => array('thailand-db/dependencies/JQL.min.js', 'thailand-db/dependencies/typeahead.bundle.js', 'thailand-db/jquery.Thailand.min.js'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
        );
        $this->renderView('teamsadd_view', $data);
    }

    public function checkusername() {
        $check = $this->teams_model->checkUsername($this->input->post('username'));
        if ($check > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add() {
        $package_id = $this->input->post('package_id');
        $package = $this->teams_model->getpackage($package_id)->row();
        $teams_package_expire = date('Y-m-d', strtotime(date('Y-m-d') . "+ $package->package_date day"));
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $datateams = array(
            'teams_name' => $this->input->post('teams_name'),
            'teams_status_id' => 1,
            'package_id' => $package_id,
            'teams_package_date' => $this->misc->getDate(),
            'teams_package_expire' => $teams_package_expire,
            'teams_create' => $this->misc->getDate(),
            'teams_update' => $this->misc->getDate()
        );
        $teams_id = $this->teams_model->addTeams($datateams);
        $this->systemlog->log_package($package_id, $teams_id);
        $teams_code = 'T' . ($teams_id > 999 ? sprintf('%04d', $teams_id) : sprintf('%03d', $teams_id));
        $this->teams_model->editTeams($teams_id, array('teams_code' => $teams_code));
        $password_conv = hash('sha256', $username . $password);
        $datauser = array(
            'username' => $username,
            'password' => $password_conv,
            'teams_id' => $teams_id,
            'user_fullname' => $this->input->post('user_fullname'),
            'user_email' => $this->input->post('user_email'),
            'user_tel' => $this->input->post('user_tel'),
            'user_image' => 'none.png',
            'role_id' => 1,
            'user_status_id' => 1,
            'user_style' => 'purple-dark',
            'user_create' => $this->misc->getDate(),
            'user_update' => $this->misc->getDate()
        );
        $user_id = $this->teams_model->addUser($datauser);
        $this->session->set_flashdata('flash_message', 'success,Success,เพิ่มข้อมูลสำเร็จ');
        redirect('teams');
    }

    public function detail($teams_id, $active = NULL) {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            //'js' => array('thailand-db/dependencies/JQL.min.js', 'thailand-db/dependencies/typeahead.bundle.js', 'thailand-db/jquery.Thailand.min.js'),
            'css_full' => array('plugin/fancybox/dist/jquery.fancybox.css'),
            'js_full' => array('plugin/fancybox/dist/jquery.fancybox.js'),
            'teams_id' => $teams_id,
            'active' => $active
        );
        $this->renderView('teamsdetail_view', $data);
    }

    public function teamsuserdetail() {
        $data = array(
            'teams_id' => $this->input->post('teams_id')
        );
        $this->load->view('ajax/teamsuserdetail_load', $data);
    }

    public function modaledit() {
        $id = $this->input->post('teams_id');
        $data = array(
            'data' => $this->teams_model->get_teams($id)->row(),
        );
        $this->load->view('modal/teams_edit', $data);
    }

    public function edit() {
        if ($this->input->post('teams_id') != null) {
            $teams_id = $this->input->post('teams_id');
            //if ($this->input->post('package_id') != $this->input->post('package_id_update')) {
            $package_id = $this->input->post('package_id_update');
            $package = $this->teams_model->getpackage($package_id)->row();
            $teams = $this->teams_model->checkteams($teams_id)->row();
            if ($teams->teams_package_expire > date('Y-m-d')) {
                $teams_package_expire = date('Y-m-d', strtotime($teams->teams_package_expire . " + $package->package_date days"));
            } else {
                $teams_package_expire = date('Y-m-d', strtotime(date('Y-m-d') . "+ $package->package_date days"));
            }
            $data = array(
                'teams_name' => $this->input->post('teams_name'),
                'package_id' => $package_id,
                'teams_package_date' => $this->misc->getDate(),
                'teams_package_expire' => $teams_package_expire,
                'teams_update' => $this->misc->getDate()
            );
//            } else {
//                $data = array(
//                    'teams_name' => $this->input->post('teams_name'),
//                    'teams_update' => $this->misc->getDate()
//                );
//            }
            $this->teams_model->edit($teams_id, $data);
            $this->systemlog->log_package($package_id, $teams_id);
            $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
            redirect('teams');
        } else {
            redirect(base_url());
        }
    }

    public function modaleditstatus() {
        $data = array(
            'teams_id' => $this->input->post('teams_id'),
        );
        $this->load->view('modal/teams_editstatus', $data);
    }

    public function editstatus() {
        $this->teams_model->edit($this->input->post('teams_id'), array('teams_status_id' => 2, 'teams_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect(base_url('teams'));
    }

    public function editchangestatus() {
        $this->teams_model->edit($this->input->post('teams_id'), array('teams_status_id' => 1, 'teams_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function modalusereditstatus() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'teams_id' => $this->input->post('teams_id'),
        );
        $this->load->view('modal/teamsuser_editstatus', $data);
    }

    public function edituserstatus() {
        $this->teams_model->edituser($this->input->post('user_id'), array('user_status_id' => 2, 'user_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        redirect('teams/detail/' . $this->input->post('teams_id'));
    }

    public function edituserchangestatus() {
        $this->teams_model->edituser($this->input->post('user_id'), array('user_status_id' => 1, 'user_update' => $this->misc->getdate()));
        $this->session->set_flashdata('flash_message', 'success,Success,อัพเดทข้อมูลเรียบร้อยเเล้ว');
        echo 1;
    }

    public function modaledituser($user_id) {
        $data = array(
            'data' => $this->teams_model->getuserid($user_id)
        );
        $this->load->view('modal/teams_edituser', $data);
    }

    public function edituser() {
        if ($this->input->post('password') != '') {
            $data = array(
                'user_fullname' => $this->input->post('user_fullname'),
                'user_tel' => $this->input->post('user_tel'),
                'user_email' => $this->input->post('user_email'),
                'password' => hash('sha256', $this->input->post('username') . $this->input->post('password')),
                'user_update' => $this->misc->getdate()
            );
        } else {
            $data = array(
                'user_fullname' => $this->input->post('user_fullname'),
                'user_tel' => $this->input->post('user_tel'),
                'user_email' => $this->input->post('user_email'),
                'user_update' => $this->misc->getdate()
            );
        }

        $this->teams_model->edituser($this->input->post('user_id'), $data);
        $this->session->set_flashdata('flash_message', 'success,Success,แก้ไขข้อมูลเรียบร้อยเเล้ว');
        redirect('teams/detail/' . $this->input->post('teams_id') . '/user');
    }

}
