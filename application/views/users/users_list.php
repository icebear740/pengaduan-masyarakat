<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/head'); ?>
<?php $this->load->view('header/sidebar'); ?>
<div class="container">
    <div class="row">
        <div class="col s12 m9">
            <?php if ($this->session->userdata('level') == 'admin') { ?>
                <h3 class="green-text" style="margin-left:130px;">User</h3>
            <?php } else { ?>
                <h3 class="orange-text" style="margin-left:130px;">User</h3>
            <?php } ?>
        </div>
        <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" style="margin-left:175px;" href="<?=site_url('users/add')?>"><i class="material-icons">add</i></a>
        </div>
    </div>
    <?=$this->session->flashdata('msg')?>
    <table class="display responsive-table" style="width:100%; margin-left:145px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Telephone</th>
                <th>Level</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach ($users as $user){ ?>
            <tr>
                <td><?=$i++?></td>
                <td><?=$user->fullname?></td>
                <td><?=$user->username?></td>
                <td><?=$user->telp_petugas?></td>
                <td>
                    <?php if ($user->level == 'Admin') { ?>
                        <span class="green-text"><?=$user->level?></span>
                    <?php } else { ?>
                        <span style="color:#FF4500"><?=$user->level?></span>
                    <?php } ?>
                </td>
                <td>
                    <a class="btn teal" href="<?=site_url('users/edit/'.$user->userid)?>">Edit</a>
                    <a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="<?=site_url('users/delete/'.$user->userid)?>" onclick="return confirm('Are you sure?')">Hapus</a>
                    <a class="orange btn" onclick="return confirm('Are you sure?')" href="<?=site_url('users/resetpass/'.$user->userid)?>" onclick="return confirm('Are you sure?')">Reset</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>        
</div>
</div>
