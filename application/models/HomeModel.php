<?php
class HomeModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Get for all games
    public function getGame()
    {
        $query = $this->db->query("SELECT * FROM reviews");
        return $query->result();
    }

    //Get the details for a game once it has been clicked on.
    public function getReview($slug = FALSE)
    {
        $query = $this->db->get_where('reviews', array('slug' => $slug));
        return $query->row_array();
    }

    public function getComments($slug = false) {
        $query = $this->db->query("SELECT * FROM comments INNER JOIN users USING(user_id) WHERE review_slug = '$slug'");
        return $query->result();
    }

    public function postComment($comment, $username, $slug) {
        $userID = $this->db->query("SELECT user_id FROM users WHERE username = '$username'");
        $result = $userID->row_array();
        $user_id = $result["user_id"];
        $query = $this->db->query("INSERT INTO comments (user_id, review_slug, comment_text) VALUES ($user_id, '$slug', '$comment' )");
    }
}