<?php
class m_rm_rj extends CI_Model
{	
	public function LihatReg(){
		$query = $this->db->query("SELECT i.jln_id, i.jln_no_rm, i.jln_status, i.jln_poli, i.jln_dokter, i.jln_diagnosa,
									i.jln_categori, i.jln_tgl_masuk, i.jln_biaya, i.biaya_detail, ii.pas_nama, ii.pas_jenkel,
									ii.pas_tgl_lahir, ii.pas_kab, ii.pas_kec, ii.pas_desa, ii.pas_rt, ii.pas_rw, iii.indonesia,
									iv.nama_kab, v.nama_kec, vi.nama_des, vii.poli_nama, viii.dokter_nama, ix.bay_nama, x.bay_det_nama
        							FROM rekam_jalan i
        							INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
        							INNER JOIN icd_10 iii ON i.jln_diagnosa = iii.kode_icd AND i.jln_categori = iii.categori
        							INNER JOIN lok_kabupaten iv ON ii.pas_kab = iv.id_kab
        							INNER JOIN lok_kecamatan v ON ii.pas_kec = v.id_kec
        							INNER JOIN lok_desa vi ON ii.pas_desa = vi.id_des
        							INNER JOIN poli vii ON i.jln_poli = vii.poli_id
        							INNER JOIN dokter viii ON i.jln_dokter = viii.dokter_id
        							INNER JOIN pembayaran ix ON i.jln_biaya = ix.bay_id
        							INNER JOIN bayar_detail x ON i.biaya_detail = x.bay_det_id 
        							ORDER BY i.jln_id DESC ");
		return $query;
	}

	public function getDatanya($id)
	{
		$query = $this->db->query("SELECT i.jln_id, i.jln_no_rm, i.jln_status, i.jln_poli, i.jln_dokter, i.jln_diagnosa,
									i.jln_categori, i.jln_tgl_masuk, i.jln_biaya, i.biaya_detail, ii.pas_nama, ii.pas_jenkel,
									ii.pas_tgl_lahir, ii.pas_kab, ii.pas_kec, ii.pas_desa, ii.pas_rt, ii.pas_rw, iii.indonesia,
									iv.nama_kab, v.nama_kec, vi.nama_des, vii.poli_nama, viii.dokter_nama, ix.bay_nama, x.bay_det_nama
        							FROM rekam_jalan i
        							INNER JOIN tbl_pasien ii ON i.jln_no_rm = ii.pas_no_rm
        							INNER JOIN icd_10 iii ON i.jln_diagnosa = iii.kode_icd AND i.jln_categori = iii.categori
        							INNER JOIN lok_kabupaten iv ON ii.pas_kab = iv.id_kab
        							INNER JOIN lok_kecamatan v ON ii.pas_kec = v.id_kec
        							INNER JOIN lok_desa vi ON ii.pas_desa = vi.id_des
        							INNER JOIN poli vii ON i.jln_poli = vii.poli_id
        							INNER JOIN dokter viii ON i.jln_dokter = viii.dokter_id
        							INNER JOIN pembayaran ix ON i.jln_biaya = ix.bay_id
        							INNER JOIN bayar_detail x ON i.biaya_detail = x.bay_det_id 
									WHERE i.jln_id = $id ");
		return $query;
	}

	public function getBayar()
	{
		$query = $this->db->query("SELECT * FROM pembayaran");
		return $query;
	}

	public function LihatDiagnosa()
	{
		$query = $this->db->query("SELECT * FROM icd_10");
		return $query;
	}

	public function tambah_data(){
		
		$data = array(
			'jln_id'		=> null,
			'jln_no_rm'		=> $this->input->post('no_rm'),
			'jln_status'	=> $this->input->post('status'),
			'jln_poli'		=> $this->input->post('poli'),
			'jln_dokter'	=> $this->input->post('dokter'),
			'jln_diagnosa'	=> $this->input->post('dig_kode'),
			'jln_categori'	=> $this->input->post('dig_cat'),
			'jln_tgl_masuk'	=> $this->input->post('tgl_masuk'),
			'jln_biaya'		=> $this->input->post('biaya'),
			'biaya_detail'	=> $this->input->post('detail_biaya')
			);

		$this->db->insert('rekam_jalan',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('jln_id',$id);
        $this->db->delete('rekam_jalan');
    } 
}
?>