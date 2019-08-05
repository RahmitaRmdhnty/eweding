<?php

class Venue extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('data') || $this->session->userdata('data') == "" || $this->session->userdata('data') === null) {
            redirect('auth');
        }

        $this->load->model('Venue_Model');
    }
    function index()
    {
        $data['hasil'] = $this->Venue_Model->get_venue('venue');
        $this->load->view('templates/home_header', $data);
        $this->load->view('menu/venue');
        $this->load->view('templates/home_footer');
    }

    function get_venue()
    {

        // $this->load->view('menu/venue', $data);

        // var_dump($this->data);
    }
}
