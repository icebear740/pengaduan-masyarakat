<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<?php  $this->load->view('header/sidebar'); ?>
<div class="container">
            <h3 class="orange-text" style="margin-left:130px;">Masyarakat</h3><br>
            <?php
    $nik = '';
    $nama = ''; 
    $username = '';
    $telp = '';
    if(isset($user)){
      $nik=$user->nik;
      $nama=$user->nama;
      $username=$user->username;
      $telp=$user->telp;
    }
    ?>
			<form action="" method="POST">
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="nik">NIK</label>
					<input id="nik" type="text" name="nik" value="<?=set_value('nik',$nik)?>" id="" required>
				</div>
                <div class="col s12 input-field" style="margin-left:130px;">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" value="<?=set_value('nama',$nama)?>" id="" required>
				</div>
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?=set_value('username',$username)?>" id="" required><br><br>
				</div>
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?=set_value('telp',$telp)?>" id="" required><br><br>
				</div>
                <div class="col s12 input-field" style="margin-left:130px;">
					<input type="submit" name="submit" value="Simpan" class="btn right">
				</div>
			</form>
</div>