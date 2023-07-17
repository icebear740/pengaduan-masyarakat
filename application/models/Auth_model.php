<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function getuser($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('petugas')->row();
        
    }
}
