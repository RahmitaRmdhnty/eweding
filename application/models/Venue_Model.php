<?php

class Venue_Model extends CI_Model
{
    public function get_venue($table)
    {
        return $this->db->get($table)->result();
    }
}
