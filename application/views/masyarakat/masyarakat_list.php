<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<?php  $this->load->view('header/sidebar'); ?>
<div class="container">
<div class="row">
          <div class="col s12 m9">
            <h3 class="orange-text" style="margin-left:130px;">Masyarakat</h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" style="margin-left:175px;" href="<?=site_url('masyarakat/add')?>"><i class="material-icons">add</i></a>
          </div>
        </div>
        <?=$this->session->flashdata('msg')?>
        <table class="display responsive-table" style="width:100%; margin-left:145px;">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Username</th>
				<th>Telp</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
          <?php $i=1; foreach ($users as $user){ ?>
		<tr>
			<td><?=$i++?></td>
			<td><?=$user->nik?></td>
			<td><?=$user->nama?></td>
			<td><?=$user->username?></td>
			<td><?=$user->telp?></td>
            <td><a class="btn teal" href="<?=site_url('masyarakat/edit/'.$user->nik)?>">Edit</a> <a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="<?=site_url('masyarakat/delete/'.$user->nik)?>" onclick="return confirm('Are you sure?')">Hapus</a> <a class="orange btn" onclick="return confirm('Are you sure?')" href="<?=site_url('masyarakat/resetpass/'.$user->nik)?>" onclick="return confirm('Are you sure?')">Reset</a></td>
            </tr>
          </tbody><?php } ?>
        </table>        
          </div>
          </div>