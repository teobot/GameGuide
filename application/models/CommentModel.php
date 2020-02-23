<?php
class CommentModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function getComments($slug) {
        $review_id_sql = $this->db->query("SELECT review_id FROM reviews WHERE slug = '$slug'");
        $review_id_result = $review_id_sql->row_array();
        $review_id = $review_id_result["review_id"];

        $query = $this->db->query("SELECT * FROM comments INNER JOIN users USING(user_id) WHERE review_id = '$review_id'");

        $comments = array();

        foreach($query->result() as $comment) {
            //echo($comment->username);
            $comments[] = (object) array(
                'username' => $comment->username,
                'message' => $comment->comment_text, 
                'admin' => $comment->account_type,
            );
        }

        return $comments;       
    }

    public function postComment($comment, $username, $slug) {
        $userID = $this->db->query("SELECT user_id FROM users WHERE username = '$username'");
        $result = $userID->row_array();
        $user_id = $result["user_id"];

        $review_id_sql = $this->db->query("SELECT review_id FROM reviews WHERE slug = '$slug'");
        $review_id_result = $review_id_sql->row_array();
        $review_id = $review_id_result["review_id"];

        $query = $this->db->query("INSERT INTO comments (user_id, review_id, comment_text) VALUES ($user_id, '$review_id', '$comment' )");
    }

    

}