<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css"/>

<style type="text/css">
.tombol-tambah{
    padding-bottom: 20px;
}
.jarak{
  padding-top: 10px;
}
</style>

<script type="text/javascript">


function loadTampil() {
  var bul = $("#bulan").val();
  var tah = $("#tahun").val();
  var pil = $("#opsi").val();

  if (pil == 1) {
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKecamatan",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }else if(pil == 2){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKecLama",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }else if(pil == 3){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilStatus",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }else if(pil == 4){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilPoli",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }else if(pil == 5){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilPenyakit",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }else if(pil == 6){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilBayar",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statusnya").html(html);
      }
    });

  }
   else{}  
}
</script>

<script type="text/javascript">

function loadLihat() {
  var bul = $("#bulank").val();
  var tah = $("#tahunk").val();
  var pil = $("#opsik").val();

  if (pil == 1) {
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKecamatans",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 2){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKecLamas",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 3){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilStatuss",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 4){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilDatangs",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 5){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKeadaans",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 6){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilPolis",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if (pil == 7){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilPenyakits",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if (pil == 8){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilBayars",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if (pil == 9){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilDokter",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if (pil == 10){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilAKLPCM",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 11){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilSetuju",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 12){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKLPCM",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 13){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilBor",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else if(pil == 14){
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_laporan/tampilKmr",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#statuslah").html(html);
      }
    });
  }

  else{};  
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
            <li><a class="" href="<?php echo base_url() ?>rekam/c_rm_ri/tampilMasuk">Rawat Inap</a></li>
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

        <li class="active">
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
        <h3 class="page-header"><i class="icon_document_alt"></i>Laporan</h3>
        <ol class="breadcrumb">
            <li><i class="icon_document_alt"></i>Laporan</li>                
          </ol>
      </div>
    </div>
    
    <div class="row">
    	<div class="col-lg-12">
    		<section class="panel">
          <header class="panel-heading tab-bg-primary ">
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#jalan">Rawat Jalan</a>
              </li>
              <li class="">
                <a data-toggle="tab" href="#inap">Rawat Inap</a>
              </li>
            </ul>
          </header>
          <div class="panel-body">
            <div class="tab-content">

              <div id="jalan" class="tab-pane active">
                <section class="panel">
                <header class="panel-heading">
                  Pencarian Laporan Rekam Medis Rawat Jalan
                </header>
                  <div class="panel-body">
                  <form method="post" action="<?php echo base_url(); ?>laporan/c_grafik/CekRawatJalan">
                    <div class="form-group">
                    <label class="control-label col-lg-1">Bulan</label>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-2">
                          <select class="form-control" id="bulan" name="bulan">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select>
                        </div>                          
                        <div class="col-lg-2">
                          <input class=" form-control" placeholder="2000" value="<?php echo date("Y");?>" id="tahun" name="tahun" data-date-format="yyyy" data-provide="datepicker" />
                        </div>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-1">Opsi</label>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-4">
                          <select class="form-control" id="opsi" name="opsi">
                            <option value="1">1. Kecamatan</option>
                            <option value="2">2. Kecamatan (Pasien Lama)</option>
                            <option value="3">3. Jumlah Pasien Lama dan Baru</option>
                            <option value="4">4. Pelayanan Poli</option>
                            <option value="5">5. 10 Besar Peyakit</option>
                            <option value="6">6. Jenis Pembayaran</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-1"></label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-6 tombol-tambah">
                          <button type="button" class="btn btn-danger" onclick="javascript:loadTampil();" >Cek</button>
                          <button type="submit" class="btn btn-success" target='_blank' name='cetak'>Cetak</button>
                        </div>
                      </div>
                    </div>
                    </div>

                    <div id="statusnya"></div>

                  </div>
                  </form>
                </section>
              </div>

              <div id="inap" class="tab-pane">
                <section class="panel">
                  <header class="panel-heading">
                    Pencarian Laporan Rekam Medis Rawat Inap
                  </header>
                  <div class="panel-body">
                    <form method="post" action="<?php echo base_url(); ?>laporan/c_grafik/CekRawatInap">
                    <div class="form-group">
                    <label class="control-label col-lg-1">Bulan</label>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-2">
                          <select class="form-control" id="bulank" name="bulank">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select>
                        </div>                          
                        <div class="col-lg-2">
                          <input class=" form-control" placeholder="2000" value="<?php echo date("Y");?>" name="tahunk" id="tahunk" data-date-format="yyyy" data-provide="datepicker" />
                        </div>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-1">Opsi</label>
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-4">
                          <select class="form-control" id="opsik" name="opsik">
                            <option value="1">1. Kecamatan</option>
                            <option value="2">2. Kecamatan (Pasien Lama)</option>
                            <option value="3">3. Jumlah Pasien Lama dan Baru</option>
                            <option value="4">4. Jenis Kedatangan Pasien</option>
                            <option value="5">5. Keadaan Pulang Pasien</option>
                            <option value="6">6. Jenis Pelayanan</option>
                            <option value="7">7. 10 Besar Penyakit</option>
                            <option value="8">8. Jenis Pembayaran Pasien</option>
                            <option value="9">9. Kunjungan Dokter</option>
                            <option value="10">10. AKLPCM</option>
                            <option value="11">11. AKLPCM Informed Consent</option>
                            <option value="12">12. KLPCM</option>
                            <option value="13">13. Jumlah BOR, LOS, TOI, HARI PERAWATAN</option>
                            <option value="14">14. Jumlah BOR, LOS, TOI, BTO Per Ruangan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-lg-1"></label>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-6 tombol-tambah">
                          <button type="button" class="btn btn-danger" onclick="javascript:loadLihat();" >Cek</button>
                          <button type="submit" class="btn btn-success" target='_blank' name='cetak'>Cetak</button>
                        </div>
                      </div>
                    </div>
                    </div>

                    <div id="statuslah"></div>

                  </div>
                  </form>
                </section>
              </div>

            </div>
          </div>
        </section>                   
      </div>                       
    </div>                         
    <!-- page end-->
  </section>
</section>


<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>