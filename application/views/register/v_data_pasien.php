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
  width: 145px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
  $(".datepicker").datepicker();
});
</script>

<script type="text/javascript">

function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }

            function loadKecamatan()
            {
                var kabupaten = $("#kabupatent").val();

                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>register/c_data_pasien/kecamatan",
                    data:"id=" + kabupaten,
                    success: function(html)
                    { 
                        $("#kecamatant").html(html);
                    }
                }); 
            }

            function loadDesa()
            {
                var kecamatan = $("#kecamatant").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url() ?>register/c_data_pasien/desa",
                    data:"id=" + kecamatan,
                    success: function(html)
                    { 
                        $("#desat").html(html);
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

        <li class="active">
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
        <h3 class="page-header"><i class="icon_desktop"></i>Daftar Nama Pasien</h3>
        <ol class="breadcrumb">
            <li><i class="icon_desktop"></i>Data Pasien</li>              
          </ol>
      </div>
    </div>
    <!-- page start-->        
    <div class="tombol-tambah">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_data" >DAFTAR BARU</button>
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
                  <th>No.RM</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $no = 1; foreach ($kirims->result() as $pasien): ?>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $pasien->pas_no_rm;?></td>
                  <td><?php echo $pasien->pas_nama;?></td>
                  <td>
                    <?php
                      $jenkel = $pasien->pas_jenkel;
                      switch ($jenkel) {
                        case '0':
                          echo "Belum DiPilih";
                        break;
                                                                        
                        case '1':
                          echo "Laki - Laki";
                        break;

                        case '2':
                          echo "Wanita";
                        break;
                        }
                      ?>
                    </td>
                    <td><?php echo $pasien->pas_tgl_lahir;?></td>
                    <td>Ds.<?php echo $pasien->nama_des;?>, Kec.<?php echo $pasien->nama_kec;?>, Kab.<?php echo $pasien->nama_kab;?></td>
                  <td>
                    <div class="aksi">
                      <a href="<?php echo base_url() ?>register/c_data_pasien/getData?us=<?php echo $pasien->pas_id; ?>"> <button type="button" class="btn btn-primary">UBAH</button></a>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-info-<?php echo $pasien->pas_id;?>">HAPUS</button>
                    </div>
                  </td>
                </tr>                

                <!-- modal delete -->
                <div class="modal fade" id="hapus-info-<?php echo $pasien->pas_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content edit-dialog-modal">
                      <form class="form-horizontal" action="<?php echo base_url(); ?>register/c_data_pasien/proses_hapus" method="post">    
                        <?php
                          $this->load->helper("form");
                        ?>
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Pasien</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $pasien->pas_id;?>">
                          Apakah anda benar mau menghapus Data "<?php echo $pasien->pas_nama;?>" ini?
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
        <form class="form-validate form-horizontal " method="post" action="<?php echo base_url(); ?>register/c_data_pasien/proses_tambah">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Form Pendaftaran Pasien Baru</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                
                  <?php
                    $this->load->helper("form");
                  ?>
                  <div class="form-group">
                    <label class="control-label col-lg-2">No.RM</label>
                    <div class="col-lg-5">
                      <input class="form-control" id="no_rm" name="no_rm" placeholder="Nomer rekam Medik" onkeypress="return hanyaAngka(event)" maxlength="6" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Nama</label>
                    <div class="col-lg-9">
                      <input class=" form-control" placeholder="Nama Pasien" id="nama" name="nama" type="text" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">J.Kelamin</label>
                    <div class="col-lg-4">
                      <select class="form-control" name="jenkel" id="jenkel" >
                        <option value="0">--Pilih Jenis Kelamin--</option>
                        <option value="1">Laki - Laki</option>
                        <option value="2">Wanita</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Tanggal Lahir</label>
                    <div class="col-lg-6">
                      <input class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="yyyy-MM-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-2">Alamat</label>
                      <div class="col-lg-10">
                        <div class="row">
                          <div class="col-lg-5">
                            <select class="form-control" name="kabupaten" onchange="loadKecamatan()" id="kabupatent">
                              <option value="">--Pilih Kabupaten/Kota--</option>
                              <?php
                              foreach ($kabupatens->result() as $kab) {
                                  echo "<option value='$kab->id_kab'>$kab->nama_kab</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-lg-5">
                            <select class="form-control" name="kecamatan" id="kecamatant" onchange="loadDesa()">
                            <option >--Pilih Kecamatan--</option>                                                         
                            </select>
                          </div>                        
                        </div>
                        <div class="row jarak">                          
                          <div class="col-lg-5">
                            <select class="form-control" name="desanya" id="desat">
                              <option value="">--Pilih Kelurahan/Desa--</option>
                            </select>
                          </div>  
                          <div class="col-lg-2">
                            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT" onkeypress="return hanyaAngka(event)">
                          </div>
                          <div class="col-lg-2">
                            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW" onkeypress="return hanyaAngka(event)">
                          </div>
                        </div>                          
                      </div>
                    </div>           

                  <div class="modal-footer">
                    <div class="col-lg-offset-2">
                      <button class="btn btn-success" type="submit">Daftar</button>
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