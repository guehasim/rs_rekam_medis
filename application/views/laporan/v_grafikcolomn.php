<style type="text/css">
.tombol-tambah{
    padding-bottom: 5px;
}
.jarak{
  padding-top: 10px;
}
</style>
<script type="text/javascript" src="<?php echo base_url() ?>assets/chart/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/chart/highcharts.js"></script>

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
        <h3 class="page-header"><i class="icon_genius"></i>Grafik</h3>
        <ol class="breadcrumb">
            <li><i class="fa fa-home"></i>Laporan</li>
            <li><i class="icon_genius"></i>Grafik</li>                
          </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <!-- /.panel-heading -->
          <div class="panel-body">

              <div id="contan"></div>
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

<script type="text/javascript">

  Highcharts.chart('contan', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Grafik AKLPCM'
      },
      xAxis: {
          categories: [
              'TPIP',
              'IGD',
              'Kamar',
              'OK',
              'Gizi',
              'Farmasi'
          ],
          crosshair: true
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Presentase(Pasien)'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:1f} </b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
          name: 'Lengkap',
          data: [
          <?php echo $tpip_lp; ?>,<?php echo $igd_lp; ?>,<?php echo $kamar_lp; ?>,<?php echo $ok_lp; ?>,<?php echo $gizi_lp; ?>,<?php echo $farmasi_lp; ?>]

      },{
          name:'Tidak Lengkap',
          data: [<?php echo $tpip_tp; ?>,<?php echo $igd_tp; ?>,<?php echo $kamar_tp; ?>,<?php echo $ok_tp; ?>,<?php echo $gizi_tp; ?>,<?php echo $farmasi_tp; ?>]
      }
      ]
  });

</script>