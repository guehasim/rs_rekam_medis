<style type="text/css">
.tombol-tambah{
    padding-bottom: 5px;
}
.jarak{
  padding-top: 10px;
}
</style>

<aside>
  <div id="sidebar"  class="nav-collapse">
     
     <ul class="sidebar-menu">                
        <li class="active">
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
        <h3 class="page-header"><i class="icon_genius"></i>Data Poli</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>Dashboard</li>
            <li><i class="icon_genius"></i>Poli</li>                
          </ol>
      </div>
    </div>
    <!-- page start-->        
    <div class="tombol-tambah">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_data" >TAMBAH</button>
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
                  <th>Nama Poli</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <?php $no = 1; foreach ($polis->result() as $poli): ?>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $poli->poli_nama;?></td>                  
                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-data-<?php echo $poli->poli_id;?>">UBAH</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-info-<?php echo $poli->poli_id;?>">HAPUS</button>                
                  </td>
                </tr>

                <!-- proses ubah data -->
                <div class="modal fade" id="edit-data-<?php echo $poli->poli_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form class="form-validate form-horizontal "method="post" action="<?php echo base_url(); ?>register/c_poli/proses_update">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Ubah Data Poli</h4>
                        </div>

                        <div class="modal-body">
                          <div class="form-group">
                            <label class="control-label col-lg-2">Nama</label>
                            <div class="col-lg-10">
                              <input class="form-control" placeholder="Nama Poli" value="<?php echo $poli->poli_nama;?>" name="nama" type="text" />
                            </div>
                          </div>
                        </div>

                        <input type="hidden" value="<?php echo $poli->poli_id;?>" name="id">

                        <div class="modal-footer">
                          <div class="col-lg-offset-2">
                            <button class="btn btn-primary" type="submit">Ubah</button>
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                          </div>
                        </div>
                      </form>            
                    </div>
                  </div>
                </div>
                <!-- end proses ubah data -->

                <!-- modal delete -->
                <div class="modal fade" id="hapus-info-<?php echo $poli->poli_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content edit-dialog-modal">
                      <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>register/c_poli/proses_hapus" method="post">    
                        <?php
                          $this->load->helper("form");
                        ?>
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Poli</h4>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="id" value="<?php echo $poli->poli_id;?>">
                          Apakah anda benar mau menghapus POLI "<?php echo $poli->poli_nama;?>" ini?
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
        <form class="form-validate form-horizontal" id="register_form_poli" method="post" action="<?php echo base_url(); ?>register/c_poli/proses_tambah">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tambah Poli</h4>
            </div>
            <div class="modal-body">
              <div class="form">
                
                  <?php
                    $this->load->helper("form");
                  ?>
                  <div class="form-group">
                    <label class="control-label col-lg-2" >Poli <span class="required">*</label>
                    <div class="col-lg-9">
                      <input class="form-control" placeholder="Nama Poli" name="nama" type="text" id="nama" />
                    </div>
                  </div>          

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

  <script src="<?php echo base_url() ?>assets/perpus/js/bootstrap-datepicker.js"></script>