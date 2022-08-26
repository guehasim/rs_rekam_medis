<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css"/>

<style type="text/css">
.tombol-tambah{
    padding-bottom: 5px;
}
.jarak{
  padding-top: 10px;
}
.kiri{
  padding-left: 30px;
}
.kiri2{
  padding-left: 50px;
}
.iki-body{
  width:whatever
}
.aksi{
  padding-bottom: 5px;
}
.wid{
  width: 145px;
}
</style>

<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
 
      return false;
    return true;
        }
</script>

<script type="text/javascript">
$(document).ready(function(){
  $(".datepicker").datepicker();
});
</script>

<aside>
  <div id="sidebar"  class="nav-collapse">
     
     <ul class="sidebar-menu">                
        <li>
          <a class="" href="<?php echo base_url() ?>">
            <i class="icon_house_alt"></i>
            <span>Dashboard</span>
          </a>
        </li>       

        <li>
          <a class="" href="<?php echo base_url() ?>register/c_data_pasien/tampil">
            <i class="icon_desktop"></i>
            <span>Pendafaran</span>
          </a>
        </li>

        <li class="sub-menu">
          <a href="javascript:;" class="">
            <i class="fa fa-file-text-o"></i>
            <span>Rekam Medis</span>
            <span class="menu-arrow arrow_carrot-right"></span>
          </a>
          <ul class="sub">
            <li><a class="" href="<?php echo base_url() ?>rekam/c_rm_rj/tampil">Rawat Jalan</a></li>                          
            <li class="active"><a class="" href="<?php echo base_url() ?>rekam/c_rm_ri/tampilMasuk">Rawat Inap</a></li>
          </ul>
        </li>

        <li class="sub-menu">
          <a href="javascript:;" class="">
            <i class="fa fa-tachometer"></i>
            <span>Hitungan RM</span>
            <span class="menu-arrow arrow_carrot-right"></span>
          </a>
          <ul class="sub">
            <li><a class="" href="<?php echo base_url() ?>laporan/c_hitung/tampil">Keseluruhan</a></li>                          
            <li><a class="" href="<?php echo base_url() ?>laporan/c_hitungkamar/tampil">Peruangan</a></li>
          </ul>
        </li>

        <li>
          <a class="" href="<?php echo base_url() ?>laporan/c_laporan/tampil">
            <i class="icon_document_alt"></i>
            <span>Laporan</span>
          </a>
        </li>

      </ul>
  </div>
</aside>

