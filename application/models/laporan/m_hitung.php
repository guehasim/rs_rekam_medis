<?php
class m_hitung extends CI_Model
{	
	public function Lihat(){
		$query = $this->db->query("SELECT * FROM hitung_rm ORDER BY hitung_id DESC");
		return $query;
	}

	public function cekData($table,$where)
	{
		return $this->db->get_where($table,$where);
	}

	public function tambah_data(){

		$bulan 		= $this->input->post('bulan');
		$tahun 		= $this->input->post('tahun');

		$waktu 		= $tahun."-".$bulan."-01";
		$pasawal 	= $this->input->post('awal');
		$pasmasuk 	= $this->input->post('masuk');
		$passisa 	= $this->input->post('sisa');
		$paskeluar 	= $pasmasuk-$passisa;
		$jmlhr 		= $this->input->post('hari');
		$jmllm 		= $this->input->post('lama');
		$tt 		= '91';

		if ($bulan == '01') {
			$periode = 31;
		}elseif ($bulan == '02') {
			$periode = 28;
		}elseif ($bulan == '03') {
			$periode = 31;
		}elseif ($bulan == '04') {
			$periode = 30;
		}elseif ($bulan == '05') {
			$periode = 31;
		}elseif ($bulan == '06') {
			$periode = 30;
		}elseif ($bulan == '07') {
			$periode = 31;
		}elseif ($bulan == '08') {
			$periode = 31;
		}elseif ($bulan == '09') {
			$periode = 30;
		}elseif ($bulan == '10') {
			$periode = 31;
		}elseif ($bulan == '11') {
			$periode = 30;
		}elseif ($bulan == '12') {
			$periode = 31;
		}
		$bor 		= (($jmlhr/($tt*$periode))*100);
		$alos 		= $jmllm/$paskeluar;
		$toi 		= (($tt*$periode)-$jmlhr)/$paskeluar;
		$bto 		= $paskeluar/$tt;
		$mkurang 	= $this->input->post('kurang');
		$mlebih 	= $this->input->post('lebih');
		$ndr 		= ($mlebih/$paskeluar)*1000;
		$gdr 		= (($mlebih+$mkurang)/$paskeluar)*1000;
		
		$data = array(
			'hitung_id'=>null,
			'hitung_date'=>$waktu,
			'hitung_pas_awal'=>$pasawal,
			'hitung_pas_masuk'=>$pasmasuk,
			'hitung_pas_keluar'=>$paskeluar,
			'hitung_pas_sisa'=>$passisa,
			'hitung_hr_rawat'=>$jmlhr,
			'hitung_lm_rawat'=>$jmllm,
			'hitung_tt'=>$tt,
			'hitung_periode'=>$periode,
			'hitung_bor'=>$bor,
			'hitung_alos'=>$alos,
			'hitung_toi'=>$toi,
			'hitung_bto'=>$bto,
			'hitung_mati_kurang'=>$mkurang,
			'hitung_mati_lebih'=>$mlebih,
			'hitung_ndr'=>$ndr,
			'hitung_gdr'=>$gdr
			);

		$this->db->insert('hitung_rm',$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('hitung_id',$id);
        $this->db->delete('hitung_rm');
    } 
}
?>