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

  function loadKeadaan() 
  {
    var bay = $("#ked").val();
    $.ajax({
    type:'GET',
    url:"<?php echo base_url() ?>rekam/c_rm_ri/hasil",
    data:"id=" + bay,
    success: function(html)
      {
        $("#detkead").html(html);
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
        <h3 class="page-header"><i class="icon_plus_alt2"></i>Tambah Data Rekam Medis Rawat Jalan</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-file-text-o"></i>Rekam Medis</li>
            <li><i class="icon_profile"></i>Rawat Jalan</li>
            <li><i class="icon_plus_alt2"></i>Tambah</li>                
          </ol>
      </div>
    </div>
    <!-- page start--> 
    <div class="row">
      <div class="col-lg-12">

        <section class="panel">
          <div class="panel-body">            

            <form class="form-validate form-horizontal" id="register_form_rm_rj" role="form" method="post" action="<?php echo base_url(); ?>rekam/c_rm_ri/proses_tambahKeluar">
              <?php foreach ($user->result() as $u): ?>
                
              <div class="form-group">
                    <label class="control-label col-lg-2">No.RM</label>
                    <div class="col-lg-8">
                      <input class="form-control" id="no_rm" value="<?php echo $u->in_rm;?>" placeholder="Nomer rekam Medik" maxlength="6" name="no_rm" type="text" onkeypress="return hanyaAngka(event)" readonly />
                    </div>
                  </div>


              <?php endforeach ?>

                  <input type="hidden" name="id_masuk" value="<?php echo $datas; ?>">
              
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Tanggal Keluar</label>
                      <div class="col-lg-7">
                        <input type="text" id="tgl_keluar" class="form-control" name="tgl_keluar" value="<?php echo date("Y-m-d");?>" placeholder="yyyy-MM-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker">
                      </div>                  
                      <div class="col-lg-2">
                        <?php foreach ($user->result() as $u): ?>
                          <input type="hidden" name="tgl_masuk" value="<?php echo $u->in_tgl_masuk;?>" >
                        <?php endforeach ?>                        
                      </div>
                  </div>
              
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Keadaan Pulang</label>
                      <div class="col-lg-4">
                        <select class="form-control" name="keadaan" id="ked" onchange="loadKeadaan()">
                            <option value="0">--Pilih Keadaan--</option>
                            <option value="1">Sehat</option>
                            <option value="2">Pulang sendiri</option>
                            <option value="3">Dirujuk</option>
                            <option value="4">Mati</option>
                          </select>
                      </div>
                      <div class="col-lg-4" id="detkead"></div>
                  </div>
              
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Diagnosa</label>
                      <div class="col-lg-7">
                        <input type="text" class="form-control" id="indonesia" name="indonesia" readonly="">
                        <input type="hidden" id="categori" name="dig_cat">
                        <input type="hidden" id="kode_icd" name="dig_kode">
                      </div>
                      <div class="col-lg-2">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cari</button>
                      </div>
                  </div>
              
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Tindakan</label>
                      <div class="col-lg-7">
                        <input type="text" class="form-control" id="str" name="str" readonly="">
                        <input type="hidden" id="kodenya" name="tin_kode">
                      </div>
                      <div class="col-lg-2">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">Cari</button>
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Kamar akhir</label>
                    <div class="col-lg-3">
                      <select class="form-control" name="kamar" id="kamar" onchange="loadKamar()">
                        <option value="">--Pilih Kamar--</option>
                          <?php
                          foreach ($kamars->result() as $kamar) {
                            echo "<option value='$kamar->kmr_id'>$kamar->kmr_nama</option>";
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <select class="form-control" name="detail_kamar" id="detail">
                        <option>--Pilih Detail Kamar--</option>
                      </select>
                    </div>

                    <?php
                    foreach ($kamard->result() as $kamarx){
                      echo "<input type='hidden' name='kamarpl' value='$kamarx->kmr_id'>";
                      echo "<input type='hidden' name='kamarpd' value='$kamarx->kmr_d_id'>";
                    }       
                    ?>
                    <div class="col-lg-2">
                      <label class="checkbox-inline">
                        <input type="checkbox" value="1" name="kode_pindah"> Pindah Kamar
                      </label>
                    </div>
                  </div><div class="form-group">
                    <label class="control-label col-lg-2">Kode Rekam Medis :</label>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">  1. TPIP</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="tpip" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="tpip" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">  2. IGD</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="igd" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="igd" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">3. Kamar</label>
                    <div class="col-lg-2">
                      <?php
                        foreach ($kamard->result() as $kmr) {
                          echo "<label class='control-label'>$kmr->kmr_nama</label>";
                          echo " / ";
                          echo "<label class='control-label'>$kmr->kmr_d_nama</label>";
                          }
                        ?>
                    </div>
                    <div class="col-lg-5">
                      <label class="checkbox-inline"><input type="radio" name="kamars" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="kamars" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">4. OK(RM 19)</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="ok" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="ok" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">5. Gizi</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="gizi" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="gizi" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">6. Farmasi</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="farmasi" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="farmasi" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2 kiri">7. Persetujuan</label>
                    <div class="col-lg-10">
                      <label class="checkbox-inline"><input type="radio" name="setuju" id="optionsRadios1" value="0" checked> Lengkap</label>
                      <label class="checkbox-inline"><input type="radio" name="setuju" id="optionsRadios2" value="1"> Tidak Lengkap</label>
                    </div>
                  </div> 

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-primary">KELUAR</button>                  
                  <a href="<?php echo base_url() ?>rekam/c_rm_ri/tampilMasuk" class="btn btn-default" role="button">CANCEL</a>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>                       
    </div>                         
    <!-- page end-->
  </section>
</section>

<!--modaltambah kategori-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">DATA DIAGNOSA</h4>
        </div>
        <div class="modal-body">
          <table id="lookup" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>Kode ICD</th>
                  <th>Kategori</th>
                  <th>Penjelasan</th>
                </tr>
              </thead>

              <tbody>
                <?php  
                $con = mysqli_connect('localhost', 'root', '', 'db_rekam_medis');
                $sql = mysqli_query($con,'SELECT * FROM icd_10');
                while ($r = mysqli_fetch_array($sql)) {
                  ?>
                <tr class="pilih" data-kodeicd="<?php echo $r['kode_icd']; ?>" 
                  data-categori="<?php echo $r['categori']; ?>" data-indonesia="<?php echo $r['indonesia']; ?>">
                  <td><?php echo $r['kode_icd']; ?></td>
                  <td><?php echo $r['categori']; ?></td>
                  <td><?php echo $r['indonesia']; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>                            
                                        
             </table>
        </div>
      </div>
    </div>
  </div>
  <!--end modaltambah kategori-->

   <!--modaltambah penanganan-->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">DATA PENANGANAN</h4>
        </div>
        <div class="modal-body">
          <table id="lookup2" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Penjelasan</th>
                </tr>
              </thead>

              <tbody>
                <?php  
                $con = mysqli_connect('localhost', 'root', '', 'db_rekam_medis');
                $sql = mysqli_query($con,'SELECT * FROM icd_9');
                while ($r = mysqli_fetch_array($sql)) {
                  ?>
                <tr class="pilih2" data-kode="<?php echo $r['code']; ?>" data-str="<?php echo $r['str']; ?>">
                  <td><?php echo $r['code']; ?></td>
                  <td><?php echo $r['str']; ?></td>
                </tr>
                <?php
                }
                ?>
                </tbody>                            
                                        
             </table>
        </div>
      </div>
    </div>
  </div>
  <!--end modaltambah diagnosa-->

 
  
  <script type="text/javascript">

//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("kode_icd").value = $(this).attr('data-kodeicd');
                document.getElementById("categori").value = $(this).attr('data-categori');
                document.getElementById("indonesia").value = $(this).attr('data-indonesia');
                $('#myModal').modal('hide');
            });

//            tabel lookup obat
            $(function () {
                $("#lookup").dataTable();
            });

            $(document).on('click', '.pilih2', function (e) {
                document.getElementById("kodenya").value = $(this).attr('data-kode');
                document.getElementById("str").value = $(this).attr('data-str');
                $('#myModal2').modal('hide');
            });

//            tabel lookup obat
            $(function () {
                $("#lookup2").dataTable();
            });
        </script>
  

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>