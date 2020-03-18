<?php
class UserAccount extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function setAccountType($user_id,$accountType) {
        //This function sets the account type using the UserID and hte account type given,
        //Which currently is only "admin" or "" (blank)
        $data = array(
            'account_type' => $accountType,
        );
        echo "user_id: ".$user_id." Admin: ".$accountType;
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    public function isUserAdmin($user_id) {
        //This function checks if the user from the given userID is a administrator
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        $return = $query->row();
        if($return->account_type === "admin") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function darkModeEnabled($user_id) {
        //Using the given user_id this function checks wether the given user has enabled darkmode
        if(empty($user_id)) {
            return FALSE;
        } else {
            $query = $this->db->get_where('users', array('user_id' => $user_id));
            $return = $query->row();
            if($return->dark_mode === "1") {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function setProfileImage($user_id,$profileImage) {
        //This function sets the given user from the userID profile picture
        $data = array(
            'profile_image' => $profileImage,
        );
        echo "user_id: ".$user_id." Admin: ".$profileImage;
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    public function setDarkMode($user_id,$darkMode) {
        //This function enabled or disables darkmode for the given user from the userID
        $data = array(
            'dark_mode' => $darkMode,
        );
        echo "user_id: ".$user_id." DarkMode: ".$darkMode;
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

}

?>