<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php  $this->load->view('header/head'); ?>
  <!DOCTYPE html>
  <html>
    <head>
    	<title>Aplikasi Pengaduan masyarakat</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">     
      <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );    
      </script>
    </head>
    <body>
<div class="container">
          <ul class="sidenav sidenav-fixed">
              <li>
                  <div class="user-view">
                      <div class="background">
                          <img src="<?php echo base_url(); ?>assets/img/bg.jpg">
                      </div>
                      <a href="#user"><img class="circle" src="https://cdn5.vectorstock.com/i/1000x1000/01/69/businesswoman-character-avatar-icon-vector-12800169.jpg"></a>
                      <a href="#name"><span class="blue-text name"><?=$this->session->userdata('fullname')?></span></a>
                  </div>
              </li>
              <li><a href="<?=base_url()?>"><i class="material-icons">dashboard</i>Dashboard</a></li>
              <?php if($this->session->userdata('level') == 'Admin'){ ?>
              <li><a href="<?=site_url('pengaduan')?>"><i class="material-icons">report</i>Pengaduan</a></li><?php } ?>
              <?php if($this->session->userdata('level') == 'Admin'){ ?>
              <li><a href="<?=site_url('respon')?>""><i class="material-icons">question_answer</i>Respon</a></li><?php } ?>
              <?php if($this->session->userdata('level') == 'Admin'){ ?>
              <li><a href="<?=site_url('users')?>"><i class="material-icons">account_box</i>User</a></li><?php } ?>
              <?php if($this->session->userdata('level') == 'Admin'){ ?>
              <li><a href="<?=site_url('laporan')?>"><i class="material-icons">book</i>Laporan</a></li><?php } ?>
              <li>
                  <div class="divider"></div>
              </li>
              <li><a class="waves-effect" href="<?=site_url('auth/logout')?>"><i class="material-icons">logout</i>Logout</a></li>
          </ul>
      </div>
      <div class="col s12 m9">
      </div>

    </body>
  </html>