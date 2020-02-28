<?php
class UserAccount extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function setAccountType($user_id,$accountType) {
        $data = array(
            'account_type' => $accountType,
        );

        echo "user_id: ".$user_id." Admin: ".$accountType;

        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

    public function isUserAdmin($user_id) {
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        $return = $query->row();
        if($return->account_type === "admin") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function setProfileImage($user_id,$profileImage) {
        $data = array(
            'profile_image' => $profileImage,
        );

        echo "user_id: ".$user_id." Admin: ".$profileImage;

        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }

}

?>