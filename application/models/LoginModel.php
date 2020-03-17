<?php
class LoginModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function userExists($username, $password) {
        //This function takes a username and password and checks if the record for the data exists inside the database, 
        //This is used to log a user in and decide if the details given by the registering user can be used
        $query = $this->db->query("SELECT username,password,user_id FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");
        $result = $query->result();
        //If the user exists in the database return the correct details, otherwise return that the user doesn't exist
        if(empty($result)) {
            $return["exist"] = FALSE;
            $return["err"] = '<div class="alert alert-danger" role="alert">Failed: Username or password is incorrect!</div>';
        } else {
            $return["exist"] = TRUE;
            $return["err"] = "";
            $return["username"] = $username;
            $return["user_id"] = $result[0]->user_id;
        }
        return $return;
    }

    public function userLoggedIn() {
        //This checks if the cookie for the username exists, if it does then the user must be logged in.
        if ($this->input->cookie("username")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertNewUser($username, $password) {
        //This inserts the given username and password into the database.
        $data = array(
            'username'=>$username,
            'password'=>$password,
            'profile_image'=>"https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg",
            'account_type'=>""
        );
        $this->db->insert('users',$data);
    }

    public function getAccount($user_id) {
        //This functions using the given userID retrieves the account details for that user
        //This is primary used by the client chat system for getting the details of the user.
        $query = $this->db->query("SELECT * FROM users WHERE user_id = '$user_id'");
        $result = $query->result();
        if(empty($result)) {
            //If the user_id failed getting any user,
            $return["failed"] = TRUE;
        } else {
            //The user_ID does exist so return the data to the array for return
            $return["failed"] = FALSE;
            $return["username"] = $result[0]->username;
            $return["password"] = $result[0]->password;
            if($result[0]->account_type == "admin") {
                $return["isAdmin"] = TRUE;
            } else {
                $return["isAdmin"] = FALSE;
            }
            $return["profile_image"] = $result[0]->profile_image;
        }
        return $return;
    }

    public function usernameTaken($username) {
        //Check if the given username has already been taken, if so then return false
        $query = $this->db->query("SELECT username FROM users WHERE username = '$username'");
        if(empty($query->result())) {
            $return["exist"] = FALSE;
        } else {
            $return["exist"] = TRUE;
        }
        return $return;
    }

    public function updateUserDetails($username, $password, $user_id) {
        //This function updates the userID account with the username and password given,
        
        //Check if the given username is already taken
        $usernameTaken = $this->usernameTaken($username);

        //If the given current username is still the same as the one in the cookie,
        //Then just update the password
        if($username===$this->input->cookie("username")) 
        {
            //Username is the same so just update the password
            $data = array(
                'password' => $password,
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('users', $data);
            $return["reason"] = '<div class="alert alert-success" role="alert">Successfully update account!</div>';
            $return["success"] = TRUE;
            return $return;
        } else {
            //Username is different so must have been changed, we need to update the all information instead,
            //Check if the username is taken, and if it is then return the username taken error message
            if($usernameTaken["exist"]) {
                //username is taken so return a error
                $return["success"] = FALSE;
                $return["reason"] = '<div class="alert alert-danger" role="alert">Username is taken! Please enter a new username.</div>';
            } else {
                //Username is not taken so update both the username and password to the database
                $data = array(
                    'username' => $username,
                    'password' => $password,
                );
                $this->db->where('user_id', $user_id);
                $this->db->update('users', $data);
                $return["reason"] = '<div class="alert alert-success" role="alert">Successfully update account!</div>';
                $return["success"] = TRUE;
            }
            return $return;
        }
    }

}