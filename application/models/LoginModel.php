<?php
class LoginModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Check if user details are correct
    public function userExists($username, $password) {
        $query = $this->db->query("SELECT username FROM users WHERE username = '$username' AND password = '$password' ");
        $return["exist"] = TRUE;
        $return["data"] = $query->result();
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