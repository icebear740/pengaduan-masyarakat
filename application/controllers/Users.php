<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(! $this->session->userdata('username')) redirect('auth/login');
        if($this->session->userdata('level')!='Admin') redirect('welcome');
        $this->load->model('Users_model');
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['users']=$this->Users_model->read();
		$this->load->view('users/users_list', $data);
	}

    public function add()
    {
        if ($this->input->post('submit')) {
            if($this->Users_model->validation()){
            $this->Users_model->create();
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:green;">User successfuly added !</p>');
            } else {
                $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:red;">User added failed !</p>');
            }
            redirect('users');
        }
    }
        $this->load->view('users/users_form');
    }

    public function edit($id)
    {
        if($this->input->post('submit')) {
            if($this->Users_model->validation()){
            $this->Users_model->update($id);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:green;">User successfuly updated !</p>');
            } else {
                $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:red;">User update failed !</p>');
            }
            redirect('users');
        }
    }
        $data['user']=$this->Users_model->read_by($id);
        $this->load->view('users/users_form', $data);
    }

    public function delete($id)
    {
        $this->Users_model->delete($id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:green;">User successfuly deleted ! </p>');
        } else {
            $this->session->set_flashdata('msg', '<p style="margin-left:130px; color:red;">User delete failed !</p>');
        }
        redirect('users');
    }

    public function resetpass($id)
    {
		$this->Users_model->reset($id);
        if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg','<p style="margin-left:130px; color:green;">Reset password successfully !</p>');
		} else {
			$this->session->set_flashdata('msg','<p style="margin-left:130px; color:red;">Reset password failed !</p>');
		}
		redirect('users');
    }
    
}
