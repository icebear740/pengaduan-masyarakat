<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pengaduan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        $status = array('belum proses');
        $data['complaints'] = $this->pengaduan_model->get_complaint($status);
        $this->load->view('pengaduan/list', $data);
    }

    public function detail($id_pengaduan) {
        $data['complaint'] = $this->pengaduan_model->get_complaint($id_pengaduan);
        $this->load->view('pengaduan/detail', $data);
    }

    public function tanggapi($id_pengaduan) {
        // Handle the tanggapi action here
        // You can access the tanggapan data using $this->input->post('tanggapan')
    }

    public function hapus($id_pengaduan) {
        // Handle the hapus action here
        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->delete('pengaduan');
        $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:green;">Delete Successfully !</p>');
        redirect('pengaduan');
    }

    public function open_modal($id_pengaduan)
{
    $this->load->view('pengaduan/list',$id_pengaduan);
}

    public function setuju($id)
    {
        if($this->input->post('submit')){
            $this->pengaduan_model->setuju($id);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('msg', '<p class="alert alert-success">pengaduan successfuly acc !</p>');
            } else {
                $this->session->set_flashdata('msg', '<p class="alert alert-danger">pengaduan denied !</p>');
            }
            redirect('pengaduan');
        }
        $data['adu']=$this->pengaduan_model->read_by($id);
        $this->load->view('respon/list_respon', $data);
    }
    public function salei(){
        if(! $this->session->userdata('usertype')=='Manager') redirect('welcome');
        $data['sales']=$this->pengaduan_model->setujui();
           $this->load->view('cats017/list_respon',$data);
    }

    private function upload()
    {
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = '100';
        $config['max_width']        = '1024';
        $config['max_height']       = '768';

        $this->load->library('upload', $config);
        return $this->upload->do_upload('foto');
    }

    public function changephoto()
    {
        if(! $this->session->userdata('fullname')) redirect('dashboard');   //filter login
        $data['error']='';
        if($this->input->post('upload')){
            if($this->upload()){    //jika sukses upload
                $this->pengaduan_model->changephoto($this->upload->data('file_name'));    //ubah data foto di database
                $this->session->set_userdata('foto',$this->upload->data('file_name')); //update data session
                $this->session->set_flashdata('msg', '<p class="alert alert-success">Photo successfuly changed !</p>');
            } else $data['error'] = $this->upload->display_errors();    //jika gagal upload
        }
        $this->load->view('dashboard', $data);
    }

    public function remove($id)
	{
		$this->pengaduan_model->remove($id);
		redirect('pengaduan');  
	}
}