<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if($this->input->post('login') && $this->validation('login')){
            $login=$this->Auth_model->getuser($this->input->post('username'));
            if($login != NULL){
                if(password_verify($this->input->post('password'), $login->password)){
                    $data = array (
                        'username' => $login->username,
                        'level' => $login->level,
                        'fullname' => $login->fullname,
                        'telp_petugas' => $login->telp_petugas
                    );
                    $this->session->set_userdata($data);
                redirect('welcome');
            }
        } 
        $this->session->set_flashdata('msg', '<p style="color:red"">Invalid username or password !</p>');
    }
            $this->load->view('auth/form_login');
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
    public function validation($type)
    {
        $this->load->library('form_validation');
        if($type == 'login'){
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
        } else {
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');
        }

        if($this->form_validation->run())
            return TRUE;
        else
            return FALSE;
    }   
}
