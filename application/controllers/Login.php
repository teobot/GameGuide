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
        $this->load->model('LoginModel');
        
    }

    public function notyou() {
        //DELETE the cookies here
        delete_cookie('username');
        redirect('Home', 'refresh');
    }

    public function index()
    {
        if(!$this->input->cookie('username',true)) {
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
                        'value'  => $username,
                        'expire' => '3600',
                    ));
                    redirect('Home', 'refresh');
                } else {
                    //Load the view and send the data accross.
                    $this->load->view('template/header');
                    $this->load->view('login', $return);
                    $this->load->view('template/footer');
                }
                //...
            } else {   
                //Load the view and send the data accross.
                $this->load->view('template/header',);
                $this->load->view('login');
                $this->load->view('template/footer');
            }
        } else {
            //The cookie does exist so they must be logged in, send them back to the home page
            redirect('Home', 'refresh');
        }
    }
}