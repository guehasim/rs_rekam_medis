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
        <a href="<?php echo base_url() ?>register/c_poli/tampil">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="icon_genius"></i>
              <div class="count">
                <?php foreach ($polis as $poli) {?>
                  <?php echo $poli->id ; ?>
                <?php } ?>
              </div>
              <div class="title">poli</div>         
            </div><!--/.info-box-->     
          </div><!--/.col-->
        </a>  
        
        <a href="<?php echo base_url() ?>register/c_dokter/tampil">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-user-md"></i>
              <div class="count">
                <?php foreach ($dokters as $dokter) {?>
                  <?php echo $dokter->idd ; ?>
                <?php } ?>
              </div>
              <div class="title">Dokter</div>            
            </div><!--/.info-box-->     
          </div><!--/.col-->
        </a>
        
      </div><!--/.row-->

    </section>
  </section>