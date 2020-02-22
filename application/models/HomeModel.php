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

}