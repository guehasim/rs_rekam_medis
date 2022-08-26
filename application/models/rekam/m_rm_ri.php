<?php
class m_rm_ri extends CI_Model
{	
	//fungsi untuk rekam medis rawat inap masuk
	public function LihatMasuk(){
		$query = $this->db->query("SELECT i.in_id, i.in_rm, i.in_status, i.in_tgl_masuk, i.in_jen_datang, i.datang_detail, i.in_kamar, i.in_kamar_detail,
											i.in_poli, i.in_dokter, i.in_bayar, i.in_bayar_detail, i.status, ii.pas_nama, iii.poli_nama, iv.dokter_nama,
											viii.kmr_nama, ix.kmr_d_nama, x.bay_nama, xi.bay_det_nama
        							FROM rekam_inap_masuk i 
        							INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
        							INNER JOIN poli iii ON i.in_poli = iii.poli_id
        							INNER JOIN dokter iv ON i.in_dokter = iv.dokter_id
        							INNER JOIN kamar viii ON i.in_kamar = viii.kmr_id
        							INNER JOIN kamar_detail ix ON i.in_kamar_detail = ix.kmr_d_id
        							INNER JOIN pembayaran x ON i.in_bayar = x.bay_id
        							INNER JOIN bayar_detail xi ON i.in_bayar_detail = xi.bay_det_id
        							WHERE i.status = '0'
        							ORDER BY i.in_id DESC ");
		return $query;
	}

	public function getDatanyaMasuk($id)
	{
		$query = $this->db->query("SELECT i.in_id, i.in_rm, i.in_status, i.in_tgl_masuk, i.in_jen_datang, i.datang_detail, i.in_kamar, i.in_kamar_detail,
											i.in_poli, i.in_dokter, i.in_bayar, i.in_bayar_detail, i.status, ii.pas_nama, iii.poli_nama, iv.dokter_nama,
											viii.kmr_nama, ix.kmr_d_nama, x.bay_nama, xi.bay_det_nama
        							FROM rekam_inap_masuk i 
        							INNER JOIN tbl_pasien ii ON i.in_rm = ii.pas_no_rm
        							INNER JOIN poli iii ON i.in_poli = iii.poli_id
        							INNER JOIN dokter iv ON i.in_dokter = iv.dokter_id
        							INNER JOIN kamar viii ON i.in_kamar = viii.kmr_id
        							INNER JOIN kamar_detail ix ON i.in_kamar_detail = ix.kmr_d_id
        							INNER JOIN pembayaran x ON i.in_bayar = x.bay_id
        							INNER JOIN bayar_detail xi ON i.in_bayar_detail = xi.bay_det_id
									WHERE i.in_id = $id ");
		return $query;
	}

	public function tambah_dataMasuk(){
		
		$data = array(
			'in_id' 			=> null,
			'in_rm' 			=> $this->input->post('no_rm'),
			'in_status' 		=> $this->input->post('status'),
			'in_tgl_masuk' 		=> $this->input->post('tgl_masuk'),
			'in_jen_datang'		=> $this->input->post('datang'),
			'datang_detail' 	=> $this->input->post('datnya'),
			'in_kamar' 			=> $this->input->post('kamar'),
			'in_kamar_detail' 	=> $this->input->post('kamar_detail'),
			'in_poli' 			=> $this->input->post('poli'),
			'in_dokter' 		=> $this->input->post('dokter'),
			'in_bayar' 			=> $this->input->post('bayar'),
			'in_bayar_detail' 	=> $this->input->post('detail_bayar'),
			'status' 			=> "0"
			);

		$this->db->insert('rekam_inap_masuk',$data);
	}

	public function hapus_dataMasuk($id)
    {
        $this->db->where('in_id',$id);
        $this->db->delete('rekam_inap_masuk');
    } 

	//fungsi untuk rekam medis rawat inap keluar

	public function LihatKeluar()
	{
		$query = $this->db->query("SELECT i.inap_id, i.in_id_masuk, i.inap_tgl_keluar, i.inap_keadaan, i.keadaan_detail, i.inap_diagnosa,
									i.diagnosa_kategori, i.inap_tindakan, i.inap_kamar_akhir, i.akhir_detail, i.inap_lama,
									i.inap_hari, i.inap_tpip, i.inap_igd, i.inap_kamar, i.inap_ok, i.inap_gizi, i.inap_farmasi,
									i.inap_setuju, ii.in_rm, ii.in_status, ii.in_tgl_masuk, ii.in_jen_datang, ii.datang_detail,
									ii.in_poli, ii.in_dokter, ii.in_bayar, ii.in_bayar_detail, iii.pas_nama, iv.indonesia, v.str,
									vi.kmr_nama, vii.kmr_d_nama, i.keadaan_detail,i.status_pindah, viii.poli_nama, ix.dokter_nama,
									x.bay_nama, xi.bay_det_nama
									FROM rekam_inap_keluar i
									INNER JOIN rekam_inap_masuk ii ON i.in_id_masuk = ii.in_id
									INNER JOIN tbl_pasien iii ON ii.in_rm = iii.pas_no_rm
									INNER JOIN icd_10 iv ON i.inap_diagnosa = iv.kode_icd AND i.diagnosa_kategori = iv.categori
									INNER JOIN icd_9 v ON i.inap_tindakan = v.code
									INNER JOIN kamar vi ON i.inap_kamar_akhir = vi.kmr_id
									INNER JOIN kamar_detail vii ON i.akhir_detail = vii.kmr_d_id
									INNER JOIN poli viii ON ii.in_poli = viii.poli_id
									INNER JOIN dokter ix ON ii.in_dokter = ix.dokter_id
        							INNER JOIN pembayaran x ON ii.in_bayar = x.bay_id
        							INNER JOIN bayar_detail xi ON ii.in_bayar_detail = xi.bay_det_id
									WHERE ii.status = 1 
									ORDER BY i.inap_id DESC ");
		return $query;
	}

	public function getDatanyaKeluar($id)
	{
		$query = $this->db->query("SELECT i.in_id, i.in_rm, i.in_tgl_masuk, i.in_kamar, i.in_kamar_detail, ii.kmr_nama, iii.kmr_d_nama
									FROM rekam_inap_masuk i 
									INNER JOIN kamar ii ON i.in_kamar = ii.kmr_id
									INNER JOIN kamar_detail iii ON i.in_kamar_detail = iii.kmr_d_id
									WHERE i.in_id = $id ");
		return $query;
	}

	public function tambah_dataKeluar(){

		$id_masuk = $this->input->post('id_masuk');
		$start_tgl = $this->input->post('tgl_masuk');
		$end_tgl = $this->input->post('tgl_keluar');
		$pindah = $this->input->post('kode_pindah');



		$tindakan = $this->input->post('tin_kode');
		if ($tindakan == NULL) {
			$kode_tin = '0.1';
		}else{
			$kode_tin = $tindakan;
		}

		$date1 = $end_tgl;
		$date2 = $start_tgl;
	   
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

		
		$data = array(
			'inap_id' 				=>null,
			'in_id_masuk'			=>$id_masuk,
			'inap_tgl_keluar' 		=>$end_tgl,
			'inap_keadaan' 			=>$this->input->post('keadaan'),
			'keadaan_detail' 		=>$this->input->post('detnya'),
			'inap_diagnosa' 		=>$this->input->post('dig_kode'),
			'diagnosa_kategori' 	=>$this->input->post('dig_cat'),
			'inap_tindakan' 		=>$kode_tin,
			'inap_kamar_akhir' 		=>$kmr_akhir,
			'akhir_detail' 			=>$kmr_d_akhir,
			'inap_lama' 			=>$lamanya,
			'status_pindah' 		=>$pin,
			'inap_hari' 			=>$hari,
			'inap_tpip' 			=>$this->input->post('tpip'),
			'inap_igd' 				=>$this->input->post('igd'),
			'inap_kamar' 			=>$this->input->post('kamars'),
			'inap_ok' 				=>$this->input->post('ok'),
			'inap_gizi' 			=>$this->input->post('gizi'),
			'inap_farmasi' 			=>$this->input->post('farmasi'),
			'inap_setuju' 			=>$this->input->post('setuju')
			);

		$this->db->insert('rekam_inap_keluar',$data);

		$query = $this->db->query("UPDATE rekam_inap_masuk SET status='1' WHERE in_id=$id_masuk ");
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_dataKeluar($id)
    {
        $this->db->where('in_id_masuk',$id);
        $this->db->delete('rekam_inap_keluar');

        $query = $this->db->query("UPDATE rekam_inap_masuk SET status='0' WHERE in_id='$id' ");
    }

    public function getKamar()
	{
		$query = $this->db->query("SELECT * FROM kamar");
		return $query;
	}

    public function kamart($id)
    {
        $query =$this->db->query("SELECT i.kmr_id, ii.kmr_d_id, i.kmr_nama, ii.kmr_d_nama 
        							FROM kamar i
        							INNER JOIN kamar_detail ii ON i.kmr_id = ii.kmr_id 
        							WHERE ii.kmr_d_id = '$id' ");
        return $query;
    }  
}
?>