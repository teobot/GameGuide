<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

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
    }

    public function index()
    {
        // Get the data from our Home Model.
        $data['result'] = $this->HomeModel->getGame();

        //Load the view and send the data accross.
        $this->load->view('template/header');
        $this->load->view('home', $data);
        $this->load->view('template/footer');
    }

    public function review($slug = NULL)
    {
        $data['review'] = $this->HomeModel->getReview($slug);

        if (empty($data['review']))
        {
            show_404();
        }

        //Load the view and send the data accross.
        $this->load->view('template/header');
        $this->load->view('review', $data);
        $this->load->view('template/footer');
    }
}