<?php
class LoginModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Check if user details are correct
    public function userExists($username, $password) {
        $query = $this->db->query("SELECT username,password,user_id FROM users WHERE username = '$username' AND password = '$password' LIMIT 1");
        $result = $query->result();
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
        if ($this->input->cookie("username")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insertNewUser($username, $password) {
        $data = array(
            'username'=>$username,
            'password'=>$password,
            'profile_image'=>"/default.jpg",
            'account_type'=>""
        );
        $this->db->insert('users',$data);
    }

    public function getAccount($user_id) {
        $query = $this->db->query("SELECT username,password,profile_image FROM users WHERE user_id = '$user_id'");
        $result = $query->result();
        if(empty($result)) {
            $return["failed"] = TRUE;
        } else {
            $return["failed"] = FALSE;
            $return["username"] = $result[0]->username;
            $return["password"] = $result[0]->password;
            $return["profile_image"] = $result[0]->profile_image;
        }
        return $return;
    }

    public function usernameTaken($username) {
        $query = $this->db->query("SELECT username FROM users WHERE username = '$username'");
        if(empty($query->result())) {
            $return["exist"] = FALSE;
        } else {
            $return["err"] = '<div class="alert alert-danger" role="alert">Failed: Username or password is incorrect!</div>';
            $return["exist"] = TRUE;
        }
        return $return;
    }

    public function updateUserDetails($username, $password, $user_id) {

        $usernameTaken = $this->usernameTaken($username);

        if($username===$this->input->cookie("username")) 
        {
            //Username is the same so just update the password and profile_image
            $data = array(
                'password' => $password,
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('users', $data);
            $return["reason"] = '<div class="alert alert-success" role="alert">Successfully update account!</div>';
            $return["success"] = TRUE;
            return $return;
        } else {
            //Username is different so must have been changed, we need to update the all information instead
            if($usernameTaken["exist"]) {
                //Username is taken
                $return["success"] = FALSE;
                $return["reason"] = '<div class="alert alert-danger" role="alert">Username is taken! Please enter a new username.</div>';
            } else {
                //Username is not taken
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