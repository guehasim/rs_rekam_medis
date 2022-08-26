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

<?php if ($idfungsi == 1 && $validasi == 1){?>
  <script type="text/javascript">

    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik Pasien (Kecamatan) yang berobat Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.pas_kec, iii.nama_kec 
                                    FROM rekam_jalan i 
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm 
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec 
                                    GROUP BY ii.pas_kec  ");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['pas_kec'];
                $nama = $row['nama_kec'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS kec_jalan 
                                                        FROM rekam_jalan i 
                                                        INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm 
                                                        INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec 
                                                        WHERE ii.pas_kec = '$id' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun"));
                $hasil = $data['kec_jalan'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>
<?php 
} elseif ($idfungsi == 1 && $validasi == 2) {?>
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik kesetiaan pasien yang berobat Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.pas_kec, iii.nama_kec 
                                    FROM rekam_jalan i 
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm 
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec 
                                    WHERE i.jln_status = '0'
                                    GROUP BY ii.pas_kec ");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['pas_kec'];
                $nama = $row['nama_kec'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS kec_lama 
                                                        FROM rekam_jalan i
                                                        INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
                                                        INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                                        WHERE ii.pas_kec = '$id' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun"));
                $hasil = $data['kec_lama'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>
<?php
}elseif ($idfungsi == 1 && $validasi == 3) {?>

  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik pasien lama dan baru Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [{
            name:'Pasien Baru',
            y:<?php echo $baru; ?>
        },{
            name:'Pasien Lama',
            y:<?php echo $lama; ?>
        }]
        }]
    });
  </script>
<?php
}elseif ($idfungsi == 1 && $validasi == 4) {?>

  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik kunjungan Poli Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.poli_nama, i.jln_poli
                                      FROM rekam_jalan i
                                      INNER JOIN poli ii ON i.jln_poli = ii.poli_id
                                      GROUP BY jln_poli ");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['jln_poli'];
                $nama = $row['poli_nama'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_poli 
                                                        FROM rekam_jalan i
                                                        INNER JOIN poli ii ON i.jln_poli = ii.poli_id
                                                        WHERE jln_poli='$id' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun"));
                $hasil = $data['total_poli'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 1 && $validasi == 5) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik 10 besar penyakit Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.indonesia, i.jln_diagnosa, i.jln_categori
                                  FROM rekam_jalan i
                                  INNER JOIN icd_10 ii ON i.jln_diagnosa = ii.kode_icd AND i.jln_categori = ii.categori
                                  GROUP BY i.jln_diagnosa");

            while ($row = mysql_fetch_assoc($query)) {
                $diagnosa = $row['jln_diagnosa'];
                $kategori = $row['jln_categori'];
                $nama = $row['indonesia'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_penyakit
                                                        FROM rekam_jalan i
                                                        INNER JOIN icd_10 ii ON i.jln_diagnosa = ii.kode_icd AND i.jln_categori = ii.categori
                                                        WHERE jln_diagnosa='$diagnosa' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun 
                                                        LIMIT 10"));
                $hasil = $data['total_penyakit'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 1 && $validasi == 6) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik jenis pembayaran pasien Rawat Jalan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT iii.bay_det_nama, i.biaya_detail
                                      FROM rekam_jalan i
                                      INNER JOIN pembayaran ii ON i.jln_biaya = ii.bay_id
                                      INNER JOIN bayar_detail iii ON i.biaya_detail = iii.bay_det_id
                                      GROUP BY biaya_detail");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['biaya_detail'];
                $nama = $row['bay_det_nama'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_biaya
                                                    FROM rekam_jalan i
                                                    INNER JOIN pembayaran ii ON i.jln_biaya = ii.bay_id
                                                    INNER JOIN bayar_detail iii ON i.biaya_detail = iii.bay_det_id
                                                    WHERE biaya_detail='$id' && Month(jln_tgl_masuk)=$bulan && YEAR(jln_tgl_masuk)=$tahun"));
                $hasil = $data['total_biaya'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 1) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik asal pasien (kecamatan) yang berobat Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.pas_kec, iii.nama_kec 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    GROUP BY ii.pas_kec");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['pas_kec'];
                $nama = $row['nama_kec'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS kec_inap 
                                                        FROM rekam_inap_masuk i
                                                        INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                                        INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                                        WHERE ii.pas_kec='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['kec_inap'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 2) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik kesetiaan pasien yang berobat Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.pas_kec, iii.nama_kec 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE i.in_status='0' 
                                    GROUP BY ii.pas_kec");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['pas_kec'];
                $nama = $row['nama_kec'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS kec_inap 
                                                        FROM rekam_inap_masuk i
                                                        INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                                        INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                                        WHERE ii.pas_kec='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['kec_inap'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 3) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik pasien lama dan baru Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [{
            name:'Pasien Baru',
            y:<?php echo $baru; ?>
        },{
            name:'Pasien Lama',
            y:<?php echo $lama; ?>
        }]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 4) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik jenis kedatangan pasien yang berobat Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT datang_detail FROM rekam_inap_masuk GROUP BY datang_detail");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['datang_detail'];

                switch ($id) {
                    case '1':
                        $nama = 'Sendiri';
                        break;
                    
                    case '2':
                        $nama = 'Poli';
                        break;

                    case '3':
                        $nama = 'Rujukan Dokter';
                        break;

                    case '4':
                        $nama = 'Rujukan Puskesmas';
                        break;

                    case '5':
                        $nama = 'Instansi Lain';
                        break;
                }

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS status_datang FROM rekam_inap_masuk
                                                        WHERE datang_detail='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['status_datang'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 5) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik keadaan pulang pasien Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT keadaan_detail FROM rekam_inap_keluar GROUP BY keadaan_detail");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['keadaan_detail'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS status_keadaan 
                                                        FROM rekam_inap_keluar 
                                                        WHERE keadaan_detail='$id' && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun"));
                $hasil = $data['status_keadaan'];

                switch ($id) {
                    case '1':
                        $nama = 'Sehat';
                        break;
                    
                    case '2':
                        $nama = 'Pulang Sendiri';
                        break;

                    case '3':
                        $nama = 'Dirujuk';
                        break;

                    case '4':
                        $nama = 'Mati <48 Jam';
                        break;

                    case '5':
                        $nama = 'Mati >48 Jam';
                        break;
                }

            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 6) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik jenis pelayanan pasien Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT iii.poli_nama, i.in_poli 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN poli iii ON i.in_poli = iii.poli_id
                                    GROUP BY i.in_poli ");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['in_poli'];
                $nama = $row['poli_nama'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_poli 
                                                        FROM rekam_inap_masuk i
                                                        INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                                        INNER JOIN poli iii ON i.in_poli = iii.poli_id
                                                        WHERE i.in_poli='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['total_poli'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 7) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik 10 besar penyakit pasien Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT ii.indonesia, i.inap_diagnosa
                                    FROM rekam_inap_keluar i
                                    INNER JOIN icd_10 ii ON i.inap_diagnosa = ii.kode_icd AND i.diagnosa_kategori = ii.categori
                                    GROUP BY i.inap_diagnosa");

            while ($row = mysql_fetch_assoc($query)) {
                $diagnosa = $row['inap_diagnosa'];
                $nama = $row['indonesia'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_penyakit
                                                        FROM rekam_inap_keluar i
                                                        INNER JOIN icd_10 ii ON i.inap_diagnosa = ii.kode_icd AND i.diagnosa_kategori = ii.categori
                                                        WHERE inap_diagnosa='$diagnosa' && Month(inap_tgl_keluar)=$bulan && YEAR(inap_tgl_keluar)=$tahun
                                                        LIMIT 10"));
                $hasil = $data['total_penyakit'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 8) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik jenis pembayaran pasien Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT iv.bay_det_nama, i.in_bayar_detail
                                      FROM rekam_inap_masuk i
                                      INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                      INNER JOIN pembayaran iii ON i.in_bayar = iii.bay_id
                                      INNER JOIN bayar_detail iv ON i.in_bayar_detail = iv.bay_det_id
                                      GROUP BY i.in_bayar_detail");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['in_bayar_detail'];
                $nama = $row['bay_det_nama'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_biaya
                                                        FROM rekam_inap_masuk i
                                                        INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                                        INNER JOIN pembayaran iii ON i.in_bayar = iii.bay_id
                                                        INNER JOIN bayar_detail iv ON i.in_bayar_detail = iv.bay_det_id
                                                        WHERE in_bayar_detail='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['total_biaya'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 9) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik kunjungan dokter pasien Rawat Inap'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [
            <?php
            $query = mysql_query("SELECT iii.dokter_nama, i.in_dokter
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN dokter iii ON i.in_dokter = iii.dokter_id
                                    GROUP BY i.in_dokter");

            while ($row = mysql_fetch_assoc($query)) {
                $id = $row['in_dokter'];
                $nama = $row['dokter_nama'];

                $data = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS total_dokter
                                                        FROM rekam_inap_masuk i
                                                        INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                                        INNER JOIN dokter iii ON i.in_dokter = iii.dokter_id
                                                        WHERE in_dokter='$id' && Month(in_tgl_masuk)=$bulan && YEAR(in_tgl_masuk)=$tahun"));
                $hasil = $data['total_dokter'];
            ?>['<?php echo $nama ?>', <?php echo $hasil ?>],<?php
            }?>
            ]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 11) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik AKLPCM Informed Consent'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [{
            name:'Lengkap',
            y:<?php echo $lengkap; ?>
        },{
            name:'Tidak Lengkap',
            y:<?php echo $tidak_lengkap; ?>
        }]
        }]
    });
  </script>

<?php
}elseif ($idfungsi == 2 && $validasi == 12) {?>
  
  <script type="text/javascript">
    Highcharts.chart('contan', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik KLPCM'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                },
                showInLegend:true
            }
        },
        series: [{
            name: 'Presentasi',
            colorByPoint: true,
            data: [{
            name:'Lengkap',
            y:<?php echo $lengkap; ?>
        },{
            name:'Tidak Lengkap',
            y:<?php echo $tidak_lengkap; ?>
        }]
        }]
    });
  </script>

<?php
}
else{}?>