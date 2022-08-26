<?php 

class c_rm_ri extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('rekam/m_rm_ri');
        $this->load->model('register/m_poli');
        $this->load->model('rekam/m_rm_rj');
	}

    //fungsi rekam medis rawat inap masuk


    public function tampilMasuk(){

        $user = $this->session->userdata('admin');
        if ($user == "") {
            $this->load->view('login/v_login');
        }else{
            $data['rminapmasuk'] = $this->m_rm_ri->LihatMasuk();
            $this->load->view('template/nav');
            $this->load->view('rekam/v_rm_ri_msk',$data);
        }       
    }

    public function getDataMasuk()
    {
        if (isset($_GET['us']) ) {
            $id = $_GET['us'];
            $data['polis']      = $this->m_poli->lihat();  
            $data['kamars']     = $this->m_rm_ri->getKamar();
            $data['bayars']     = $this->m_rm_rj->getBayar();  
            $data['user']       = $this->m_rm_ri->getDatanyaMasuk($id);        
            $this->load->view('template/nav');
            $this->load->view('rekam/v_rm_ri_msk_update',$data);
        }
    }

    public function kamar(){
        $kamarID = $_GET['id'];
        $detail = $this->db->get_where('kamar_detail',array('kmr_id'=>$kamarID));
        echo "<option>--Pilih Detail Kamar--</option>";
        foreach ($detail->result() as $det) 
        {
            echo "<option value='$det->kmr_d_id'>$det->kmr_d_nama</option>";
        }
    }

    public function datangnya(){
        $kodeID = $_GET['id'];
        if ($kodeID == 1) {
            echo "<input type='hidden' name='datnya' value='1'>";
        }
        else if($kodeID == 2){
            echo "<input type='hidden' name='datnya' value='2'>";
        }
        else if ($kodeID == 3) {
            echo "<select class='form-control' name='datnya'>";
            echo "<option value='3'>Dokter</option> ";
            echo "<option value='4'>Puskesmas</option> ";
            echo "<option value='5'>Instansi Lain</option> ";
            echo "</select>";
        }else{
            echo "<input type='hidden' name='datnya' value='0'>";
        }
    }

    public function hasil(){
        $kodeID = $_GET['id'];
        if ($kodeID == 1) {
            echo "<input type='hidden' name='detnya' value='1'>";
        }else if ($kodeID == 2) {
            echo "<input type='hidden' name='detnya' value='2'>";
        }else if ($kodeID == 3) {
            echo "<input type='hidden' name='detnya' value='3'>";
        }else if ($kodeID == 4) {
            echo "<select class='form-control' name='detnya'>";
            echo "<option value='4'>Kurang dari 48 jam</option> ";
            echo "<option value='5'>Lebih dari 48 jam</option> ";
            echo "</select>";
        }else{
            echo "<input type='hidden' name='detnya' value=''>";
        }
    }

    public function proses_tambahMasuk()
    {
        if (isset($_POST)) {
            $this->m_rm_ri->tambah_dataMasuk();

            $this->session->set_flashdata('msg',
                '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
                </div>');
            
            redirect('rekam/c_rm_ri/tampilMasuk');
        }
        else{
            echo "no";
        }
    }

    public function proses_updateMasuk()
    {
        $id             = $this->input->post('id');
        $rm             = $this->input->post('no_rm');
        $statusnya      = $this->input->post('status');
        $tgl_masuk      = $this->input->post('tgl_masuk');
        $datang         = $this->input->post('datang');
        $dat_det        = $this->input->post('datnya');
        $kamar          = $this->input->post('kamar');
        $kamar_detail   = $this->input->post('kamar_detail');
        $poli           = $this->input->post('poli');
        $dokter         = $this->input->post('dokter');
        $bayar          = $this->input->post('bayar');
        $detail         = $this->input->post('detail_bayar');
        $status         = 0;

        $data = array(
            'in_rm'             => $rm,
            'in_status'         => $statusnya,
            'in_tgl_masuk'      => $tgl_masuk,
            'in_jen_datang'     => $datang,
            'datang_detail'     => $dat_det,
            'in_kamar'          => $kamar,
            'in_kamar_detail'   => $kamar_detail,
            'in_poli'           => $poli,
            'in_dokter'         => $dokter,
            'in_bayar'          => $bayar,
            'in_bayar_detail'   => $detail,
            'status'            => $status
            );

        $where = array(
            'in_id' =>$id
            );

        $this->m_rm_ri->update_data($where,$data,'rekam_inap_masuk');

        $this->session->set_flashdata('msg',
                '<div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
                </div>');

        redirect('rekam/c_rm_ri/tampilMasuk');
    }

    public function proses_hapusMasuk()
    {
        $id = $this->input->post('id');
        $this->m_rm_ri->hapus_dataMasuk($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
                </div>');
        
        redirect('rekam/c_rm_ri/tampilMasuk');

    }

    public function proses_updateKeluar()
    {
        $id             = $this->input->post('id');

        $data = array(
            'status'            => 1
            );

        $where = array(
            'in_id' =>$id
            );

        $this->m_rm_ri->update_data($where,$data,'rekam_inap_masuk');

        $this->session->set_flashdata('msg',
                '<div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Proses sudah selesai, Pasien sudah bisa keluar !!
                </div>');

        redirect('rekam/c_rm_ri/tampilMasuk');
    }



    //fungsi rekam medis rawat inap keluar

	public function tampilKeluar(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$data['rminapkeluar'] = $this->m_rm_ri->LihatKeluar();
			$this->load->view('template/nav');
			$this->load->view('rekam/v_rm_ri_klr',$data);
		}		
	}

    public function getDataklr_tambah()
    {
        if (isset($_GET['us']) ) {
            $id = $_GET['us'];
            $data['datas'] = $id;
            $data['user'] = $this->m_rm_ri->getDatanyaKeluar($id);
            $data['kamars'] = $this->m_rm_ri->getKamar();
            $data['kamard'] = $this->m_rm_ri->kamart($id);             
            $this->load->view('template/nav');
            $this->load->view('rekam/v_rm_ri_klr_tambah',$data);
        }
    }

    public function getData()
    {
        if (isset($_GET['us']) ) {
            $id = $_GET['us'];
            $data['user'] = $this->m_rm_ri->getDatanya($id); 
            $data['kamars'] = $this->m_rm_ri->getKamar();           
            $this->load->view('template/nav');
            $this->load->view('rekam/v_rm_ri_edit',$data);
        }
    }

    public function proses_tambahKeluar()
    {
        if (isset($_POST)) {
            $this->m_rm_ri->tambah_dataKeluar();

            $this->session->set_flashdata('msg',
                '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Data sudah ditambahkan, Pasien Sudah dapat keluar !!
                </div>');
            
            redirect('rekam/c_rm_ri/tampilMasuk');
        }
        else{
            echo "no";
        }
    }

    public function proses_update()
    {


        $start_tgl = $this->input->post('tgl_masuk');
        $end_tgl = $this->input->post('tgl_keluar');
        $pindah = $this->input->post('kode_pindah');

        $tindakan = $this->input->post('tin_kode');
        if ($tindakan == NULL) {
            $kode_tin = '0.1';
        }else{
            $kode_tin = $tindakan;
        }

        $date1 = $start_tgl;
        $date2 = $end_tgl;         
        $lamanya = ((abs(strtotime ($date1) - strtotime ($date2)))/(60*60*24));

        if ($pindah == 1) {
            $hari = $lamanya+2;
            $pin = '1';
            $kmr_akhir = $this->input->post('kamar');
            $kmr_d_akhir = $this->input->post('detail_kamar');
            
        }else{
            $hari = $lamanya;
            $pin = '0';
            $kmr_akhir = $this->input->post('kamarpl');
            $kmr_d_akhir = $this->input->post('kamarpd');
        }

        $rm                 = $this->input->post('no_rm');
        $keadaan            = $this->input->post('keadaan');
        $ked_detail         = $this->input->post('detnya');
        $diagnosa_code      = $this->input->post('dig_kode');
        $diagnosa_categori  = $this->input->post('dig_cat');
        $tindakan_kode      = $kode_tin;
        $kamarnya           = $kmr_akhir;
        $kamar_detail       = $kmr_d_akhir;
        $pindah_kode        = $this->input->post('kode_pindah');
        $tpipnya            = $this->input->post('tpip');
        $igdnya             = $this->input->post('igd');
        $kamarsnya          = $this->input->post('kamars');
        $oknya              = $this->input->post('ok');
        $gizinya            = $this->input->post('gizi');
        $farmasinya         = $this->input->post('farmasi');
        $setujunya          = $this->input->post('setuju');

        $data = array(
            'inap_tgl_keluar'       => $end_tgl,
            'inap_keadaan'          => $keadaan,
            'keadaan_detail'        => $ked_detail,
            'inap_diagnosa'         => $diagnosa_code,
            'diagnosa_kategori'     => $diagnosa_categori,
            'inap_tindakan'         => $tindakan_kode,
            'inap_kamar_akhir'      => $kamarnya,
            'akhir_detail'          => $kamar_detail,
            'inap_lama'             => $lamanya,
            'status_pindah'         => $pin,
            'inap_hari'             => $hari,
            'inap_tpip'             => $tpipnya,
            'inap_igd'              => $igdnya,
            'inap_kamar'            => $kamarsnya,
            'inap_ok'               => $oknya,
            'inap_gizi'             => $gizinya,
            'inap_farmasi'          => $farmasinya,
            'inap_setuju'           => $setujunya
            );

        $where = array(
            'inap_rm'               => $rm
            );

        $this->m_rm_ri->update_data($where,$data,'rekam_inap');
        $this->session->set_flashdata('msg',
                '<div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
                </div>');

        redirect('rekam/c_rm_ri/tampil');
    }

    public function proses_hapusKeluar()
    {
        $id = $this->input->post('id');
        $this->m_rm_ri->hapus_dataKeluar($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Data sudah di Update, Sekarng pasien tidak jadi keluar !!
                </div>');
        
        redirect('rekam/c_rm_ri/tampilKeluar');
    }

    public function pindah()
    {
        $kod = $this->input->post('rm');
        $nama = $this->input->post('nama');
        $id = $this->input->post('kmr');

        $data['kod']    = $kod;
        $data['nama']   = $nama;
        $data['kamard'] = $this->m_rm_ri->kamart($id);			
		$data['kamars'] = $this->m_rm_ri->getKamar();
		$data['datet']	= $this->input->post('tgl_msk');
        $this->load->view('template/nav');
        $this->load->view('rekam/v_rm_ri_tambah',$data);
    }
}