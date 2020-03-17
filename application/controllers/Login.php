<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        // Loading helpers here ...
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');
        // Loading helpers here ...

        // Loading models here ...
        $this->load->model('LoginModel');
        // Loading models here ...
        
    }

    public function notyou() {
        //This function deletes the cookies stored by the user, This allows users to Logout.
        delete_cookie('username');
        delete_cookie('user_id');
        redirect('Home', 'refresh');
    }

    public function index()
    {
        // index.php/Login
        //
        // This function is for logging the user into the system, If the user inputs a matching username and password
        // The User_id is stored for passing to functions and so is the username for quicker and more responsive customization.

        //If the user is not logged in, then show the login screen, Other redirect them back the home page.
        if(!$this->LoginModel->userLoggedIn()) {
            //The cookie doesn't exist so they aren't logged in
            //Have they submitted values to login?
            if( ($this->input->post('username') !== null) && ($this->input->post('password') !== null) ) {
                //User has submitted values so we need to see if they are valid
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                //Submit the values to the database to check for the account: TODO
                $return = $this->LoginModel->userExists($username, $password);
                if( $return["exist"] ) {
                    //The user does exist, we need to set the cookie to keep them logged in  
                    $this->input->set_cookie(array(
                        'name'   => 'username',
                        'value'  => $return["username"],
                        'expire' => '3600',
                    ));
                    $this->input->set_cookie(array(
                        'name'   => 'user_id',
                        'value'  => $return["user_id"],
                        'expire' => '3600',
                    ));
                    redirect('Home', 'refresh');
                } else {
                    //The users doesn't exist so send them back.
                    if (empty($this->input->cookie("user_id"))) {
                        $headerData["darkMode"] = FALSE;
                    } else {
                        $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                    }
                    $this->load->view('template/header', $headerData);
                    $this->load->view('login', $return);
                    $this->load->view('template/footer');
                }
                //...
            } else {   
                //User hasn't tried to login so give them the login page!
                if (empty($this->input->cookie("user_id"))) {
                    $headerData["darkMode"] = FALSE;
                } else {
                    $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                }
                $this->load->view('template/header', $headerData);
                $this->load->view('login');
                $this->load->view('template/footer');
            }
        } else {
            //The cookie does exist so they must be logged in, send them back to the home page
            redirect('Home', 'refresh');
        }
    }

    public function register() {
        if(!$this->LoginModel->userLoggedIn()) {
            //User isn't logged in so check for posted data otherwise give them the register screen
            if( ($this->input->post('username') !== null) && ($this->input->post('password') !== null) ) {
                //The user isn't logged in and has also filled the form out and submitted
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $userExists = $this->LoginModel->usernameTaken($username, $password);
                if(!$userExists["exist"]) {
                    //Username is free so they can have it,
                    //Insert the data into the users table and log the user in before returning to home
                    $this->LoginModel->insertNewUser($username, $password);
                    $return = $this->LoginModel->userExists($username, $password);
                    if( $return["exist"] ) {
                        //The user does exist, we need to set the cookie to keep them logged in  
                        $this->input->set_cookie(array(
                            'name'   => 'username',
                            'value'  => $return["username"],
                            'expire' => '3600',
                        ));
                        $this->input->set_cookie(array(
                            'name'   => 'user_id',
                            'value'  => $return["user_id"],
                            'expire' => '3600',
                        ));
                        redirect('Home', 'refresh');
                    } else {
                        //The users doesn't exist so send them back.
                    if (empty($this->input->cookie("user_id"))) {
                        $headerData["darkMode"] = FALSE;
                    } else {
                        $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                    }
                        $this->load->view('template/header', $headerData);
                        $this->load->view('login', $return);
                        $this->load->view('template/footer');
                    }    
                } else {
                    //Username is taken so load the page with a err message
                    $data["err"] = '<div class="alert alert-danger" role="alert">Username is taken!</div>';
                    if (empty($this->input->cookie("user_id"))) {
                        $headerData["darkMode"] = FALSE;
                    } else {
                        $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                    }
                    $this->load->view('template/header', $headerData);
                    $this->load->view('register', $data);
                    $this->load->view('template/footer');
                }
            } else {
                //The users isn't logged in and hasn't submitted any data so load the form up
                if (empty($this->input->cookie("user_id"))) {
                    $headerData["darkMode"] = FALSE;
                } else {
                    $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                }
                $this->load->view('template/header', $headerData);
                $this->load->view('register');
                $this->load->view('template/footer');
            }
        } else {
            //The cookie exists so they must be logged in already
            redirect('Home', 'refresh');
        } 
    }

}