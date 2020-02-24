<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Consider if it would be best to autoload some of the helpers from here.
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');

        // Load in your Models below.
        $this->load->model('LoginModel');
        
    }

    public function index() {
        //User has to be logged in to view the account page
        if($this->LoginModel->userLoggedIn()) {
            //User is logged in so let them view and update
            //Get the current information and insert
            $username = $this->input->cookie("username");
            $password = $this->input->cookie("password");
            $userInfo = $this->LoginModel->userExists($username,$password);
            
            $this->load->view('template/header',);
            $this->load->view('account', $userInfo);
            $this->load->view('template/footer');
        } else {
            //User is not logged in so redirect back to the login screen with error message
            $error["err"] = '<div class="alert alert-danger" role="alert">Must login first before accessing the account page!</div>';
            $this->load->view('template/header',);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }

    public function updateAccount() {
        //Check if the values are valid then send to the model for update,
         if($this->LoginModel->userLoggedIn()) {
            if( ($this->input->post('username') !== "") && ($this->input->post('password') !== "") && ($this->input->post('profile_image') !== "") ) {
                //User has submitted data to be updated to their account
                $username = $this->input->post("username");
                $password  = $this->input->post("password");
                $userData = $this->LoginModel->userExists($this->input->cookie("username"), $this->input->cookie("password"));
                $profile_image  = $this->input->post("profile_image");
                $profile_image_selection = array("/default.jpg", "/mmuDark.jpg", "/mmu.jpg");
                $this->LoginModel->updateUserDetails($username,$password,$profile_image_selection[$profile_image], $userData["user_id"] );
                //Succesfully updated now reset the cookies and send them back to the account update page
                $this->input->set_cookie(array(
                    'name'   => 'username',
                    'value'  => $username,
                    'expire' => '3600',
                ));
                $this->input->set_cookie(array(
                    'name'   => 'password',
                    'value'  => $password,
                    'expire' => '3600',
                ));
                redirect('home', 'refresh');
            } else {
                //User has not submitted the correct data
                $userInfo["err"] = '<div class="alert alert-danger" role="alert">You must have a username and password!</div>';
                $userInfo["username"] = $this->input->cookie("username");
                $userInfo["password"] = $this->input->cookie("password");
                $this->load->view('template/header',);
                $this->load->view('account', $userInfo);
                $this->load->view('template/footer');
            }
        } else {
            //User is not logged in so redirect back to the login screen with error message
            $error["err"] = '<div class="alert alert-danger" role="alert">Must login first before accessing the account page!</div>';
            $this->load->view('template/header',);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }
}