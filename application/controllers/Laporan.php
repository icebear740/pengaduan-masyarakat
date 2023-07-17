<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pengaduan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $status = array('selesai');
        $data['complaints'] = $this->pengaduan_model->get_all_complaints($status);
        $this->load->view('laporan/list', $data);
    }
}