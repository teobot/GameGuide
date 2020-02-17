<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Consider if it would be best to autoload some of the helpers from here.
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');

        // Load in your Models below.
        $this->load->model('HomeModel');
        
        // Consider creating new Models for different functionality.
    }

    public function index()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('username');
        $data = [];
        $this->load->view('login', $data);
    }
}