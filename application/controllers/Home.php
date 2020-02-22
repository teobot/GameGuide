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
        $this->load->model('LoginModel');
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
        //LOOK FOR THE USERS COMMIT INFORMATION AND PUSH IT TO THE MODEL
        if ($this->input->post("comment") && $this->input->cookie("username")) {
            $user_comment = $this->input->post("comment");
            $username = $this->input->cookie("username");
            $location_slug = $slug;
            $this->HomeModel->postComment($user_comment, $username, $location_slug);
        }

        $data['review'] = $this->HomeModel->getReview($slug);
        $data['comments'] = $this->HomeModel->getComments($slug);
        $data['loggedIn'] = $this->LoginModel->userLoggedIn();

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