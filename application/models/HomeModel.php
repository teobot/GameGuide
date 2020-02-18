<?php
class HomeModel extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    //Get for all games
    public function getGame()
    {
        // You can use the select, from, and where functions to simplify this as seen in Week 13.
        $query = $this->db->query("SELECT * FROM reviews");
        return $query->result();
    }

    //Get the details for a game once it has been clicked on.
    public function getReview($slug = FALSE)
    {
        if ($slug === FALSE)
        {
                $query = $this->db->get('reviews');
                return $query->result_array();
        }

        $query = $this->db->get_where('reviews', array('slug' => $slug));
        return $query->row_array();
    }
}