<?php
class m_reg_ri extends CI_Model
{	
	public function Lihat(){
		$query = $this->db->query("SELECT i.in_id, i.in_rm, i.in_status, i.in_nama, i.in_al_kab, i.in_al_kec, i.in_al_des,
											i.in_al_rt, i.in_al_rw, i.in_tgl_lahir, i.in_jenkel, i.in_tgl_masuk, i.in_jen_datang,
											i.in_kamar, i.in_kamar_detail, i.in_poli, i.in_dokter, i.in_bayar, i.in_bayar_detail,
											i.status, ii.poli_nama, iii.dokter_nama, iv.nama_kab, v.nama_kec, vi.nama_des, vii.kmr_nama,
											viii.kmr_d_nama, ix.bay_nama, x.bay_det_nama, i.datang_detail
        							FROM rawat_inap i 
        							INNER JOIN poli ii ON i.in_poli = ii.poli_id
        							INNER JOIN dokter iii ON i.in_dokter = iii.dokter_id
        							INNER JOIN lok_kabupaten iv ON i.in_al_kab = iv.id_kab
        							INNER JOIN lok_kecamatan v ON i.in_al_kec = v.id_kec
        							INNER JOIN lok_desa vi ON i.in_al_des = vi.id_des
        							INNER JOIN kamar vii ON i.in_kamar = vii.kmr_id
        							INNER JOIN kamar_detail viii ON i.in_kamar_detail = viii.kmr_d_id
        							INNER JOIN pembayaran ix ON i.in_bayar = ix.bay_id
        							INNER JOIN bayar_detail x ON i.in_bayar_detail = x.bay_det_id
        							ORDER BY i.in_id DESC ");
		return $query;
	}

	public function getDatanya($id)
	{
		$query = $this->db->query("SELECT i.in_id, i.in_rm, i.in_status, i.in_nama, i.in_al_kab, i.in_al_kec, i.in_al_des,
											i.in_al_rt, i.in_al_rw, i.in_tgl_lahir, i.in_jenkel, i.in_tgl_masuk, i.in_jen_datang,
											i.in_kamar, i.in_kamar_detail, i.in_poli, i.in_dokter, i.in_bayar, i.in_bayar_detail,
											i.status, ii.poli_nama, iii.dokter_nama, iv.nama_kab, v.nama_kec, vi.nama_des, vii.kmr_nama,
											viii.kmr_d_nama, ix.bay_nama, x.bay_det_nama, i.datang_detail
        							FROM rawat_inap i 
        							INNER JOIN poli ii ON i.in_poli = ii.poli_id
        							INNER JOIN dokter iii ON i.in_dokter = iii.dokter_id
        							INNER JOIN lok_kabupaten iv ON i.in_al_kab = iv.id_kab
        							INNER JOIN lok_kecamatan v ON i.in_al_kec = v.id_kec
        							INNER JOIN lok_desa vi ON i.in_al_des = vi.id_des
        							INNER JOIN kamar vii ON i.in_kamar = vii.kmr_id
        							INNER JOIN kamar_detail viii ON i.in_kamar_detail = viii.kmr_d_id
        							INNER JOIN pembayaran ix ON i.in_bayar = ix.bay_id
        							INNER JOIN bayar_detail x ON i.in_bayar_detail = x.bay_det_id
									WHERE i.in_id = $id ");
		return $query;
	}

	public function getPoli()
	{
		$query = $this->db->query("SELECT * FROM poli ORDER BY poli_id DESC");
		return $query;
	}

	public function getKota()
	{
		$query = $this->db->query("SELECT * FROM lok_kabupaten");
		return $query;
	}

	public function getKamar()
	{
		$query = $this->db->query("SELECT * FROM kamar");
		return $query;
	}

	public function tambah_data(){
		
		$data = array(
			'in_id' 			=>null,
			'in_rm' 			=>$this->input->post('no_rm'),
			'in_status' 		=>$this->input->post('status'),
			'in_nama' 			=>$this->input->post('nama'),
			'in_al_kab' 		=>$this->input->post('kabupaten'),
			'in_al_kec' 		=>$this->input->post('kecamatan'),
			'in_al_des'	 		=>$this->input->post('desa'),
			'in_al_rt' 			=>$this->input->post('rt'),
			'in_al_rw' 			=>$this->input->post('rw'),
			'in_tgl_lahir' 		=>$this->input->post('tgl_lahir'),
			'in_jenkel' 		=>$this->input->post('jenkel'),
			'in_tgl_masuk' 		=>$this->input->post('tgl_masuk'),
			'in_jen_datang'		=>$this->input->post('datang'),
			'datang_detail' 	=>$this->input->post('datnya'),
			'in_kamar' 			=>$this->input->post('kamar'),
			'in_kamar_detail' 	=>$this->input->post('kamar_detail'),
			'in_poli' 			=>$this->input->post('poli'),
			'in_dokter' 		=>$this->input->post('dokter'),
			'in_bayar' 			=>$this->input->post('bayar'),
			'in_bayar_detail' 	=>$this->input->post('detail_bayar'),
			'status' 			=>"0"
			);

		$this->db->insert('rawat_inap',$data);
	}
	
	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('in_id',$id);
        $this->db->delete('rawat_inap');
    } 
}
?>