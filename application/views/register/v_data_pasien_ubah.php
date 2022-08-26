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

.kiri{
  padding-left: 30px;
}
.kiri2{
  padding-left: 50px;
}
</style>

<script type="text/javascript">

$(document).ready(function(){
  $(".datepicker").datepicker();
});

            function loadKecamatans()
            {
                var kabupaten = $("#kabupatens").val();

                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url(); ?>register/c_data_pasien/kecamatan",
                    data:"id=" + kabupaten,
                    success: function(html)
                    { 
                        $("#kecamatans").html(html);
                    }
                }); 
            }

            function loadDesas()
            {
                var kecamatan = $("#kecamatans").val();
                $.ajax({
                    type:'GET',
                    url:"<?php echo base_url() ?>register/c_data_pasien/desa",
                    data:"id=" + kecamatan,
                    success: function(html)
                    { 
                        $("#desas").html(html);
                    }
                }); 
            }

</script>

<script type="text/javascript">
       $(function() {
    var name = $("#questions").val();
    $("input[name='"+name +"']").val("your value");
});​
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
        <h3 class="page-header"><i class="icon_check_alt2"></i>Form Ubah Data Pasien</h3>
      </div>
    </div>
    <!-- page start--> 
    <div class="row">
      <div class="col-lg-12">

        <section class="panel">
          <div class="panel-body">

            <?php foreach ($user->result() as $u): ?>            

            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>register/c_data_pasien/proses_update">  

              <div class="form-group">
                <label class="col-lg-2 control-label">No.RM</label>
                  <div class="col-lg-6">
                    <input class="form-control" value="<?php echo $u->pas_no_rm;?>" maxlength="6" placeholder="Nomer rekam Medik" name="no_rm" type="text" onkeypress="return hanyaAngka(event)" readonly />
                  </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">Nama</label>
                  <div class="col-lg-6">
                    <input class="form-control" value="<?php echo $u->pas_nama;?>" placeholder="Nama Pasien" name="nama" type="text"/>
                  </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-2">J.Kelamin</label>
                <div class="col-lg-3">
                  <select class="form-control" name="jenkel">
                    <option value="<?php echo $u->pas_jenkel;?>">
                    <?php
                    $jstatus = $u->pas_jenkel;
                    switch ($jstatus) {
                      case '0':
                        echo "Belum Dipilih";
                      break;
                                                                                      
                      case '1':
                        echo "Laki - Laki";
                      break;

                      case '2':
                        echo "Wanita";
                      break;
                      }
                    ?>
                    .</option>
                    <option value="1">Laki - Laki</option>
                    <option value="2">Wanita</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-2">Tanggal Lahir</label>
                <div class="col-lg-3">
                  <input class="form-control" id="tgl_lahir" value="<?php echo $u->pas_tgl_lahir;?>" name="tgl_lahir" placeholder="yyyy-MM-dd" data-date-format="yyyy-mm-dd" data-provide="datepicker" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-2" for="inputSuccess">Alamat</label>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-4">
                      <select class="form-control" name="kabupaten" onchange="loadKecamatans()" id="kabupatens">
                        <option value="<?php echo $u->pas_kab;?>"><?php echo $u->nama_kab;?>.</option>
                        <?php
                          foreach ($kabupatens->result() as $kab) {
                            echo "<option value='$kab->id_kab'>$kab->nama_kab</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-4">
                      <select class="form-control" name="kecamatan" id="kecamatans" onchange="loadDesas()">
                        <option value="<?php echo $u->pas_kec;?>"><?php echo $u->nama_kec;?>.</option>                                                       
                      </select>
                    </div>                        
                  </div>                        
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-2" for="inputSuccess"></label>
                <div class="col-lg-8">                              
                  <div class="row">                          
                    <div class="col-lg-4">
                      <select class="form-control" name="desa" id="desas">
                        <option value="<?php echo $u->pas_desa;?>"><?php echo $u->nama_des;?>.</option>
                      </select>
                    </div>  
                    <div class="col-lg-2">
                      <input type="text" value="<?php echo $u->pas_rt;?>" class="form-control" name="rt" placeholder="RT" onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="col-lg-2">
                      <input type="text" value="<?php echo "$u->pas_rw";?>" class="form-control" name="rw" placeholder="RW" onkeypress="return hanyaAngka(event)">
                    </div>
                  </div>                         
                </div>
              </div>

              <input type="hidden" value="<?php echo $u->pas_id;?>" name="id">       

              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-primary">UBAH</button>
                  <a href="<?php echo base_url() ?>register/c_data_pasien/tampil" class="btn btn-default" role="button">CANCEL</a>
                </div>
              </div>

            </form>
            <?php endforeach ?>
          </div>
        </section>
      </div>                       
    </div>                         
    <!-- page end-->
  </section>
</section>

<!--modaltambah kategori-->

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>