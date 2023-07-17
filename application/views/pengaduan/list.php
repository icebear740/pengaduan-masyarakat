<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('header/head'); ?>
<?php $this->load->view('header/sidebar'); ?>
<div class="container">
    <div class="row">
        <div class="col s12 m9">
            <h3 class="orange-text" style="margin-left:130px;">Pengaduan</h3>
        </div>
    </div>
    <?=$this->session->flashdata('msg')?>
    <table class="display responsive-table" style="width:100%; margin-left:145px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <?php $i=1; foreach ($complaints as $complaint): ?>
            <?php if ($complaint['view'] == 'tampil') { ?>

        <tbody>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $complaint['nama_pengadu']; ?></td>
                <td><?php echo $complaint['tgl_pengaduan']; ?></td>
                <td><?php echo $complaint['isi_laporan'];?></td>
                <td>
                    <?php if ($complaint['status'] == 'belum proses'): ?>
                        <span style="color: red;"><?php echo $complaint['status']; ?></span>
                    <?php else: ?>
                        <?php echo $complaint['status']; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <a class="btn blue modal-trigger" data-toggle="modal" data-target="#myModal<?php echo $complaint['id_pengaduan'];?>" data-id="">More</a>
                    <!-- Modal -->
                    <div class="modal" data-id="" id="myModal<?php echo $complaint['id_pengaduan'];?>" style="margin-left:370px; margin-top:-150px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="orange-text">Detail</h4>
                                </div>
                                <!-- Modal Body -->
                                <div class="col s12">
                                    <p>Dari : <?php echo $complaint['nama_pengadu']; ?></p>
                                    <p>Tanggal Masuk : <?php echo $complaint['tgl_pengaduan']; ?></p>
                                    <?php 
                                        if($complaint['foto']=="kosong"){ ?>
                                            <img src="<?=base_url('uploads/'.$complaint['foto']);?>" width="100" class="img-thumbnail">
                                    <?php   }else{ ?>
                                        <img width="100" src="<?=base_url('uploads/'.$complaint['foto']);?>" class="img-thumbnail">
                                    <?php }
                                    ?>
                                    <br><b>Pesan</b>
                                    <p><?php echo $complaint['isi_laporan']; ?></p>
                                    <p>Status : <span <?php echo ($complaint['status'] == 'belum proses') ? 'style="color: red;"' : ''; ?>><?php echo $complaint['status']; ?></span></p>
                                </div>
                                <?php if($complaint['status']=="belum proses"): ?>
                                <div class="col s12 m6">
                                    <form method="POST" action="<?php echo site_url('respon/tanggapi/'.$complaint['id_pengaduan']); ?>" enctype="multipart/form-data">
                                        <div class="col s12 input-field">
                                            <label for="textarea">Tanggapan</label>
                                            <textarea id="textarea" name="tanggapan" class="materialize-textarea"></textarea>
                                        </div>
                                        <input type="file" name="foto_tanggapan"><br><br>
                                        <div class="col s12 input-field">
                                            <input class="btn btn-danger" type="submit" name="tanggapi" value="Kirim" class="btn right">
                                        </div>
                                    </form>
                                </div>
                                <?php endif; ?>
                                <!-- Modal Footer -->
                                <div class="modal-footer col s12">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="<?php echo site_url('pengaduan/hapus/'.$complaint['id_pengaduan']); ?>">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        <?php endforeach; ?> 
        </tbody>
    </table>  
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</div>
