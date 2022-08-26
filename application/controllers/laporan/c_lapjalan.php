<?php

/**
* 
*/
class c_lapjalan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$this->load->view('template/nav');
			$this->load->view('v_lapjalan');
		}		
	}

	public function tampilKecamatan()
    {
      $bulanID = $_GET['bulan'];
      $tahunID = $_GET['tahun'];

      $kecs = $this->db->query("SELECT i.jln_al_kec,ii.nama_kec, COUNT(*) AS kec_jalan 
                                    FROM rawat_jalan i
                                    INNER JOIN lok_kecamatan ii ON i.jln_al_kec = ii.id_kec
                                    WHERE Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID
                                    GROUP BY jln_al_kec ");

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
                <button type='submit' class='btn btn-success' >GRAFIK</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }
}