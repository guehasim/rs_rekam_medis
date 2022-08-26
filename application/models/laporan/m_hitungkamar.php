<?php
class m_hitungkamar extends CI_Model
{	
	public function Lihat(){
		$query = $this->db->query("SELECT i.h_kmr_id, i.h_kmr_date, i.h_kmr_kamar, i.h_kmr_awal, i.h_kmr_keluar, i.h_kmr_sisa, i.h_kmr_hr,
									i.h_kmr_lm, i.h_kmr_tt, i.h_kmr_periode, i.h_kmr_bor, i.h_kmr_alos, i.h_kmr_toi, i.h_kmr_bto, i.h_kmr_ndr,
									i.h_kmr_gdr, ii.kmr_d_nama
									FROM hitung_kmr i 
									INNER JOIN kamar_detail ii ON i.h_kmr_kamar = ii.kmr_d_id
									ORDER BY i.h_kmr_id DESC");
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
		$kamar 		= $this->input->post('kamarnya');
		$pasawal 	= $this->input->post('awal');
		$passisa 	= $this->input->post('sisa');
		$paskeluar 	= $pasawal-$passisa;
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
			'h_kmr_id'=>null,
			'h_kmr_date'=>$waktu,
			'h_kmr_kamar'=>$kamar,
			'h_kmr_awal'=>$pasawal,
			'h_kmr_keluar'=>$paskeluar,
			'h_kmr_sisa'=>$passisa,
			'h_kmr_hr'=>$jmlhr,
			'h_kmr_lm'=>$jmllm,
			'h_kmr_tt'=>$tt,
			'h_kmr_periode'=>$periode,
			'h_kmr_bor'=>$bor,
			'h_kmr_alos'=>$alos,
			'h_kmr_toi'=>$toi,
			'h_kmr_bto'=>$bto,
			'h_kmr_ndr'=>$ndr,
			'h_kmr_gdr'=>$gdr
			);

		$this->db->insert('hitung_kmr',$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('h_kmr_id',$id);
        $this->db->delete('hitung_kmr');
    } 
}
?>