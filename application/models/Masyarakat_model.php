<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masyarakat_model extends CI_Model {

	public function create()
	{
		$data = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'telp' => $this->input->post('telp'),
            'password' => password_hash($this->input->post('level'), PASSWORD_DEFAULT)
        );
        $this->db->insert('masyarakat', $data);
	}

    public function read()
    {
        $query = $this->db->get('masyarakat');
        return $query->result();
    }

    public function read_by($nik)
    {
        $this->db->where('nik', $nik);
        $query = $this->db->get('masyarakat');
        return $query->row();
    }

    public function update($nik)
    {
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'telp' => $this->input->post('telp')
        );
        $this->db->where('nik', $nik);
        $this->db->update('masyarakat', $data);
    }

    public function reset($id)
    {
        $this->db->set('password', password_hash($this->db->where('nik',$id)->get('masyarakat')->row('level'), PASSWORD_DEFAULT));
        $this->db->where('nik', $id);
        return $this->db->update('masyarakat');
    }

    public function delete($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->delete('masyarakat');
    }
    public function validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required');

        if($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }   
}
