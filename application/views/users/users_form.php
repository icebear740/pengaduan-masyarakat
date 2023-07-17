<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<?php  $this->load->view('header/sidebar'); ?>
<div class="container">
            <h3 class="orange-text" style="margin-left:130px;">User</h3><br>
            <?php
    $fullname = '';
    $username = ''; 
    $telp_petugas = '';
    $level = '';
    if(isset($user)){
      $fullname=$user->fullname;
      $username=$user->username;
      $telp_petugas=$user->telp_petugas;
      $level=$user->level;
    }
    ?>
			<form action="" method="POST">
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="nama">Fullname</label>
					<input id="nama" type="text" name="fullname" value="<?=set_value('fullname',$fullname)?>" id="" required>
				</div>
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?=set_value('username',$username)?>" id="" required><br><br>
				</div>
				<div class="col s12 input-field" style="margin-left:130px;">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp_petugas" value="<?=set_value('telp_petugas',$telp_petugas)?>" id="" required><br><br>
				</div>
				<div class="col s12 input-field" style="margin-left:130px;">
					<p>
					<label for="level" style="font-size:15px; color:black; margin-left:8px;">Level</label>
						<label>
						  <input value="Admin" class="with-gap" name="level" type="radio" <?=set_radio('level','Admin', $level=='Admin'?TRUE:FALSE)?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="Masyarakat" class="with-gap" name="level" type="radio" <?=set_radio('level','Masyarakat', $level=='Masyarakat'?TRUE:FALSE)?> />
						  <span>Masyarakat</span>
						</label>
					</p>
				</div>
                <div class="col s12 input-field" style="margin-left:130px;">
					<input type="submit" name="submit" value="Simpan" class="btn right">
				</div>
			</form>
</div>