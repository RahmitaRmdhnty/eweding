<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('data') || $this->session->userdata('data') == "" || $this->session->userdata('data') === null) {
            redirect('home');
        }
    }
    public function index()
    {
        // var_dump($this->session->userdata('data'));
        $this->load->view('templates/home_header');
        $this->load->view('home/home');
        $this->load->view('templates/home_footer');
    }

    public function todolist()
    {
        $this->load->view('templates/home_header');
        $this->load->view('todolist/');
        $this->load->view('templates/home_footer');
    }
}
