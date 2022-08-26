<?php
class c_poli extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('register/m_poli');
		$this->load->library('session');
	}

	public function tampil(){

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{			
			$data['polis'] = $this->m_poli->lihat();
			$this->load->view('template/nav');
			$this->load->view('lain/v_poli', $data);
		}
	}

	public function proses_tambah()
	{
		if (isset($_POST)) {
			$this->m_poli->tambah_data();

			$this->session->set_flashdata('msg',
				'<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menyimpan
				</div>');
			
			redirect('register/c_poli/tampil');
		}
		else{
			echo "no";
		}
	}

	public function proses_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');

		$data = array(
			'poli_nama' => $nama
			);

		$where = array(
			'poli_id' =>$id
			);

		$this->m_poli->update_data($where,$data,'poli');

		$this->session->set_flashdata('msg',
				'<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Mengubah
				</div>');
		redirect('register/c_poli/tampil');
	}

	public function proses_hapus()
    {
    	$id = $this->input->post('id');
        $this->m_poli->hapus_data($id);

        $this->session->set_flashdata('msg',
				'<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Berhasil Menghapus
				</div>');
        redirect('register/c_poli/tampil');

    }
}