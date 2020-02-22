<?php
class LoginModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Check if user details are correct
    public function userExists($username, $password) {
        $query = $this->db->query("SELECT username FROM users WHERE username = '$username' AND password = '$password' ");
        if(empty($query->result())) {
            $return["exist"] = FALSE;
            $return["data"] = '';
            $return["err"] = '<div class="alert alert-danger" role="alert">Failed: Username or password is incorrect!</div>';
        } else {
            $return["exist"] = TRUE;
            $return["err"] = "";
            $return["data"] = $query->result();
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

}