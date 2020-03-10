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
        $this->load->model('CommentModel');
        $this->load->model('UserAccount');
    }

    public function index()
    {
        // Get the data from our Home Model.
        $data['result'] = $this->HomeModel->getGame();

        //Load the view and send the data accross.
        if (empty($this->input->cookie("user_id"))) {
            $headerData["darkMode"] = FALSE;
        } else {
            $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
        }
        $this->load->view('template/header', $headerData);
        $this->load->view('home', $data);
        $this->load->view('template/footer');
    }

    public function get_Comments() {
        $data = $this->CommentModel->getComments($this->input->get("slug"));
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function review($slug = NULL)
    {
        //If the user has tried to comment then send the data to be inserted
        if ($this->input->post("comment") && $this->input->cookie("username")) {
            
            $user_comment = $this->input->post("comment");
            $user_id = $this->input->cookie("user_id");
            $location_slug = $slug;
            $this->CommentModel->postComment($user_comment, $user_id, $location_slug);
        }

        $data['review'] = $this->HomeModel->getReview($slug);
        $data['loggedIn'] = $this->LoginModel->userLoggedIn();

        if (empty($data['review']))
        {
            show_404();
        }

        //Load the view and send the data accross.
        if (empty($this->input->cookie("user_id"))) {
            $headerData["darkMode"] = FALSE;
        } else {
            $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
        }
        $this->load->view('template/header', $headerData);
        $this->load->view('review', $data);
        $this->load->view('template/footer');
    }

}