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
        
        // Consider creating new Models for different functionality.
    }

    public function index()
    {
        // Check to see if the User exists on the homepage. You will need to change this to look up the existance of a cookie.
        $userExists = '';

        // Condition checking if the user exists.
        if (!$userExists)
        {
            //The user doesn't exist so change your page accordigly.
        }
        else
        {
            //The user does exist so change your page accordigly.
        }

        
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

        $this->load->view('template/header');
        $this->load->view('review', $data);
        $this->load->view('template/footer');
    }

    //TODO: Create all other functions as required for further functionality (Comments, Login and so on.)
    // Note: You can redirect to a page by using the redirect function as follows:
    /*
        //Redirect Home
        redirect('http://localhost/games-review');
    */
  
}