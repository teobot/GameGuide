<?php
class CommentModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function getComments($slug) {
        //This function returns the comments on a game review using the provided slug,
        //The data is returned as a array to the controller but then JSON_ENCODED for VueJS
        $review_id_sql = $this->db->query("SELECT review_id FROM reviews WHERE slug = '$slug'");
        $review_id_result = $review_id_sql->row_array();
        $review_id = $review_id_result["review_id"];
        $query = $this->db->query("SELECT * FROM comments INNER JOIN users USING(user_id) WHERE review_id = '$review_id' ORDER BY time_stamp DESC");
        
        $comments = array();

        foreach($query->result() as $comment) {
            $comments[] = (object) array(
                'username' => $comment->username,
                'message' => $comment->comment_text,
                'profile_image' => $comment->profile_image,
                'admin' => $comment->account_type,
                'timestamp' => $comment->time_stamp,
            );
        }

        return $comments;       
    }

    public function postComment($comment, $user_id, $slug) {
        //This function accepts a users comment, userID and slug to be inserted into the database
        //This function requires:
        //$comment: Which is the comment that the user want's to post,
        //$user_id: THis is the unique userID of the logged in user,
        //$slug: This is the games review identifier, the game review ID is found using the slug
        $review_id_sql = $this->db->query("SELECT review_id FROM reviews WHERE slug = '$slug'");
        $review_id_result = $review_id_sql->row_array();
        $review_id = $review_id_result["review_id"];

        $this->db->query("INSERT INTO comments (user_id, review_id, comment_text) VALUES ($user_id, '$review_id', '$comment' )");
    }

    

}