<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file-text-o"></i>History Rekam Medis Rawat Inap</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-file-text-o"></i>Rekam Medis</li>
            <li><i class="icon_profile"></i>Rawat Inap</li>
            <li><i class="fa fa-mail-forward"></i>History</li>                
          </ol>
      </div>
    </div>

    <div>
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <header class="panel-heading">
            Data Rekam Medis Rawat Inap
        </header>
          <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No.RM</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                  <th>Jenis Kedatangan</th>
                  <th>Poli</th>
                  <th>Dokter</th>
                  <th>Keadaan</th>
                  <th>Kamar Akhir</th>
                  <th>Lama Dirawat</th>
                  <th>Perawatan</th>
                  <th>Diagnosa</th>
                  <th>Tindakan</th>
                  <th>TPIP</th>
                  <th>IGD</th>
                  <th>Kel.Kamar</th>
                  <th>OK(RM19)</th>
                  <th>Gizi</th>
                  <th>Farmasi</th>
                  <th>Persetujuan</th>
                  <th>Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $no = 1; foreach ($rminapkeluar->result() as $rminap): ?>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $rminap->in_rm;?></td>
                  <td><?php echo $rminap->pas_nama;?></td>
                  <td>
                    <?php
                    $jstatus = $rminap->in_status;
                    switch ($jstatus) {
                       case '0':
                         echo "Pasien Lama";
                         break;

                        case '1':
                          echo "Pasien Baru";
                          break;
                     } 
                     ?>
                  </td>
                  <td>
                    <?php
                      $timestamp = strtotime($rminap->in_tgl_masuk);
                      echo date('d-m-Y',$timestamp);
                    ?>
                  </td>
                  <td>
                    <?php
                      $timestamp = strtotime($rminap->inap_tgl_keluar);
                      echo date('d-m-Y',$timestamp);
                    ?>
                  </td>
                  <td>
                  <?php
                    $datang = $rminap->in_jen_datang;
                    switch ($datang) {
                      case '0':
                        echo ": Belum Dipilih";
                      break;
                                                                                      
                      case '1':
                        echo ": Sendiri";
                      break;

                      case '2':
                        echo ": Poli";
                      break;

                      case '3':
                        echo ": Rujukan";
                      break;
                      }
                      ?> 
                      
                      <?php
                      if ($rminap->datang_detail == 3) {
                        echo "Dokter";
                      }else if($rminap->datang_detail == 4){
                        echo "Puskesmas";
                      }else if($rminap->datang_detail == 5){
                        echo "Instansi Lain";
                      }else{
                        echo "";
                      } 
                      ?>
                  </td>
                  <td><?php echo $rminap->poli_nama;?></td>
                  <td><?php echo $rminap->dokter_nama;?></td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_keadaan;
                    switch ($jstatus) {
                      case '0':
                        echo ": Belum Dipilih";
                      break;
                                                                                    
                      case '1':
                        echo ": Sehat";
                      break;

                      case '2':
                        echo ": Pulang Sendiri";
                      break;

                      case '3':
                        echo ": Dirujuk";
                      break;

                      case '4':
                        echo ": Mati";
                        echo " / ";

                      switch ($rminap->keadaan_detail) {

                        case '4':
                          echo "<48 jam";
                        break;

                        case '5':
                          echo ">48 jam";
                        break;
                        }
                      break;
                      }
                    ?>
                  </td>
                  <td><?php echo $rminap->kmr_nama;?> / <?php echo $rminap->kmr_d_nama;?></td>
                  <td><?php echo $rminap->inap_lama;?> /hari</td>
                  <td><?php echo $rminap->inap_hari;?> /hari</td>
                  <td><?php echo $rminap->indonesia;?></td>
                  <td><?php echo $rminap->str;?></td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_tpip;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_igd;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_kamar;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_ok;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_gizi;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_farmasi;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td>
                    <?php
                    $jstatus = $rminap->inap_setuju;
                    switch ($jstatus) {
                      case '0':
                        echo ": Lengkap";
                      break;
                                                                                      
                      case '1':
                        echo ": Tidak Lengkap";
                      break;
                    }?>
                  </td>
                  <td><?php echo $rminap->bay_nama;?> => <?php echo $rminap->bay_det_nama;?> </td>
                  <td>
                    <div>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-info-<?php echo $rminap->inap_id;?>">TIDAK JADI KELUAR</button>
                    </div>
                  </td>
                </tr>

                <!-- modal delete -->
                <div class="modal fade" id="hapus-info-<?php echo $rminap->inap_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content edit-dialog-modal">
                      <form class="form-horizontal" action="<?php echo base_url(); ?>rekam/c_rm_ri/proses_hapusKeluar" method="post">    
                        <?php
                          $this->load->helper("form");
                        ?>
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Pasien Tidak Jadi Keluar</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $rminap->in_id_masuk;?>">
                          Apakah pasien "<?php echo $rminap->pas_nama;?>" tersebut tidak jadi keluar?
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">Iya,Benar</button>
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- end modal delete-->
                <?php endforeach ?>

              </tbody>                                                
            </table>                                    <!-- /.table-responsive -->
          </div>                                <!-- /.panel-body -->
        </div>                            <!-- /.panel -->
      </div>                        <!-- /.col-lg-12 -->
    </div>

    <div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-validate form-horizontal " method="post" action="<?php echo base_url(); ?>rekam/c_rm_rj/cekno_rm">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Cek Nomor Rekam Medis</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                
                  <?php
                    $this->load->helper("form");
                  ?>
                  <div class="form-group">
                    <label class="control-label col-lg-2">No.RM</label>
                    <div class="col-lg-5">
                      <input class="form-control" id="no_rm" name="nomor_rm" placeholder="Nomer rekam Medis" onkeypress="return hanyaAngka(event)" maxlength="6" />
                    </div>
                  </div>

                  <input type="hidden" name="id" value="2">        

                  <div class="modal-footer">
                    <div class="col-lg-offset-2">
                      <button class="btn btn-danger" type="submit">Cek</button>
                      <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    </div>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

        
    
  </section>
</section>

  <script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap-switch.js"></script>