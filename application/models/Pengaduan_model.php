<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_model extends CI_Model {


    public function get_complaint($pengaduan) {
        $this->db->distinct();
        $this->db->select('pengaduan.id_pengaduan, pengaduan.fullname AS nama_pengadu, petugas.fullname AS nama_petugas, pengaduan.tgl_pengaduan, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, pengaduan.isi_laporan, pengaduan.foto, pengaduan.view');
        $this->db->from('pengaduan');
        $this->db->join('petugas', 'pengaduan.fullname = petugas.fullname');

        $this->db->where_in('pengaduan.status', $pengaduan);
        $this->db->order_by('pengaduan.id_pengaduan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_complaint2($status) {
        $this->db->distinct();
        $this->db->select('pengaduan.id_pengaduan, pengaduan.fullname AS nama_pengadu, petugas.fullname AS nama_petugas, pengaduan.tgl_pengaduan, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, pengaduan.isi_laporan, pengaduan.foto, tanggapan.tanggapan, tanggapan.tgl_tanggapan, tanggapan.foto_tanggapan, pengaduan.view');
        $this->db->from('pengaduan');
        $this->db->join('petugas', 'petugas.userid = petugas.userid');
        $this->db->join('tanggapan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan');
    
        if ($status === 'proses') {
            $this->db->where('pengaduan.status', 'proses');
        } elseif ($status === 'selesai') {
            $this->db->where('pengaduan.status', 'selesai');
        }
    
        $this->db->order_by('pengaduan.id_pengaduan', 'DESC');
        $this->db->group_by('pengaduan.id_pengaduan');
        return $this->db->get()->result_array();
    }

    public function get_all_complaints($pengaduan) {
        
        $this->db->distinct();
        $this->db->select('pengaduan.id_pengaduan, pengaduan.fullname AS nama_pengadu, petugas.fullname AS nama_petugas, pengaduan.tgl_pengaduan, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tgl_tanggapan, pengaduan.isi_laporan, pengaduan.foto, tanggapan.foto_tanggapan, tanggapan.tanggapan, pengaduan.view');
        $this->db->from('pengaduan');
        $this->db->join('petugas', 'pengaduan.userid = petugas.userid');
        $this->db->join('tanggapan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan');
        if ($pengaduan === 'proses') {
            $this->db->where('pengaduan.status', 'proses');
        } elseif ($pengaduan === 'selesai') {
            $this->db->where('pengaduan.status', 'selesai');
        }
        $this->db->order_by('pengaduan.id_pengaduan', 'DESC');
        $this->db->group_by('pengaduan.id_pengaduan');
        return $this->db->get()->result_array();
    }

    // public function changephoto($file){
    //     if($file != 'noImage.png')
    //     unlink('../uploads/'.$file);

    //     $this->db->set('foto', $file);
    //     return $this->db->update('pengaduan');
    // }

    public function changephoto($file){
        if($this->session->userdata('foto') != 'noImage.png')
        unlink('./uploads/'.$this->session->userdata('foto'));

        $this->db->set('foto', $file);
        $this->db->where('id_pengaduan',$this->session->userdata('fullname'));
        return $this->db->update('pengaduan');
    }

    public function insert($data) {
        $this->db->select('userid');
        $this->db->from('petugas');
        $this->db->where('username',$this->session->userdata('username'));
        $data['userid'] = $this->db->get()->row()->userid;
        
        $this->db->insert('pengaduan', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_pengaduan', $id);
        $this->db->delete('pengaduan');
    }

    public function validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tgl_pengaduan', 'Tgl Pengaduan', 'required');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('isi_laporan', 'Isi Laporan', 'required');
        $this->form_validation->set_rules('foto', 'Foto', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }   
    public function setuju($id)
    {
        $data = array(
            'fullname' => $this->input->post('customer_address_017'),
            'isi_laporan' => $this->input->post('customer_phone_017'),
            'id_pengaduan' => $id
        );
        $this->db->insert('respon', $data);

        $this->db->set('respon_laporan', '1');
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan');
    }
    public function setujui(){
        //$query=$this->db->get('catsales017');
        $this->db->select('*');
        $this->db->from('respon');
        $this->db->join('pengaduan','respon.id_pengaduan = pengaduan.id_pengaduan');
        $query = $this->db->get();
        return $query->result();
    }

    public function remove($id)
	{
		$data = array	(
			'view' => 'unTampil'
		);
		$this->db->where('id_pengaduan',$id);
		$this->db->update('pengaduan',$data);
	}
}