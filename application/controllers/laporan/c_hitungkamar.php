<?php 

class c_hitungkamar extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('laporan/m_hitungkamar');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
            $data['hitungs'] = $this->m_hitungkamar->Lihat();
			$this->load->view('template/nav');
			$this->load->view('laporan/v_hitungkamar',$data);
		}		
	}

    public function CekKamar()
    {
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];

        $kamars = $this->db->query(" SELECT i.in_kamar_detail, ii.kmr_d_nama 
                                        FROM rekam_inap_masuk i
                                        INNER JOIN kamar_detail ii ON i.in_kamar_detail = ii.kmr_d_id
                                        WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID
                                        GROUP BY in_kamar_detail
            ");
        echo "<label class='control-label col-lg-2'>Pilih Kamar</label>";
        echo "<div class='col-lg-10'>";
        echo "<div class='row'>";
        echo "<div class='col-lg-4'>";
        echo "<select class='form-control' name='kamarnya' id='kamar'>";
        foreach ($kamars->result() as $kamar) 
        {            
            echo "<option value='$kamar->in_kamar_detail'>$kamar->kmr_d_nama</option>";            
        }
        echo "</select></div>";
        echo "<div class='col-lg-3'>";
        echo "<button type='button' class='btn btn-danger' onclick='javascript:loadKeadaan();'>Cek Perhitungan</button>";
        echo "</div></div></div>";
    }

    public function CekPasienAwal(){
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

        $awals = $this->db->query("SELECT COUNT(*) AS id_awal FROM rekam_inap_masuk WHERE in_kamar_detail=$kamarID && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID ");

        foreach ($awals->result() as $awal) 
        {
            echo "<label class='control-label col-lg-2'>Pasien Awal</label>";
            echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$awal->id_awal' name='awal' readonly='' />";
            echo "</div>";
        }

        
    }

    public function CekPasienSisa()
    {
    	$bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

    	$sisas = $this->db->query("SELECT COUNT(*) AS id_sisa FROM rekam_inap_masuk WHERE status='0' && in_kamar_detail=$kamarID && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID ");

        foreach ($sisas->result() as $sisa) 
        {
        	echo "<label class='control-label col-lg-2'>Sisa Pasien</label>";
        	echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$sisa->id_sisa' name='sisa' readonly='' />";
            echo "</div>";
        }
    }

    public function CekLamaRawat()
    {
    	$bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

    	$lamas = $this->db->query("SELECT *,SUM(inap_lama) AS lama FROM rekam_inap_keluar WHERE akhir_detail=$kamarID && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

        foreach ($lamas->result() as $lama) 
        {
        	echo "<label class='control-label col-lg-2'>Lama Perawatan</label>";
        	echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$lama->lama' name='lama' readonly='' />";
            echo "</div>";
        }
    }

    public function CekHariRawat()
    {
    	$bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

    	$haris = $this->db->query("SELECT *,SUM(inap_hari) AS hari FROM rekam_inap_keluar WHERE akhir_detail=$kamarID && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

        foreach ($haris->result() as $hari) 
        {
        	echo "<label class='control-label col-lg-2'>Hari Perawatan</label>";
        	echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$hari->hari' name='hari' readonly='' />";
            echo "</div>";
        }
    }



    public function CekKurang()
    {
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

        $kurangs = $this->db->query("SELECT *,COUNT(keadaan_detail) AS kurang_dari FROM rekam_inap_keluar WHERE akhir_detail=$kamarID && keadaan_detail=4 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

        foreach ($kurangs->result() as $kurang) 
        {
            echo "<label class='control-label col-lg-2'>Mati <48 jam</label>";
            echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$kurang->kurang_dari' name='kurang' readonly='' />";
            echo "</div>";
        }
    }

    public function CekLebih()
    {
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];
        $kamarID = $_GET['kamar'];

        $lebihs = $this->db->query("SELECT *,COUNT(keadaan_detail) AS lebih_dari FROM rekam_inap_keluar WHERE akhir_detail=$kamarID && keadaan_detail=5 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

        foreach ($lebihs->result() as $lebih) 
        {
            echo "<label class='control-label col-lg-2'>Mati >48 jam</label>";
            echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$lebih->lebih_dari' name='lebih' readonly='' />";
            echo "</div>";
        }
    }

    public function proses_tambah()
	{
        $bulanID = $this->input->post('bulan');
        $tahunID = $this->input->post('tahun');
        $date = $tahunID."-".$bulanID."-01";;
        $kamarID = $this->input->post('kamarnya');
        $where = array(
            'h_kmr_date' => $date,
            'h_kmr_kamar' => $kamarID
            );
        $cek = $this->m_hitungkamar->cekData("hitung_kmr",$where)->num_rows();
        if ($cek > 0) {

            $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Data tidak bisa disimpan, karena sudah ada.
                </div>');
            redirect('laporan/c_hitungkamar/tampil');                                   
            

        }else{

            if (isset($_POST)) {
            $this->m_hitungkamar->tambah_data();

            $this->session->set_flashdata('msg',
                '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
                </div>');
            
            redirect('laporan/c_hitungkamar/tampil');
        }
            else{
                echo "no";
            }            
        }

		
	}

    public function proses_hapus()
    {
        $id = $this->input->post('id');
        $this->m_hitungkamar->hapus_data($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
                </div>');
        redirect('laporan/c_hitungkamar/tampil');

    }
}