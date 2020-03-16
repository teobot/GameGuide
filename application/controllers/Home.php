<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Loading helpers here ...
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');
        // Loading helpers here ...

        // Loading models used here ...
        $this->load->model('HomeModel');
        $this->load->model('LoginModel');
        $this->load->model('CommentModel');
        $this->load->model('UserAccount');
        // Loading models used here ...
    }

    public function index()
    {
        // index.php
        //
        // This is the landing page for the website, This page shows the current reviews that have been posted. 

        // Get a array of all the current game reviews, and save it to the data array
        $data['result'] = $this->HomeModel->getGame();

        //Check if the user is logged in and therefore if they have darkmode enabled
        if (empty($this->input->cookie("user_id"))) {
            $headerData["darkMode"] = FALSE;
        } else {
            $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
        }

        //Load the view and send the data accross
        $this->load->view('template/header', $headerData);
        $this->load->view('home', $data);
        $this->load->view('template/footer');
    }

    public function get_Comments() {
        //This gets the comments based on the posted slug and returns the comments in a array,
        //the function then json encodes the result so that the VueJS can parse the result.
        $data = $this->CommentModel->getComments( $this->input->get("slug") );
        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function post_comment() {
        //This function gathers the users comment inforamtion from the post and then submits that to a postComment model function
        //so the comment can be inserted.
        $user_comment = $this->input->post("comment");
        $user_id = $this->input->cookie("user_id");
        $location_slug = $this->input->post("slug");
        $this->CommentModel->postComment($user_comment, $user_id, $location_slug);     
    }

    public function review($slug = NULL)
    {
        // index.php/review/game-review-slug
        //
        // This function displays the review information from the selected review,
        // Using the slug, the function sends it off to the HomeModel model, which returns all the inforamtion on the specific review
        $data['review'] = $this->HomeModel->getReview($slug);
        $data['loggedIn'] = $this->LoginModel->userLoggedIn();

        //If the return is null, then you user has inputted a incorrrect link and should be shown a 404 page
        if (empty($data['review']))
        {
            show_404();
        }

        //If the user is logged in then return if they have darkmode enabled for the header to display darkmode.
        if (empty($this->input->cookie("user_id"))) {
            $headerData["darkMode"] = FALSE;
        } else {
            $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
        }

        //Load the view and send the data accross.
        $this->load->view('template/header', $headerData);
        $this->load->view('review', $data);
        $this->load->view('template/footer');
    }

}