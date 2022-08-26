<?php 

class c_rm_rj extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->model('register/m_poli');
		$this->load->model('rekam/m_rm_rj');
        $this->load->model('register/m_data_pasien');
        $this->load->model('rekam/m_rm_ri');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$data['rmjalans']    = $this->m_rm_rj->LihatReg();
			$this->load->view('template/nav');
			$this->load->view('rekam/v_rm_rj',$data);
		}		
	}

    public function dokter()
    {
        $poliID     = $_GET['id'];
        $dokter = $this->db->get_where('dokter',array('poli_id'=>$poliID));
        echo "<option>--Pilih Dokter--</option>";
        foreach ($dokter->result() as $r) 
        {
            echo "<option value='$r->dokter_id'>$r->dokter_nama</option>";
        }
    }

    public function pembayaran()
    {
        $bayarID     = $_GET['id'];
        $bayars = $this->db->get_where('bayar_detail',array('bay_id'=>$bayarID));
        echo "<option>--Pilih Pembayaran--</option>";
        foreach ($bayars->result() as $bayar) 
        {
            echo "<option value='$bayar->bay_det_id'>$bayar->bay_det_nama</option>";
        }
    }

    public function cekno_rm()
    {
        $cek_rm = $this->input->post('nomor_rm');
        $ids = $this->input->post('id');
        $where = array(
            'pas_no_rm' => $cek_rm
            );
        $cek = $this->m_data_pasien->cek_no_rm("tbl_pasien",$where)->num_rows();
        if ($cek > 0) {

            if ($ids == 1) {
                $data['nomor_rm'] = $cek_rm;
                $data['namanya'] = $this->m_data_pasien->getDatanyaPasien($cek_rm);
                $data['bayars'] = $this->m_rm_rj->getBayar();  
                $data['polis'] = $this->m_poli->lihat();           
                $this->load->view('template/nav');
                $this->load->view('rekam/v_rm_rj_tambah',$data);
            }else{
                $data['nomor_rm']   = $cek_rm;
                $data['namanya'] = $this->m_data_pasien->getDatanyaPasien($cek_rm);
                $data['kamars']     = $this->m_rm_ri->getKamar();
                $data['bayars']     = $this->m_rm_rj->getBayar();  
                $data['polis']      = $this->m_poli->lihat();           
                $this->load->view('template/nav');
                $this->load->view('rekam/v_rm_ri_msk_tambah',$data);
            }

            
        }else{
            $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Maaf Nomor Rekam Medis tidak Tersedia !!
                </div>');
            
            redirect('rekam/c_rm_rj/tampil');
        }
    }

    public function kategori(){
        $kodeID = $_GET['id'];
        $kategoris = $this->db->get_where('icd_10',array('kode_icd'=>$kodeID));
        foreach ($kategori->result() as $kategori) 
        {
            echo "<option value='$kategori->categori'>$kategori->indonesia</option>";
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

    public function proses_tambah()
    {
        if (isset($_POST)) {
            $this->m_rm_rj->tambah_data();

            $this->session->set_flashdata('msg',
                '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
                </div>');
            
            redirect('rekam/c_rm_rj/tampil');
        }
        else{
            echo "no";
        }
    }

    public function getData()
    {
        if (isset($_GET['us']) ) {
            $id = $_GET['us'];            
            $data['bayars'] = $this->m_rm_rj->getBayar();  
            $data['polis'] = $this->m_poli->lihat();  
            $data['user'] = $this->m_rm_rj->getDatanya($id);            
            $this->load->view('template/nav');
            $this->load->view('rekam/v_rm_rj_edit',$data);
        }
    }

    public function proses_update()
    {
        $id             = $this->input->post('id');
        $no_rm          = $this->input->post('no_rm');
        $status         = $this->input->post('status');
        $poli           = $this->input->post('poli');
        $dokter         = $this->input->post('dokter');
        $diagnosa       = $this->input->post('dig_kode');
        $categori       = $this->input->post('dig_cat');
        $tgl_masuk      = $this->input->post('tgl_masuk');
        $biaya          = $this->input->post('biaya');
        $biaya_detail   = $this->input->post('detail_biaya');

        $data = array(
            'jln_no_rm'     => $no_rm,
            'jln_status'    => $status,
            'jln_poli'      => $poli,
            'jln_dokter'    => $dokter,
            'jln_diagnosa'  => $diagnosa,
            'jln_categori'  => $categori,
            'jln_tgl_masuk' => $tgl_masuk,
            'jln_biaya'     => $biaya,
            'biaya_detail'  => $biaya_detail
            );

        $where = array(
            'jln_id' =>$id
            );

        $this->m_rm_rj->update_data($where,$data,'rekam_jalan');

        $this->session->set_flashdata('msg',
                '<div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
                </div>');

        redirect('rekam/c_rm_rj/tampil');
    }

    public function proses_hapus()
    {
        $id = $this->input->post('id');
        $this->m_rm_rj->hapus_data($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
                </div>');
        
        redirect('rekam/c_rm_rj/tampil');
    }

    public function pindah()
    {
        $kod = $this->input->post('rm');
        $nama = $this->input->post('nama');

        $data['rm'] = $kod;
        $data['nama'] = $nama;
        $this->load->view('template/nav');
        $this->load->view('rekam/v_rm_rj_tambah',$data);
    }
}