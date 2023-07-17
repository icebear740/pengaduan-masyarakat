<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function create()
	{
		$data = array(
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
            'fullname' => $this->input->post('fullname'),
            'telp_petugas' => $this->input->post('telp_petugas'),
            'password' => password_hash($this->input->post('level'), PASSWORD_DEFAULT)
        );
        $this->db->insert('petugas', $data);
	}

    public function read()
    {
        $query = $this->db->get('petugas');
        return $query->result();
    }

    public function read_by($userid)
    {
        $this->db->where('userid', $userid);
        $query = $this->db->get('petugas');
        return $query->row();
    }

    public function update($userid)
    {
        $data = array(
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
            'fullname' => $this->input->post('fullname'),
            'telp_petugas' => $this->input->post('telp_petugas')
        );
        $this->db->where('userid', $userid);
        $this->db->update('petugas', $data);
    }

    public function reset($id)
    {
        $this->db->set('password', password_hash($this->db->where('userid',$id)->get('petugas')->row('level'), PASSWORD_DEFAULT));
        $this->db->where('userid', $id);
        return $this->db->update('petugas');
    }

    public function delete($userid)
    {
        $this->db->where('userid', $userid);
        $this->db->delete('petugas');
    }
    public function validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('telp_petugas', 'Telp Petugas', 'required');

        if($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }   
}
