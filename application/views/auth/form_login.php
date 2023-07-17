<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php  $this->load->view('header/head'); ?>
<div class="card" style="padding: 60px; width: 30%; margin: 0 auto; margin-top: 7%;">
<h3 style="text-align: center;" class="orange-text">Login!</h3>
<?=$this->session->flashdata('msg')?>
                            <div style="color:red;"><?=validation_errors()?></div>
	<form method="POST">
		<div class="input_field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" required>
		</div>
		<div class="input_field">
			<label for="password">Passowrd</label>
			<input id="password" type="password" name="password" required>
		</div><br>
		<input type="submit" name="login" value="Login" class="btn orange" style="width: 100%;">
	</form>
</div>
                            
							