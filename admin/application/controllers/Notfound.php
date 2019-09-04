<?php

class Notfound extends CI_Controller {

    public function index() {
        $data = array(
            'title' => '404 Error!'
        );
        $this->load->view('notfound_view', $data);
    }

}
