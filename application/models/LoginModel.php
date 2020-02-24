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
            $return["data"] = '';
            $return["err"] = '<div class="alert alert-danger" role="alert">Failed: Username or password is incorrect!</div>';
        } else {
            $return["exist"] = TRUE;
            $return["err"] = "";
            $return["username"] = $username;
            $return["password"] = $password;
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

    public function usernameTaken($username) {
        $query = $this->db->query("SELECT username FROM users WHERE username = '$username'");
        if(empty($query->result())) {
            $return["exist"] = FALSE;
            $return["err"] = '<div class="alert alert-danger" role="alert">Failed: Username or password is incorrect!</div>';
        } else {
            $return["exist"] = TRUE;
        }
        return $return;
    }

    public function updateUserDetails($username, $password, $profile_image, $user_id) {
        $data = array(
            'username' => $username,
            'password' => $password,
            'profile_image' => $profile_image
        );
    
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

}