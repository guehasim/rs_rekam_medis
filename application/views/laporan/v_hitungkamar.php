<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css"/>

<style type="text/css">
.tombol-tambah{
    padding-bottom: 5px;
}
.jarak{
  padding-top: 10px;
}
.aksi{
  padding-bottom: 5px;
}
.aksi2{
  padding-bottom: 20px;
}
.wid{
  width: 120px;
}
</style>

<script type="text/javascript">

function loadKamar() {
  var bul = $("#bulan").val();
  var tah = $("#tahun").val();

  $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekKamar",
    data:{bulan:bul, tahun:tah},
    success: function(html)
      {
        $("#kamarnya").html(html);
      }
    });
}

function loadKeadaan() 
  {
    var bul = $("#bulan").val();
    var tah = $("#tahun").val();
    var kmr = $("#kamar").val();

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekPasienAwal",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#awalnya").html(html);
      }
    });

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekPasienSisa",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#sisanya").html(html);
      }
    });

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekLamaRawat",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#lamanya").html(html);
      }
    });

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekHariRawat",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#harinya").html(html);
      }
    });

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekKurang",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#kurangnya").html(html);
      }
    });

    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>laporan/c_hitungkamar/CekLebih",
    data:{bulan:bul, tahun:tah, kamar:kmr},
    success: function(html)
      {
        $("#lebihnya").html(html);
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
            <li class="active"><a class="" href="<?php echo base_url() ?>laporan/c_hitungkamar/tampil">Peruangan</a></li>
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
        <h3 class="page-header"><i class="fa fa-tachometer"></i>Hitung Rekam Medis Peruangan</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-tachometer"></i>Hitungan RM</li>
            <li><i class="fa fa-map-marker"></i>Peruangan</li>                 
          </ol>
      </div>
    </div>
    <!-- page start-->        
    <div class="tombol-tambah">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_data">TAMBAH</button>
    </div>
    <div>
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <!-- /.panel-heading -->
          <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>BLN</th>
                  <th>Kamar</th>
                  <th>Pasien Awal</th>
                  <th>Pasien Keluar</th>
                  <th>Sisa Pasien</th>
                  <th>JML HR PERWTN</th>
                  <th>JML LM DIRWT</th>
                  <th>TT</th>
                  <th>Aksi</th>

                </tr>
              </thead>

              <tbody>
                <tr>
                  <?php $no = 1; foreach ($hitungs->result() as $hitung): ?>
                  <td><?php echo $no++;?></td> 
                  <td>
                    <?php 
                    $timestamp = strtotime($hitung->h_kmr_date);
                    echo date('m-Y',$timestamp);
                    ?>
                  </td>
                  <td><?php echo $hitung->kmr_d_nama;?> </td>
                  <td><?php echo $hitung->h_kmr_awal;?></td>
                  <td><?php echo $hitung->h_kmr_keluar;?></td>
                  <td><?php echo $hitung->h_kmr_sisa;?></td>
                  <td><?php echo $hitung->h_kmr_hr;?></td>
                  <td><?php echo $hitung->h_kmr_lm;?></td>
                  <td><?php echo $hitung->h_kmr_tt;?></td>            
                  <td>
                    <div class="aksi">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detail-info-<?php echo $hitung->h_kmr_id;?>">LIHAT</button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-info-<?php echo $hitung->h_kmr_id;?>">HAPUS</button> 
                    </div>               
                  </td>
                </tr>

                <!-- modal delete -->
                <div class="modal fade" id="hapus-info-<?php echo $hitung->h_kmr_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content edit-dialog-modal">
                      <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>laporan/c_hitungkamar/proses_hapus" method="post">    
                        <?php
                          $this->load->helper("form");
                        ?>
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Jurusan</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $hitung->h_kmr_id;?>">
                          Apakah anda benar mau menghapus perhitungan pada bulan "<?php $timestamp = strtotime($hitung->h_kmr_date); echo date('m-Y',$timestamp);?>"
                          dan kamar "<?php echo $hitung->kmr_d_nama; ?>" ini?
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger">Hapus</button>
                          <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- end modal delete-->

                <!-- start modal detail-->
                <div class="modal fade" id="detail-info-<?php echo $hitung->h_kmr_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Detail Data Perhitungan Rekam Medis</h4>
                        </div>

                        <div class="modal-body">

                          <div class="">
                            <label class="control-label col-lg-4"><h3>Bulan</h3></label>
                            <div>
                              <label class="control-label"> <h3>: 
                                <?php
                                $timestamp = strtotime($hitung->h_kmr_date);
                                echo date('m-Y',$timestamp);
                                ?>
                              </h3> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Kamar</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->kmr_d_nama;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Pasien Awal</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_awal;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Pasien Keluar</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_keluar;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Pasien Sisa</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_sisa;?></h4> </label>
                            </div> 
                          </div> 

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Hari Perawatan</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_hr;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Lama Perawatan</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_lm;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>TT</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_tt;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>Periode</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_periode;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>BOR</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_bor;?>%</h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>ALOS(HR)</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_alos;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>TOI(HR)</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_toi;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>BTO</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_bto;?></h4> </label>
                            </div> 
                          </div>

                          <div class="">
                            <label class="control-label col-lg-4"><h4>NDR</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_ndr;?></h4> </label>
                            </div> 
                          </div> 

                          <div class="">
                            <label class="control-label col-lg-4"><h4>GDR</h4></label>
                            <div>
                              <label class="control-label"> <h4>: <?php echo $hitung->h_kmr_gdr;?></h4> </label>
                            </div> 
                          </div>                         
                      </div>

                    </div>
                  </div>
                </div>

                <?php endforeach ?>


              </tbody>                                          
                                        
             </table>
                                    <!-- /.table-responsive -->
            </div>
                                <!-- /.panel-body -->
           </div>
                            <!-- /.panel -->
          </div>
                        <!-- /.col-lg-12 -->
         </div>                         
    <!-- page end-->
  </section>
</section>

<!--modaltambah kategori-->
  <div class="modal fade" id="tambah_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="form-validate form-horizontal" id="register_form_poli" method="post" action="<?php echo base_url(); ?>laporan/c_hitungkamar/proses_tambah">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Perhitungan Rekam Medis</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                
                  <?php
                    $this->load->helper("form");
                  ?>
                  <div class="form-group">
                    <label class="control-label col-lg-2">Bulan</label>
                      <div class="col-lg-10">
                        <div class="row">
                          <div class="col-lg-4">
                            <select class="form-control" name="bulan" id="bulan">
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
                          <div class="col-lg-4">
                            <input class=" form-control" placeholder="2000" value="<?php echo date("Y");?>" id="tahun" name="tahun" data-date-format="yyyy" data-provide="datepicker" />
                          </div>
                          <div class="col-lg-2">
                            <button type="button" class="btn btn-danger" onclick="javascript:loadKamar();" >Cek</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" id="kamarnya"></div>
                  <div class="form-group" id="awalnya"></div>
                  <div class="form-group" id="sisanya"></div>
                  <div class="form-group" id="lamanya"></div>
                  <div class="form-group" id="harinya"></div>
                  <div class="form-group" id="kurangnya"></div>
                  <div class="form-group" id="lebihnya"></div>     


                  <div class="modal-footer">
                    <div class="col-lg-offset-2">
                      <button class="btn btn-success" type="submit">Tambah</button>
                      <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    </div>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!--end modaltambah kategori-->



  <script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>