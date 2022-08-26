<?php 

class c_data_pasien extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('register/m_data_pasien');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$data['kirims']     = $this->m_data_pasien->lihat();
			$data['kabupatens']  = $this->m_data_pasien->getKota();
			$this->load->view('template/nav');
			$this->load->view('register/v_data_pasien',$data);
		}		
	}

    public function getData()
    {
        if (isset($_GET['us']) ) {
            $id = $_GET['us'];
            $data['user'] = $this->m_data_pasien->getDatanya($id);
            $data['kabupatens'] = $this->m_data_pasien->getKota();     
            $this->load->view('template/nav');
            $this->load->view('register/v_data_pasien_ubah',$data);
        }
    }

	public function kecamatan(){
        $kabupatenID = $_GET['id'];
        $kecamatan = $this->db->get_where('lok_kecamatan',array('id_kabupaten'=>$kabupatenID));
        echo "<option>--Pilih Kecamatan--</option>";
        foreach ($kecamatan->result() as $kec) 
        {
            echo "<option value='$kec->id_kec'>$kec->nama_kec</option>";
        }
    }

    public function desa()
    {
    	$kecamatanID	= $_GET['id'];
    	$desa			= $this->db->get_where('lok_desa',array('id_kecamatan'=>$kecamatanID));
    	echo "<option>--Pilih Kelurahan/Desa--</option>";
    	foreach ($desa->result() as $d) 
    	{
    		echo "<option value='$d->id_des'>$d->nama_des</option>";
    	}
    }
    public function proses_tambah()
    {
        $cek_rm = $this->input->post('no_rm');
        $where = array(
            'pas_no_rm' => $cek_rm
            );
        $cek = $this->m_data_pasien->cek_no_rm("tbl_pasien",$where)->num_rows();
        if ($cek > 0) {    

            $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Maaf Nomor RM sudah digunakan
                </div>');
            
            redirect('register/c_data_pasien/tampil');      

        }else{

            if (isset($_POST)) {
                $this->m_data_pasien->tambah_data();

                $this->session->set_flashdata('msg',
                    '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    Berhasil Menyimpan
                    </div>');
                
                redirect('register/c_data_pasien/tampil');
            }
            else{
                echo "no";
            }
            
        }
    }

    public function proses_update()
    {
        $id         = $this->input->post('id');
        $rm         = $this->input->post('no_rm');
        $nama       = $this->input->post('nama');
        $jenkel     = $this->input->post('jenkel');
        $tgl_lahir  = $this->input->post('tgl_lahir');
        $kabupaten  = $this->input->post('kabupaten');
        $kecamatan  = $this->input->post('kecamatan');
        $desa       = $this->input->post('desa');
        $rt         = $this->input->post('rt');
        $rw         = $this->input->post('rw');

        $data = array(
            'pas_no_rm'     => $rm,
            'pas_nama'      => $nama,
            'pas_jenkel'    => $jenkel,
            'pas_tgl_lahir' => $tgl_lahir,
            'pas_kab'       => $kabupaten,
            'pas_kec'       => $kecamatan,
            'pas_desa'      => $desa,
            'pas_rt'        => $rt,
            'pas_rw'        => $rw
            );

        $where = array(
            'pas_id' =>$id
            );

        $this->m_data_pasien->update_data($where,$data,'tbl_pasien');

        $this->session->set_flashdata('msg',
                '<div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
                </div>');

        redirect('register/c_data_pasien/tampil');
    }

    public function proses_hapus()
    {

        $id = $this->input->post('id');
        $this->m_data_pasien->hapus_data($id);

        $this->session->set_flashdata('msg',
                '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
                </div>');
        
        redirect('register/c_data_pasien/tampil');

    }
}