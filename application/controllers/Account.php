<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        // Load my helpers ...
        $this->load->helper('url');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->helper('cookie');
        // Load my helpers ...


        // Loading models ...
        $this->load->model('LoginModel');
        $this->load->model('UserAccount');
        // Loading models ...
        
    }

    public function index() {
        // index.php/account
        //
        // This is the landing page for the account, Here it displays the change account form and switch button for admin and darkmode

        //User has to be logged in to view the account page
        if($this->LoginModel->userLoggedIn()) {
            //User is logged in so let them view and update
            //Get the current account information and send it to the view
            $user_id = $this->input->cookie("user_id");
            $userInfo = $this->LoginModel->getAccount($user_id);

            //If the user is admin, check the admin switch button
            if($this->UserAccount->isUserAdmin($this->input->cookie("user_id"))) {
                $userInfo["adminChecked"] = "checked-active";
            } else {
                $userInfo["adminChecked"] = "";
            }

            //If the user has enabled darkmode, enable the dark mode switch button
            if($this->UserAccount->darkModeEnabled($this->input->cookie("user_id"))) {
                $userInfo["darkModeChecked"] = "checked-active";
            } else {
                $userInfo["darkModeChecked"] = "";
            }

            //This displays any error when setting details, Set to empty for just getting to the page
            $userInfo["err"] = "";
            
            //If the user isn't logged in then set DarkMode to false, otherwise check wether they want it on or off
            if (empty($this->input->cookie("user_id"))) {
                $headerData["darkMode"] = FALSE;
            } else {
                $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
            }

            //Load the views, pushing the collected data to them
            $this->load->view('template/header', $headerData);
            $this->load->view('account', $userInfo);
            $this->load->view('template/footer');
        } else {
            //User is not logged in so redirect back to the login screen with error message
            $error["err"] = '<div class="alert alert-danger" role="alert">Must login first before accessing the account page!</div>';
            
            //If the user isn't logged in then set darkmode to false, otherwsise check wether they want it on or off
            if (empty($this->input->cookie("user_id"))) {
                $headerData["darkMode"] = FALSE;
            } else {
                $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
            }

            //Load the views, Pusing the collected data to them
            $this->load->view('template/header', $headerData);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }

    public function updateAccount() {
        // index.php/account/update-details
        //
        // This page looks for data inputted from the form on the account page, and if the data is valid, send it to the model to be updated

        //Check if the user is logged in first
         if($this->LoginModel->userLoggedIn()) {
            //Check for user input from the form, using the post helper
            if( ($this->input->post('username') !== "") && ($this->input->post('password') !== "") ) {
                //User has submitted data to be updated to their account
                //Save the data submitted to some variables
                $username = $this->input->post("username");
                $password  = $this->input->post("password");

                //Send the data that has been submitted to the model to be updated within the account
                $update = $this->LoginModel->updateUserDetails($username,$password, $this->input->cookie("user_id") );

                //The update has returned succesful, so update the cookie and redirect back to the account page
                if($update["success"]) {
                    //Succesfully updated now reset the cookies and send them back to the account update page
                    $this->input->set_cookie(array(
                        'name'   => 'username',
                        'value'  => $username,
                        'expire' => '3600',
                    ));
                    redirect('account', 'refresh');
                } else {
                    //The update has failed so display a error messsage and place the form values back into the view
                    $userInfo["err"] = $update["reason"];
                    $userInfo["username"] = $this->input->cookie("username");
                    $userInfo["password"] = $this->LoginModel->getAccount($this->input->cookie("user_id"))["password"];
                    
                    //If the user is admin then check the switch button
                    if($this->UserAccount->isUserAdmin($this->input->cookie("user_id"))) {
                        $userInfo["adminChecked"] = "checked-active";
                    } else {
                        $userInfo["adminChecked"] = "";
                    }

                    //If the user has enabled darkmode, then enable the switch button
                    if($this->UserAccount->darkModeEnabled($this->input->cookie("user_id"))) {
                        $userInfo["darkModeChecked"] = "checked-active";
                    } else {
                        $userInfo["darkModeChecked"] = "";
                    }

                    //If the user isn't logged in then disable darkmode, otherwise check if they want darkMode enabled or disabled
                    if (empty($this->input->cookie("user_id"))) {
                        $headerData["darkMode"] = FALSE;
                    } else {
                        $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                    }

                    //Load the collected data into the views
                    $this->load->view('template/header', $headerData);
                    $this->load->view('account', $userInfo);
                    $this->load->view('template/footer');
                }

            } else {
                //User has not submitted the correct data, or hasn't submitted both a username or password
                //Display the message that they must submitt both a username and password,
                //Then reset the values for the form and switch buttons
                $userInfo["err"] = '<div class="alert alert-danger" role="alert">You must have a username and password!</div>';
                $userInfo["username"] = $this->input->cookie("username");
                $userInfo["password"] = $this->LoginModel->getAccount($this->input->cookie("user_id"))["password"];
                if (empty($this->input->cookie("user_id"))) {
                    $headerData["darkMode"] = FALSE;
                } else {
                    $headerData["darkMode"] = $this->UserAccount->darkModeEnabled($this->input->cookie("user_id"));
                }

                //Load the collected data back into the views
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

            //Load the views, saying that they must be logged in to view this page
            $this->load->view('template/header', $headerData);
            $this->load->view('login', $error);
            $this->load->view('template/footer');
        }
    }

    public function setAdmin()
    {
        //This function sets the account type of the user to the posted value, either "admin" or "".
        $accountType = $this->input->post("accountType");
        echo $accountType;
        $this->UserAccount->setAccountType($this->input->cookie('user_id'),$accountType);
    }

    public function setDarkMode()
    {
        //This function sets the value for darkMode, its either 1 or 0, with 1 being enabled.
        $darkMode = $this->input->post("darkMode");
        echo $darkMode;
        $this->UserAccount->setDarkMode($this->input->cookie('user_id'),$darkMode);
    }

    public function setProfileImage()
    {
        //This function sets the profile picture of the account for the comment section, the values for what this can be is in the VueJS "CustomVue.js" script.
        $profileImage = $this->input->post("image");
        echo $profileImage;
        $this->UserAccount->setProfileImage($this->input->cookie('user_id'),$profileImage);
    }

    public function getAccountDetails(){
        //This functions returns the account details based from the cookie saved, This is used for the chat System, so the VueJS can easily save and receieve the account details.
        if(!empty($this->input->cookie("user_id"))) {
            //If the user has a userID they must be logged on so collect the account details from the getAccount Model
            $return = $this->LoginModel->getAccount($this->input->cookie("user_id"));
            header('Content-Type: application/json');
            echo json_encode($return);
        } else {
            //The user isn't logged in so return failed, The privilages of the user will now be restricted
            $return["failed"] = TRUE;
            header('Content-Type: application/json');
            echo json_encode($return);
        }
    }

}