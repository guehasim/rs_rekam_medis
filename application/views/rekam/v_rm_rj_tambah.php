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
            <li class="active"><a class="" href="<?php echo base_url() ?>rekam/c_rm_rj/tampil">Rawat Jalan</a></li>                          
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

            <form class="form-validate form-horizontal" id="register_form_rm_rj" role="form" method="post" action="<?php echo base_url(); ?>rekam/c_rm_rj/proses_tambah">
              <div class="form-group">
                <label class="col-lg-2 control-label">No.RM</label>
                  <div class="col-lg-8">
                    <input type="text" name="no_rm" class="form-control" value="<?php echo $nomor_rm;?>" readonly="">
                  </div>
              </div>

              <?php foreach ($namanya->result() as $u): ?>              

              <div class="form-group">
                <label class="col-lg-2 control-label">Nama</label>
                  <div class="col-lg-8">
                    <input type="text" name="no_rm" class="form-control" value="<?php echo $u->pas_nama;?>" readonly="">
                  </div>
              </div>

              <?php endforeach ?>

              <div class="form-group">
                  <label class="control-label col-lg-2">Status</label>
                  <div class="col-lg-4">
                    <select class="form-control" name="status" id="status" >
                    <option value="0">Pasien Lama</option>
                    <option value="1">Pasien Baru</option>
                  </select>
                </div>
              </div>

              <div class="form-group ">
              <label class="control-label col-lg-2">Layanan</label>
                <div class="col-lg-10">
                  <div class="row">
                    <div class="col-lg-5">
                      <select class="form-control" name="poli" onchange="loadDokter()" id="poli">
                        <option value="">--Pilih Poli--</option>
                        <?php foreach($polis->result() as $poli){ ?>
                        <option value="<?php echo $poli->poli_id; ?>"
                          <?php echo set_select('poli', $poli->poli_id, (!empty($data) && $data == $poli->poli_id ? TRUE : FALSE )) ?>>
                          <?php echo ucwords($poli->poli_nama); ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-lg-5">
                      <select class="form-control" name="dokter" id="dokter">
                        <option >--Pilih Dokter--</option>                                                         
                      </select>
                    </div>
                  </div>
                </div>
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
                <label class="control-label col-lg-2">Tanggal Masuk</label>
                <div class="col-lg-6">
                  <input class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="yyyy-MM-dd" value="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd" data-provide="datepicker" />
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-lg-2">Pembayaran</label>
                <div class="col-lg-10">
                  <div class="row">
                    <div class="col-lg-5">
                      <select class="form-control" name="biaya" onchange="loadBayar()" id="bayar">
                        <option value="">--Pilih Bayar--</option>
                        <?php
                          foreach ($bayars->result() as $bay) {
                          echo "<option value='$bay->bay_id'>$bay->bay_nama</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-5">
                      <select name='detail_biaya' id='detbayar' class='form-control'>
                        <option>--Pilih Pembayaran--</option>                            
                      </select>
                    </div>
                  </div>
                </div>
              </div>  

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-primary">TAMBAH</button>                  
                  <a href="<?php echo base_url() ?>rekam/c_rm_rj/tampil" class="btn btn-default" role="button">CANCEL</a>
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

            function dummy() {
                var kode_obat = document.getElementById("kode_icd").value;
                alert('kode obat ' + kode_obat + ' berhasil tersimpan');
            }
        </script>

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>