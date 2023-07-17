<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pengaduan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $status = array('proses','selesai');
        $data['complaints'] = $this->pengaduan_model->get_all_complaints($status);
        $this->load->view('dashboard', $data);
    }

    public function detail($id_pengaduan) {
        $data['complaint'] = $this->pengaduan_model->get_complaint($id_pengaduan);
        $this->load->view('dashboard', $data);
    }

    public function tanggapi($id_pengaduan) {
        
    }

    public function hapus($id_pengaduan) {
        // Handle the hapus action here
        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->delete('pengaduan');
        $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:red;">Delete Successfully !</p>');
        redirect('dashboard');
    }

    private function upload()
    {
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = '10000';
        $config['max_width']        = '102400';
        $config['max_height']       = '768000';

        $this->load->library('upload', $config);
        return $this->upload->do_upload('foto');
    }

    public function submit()
    {
        $tgl = date('Y-m-d');
        $fullname = $this->session->userdata('fullname');
        $foto = $this->session->userdata('foto');
        // $data['error']='';
        if($this->input->post('kirim')){
            if($this->upload()){    //jika sukses upload
                $nama =  $this->upload->data('file_name');
                $data1 = array(
                    'tgl_pengaduan' => $tgl,
                    'isi_laporan' => $this->input->post('laporan'),
                    'fullname' => $fullname,
                    'foto' => $nama,
                    'status' => 'belum proses'
                );
                $this->pengaduan_model->insert($data1);
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Photo successfuly changed !</p>');
            } else {
                $data = array(
                    'tgl_pengaduan' => $tgl,
                    'isi_laporan' => $this->input->post('laporan'),
                    'fullname' => $fullname,
                    'foto' => 'noImage.png',
                    'status' => 'belum proses'
                );
                $this->pengaduan_model->insert($data);
                // $data['error'] = $this->upload->display_errors(); 
            }    
        }
        $data['complaints'] = $this->pengaduan_model->get_all_complaints('belum proses');
        $this->load->view('dashboard', $data);

    }

}