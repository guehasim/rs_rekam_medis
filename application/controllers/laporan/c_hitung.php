<?php 

class c_hitung extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('laporan/m_hitung');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
            $data['hitungs'] = $this->m_hitung->Lihat();
			$this->load->view('template/nav');
			$this->load->view('laporan/v_hitunglap',$data);
		}		
	}

    public function CekPasienAwal(){
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];

        $awals = $this->db->query("SELECT COUNT(*) AS id_awal FROM rekam_inap_masuk WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID");

        foreach ($awals->result() as $awal) 
        {
            echo "<label class='control-label col-lg-2'>Pasien Awal</label>";
            echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$awal->id_awal' name='awal' readonly='' />";
            echo "</div>";
        }

        
    }

	public function CekPasienMasuk(){
        $bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];

        $masuks = $this->db->query(" SELECT COUNT(*) AS id_masuk FROM rekam_inap_masuk WHERE Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID ");

        foreach ($masuks->result() as $masuk) 
        {
        	echo "<label class='control-label col-lg-2'>Pasien Masuk</label>";
        	echo "<div class='col-lg-4'>";
            echo "<input class='form-control' value='$masuk->id_masuk' name='masuk' readonly='' />";
            echo "</div>";
        }

        
    }

    public function CekPasienSisa()
    {
    	$bulanID = $_GET['bulan'];
        $tahunID = $_GET['tahun'];

    	$sisas = $this->db->query("SELECT COUNT(*) AS id_sisa FROM rekam_inap_masuk WHERE status='0' && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID ");

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

    	$lamas = $this->db->query("SELECT *,SUM(inap_lama) AS lama FROM rekam_inap_keluar WHERE Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

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

    	$haris = $this->db->query("SELECT *,SUM(inap_hari) AS hari FROM rekam_inap_keluar WHERE Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

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

        $kurangs = $this->db->query("SELECT *,COUNT(keadaan_detail) AS kurang_dari FROM rekam_inap_keluar WHERE keadaan_detail=4 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

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

        $lebihs = $this->db->query("SELECT *,COUNT(keadaan_detail) AS lebih_dari FROM rekam_inap_keluar WHERE keadaan_detail=5 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID ");

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
        $where = array(
            'hitung_date' => $date
            );
        $cek = $this->m_hitung->cekData("hitung_rm",$where)->num_rows();
        if ($cek > 0) {

            $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Data tidak bisa disimpan, karena sudah ada.
                </div>');
            redirect('laporan/c_hitung/tampil');                                    
            

        }else{

            if (isset($_POST)) {

            $this->m_hitung->tambah_data();
            $this->session->set_flashdata('msg',
                '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
                </div>');
            
            redirect('laporan/c_hitung/tampil');
            }
            else{
                echo "no";
            }            
        }		
	}

    public function proses_hapus()
    {
        $id = $this->input->post('id');
        $this->m_hitung->hapus_data($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
                </div>');
        redirect('laporan/c_hitung/tampil');

    }
}