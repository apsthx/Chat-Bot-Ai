<?php

class Notfound extends CI_Controller {

    public function index() {
        $data = array(
            'title' => '404 PAGE NOT FOUND!'
        );
        $this->load->view('notfound_view', $data);
    }

}
