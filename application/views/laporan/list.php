<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php  $this->load->view('header/head'); ?>
<div class="row">
  <div class="col s12 m9">
    <h3 style="margin-left:150px;" class="orange-text">Laporan</h3>
  </div> 
  <div class="col s12 m3">
    <div class="section"></div>
    <a class="waves-effect waves-light btn blue" href="#" onclick="printPage()" style="margin-left:70px;"><i class="material-icons">print</i></a>
  </div>
</div>
<div class="container">
  <?=$this->session->flashdata('msg')?>
  <table class="display responsive-table" style="width:100%; margin-left:-10px;">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Pelapor</th>
        <th>Nama Petugas</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Ditanggapi</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($complaints as $complaint): ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $complaint['nama_pengadu']; ?></td>
        <td><?php echo $complaint['nama_petugas']; ?></td>
        <td><?php echo $complaint['tgl_pengaduan']; ?></td>
        <td><?php echo $complaint['tgl_tanggapan']; ?></td>
        <td <?php echo ($complaint['status'] == 'proses') ? 'style="color: #FF4500;"' : 'style="color: green;"'; ?>>
          <?php echo $complaint['status']; ?>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <br><br> 
  <a class="waves-effect waves-light btn blue" style="margin-left:-50px;" href="<?=base_url()?>"><b>Kembali</b></a> 
</div>
<script>
  function printPage() {
    window.print();
  }
</script>
<style>
  @media print {
    /* Tambahkan gaya CSS khusus untuk cetak di sini */
    /* Misalnya, menghilangkan tombol cetak agar tidak tercetak */
    .btn {
      display: none;
    }
    .orange-text {
      display: none;
    }
    /* Menghilangkan teks "Document" dan URL localhost */
    @page {
      size: auto;
      margin: 0mm;
      
    }
    @media print {
      body::after {
        content: "";
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-color: white;
      }
    }
  }
</style>
