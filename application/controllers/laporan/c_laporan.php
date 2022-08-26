<?php 

class c_laporan extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$this->load->view('template/nav');
			$this->load->view('laporan/v_cari_laporan');
		}		
	}

	//start rawat jalan

    public function tampilKecamatan()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $kecs = $this->db->query("SELECT ii.pas_kec,iii.nama_kec, COUNT(*) AS kec_jalan 
                                    FROM rekam_jalan i
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                    GROUP BY ii.pas_kec ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kecamatan Pasien Rawat Jalan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Kecamatan</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($kecs->result() as $kec):
                  echo "<tr>"; 
                  echo "<td>$kec->nama_kec</td>";
                  echo "<td>$kec->kec_jalan</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success' name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilKecLama()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $lamas = $this->db->query("SELECT ii.pas_kec,iii.nama_kec, COUNT(*) AS kec_lama 
                                    FROM rekam_jalan i
                                    INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE i.jln_status='0' && Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                    GROUP BY ii.pas_kec ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kesetiaan Pasien Rawat Jalan Berdasarkan Kecamatan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Kecamatan</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($lamas->result() as $lama):
                  echo "<tr>"; 
                  echo "<td>$lama->nama_kec</td>";
                  echo "<td>$lama->kec_lama</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success' name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilStatus()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $statuss = $this->db->query("SELECT 
                                      (SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=1 && Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID) AS p_baru,
                                      (SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=0 && Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID) AS p_lama");

    	echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Status Pasien Rawat Jalan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Status Pasien</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($statuss->result() as $status):
                  echo "<tr>"; 
                  echo "<td>Pasien Baru</td>";
                  echo "<td>$status->p_baru</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>Pasien Lama</td>";
                  echo "<td>$status->p_lama</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
    	";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success' name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilPoli()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $polis = $this->db->query("SELECT ii.poli_nama, COUNT(*) AS total_poli 
                                    FROM rekam_jalan i
                                    INNER JOIN poli ii ON i.jln_poli = ii.poli_id
                                    WHERE Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                    GROUP BY jln_poli ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kecamatan Pasien Rawat Jalan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Nama Poli</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($polis->result() as $poli):
                  echo "<tr>"; 
                  echo "<td>$poli->poli_nama</td>";
                  echo "<td>$poli->total_poli</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilPenyakit()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $penyakits = $this->db->query("SELECT i.jln_diagnosa,ii.indonesia, COUNT(*) AS total_penyakit
                                      FROM rekam_jalan i
                                      INNER JOIN icd_10 ii ON i.jln_diagnosa = ii.kode_icd AND i.jln_categori = ii.categori
                                      WHERE Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                      GROUP BY i.jln_diagnosa LIMIT 10");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Diagnosa Pasien Rawat Jalan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis Penyakit</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($penyakits->result() as $penyakit):
                  echo "<tr>"; 
                  echo "<td>$penyakit->indonesia</td>";
                  echo "<td>$penyakit->total_penyakit</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilBayar()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $bayars = $this->db->query("SELECT ii.bay_nama,iii.bay_det_nama, COUNT(*) AS total_biaya
                                    FROM rekam_jalan i
                                    INNER JOIN pembayaran ii ON i.jln_biaya = ii.bay_id
                                    INNER JOIN bayar_detail iii ON i.biaya_detail = iii.bay_det_id
                                    WHERE Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                    GROUP BY i.biaya_detail ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Pembayaran Pasien Rawat Jalan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis Pembayaran</th>
                  <th>Detail Pembayaran</th>
                  <th>Total Status</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($bayars->result() as $bayar):
                  echo "<tr>"; 
                  echo "<td>$bayar->bay_nama</td>";
                  echo "<td>$bayar->bay_det_nama</td>";
                  echo "<td>$bayar->total_biaya</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }


    //end rawat jalan   


    //start rawat inap

    
    public function tampilKecamatans()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $kecs = $this->db->query("SELECT ii.pas_kec, iii.nama_kec, COUNT(*) AS kec_inap 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                    GROUP BY ii.pas_kec ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kecamatan Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Kecamatan</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($kecs->result() as $kec):
                  echo "<tr>"; 
                  echo "<td>$kec->nama_kec</td>";
                  echo "<td>$kec->kec_inap</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilKecLamas()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $lamas = $this->db->query("SELECT ii.pas_kec, iii.nama_kec, COUNT(*) AS kec_lama 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
                                    INNER JOIN lok_kecamatan iii ON ii.pas_kec = iii.id_kec
                                    WHERE i.in_status='0' && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                    GROUP BY ii.pas_kec ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kesetiaan Pasien Rawat Inap Berdasarkan Kecamatan
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Kecamatan</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($lamas->result() as $lama):
                  echo "<tr>"; 
                  echo "<td>$lama->nama_kec</td>";
                  echo "<td>$lama->kec_lama</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilStatuss()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $statusl = $this->db->query("SELECT 
                                      (SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=1 && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID) AS p_baru,
                                      (SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=0 && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID) AS p_lama
                                      ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Status Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Status Pasien</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($statusl->result() as $status):
                  echo "<tr>"; 
                  echo "<td>Pasien Baru</td>";
                  echo "<td>$status->p_baru</td>";
                  echo "</tr>";
                  
                  echo "<tr>"; 
                  echo "<td>Pasien Lama</td>";
                  echo "<td>$status->p_lama</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilDatangs()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $datangs = $this->db->query("SELECT in_jen_datang, datang_detail, COUNT(*) AS status_datang FROM rekam_inap_masuk WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID GROUP BY datang_detail ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kedatangan Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis Kedatangan</th>
                  <th>Detail Kedatangan</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($datangs->result() as $datang):
                  echo "<tr>"; 
                  echo "<td>" ;                 
                  switch ($datang->in_jen_datang) {                                                                        
                    case '1':
                      echo 'Sendiri';
                    break;

                    case '2':
                      echo 'Poli';
                    break;

                    case '3':
                      echo 'Rujukan';
                    break;
                        }
                  echo "</td>";
                  echo "<td>";
                  switch ($datang->datang_detail) {
                    case '1':
                      echo "";
                      break;
                    case '2':
                      echo "";
                    break;
                    case '3':
                      echo "Dokter";
                    break;
                    case '4':
                      echo "Puskesmas";
                    break;
                    case '5':
                      echo "Instansi Lain";
                    break;
                  }
                  echo "</td>";
                  echo "<td>$datang->status_datang</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilKeadaans()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $keadaans = $this->db->query("SELECT keadaan_detail, COUNT(*) AS status_keadaan FROM rekam_inap_keluar WHERE Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID GROUP BY keadaan_detail ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Keadaan Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Keadaan Pasien Pulang</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($keadaans->result() as $keadaan):
                  echo "<tr>"; 
                  echo "<td>" ;                 
                  switch ($keadaan->keadaan_detail) {                                                                        
                    case '1':
                      echo 'Sehat';
                    break;

                    case '2':
                      echo 'Pulang Sendiri';
                    break;

                    case '3':
                      echo 'Dirujuk';
                    break;
                    
                    case '4':
                      echo "Mati <48 Jam";
                    break;

                    case '5':
                      echo "Mati >48 Jam";
                      break;
                        }
                  echo "</td>";
                  echo "<td>$keadaan->status_keadaan</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilPolis()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $polis = $this->db->query("SELECT ii.poli_nama, COUNT(*) AS total_poli 
                                    FROM rekam_inap_masuk i
                                    INNER JOIN poli ii ON i.in_poli = ii.poli_id
                                    WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                    GROUP BY i.in_poli ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kecamatan Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Nama Poli</th>
                  <th>Jumlah Pasien</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($polis->result() as $poli):
                  echo "<tr>"; 
                  echo "<td>$poli->poli_nama</td>";
                  echo "<td>$poli->total_poli</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

  public function tampilPenyakits()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $penyakits = $this->db->query("SELECT i.inap_diagnosa,ii.indonesia, COUNT(*) AS total_penyakit
                                      FROM rekam_inap_keluar i
                                      INNER JOIN icd_10 ii ON i.inap_diagnosa = ii.kode_icd AND i.diagnosa_kategori = ii.categori
                                      WHERE Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID
                                      GROUP BY i.inap_diagnosa LIMIT 10");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Diagnosa Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis Penyakit</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($penyakits->result() as $penyakit):
                  echo "<tr>"; 
                  echo "<td>$penyakit->indonesia</td>";
                  echo "<td>$penyakit->total_penyakit</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

  public function tampilBayars()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $bayars = $this->db->query("SELECT ii.bay_nama,iii.bay_det_nama, COUNT(*) AS total_biaya
                                    FROM rekam_inap_masuk i
                                    INNER JOIN pembayaran ii ON i.in_bayar = ii.bay_id
                                    INNER JOIN bayar_detail iii ON i.in_bayar_detail = iii.bay_det_id
                                    WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                    GROUP BY i.in_bayar_detail ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Pembayaran Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis Pembayaran</th>
                  <th>Detail Pembayaran</th>
                  <th>Total Status</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($bayars->result() as $bayar):
                  echo "<tr>"; 
                  echo "<td>$bayar->bay_nama</td>";
                  echo "<td>$bayar->bay_det_nama</td>";
                  echo "<td>$bayar->total_biaya</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilDokter()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $dokters = $this->db->query("SELECT ii.dokter_nama, COUNT(*) AS total_dokter
                                    FROM rekam_inap_masuk i
                                    INNER JOIN dokter ii ON i.in_dokter = ii.dokter_id
                                    WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                    GROUP BY i.in_dokter ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Kunjungan Dokter Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Nama Dokter</th>
                  <th>Jumlah Kunjungan</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($dokters->result() as $dokter):
                  echo "<tr>"; 
                  echo "<td>$dokter->dokter_nama</td>";
                  echo "<td>$dokter->total_dokter</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilAKLPCM()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $setujus = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS tpip_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS igd_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS kamar_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS ok_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS gizi_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS farmasi_lp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS tpip_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS igd_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS kamar_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS ok_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS gizi_tp,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS farmasi_tp
                                  ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan AKLPCM Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Jenis AKLPCM</th>
                  <th>Lengkap</th>
                  <th>Tidak Lengkap</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($setujus->result() as $setuju):
                  echo "<tr>"; 
                  echo "<td>TPIP</td>";
                  echo "<td>$setuju->tpip_lp</td>";
                  echo "<td>$setuju->tpip_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>IGD</td>";
                  echo "<td>$setuju->igd_lp</td>";
                  echo "<td>$setuju->igd_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>Kamar</td>";
                  echo "<td>$setuju->kamar_lp</td>";
                  echo "<td>$setuju->kamar_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>OK</td>";
                  echo "<td>$setuju->ok_lp</td>";
                  echo "<td>$setuju->ok_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>Gizi</td>";
                  echo "<td>$setuju->gizi_lp</td>";
                  echo "<td>$setuju->gizi_tp</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>Farmasi</td>";
                  echo "<td>$setuju->farmasi_lp</td>";
                  echo "<td>$setuju->farmasi_tp</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

  public function tampilSetuju()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $setujus = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS lengkap,
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS tidak_lengkap
                                    ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan AKLPCM Informed Consent Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Status Kelengkapan</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($setujus->result() as $setuju):
                  echo "<tr>"; 
                  echo "<td>Lengkap</td>";
                  echo "<td>$setuju->lengkap</td>";
                  echo "</tr>";

                  echo "<tr>"; 
                  echo "<td>Tidak Lengkap</td>";
                  echo "<td>$setuju->tidak_lengkap</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilKLPCM()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $setujus = $this->db->query("SELECT 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS lengkap, 
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS tidak_lengkap
                                  ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan KLPCM Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Status</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($setujus->result() as $setuju):
                  echo "<tr>"; 
                  echo "<td>Lengkap</td>";
                  echo "<td>$setuju->lengkap</td>";
                  echo "</tr>";
                  
                  echo "<tr>"; 
                  echo "<td>Tidak Lengkap</td>";
                  echo "<td>$setuju->tidak_lengkap</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
                <button type='submit' class='btn btn-success'name='grafik' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    public function tampilBor()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $bors = $this->db->query("SELECT * FROM hitung_rm WHERE Month(hitung_date)=$bulanID && YEAR(hitung_date)=$tahunID ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan AKPLCM Informed Consent Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Pasien Awal</th>
                  <th>Pasien Keluar</th>
                  <th>Sisa Pasien</th>
                  <th>Hari Prwtn</th>
                  <th>Lama Drwt</th>
                  <th>TT</th>
                  <th>Periode</th>
                  <th>BOR %</th>
                  <th>ALOS (HR)</th>
                  <th>TOI (HR)</th>
                  <th>BTO X</th>
                  <th>NDR </th>
                  <th>GDR </th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($bors->result() as $bor):
                  echo "<tr>";
                  echo "<td>$bor->hitung_pas_awal</td>";
                  echo "<td>$bor->hitung_pas_keluar</td>";
                  echo "<td>$bor->hitung_pas_sisa</td>";
                  echo "<td>$bor->hitung_hr_rawat</td>";
                  echo "<td>$bor->hitung_lm_rawat</td>";
                  echo "<td>$bor->hitung_tt</td>";
                  echo "<td>$bor->hitung_periode</td>";
                  echo "<td>$bor->hitung_bor</td>";
                  echo "<td>$bor->hitung_alos</td>";
                  echo "<td>$bor->hitung_toi</td>";
                  echo "<td>$bor->hitung_bto</td>";
                  echo "<td>$bor->hitung_ndr</td>";
                  echo "<td>$bor->hitung_gdr</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
              </div>
            </div>
          </div>
        </div>
      ";
    }

  public function tampilKmr()
    {

      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $kamars = $this->db->query("SELECT i.h_kmr_kamar, i.h_kmr_awal, i.h_kmr_keluar, i.h_kmr_sisa, i.h_kmr_hr, i.h_kmr_lm,
                                  i.h_kmr_tt, i.h_kmr_periode, i.h_kmr_bor, i.h_kmr_alos, i.h_kmr_toi, i.h_kmr_bto, i.h_kmr_ndr,
                                  i.h_kmr_gdr, ii.kmr_d_nama
                                  FROM hitung_kmr i
                                  INNER JOIN kamar_detail ii ON i.h_kmr_kamar = ii.kmr_d_id
                                  WHERE Month(i.h_kmr_date)=$bulanID && YEAR(i.h_kmr_date)=$tahunID ");

      echo "
        <div class='col-sm-11 '>
          <section class='panel'>
            <header class='panel-heading no-border'>
              Laporan Perhitungan PerRuangan Pasien Rawat Inap
            </header>
            <table class='table table-bordered tombol-tambah'>
              <thead>
                <tr>
                  <th>Kamar</th>
                  <th>Pasien Awal</th>
                  <th>Pasien Keluar</th>
                  <th>Sisa Pasien</th>
                  <th>Hari Prwtn</th>
                  <th>Lama Drwt</th>
                  <th>TT</th>
                  <th>Periode</th>
                  <th>BOR %</th>
                  <th>ALOS (HR)</th>
                  <th>TOI (HR)</th>
                  <th>BTO X</th>
                  <th>NDR </th>
                  <th>GDR </th>
                </tr>
              </thead>
              <tbody>
                ";
                foreach ($kamars->result() as $kamar):
                  echo "<tr>";
                  echo "<td>$kamar->kmr_d_nama</td>";
                  echo "<td>$kamar->h_kmr_awal</td>";
                  echo "<td>$kamar->h_kmr_keluar</td>";
                  echo "<td>$kamar->h_kmr_sisa</td>";
                  echo "<td>$kamar->h_kmr_hr</td>";
                  echo "<td>$kamar->h_kmr_lm</td>";
                  echo "<td>$kamar->h_kmr_tt</td>";
                  echo "<td>$kamar->h_kmr_periode</td>";
                  echo "<td>$kamar->h_kmr_bor</td>";
                  echo "<td>$kamar->h_kmr_alos</td>";
                  echo "<td>$kamar->h_kmr_toi</td>";
                  echo "<td>$kamar->h_kmr_bto</td>";
                  echo "<td>$kamar->h_kmr_ndr</td>";
                  echo "<td>$kamar->h_kmr_gdr</td>";
                  echo "</tr>";
                endforeach;
  echo "      </tbody>
            </table>
          </section>
      </div>
      ";

      echo "
      <div class='form-group'>
        <label class='control-label col-lg-1'></label>
          <div class='col-lg-10'>
            <div class='row'>
              <div class='col-lg-6'>
              </div>
            </div>
          </div>
        </div>
      ";
    }

}