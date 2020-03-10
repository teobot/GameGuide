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
        $this->load->model('UserAccount');
        
    }

    public function index() {
        //User has to be logged in to view the account page
        if($this->LoginModel->userLoggedIn()) {
            //User is logged in so let them view and update
            //Get the current information and insert
            $user_id = $this->input->cookie("user_id");
            $userInfo = $this->LoginModel->getAccount($user_id);

            if($this->UserAccount->isUserAdmin($this->input->cookie("user_id"))) {
                $userInfo["adminChecked"] = "checked-active";
            } else {
                $userInfo["adminChecked"] = "";
            }

            if($this->UserAccount->darkModeEnabled($this->input->cookie("user_id"))) {
                $userInfo["darkModeChecked"] = "checked-active";
            } else {
                $userInfo["darkModeChecked"] = "";
            }

            $userInfo["err"] = "";
            
            if (empty($this->input->cookie("user_id"))) {
                $headerData["darkMode"] = FALSE;
            } else {
                $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
            }
            $this->load->view('template/header', $headerData);
            $this->load->view('account', $userInfo);
            $this->load->view('template/footer');
        } else {
            //User is not logged in so redirect back to the login screen with error message
            $error["err"] = '<div class="alert alert-danger" role="alert">Must login first before accessing the account page!</div>';
            if (empty($this->input->cookie("user_id"))) {
                $headerData["darkMode"] = FALSE;
            } else {
                $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
            }
            $this->load->view('template/header', $headerData);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }

    public function updateAccount() {
        //Check if the values are valid then send to the model for update,
         if($this->LoginModel->userLoggedIn()) {
            if( ($this->input->post('username') !== "") && ($this->input->post('password') !== "") ) {
                //User has submitted data to be updated to their account
                $username = $this->input->post("username");
                $password  = $this->input->post("password");

                $update = $this->LoginModel->updateUserDetails($username,$password, $this->input->cookie("user_id") );

                if($update["success"]) {
                    //Succesfully updated now reset the cookies and send them back to the account update page
                    $this->input->set_cookie(array(
                        'name'   => 'username',
                        'value'  => $username,
                        'expire' => '3600',
                    ));
                    redirect('account', 'refresh');
                } else {
                    //The update has failed
                    $userInfo["err"] = $update["reason"];
                    $userInfo["username"] = $this->input->cookie("username");
                    $userInfo["password"] = $this->LoginModel->getAccount($this->input->cookie("user_id"))["password"];                     
                    if($this->UserAccount->isUserAdmin($this->input->cookie("user_id"))) {
                        $userInfo["adminChecked"] = "checked-active";
                    } else {
                        $userInfo["adminChecked"] = "";
                    }
                    if($this->UserAccount->darkModeEnabled($this->input->cookie("user_id"))) {
                        $userInfo["darkModeChecked"] = "checked-active";
                    } else {
                        $userInfo["darkModeChecked"] = "";
                    }
                    if (empty($this->input->cookie("user_id"))) {
                        $headerData["darkMode"] = FALSE;
                    } else {
                        $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                    }
                    $this->load->view('template/header', $headerData);
                    $this->load->view('account', $userInfo);
                    $this->load->view('template/footer');
                }

            } else {
                //User has not submitted the correct data
                $userInfo["err"] = '<div class="alert alert-danger" role="alert">You must have a username and password!</div>';
                $userInfo["username"] = $this->input->cookie("username");
                $userInfo["password"] = $this->LoginModel->getAccount($this->input->cookie("user_id"))["password"];
                if (empty($this->input->cookie("user_id"))) {
                    $headerData["darkMode"] = FALSE;
                } else {
                    $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                }
                $this->load->view('template/header', $headerData);
                $this->load->view('account', $userInfo);
                $this->load->view('template/footer');
            }
        } else {
            //User is not logged in so redirect back to the login screen with error message
            $error["err"] = '<div class="alert alert-danger" role="alert">Must login first before accessing the account page!</div>';
            if (empty($this->input->cookie("user_id"))) {
                $headerData["darkMode"] = FALSE;
            } else {
                $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
            }
            $this->load->view('template/header', $headerData);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }

    public function setAdmin()
    {
        $accountType = $this->input->post("accountType");
        echo $accountType;
        $this->UserAccount->setAccountType($this->input->cookie('user_id'),$accountType);
    }

    public function setDarkMode()
    {
        $darkMode = $this->input->post("darkMode");
        echo $darkMode;
        $this->UserAccount->setDarkMode($this->input->cookie('user_id'),$darkMode);
    }

    public function setProfileImage()
    {
        $profileImage = $this->input->post("image");
        echo $profileImage;
        $this->UserAccount->setProfileImage($this->input->cookie('user_id'),$profileImage);
    }

}