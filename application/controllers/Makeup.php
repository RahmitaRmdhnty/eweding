<?php

class Makeup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('data') || $this->session->userdata('data') == "" || $this->session->userdata('data') === null) {
            redirect('auth');
        }
    }
    function index()
    {
        $this->load->view('templates/home_header');
        $this->load->view('menu/makeup');
        $this->load->view('templates/home_footer');
    }
}
