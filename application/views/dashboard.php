<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<?php if($this->session->userdata('level') == 'Admin'){ ?>
<div class="container2" style="margin-left:333px;">
<h3 class="orange-text" >Dahsboard</h3>
	<div class="row" style="margin-left:-10px;">
		<div class="col s4">
		  <div class="card red">
		    <div class="card-content white-text">
			<?php
                $this->db->from('pengaduan');
                $jlmmember = $this->db->count_all_results();
				$query = $this->db->get_where('pengaduan', array('status' => 'proses'));
                if ($jlmmember < 1) {
					$jlmmember = 0;
				}
				?>
		      <span class="card-title">Laporan Masuk<b class="right"><?php echo $jlmmember; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>	
		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php
$query = $this->db->get_where('pengaduan', array('status' => 'selesai'));
$jlmmember = $query->num_rows();
if ($jlmmember < 1) {
    $jlmmember = 0;
}
?>

		      <span class="card-title">Laporan Selesai <b class="right"><?php echo $jlmmember; ?></b></span>
		    </div>
		  </div>
		</div>
        </div>
	</div>
	<?php } ?>
	<?php if($this->session->userdata('level') == 'Masyarakat'): ?>
	<table border="2" style="width: 70%; margin-left:325px;">
		<tr>
			<td><h4 class="orange-text hide-on-med-and-down">Tulis Laporan</h4></td>	
		</tr>
		<tr>
			<td style="padding: 20px;">
				<form action="<?=site_url('dashboard/submit')?>" method="POST" enctype="multipart/form-data">
					<textarea class="materialize-textarea" name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
					<label>Gambar</label>
					<input type="file" name="foto"><br><br>
					<input type="submit" name="kirim" value="Kirim" class="btn">
				</form>
			</td>
		</tr>
	</table>
	<div class="container">
		<div class="row">
			<div class="col s12 m9">
				<h3 class="orange-text" style="margin-left:130px;">Daftar Laporan</h3>
			</div>  
		</div>
		&nbsp;<?=$this->session->flashdata('msg')?>
		<table class="display responsive-table" style="width:100%; margin-left:145px;">
			<tr>
				<td>No</td>
				<td>Nama</td>
				<td>Tanggal Masuk</td>
				<td>Isi Tanggapan</td>
				<td>Status</td>
				<td>Opsi</td>
			</tr>
			<?php $i=1; foreach ($complaints as $complaint): ?>
				<?php if ($complaint['status'] == "proses" || $complaint['status'] == "selesai"): ?>
					<?php if ($complaint['nama_pengadu'] == $this->session->userdata('fullname')): ?>
					<div class="modal" id="myModal<?php echo $complaint['id_pengaduan'];?>" style="margin-top:-350px; margin-left:370px;">
						<div class="modal-dialog">
							<div class="modal-content">
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="orange-text">Detail</h4>
								</div>
								<!-- Modal Body -->
								<div class="col s12">
									<p>Dari : <?php echo $complaint['nama_pengadu']; ?></p>
									<p>Petugas : <?php echo $complaint['nama_petugas']; ?></p>
									<p>Tanggal Masuk : <?php echo $complaint['tgl_pengaduan']; ?></p>
									<p>Tanggal Ditanggapi : <?php echo $complaint['tgl_tanggapan']; ?></p>
									<?php if ($complaint['foto'] == "kosong"): ?>
										<img src="<?=base_url('uploads/'.$complaint['foto']);?>" width="100">
									<?php else: ?>
										<img width="100" src="<?=base_url('uploads/'.$complaint['foto']);?>">
									<?php endif; ?>
									<br><b>Pesan</b>
									<p><?php echo $complaint['isi_laporan']; ?></p>
									<b>Respon</b>
									<p><?php echo $complaint['tanggapan']; ?></p>
									<?php if ($complaint['foto_tanggapan'] == "kosong"): ?>
										<img src="<?=base_url('uploads/'.$complaint['foto_tanggapan']);?>" width="100">
									<?php else: ?>
										<img width="100" src="<?=base_url('uploads/'.$complaint['foto_tanggapan']);?>">
									<?php endif; ?>
								</div>
								<!-- Modal Footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $complaint['nama_pengadu'];?></td>
						<td><?php echo $complaint['tgl_pengaduan']; ?></td>
						<td><?php echo $complaint['tanggapan']; ?></td>
						<td><?php if ($complaint['status'] == 'proses'): ?>
                                <span style="color:#FF4500"><?php echo $complaint['status']; ?></span>
                            <?php elseif ($complaint['status'] == 'selesai'): ?>
                                <span class="green-text"><?php echo $complaint['status']; ?></span>
                            <?php endif; ?></td>
						<td>
							<a class="btn blue modal-trigger" data-toggle="modal" data-target="#myModal<?php echo $complaint['id_pengaduan'];?>">More</a>
							<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="<?php echo site_url('dashboard/hapus/'.$complaint['id_pengaduan']); ?>">Hapus</a>
						</td>
					</tr>
				<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</table>
	</div>
<?php endif; ?>

<?php  $this->load->view('header/sidebar'); ?>



<!-- 

 -->
