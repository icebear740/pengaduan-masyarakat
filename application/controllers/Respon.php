<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Respon extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('pengaduan_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
	{
    $status = array('proses', 'selesai');
    $data['complaints'] = $this->pengaduan_model->get_complaint2($status);
    $this->load->view('respon/list', $data);
	}
  
  public function tanggapi($id_pengaduan) {
    // Retrieve the complaint data based on $id_pengaduan
    $complaint = $this->db->get_where('pengaduan', array('id_pengaduan' => $id_pengaduan))->row();
    
    if ($complaint) {
        // Handle the form submission
        if ($this->input->post('tanggapi')) {
            $tgl = date('Y-m-d');
            $tanggapan = $this->input->post('tanggapan');
            $id = $this->session->userdata('userid');

            // Upload the photo
            $config['upload_path'] = './uploads/';  // Set the upload directory path
            $config['allowed_types'] = 'gif|jpg|png';  // Set the allowed file types
            $config['max_size'] = 2048;  // Set the maximum file size (in kilobytes)

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_tanggapan')) {
                // Photo uploaded successfully
                $upload_data = $this->upload->data();
                $foto_tanggapan = $upload_data['file_name'];

                $this->db->select('userid')->from('petugas')->where('username', $this->session->userdata('username'));
                $userid = $this->db->get()->row()->userid;

                // Insert the response into the 'tanggapan' table
                $data = array(
                    'id_pengaduan' => $id_pengaduan,
                    'tgl_tanggapan' => $tgl,
                    'tanggapan' => $tanggapan,
                    'foto_tanggapan' => $foto_tanggapan  // Save the uploaded file name in the database
                );
                $this->db->insert('tanggapan', $data);

                // Update the 'status' column of the 'pengaduan' table to 'selesai'
                $this->db->where('id_pengaduan', $id_pengaduan);
                $this->db->update('pengaduan', array(
                    'status' => 'proses',
                    'userid' => $userid)
                );
                
                // Redirect to a success page or display a success message
            } else {
                // Error uploading the photo
                $error = $this->upload->display_errors();
                // Handle the error accordingly (e.g., display error message, redirect, etc.)
            }
        }

        // Pass the complaint data to the view for display
        $data['complaints'] = $this->pengaduan_model->get_all_complaints('proses');
        $this->load->view('respon/list', $data);
    } else {
        // Handle the case when the complaint doesn't exist
        show_404();
    }
}
            
public function selesai($id_pengaduan) {
  // Retrieve the complaint data based on $id_pengaduan
  $complaint = $this->db->get_where('pengaduan', array('id_pengaduan' => $id_pengaduan))->row();
  
  if ($complaint) {
      // Handle the form submission
      if ($this->input->post('selesai')) {
          $tgl = date('Y-m-d');
          $tanggapan = $this->input->post('tanggapan');
          $id = $this->session->userdata('userid');

          // Upload the photo
          $config['upload_path'] = './uploads/';  // Set the upload directory path
          $config['allowed_types'] = 'gif|jpg|png';  // Set the allowed file types
          $config['max_size'] = 2048;  // Set the maximum file size (in kilobytes)

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('foto_tanggapan')) {
              // Photo uploaded successfully
              $upload_data = $this->upload->data();
              $foto_tanggapan = $upload_data['file_name'];

              // Check if the response already exists for the complaint
              $existingTanggapan = $this->db->get_where('tanggapan', array('id_pengaduan' => $id_pengaduan))->row();

            //   $sql = 'SELECT userid FROM petugas WHERE username = ?';
            //   $userid = $this->db->query($sql, $this->session->userdata('username'));

              if ($existingTanggapan) {
                  // Update the existing response
                  $data = array(
                      'tgl_tanggapan' => $tgl,
                      'tanggapan' => $tanggapan,
                      'foto_tanggapan' => $foto_tanggapan  // Save the uploaded file name in the database
                  );
                  $this->db->where('id_pengaduan', $id_pengaduan);
                  $this->db->update('tanggapan', $data);
              } else {
                  // Insert a new response
                  $data = array(
                      'id_pengaduan' => $id_pengaduan,
                      'tgl_tanggapan' => $tgl,
                      'tanggapan' => $tanggapan,
                      'foto_tanggapan' => $foto_tanggapan  // Save the uploaded file name in the database
                    //   'userid' => $userid
                  );
                  $this->db->insert('tanggapan', $data);
              }

              // Update the 'status' column of the 'pengaduan' table to 'selesai'
              $this->db->where('id_pengaduan', $id_pengaduan);
              $this->db->update('pengaduan', array('status' => 'selesai'));

              // Redirect to a success page or display a success message
          } else {
              // Error uploading the photo
              $error = $this->upload->display_errors();
              // Handle the error accordingly (e.g., display error message, redirect, etc.)
          }
      }

      // Pass the complaint data to the view for display
      $data['complaints'] = $this->pengaduan_model->get_all_complaints('selesai');
      $this->load->view('respon/list', $data);
  } else {
      // Handle the case when the complaint doesn't exist
      show_404();
  }
}
}