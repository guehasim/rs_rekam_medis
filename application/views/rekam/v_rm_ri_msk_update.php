<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css"/>
<style type="text/css">
.tombol-tambah{
    padding-bottom: 5px;
}
.jarak{
  padding-top: 10px;
}
.pilih:hover{
  cursor: pointer;
}
</style>

<script type="text/javascript">

$(document).ready(function(){
  $(".datepicker").datepicker();
});

function loadKedatangan() 
  {
    var bay = $("#ked").val();
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>rekam/c_rm_ri/datangnya",
    data:"id=" + bay,
    success: function(html)
      {
        $("#datkead").html(html);
      }
    });
  }

            function loadDokter() 
            {
              var poli = $("#poli").val();
              $.ajax({
                type:'GET',
                url:"<?php echo base_url() ?>rekam/c_rm_rj/dokter",
                data:"id=" + poli,
                success: function(html)
                {
                  $("#dokter").html(html);
                }
              });
            }

            function loadBayar() 
            {
              var bay = $("#bayar").val();
              $.ajax({
                type:'GET',
                url:"<?php echo base_url() ?>rekam/c_rm_rj/pembayaran",
                data:"id=" + bay,
                success: function(html)
                {
                  $("#detbayar").html(html);
                }
              });
            }

            function loadKamar() 
            {
              var kamar = $("#kamar").val();
              $.ajax({
                type:'GET',
                url:"<?php echo base_url() ?>rekam/c_rm_ri/kamar",
                data:"id=" + kamar,
                success: function(html)
                {
                  $("#detail").html(html);
                }
              });
            }
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
        <h3 class="page-header"><i class="icon_plus_alt2"></i>Update Data Rekam Medis Rawat Jalan</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-file-text-o"></i>Rekam Medis</li>
            <li><i class="icon_profile"></i>Rawat Jalan</li>
            <li><i class="icon_plus_alt2"></i>Update</li>                
          </ol>
      </div>
    </div>
    <!-- page start--> 
    <div class="row">
      <div class="col-lg-12">

        <section class="panel">
          <div class="panel-body">            

            <form class="form-validate form-horizontal" id="register_form_rm_rj" role="form" method="post" action="<?php echo base_url(); ?>rekam/c_rm_ri/proses_updateMasuk">

              <?php foreach ($user->result() as $u): ?>              
              
              <div class="form-group">
                    <label class="control-label col-lg-2">No.RM</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="no_rm" value="<?php echo $u->in_rm;?>" placeholder="Nomer rekam Medik" maxlength="6" name="no_rm" type="text" onkeypress="return hanyaAngka(event)" readonly />
                    </div>
                  </div>     

                  <div class="form-group">
                    <label class="col-lg-2 control-label">Nama</label>
                      <div class="col-lg-8">
                        <input type="text" name="no_rm" class="form-control" value="<?php echo $u->pas_nama;?>" readonly="">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Status</label>
                    <div class="col-lg-4">
                      <select class="form-control" name="status" id="status" >
                        <option value="<?php echo $u->in_status;?>">
                          <?php
                          $jstatus = $u->in_status;
                          switch ($jstatus) {
                            case '0':
                              echo "Pasien Lama";
                            break;
                                                                                      
                            case '1':
                              echo "Pasien Baru";
                            break;
                            }
                          ?>.
                        </option>
                        <option value="0">Pasien Lama</option>
                        <option value="1">Pasien Baru</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Tanggal Masuk</label>
                    <div class="col-lg-4">
                      <input class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="yyyy-MM-dd" value="<?php echo $u->in_tgl_masuk;?>" data-date-format="yyyy-mm-dd" data-provide="datepicker" />
                    </div>
                  </div>

                  <input type="hidden" name="id" value="<?php echo $u->in_id;?>">

                  <div class="form-group ">
                    <label class="control-label col-lg-2">Kedatangan</label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-5">
                          <select class="form-control" name="datang" id="ked" onchange="loadKedatangan()">
                            <option value="<?php echo $u->in_jen_datang;?>">
                              <?php
                              $jstatus = $u->in_jen_datang;
                              switch ($jstatus) {
                                case '0':
                                  echo "Belum Dipilih!!";
                                break;
                                                                                          
                                case '1':
                                  echo "Sendiri";
                                break;

                                case '2':
                                  echo "Poli";
                                  break;

                                case '3':
                                  echo "Rujukan";
                                  break;
                                }
                              ?>.
                            </option>
                            <option value="1">Sendiri</option>
                            <option value="2">Poli</option>
                            <option value="3">Rujukan</option>
                          </select>
                        </div>
                        <div class="col-lg-5" id="datkead">
                          <input type="hidden" value="<?php echo $u->datang_detail;?>" name="datnya">
                          <input type="text" class="form-control" readonly="" value="<?php 
                            if ($u->datang_detail == 3) {
                                echo 'Dokter.';
                              }else if($u->datang_detail == 4){
                                echo 'Puskesmas.';
                              }else if($u->datang_detail == 5){
                                echo 'Instansi Lain.';
                              }else{
                                echo '';
                              }
                              ?>">
                        </div>
                      </div>
                    </div>
                  </div> 

                  <div class="form-group ">
                    <label class="control-label col-lg-2">Kamar Awal</label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-5">
                          <select class="form-control" name="kamar" id="kamar" onchange="loadKamar()">
                            <option value="<?php echo $u->in_kamar;?>"><?php echo $u->kmr_nama;?>.</option>
                            <?php
                            foreach ($kamars->result() as $kamar) {
                              echo "<option value='$kamar->kmr_id'>$kamar->kmr_nama</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <select class="form-control" name="kamar_detail" id="detail">
                            <option value="<?php echo $u->in_kamar_detail;?>"><?php echo $u->kmr_d_nama;?>.</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group ">
                    <label class="control-label col-lg-2">Layanan</label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-5">
                          <select class="form-control" name="poli" onchange="loadDokter()" id="poli">
                            <option value="<?php echo $u->in_poli;?>"><?php echo $u->poli_nama;?>.</option>
                              <?php
                              foreach ($polis->result() as $poli) {
                                echo "<option value='$poli->poli_id'>$poli->poli_nama</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <select class="form-control" name="dokter" id="dokter">
                            <option value="<?php echo $u->in_dokter;?>"><?php echo $u->dokter_nama;?>.</option>
                          </select>
                        </div>
                      </div>
                  </div>
                  </div>

                  <div class="form-group ">
                    <label class="control-label col-lg-2">Pembayaran</label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-5">
                          <select class="form-control" name="bayar" onchange="loadBayar()" id="bayar">
                            <option value="<?php echo $u->in_bayar;?>"><?php echo $u->bay_nama;?>.</option>
                            <?php
                              foreach ($bayars->result() as $bay) {
                              echo "<option value='$bay->bay_id'>$bay->bay_nama</option>";
                              }
                            ?>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <select name='detail_bayar' id='detbayar' class='form-control'>
                          <option value="<?php echo $u->in_bayar_detail;?>"><?php echo $u->bay_det_nama;?></option>                            
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>   

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-primary">UPDATE</button>                  
                  <a href="<?php echo base_url() ?>rekam/c_rm_ri/tampilMasuk" class="btn btn-default" role="button">CANCEL</a>
                </div>
              </div>
              
              <?php endforeach ?>

            </form>
          </div>
        </section>
      </div>                       
    </div>                         
    <!-- page end-->
  </section>
</section>

<!--modaltambah kategori-->
  

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>