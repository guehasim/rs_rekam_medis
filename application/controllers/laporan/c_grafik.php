<?php
/**
* 
*/
class c_grafik extends CI_Controller
{
	
	function __construct(){
		parent::__construct();
	}


	public function CekRawatJalan()
	{
		$opsiID  = $this->input->post('opsi');
		$bulanID = $this->input->post('bulan');
		$tahunID = $this->input->post('tahun');

		if (isset($_POST["cetak"])) {
			$data['bulan'] = $this->input->post("bulan");
      		$data['tahun'] = $this->input->post("tahun");     

            
      		$this->load->view("laporan/v_cetak_rj",$data);
		}else{
			if ($opsiID == 1) {
				$data['bulan']		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] 	= '1';
				$data['validasi'] 	= '1';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 2) {
				$data['bulan']		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] 	= '1';
				$data['validasi'] 	= '2';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 3) {
				$query = $this->db->query("SELECT 
											(SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=1 && Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID) AS p_baru,
	                                      	(SELECT COUNT(*) FROM rekam_jalan WHERE jln_status=0 && Month(jln_tgl_masuk)=$bulanID && YEAR(jln_tgl_masuk)=$tahunID) AS p_lama
											");

				foreach ($query->result() as $keyg) {
					$data['baru'] = $keyg->p_baru;
	            	$data['lama'] = $keyg->p_lama;
	            	$data['idfungsi'] = '1';
					$data['validasi'] = '3';
				}			
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 4) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] 	= '1';
				$data['validasi'] 	= '4';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 5) {
				$data['bulan'] = $bulanID;
				$data['tahun'] = $tahunID;
				$data['idfungsi'] = '1';
				$data['validasi'] = '5';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 6) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID; 
				$data['idfungsi'] 	= '1';
				$data['validasi'] 	= '6';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			else{
				echo "tidak ada opsi";
			}
		}	
		
	}

	public function CekRawatInap()
	{
		$opsiID  = $this->input->post('opsik');
		$bulanID = $this->input->post('bulank');
		$tahunID = $this->input->post('tahunk');

		if (isset($_POST["cetak"])) {
			$data['bulan'] = $this->input->post('bulank');
			$data['tahun'] = $this->input->post('tahunk');

			$this->load->view("laporan/v_cetak_ri",$data);
		}else{

			if ($opsiID == 1) {
				$data['bulan'] = $bulanID;
				$data['tahun'] = $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '1';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 2) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] 	= '2';
				$data['validasi'] 	= '2';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 3) {
				$query = $this->db->query("SELECT 
											(SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=1 && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID) AS p_baru,
	                                      	(SELECT COUNT(*) FROM rekam_inap_masuk WHERE in_status=0 && Month(in_tgl_masuk)=$bulanID && YEAR(in_tgl_masuk)=$tahunID) AS p_lama
											");
				foreach ($query->result() as $keyg) {
					$data['baru'] = $keyg->p_baru;
	            	$data['lama'] = $keyg->p_lama;
	            	$data['idfungsi'] = '2';
					$data['validasi'] = '3';
				}
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 4) {			
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '4';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 5) {			
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '5';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 6) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '6';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 7) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '7';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 8) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '8';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 9) {
				$data['bulan'] 		= $bulanID;
				$data['tahun']		= $tahunID;
				$data['idfungsi'] = '2';
				$data['validasi'] = '9';
				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 10) {
				$query = $this->db->query("SELECT
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
				foreach ($query->result() as $akan) {
		        	$data['tpip_lp']	= $akan->tpip_lp;
		        	$data['igd_lp']		= $akan->igd_lp;
		        	$data['kamar_lp']	= $akan->kamar_lp;
		        	$data['ok_lp']		= $akan->ok_lp;
		        	$data['gizi_lp']	= $akan->gizi_lp;
		        	$data['farmasi_lp']	= $akan->farmasi_lp;

		        	$data['tpip_tp']	= $akan->tpip_tp;
		        	$data['igd_tp']		= $akan->igd_tp;
		        	$data['kamar_tp']	= $akan->kamar_tp;
		        	$data['ok_tp']		= $akan->ok_tp;
		        	$data['gizi_tp']	= $akan->gizi_tp;
		        	$data['farmasi_tp']	= $akan->farmasi_tp;  
	        	}
	        $this->load->view('template/nav');
	        $this->load->view('laporan/v_grafikcolomn',$data);
			}

			elseif ($opsiID == 11) {
				$query = $this->db->query("SELECT 
											(SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS p_lengkap,
	                                      	(SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_setuju=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS p_tidak");

				foreach ($query->result() as $keyg) {
					$data['lengkap'] = $keyg->p_lengkap;
	            	$data['tidak_lengkap'] = $keyg->p_tidak;
	            	$data['idfungsi'] = '2';
					$data['validasi'] = '11';
				}

				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			elseif ($opsiID == 12) {
				$query = $this->db->query("SELECT 
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=0 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS p_lengkap,
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_tpip=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_igd=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_kamar=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_ok=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_gizi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID)+
	                                    (SELECT COUNT(*) FROM rekam_inap_keluar WHERE inap_farmasi=1 && Month(inap_tgl_keluar)=$bulanID && YEAR(inap_tgl_keluar)=$tahunID) AS p_tidak");
				
				foreach ($query->result() as $keyg) {
					$data['lengkap'] = $keyg->p_lengkap;
	            	$data['tidak_lengkap'] = $keyg->p_tidak;
	            	$data['idfungsi'] = '2';
					$data['validasi'] = '12';
				}

				$this->load->view('template/nav');
				$this->load->view('laporan/v_grafikpie',$data);
			}

			else{
				echo "Tidak Ada Opsi";
			}

		}		
	}
}