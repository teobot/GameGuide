<?php
class HomeModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Get for all games
    public function getGame()
    {
        //This function recreives all the game review information from the database
        $query = $this->db->query("SELECT * FROM reviews");
        return $query->result();
    }

    public function getReview($slug = FALSE)
    {
        //This function returns a array of the currently selected review information
        $query = $this->db->get_where('reviews', array('slug' => $slug));
        return $query->row_array();
    }

}