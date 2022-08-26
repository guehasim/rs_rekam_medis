<?php 

class index extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('register/m_poli');
		$this->load->model('register/m_dokter');
		$this->load->library('session');
	}

	public function index()
	{

		$user = $this->session->userdata('admin');
		if ($user == "") {
			$this->load->view('login/v_login');
		}else{
			redirect('index/admin_page');
		}
	}

	public function aksi_login()
	{
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		if ($user == "admin" && $pass == "admin") {
			$this->session->set_userdata(array('admin' => $user));
			redirect('index/admin_page');
		}else{
			redirect('index');
		}
	}

	public function admin_page()
	{
		$data['polis'] = $this->m_poli->HitungPoli();
		$data['dokters'] = $this->m_dokter->HitungDokter();
		$this->load->view('template/nav');
		$this->load->view('template/dashboard',$data);
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		session_destroy();

		redirect('index');
	}
}