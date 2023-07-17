<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<?php  $this->load->view('header/sidebar'); ?>
<div class="container">
    <div class="row">
        <div class="col s12 m9">
            <h3 class="orange-text" style="margin-left: 130px;">Respon</h3>
        </div>
    </div>
    <?=$this->session->flashdata('msg')?>
    <table class="display responsive-table" style="width: 100%; margin-left: 145px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Isi Tanggapan</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($complaints as $complaint): ?>
            <?php if ($complaint['view'] == 'tampil') { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $complaint['nama_pengadu']; ?></td>
                <td><?php echo $complaint['tanggapan'];?></td>
                <td <?php echo ($complaint['status'] == 'proses') ? 'style="color: #FF4500;"' : 'style="color: green;"'; ?>>
                    <?php echo $complaint['status']; ?>
                </td>
                <td>
                    <a class="btn blue modal-trigger" data-toggle="modal" data-target="#myModal<?php echo $complaint['id_pengaduan'];?>" data-id="">More</a>

                    <!-- The Modal -->
                    <div class="modal modal-dialog-centered" data-id="" id="myModal<?php echo $complaint['id_pengaduan'];?>" style="margin-left:370px; margin-top:-150px;">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="orange-text">Detail</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col s12">
                                            <p>Dari: <?php echo $complaint['nama_pengadu']; ?></p>
                                            <p>Tanggal Masuk: <?php echo $complaint['tgl_pengaduan']; ?></p>
                                            <?php if($complaint['foto_tanggapan']=="kosong"){ ?>
                                                <img src="<?=base_url('uploads/'.$complaint['foto_tanggapan']);?>" width="100">
                                            <?php } else { ?>
                                                <img src="<?=base_url('uploads/'.$complaint['foto_tanggapan']);?>" width="100">
                                            <?php } ?>
                                            <br>
                                            <b>Pesan</b>
                                            <p><?php echo $complaint['isi_laporan']; ?></p>
                                            <b>Respon</b>
                                            <p><?php echo $complaint['tanggapan']; ?></p>
                                            <p>Status: <span <?php echo ($complaint['status'] == 'proses') ? 'style="color: #FF4500;"' : 'style="color: green;"'; ?>><?php echo $complaint['status']; ?></span></p>
                                        </div>
                                    </div>
                                    <?php if($complaint['status']=="proses"){ ?>
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <form method="POST" action="<?php echo site_url('respon/selesai/'.$complaint['id_pengaduan']); ?>" enctype="multipart/form-data">
                                                    <div class="input-field">
                                                        <label for="textarea">Tanggapan</label>
                                                        <textarea id="textarea" name="tanggapan" class="materialize-textarea"></textarea>
                                                    </div>
                                                    <div class="input-field">
                                                        <input type="file" name="foto_tanggapan"><br><br>
                                                    </div>
                                                    <div class="input-field">
                                                        <input class="btn btn-danger" type="submit" name="selesai" value="Kirim" class="btn right">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="<?php echo site_url('pengaduan/remove/'.$complaint['id_pengaduan']); ?>">Hapus</a>
                </td>
            </tr>
            <?php } ?>
            <?php endforeach; ?> 
        </tbody>
    </table>  
</div>
</div> <!-- Penutupan div yang kurang -->

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
