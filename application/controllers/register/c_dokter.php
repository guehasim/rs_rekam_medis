<?php
class c_dokter extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('register/m_dokter');
		$this->load->model('register/m_poli');
		$this->load->library('session');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			$data['polis'] = $this->m_poli->lihat(); 			
			$data['dokters'] = $this->m_dokter->lihat();
			$this->load->view('template/nav');
			$this->load->view('lain/v_dokter', $data);
		}
	}

	public function proses_tambah()
	{
		if (isset($_POST)) {
			$this->m_dokter->tambah_data();

			$this->session->set_flashdata('msg',
				'<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
				</div>');
			
			redirect('register/c_dokter/tampil');
		}
		else{
			echo "no";
		}
	}

	public function proses_update()
	{
		$id = $this->input->post('id');
		$poli = $this->input->post('poli');
		$nama = $this->input->post('nama');

		$data = array(
			'poli_id' => $poli,
			'dokter_nama' => $nama
			);

		$where = array(
			'dokter_id' =>$id
			);

		$this->m_dokter->update_data($where,$data,'dokter');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');

		redirect('register/c_dokter/tampil');
	}

	public function proses_hapus()
    {
    	$id = $this->input->post('id');
        $this->m_dokter->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        
        redirect('register/c_dokter/tampil');

    }
}