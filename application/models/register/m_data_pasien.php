<?php
class m_data_pasien extends CI_Model
{	
	public function lihat(){
		$query = $this->db->query("SELECT i.pas_id, i.pas_no_rm, i.pas_nama, i.pas_jenkel, i.pas_tgl_lahir, i.pas_kab, i.pas_kec, i.pas_desa,
									i.pas_rt, i.pas_rw, ii.nama_kab, iii.nama_kec, iv.nama_des
									FROM tbl_pasien i
									INNER JOIN lok_kabupaten ii ON i.pas_kab = ii.id_kab
									INNER JOIN lok_kecamatan iii ON i.pas_kec = iii.id_kec
									INNER JOIN lok_desa iv ON i.pas_desa = iv.id_des
									ORDER BY i.pas_id DESC");
		return $query;
	}

	public function getDatanya($id)
	{
		$query = $this->db->query("SELECT i.pas_id, i.pas_no_rm, i.pas_nama, i.pas_jenkel, i.pas_tgl_lahir, i.pas_kab, i.pas_kec, i.pas_desa,
									i.pas_rt, i.pas_rw, ii.nama_kab, iii.nama_kec, iv.nama_des
									FROM tbl_pasien i
									INNER JOIN lok_kabupaten ii ON i.pas_kab = ii.id_kab
									INNER JOIN lok_kecamatan iii ON i.pas_kec = iii.id_kec
									INNER JOIN lok_desa iv ON i.pas_desa = iv.id_des WHERE pas_id = $id ");
		return $query;
	}

	public function getDatanyaPasien($cek_rm)
	{
		$query = $this->db->query("SELECT i.pas_id, i.pas_no_rm, i.pas_nama, i.pas_jenkel, i.pas_tgl_lahir, i.pas_kab, i.pas_kec, i.pas_desa,
									i.pas_rt, i.pas_rw, ii.nama_kab, iii.nama_kec, iv.nama_des
									FROM tbl_pasien i
									INNER JOIN lok_kabupaten ii ON i.pas_kab = ii.id_kab
									INNER JOIN lok_kecamatan iii ON i.pas_kec = iii.id_kec
									INNER JOIN lok_desa iv ON i.pas_desa = iv.id_des 
									WHERE i.pas_no_rm = $cek_rm ");
		return $query;
	}

	public function getKota()
	{
		$query = $this->db->query("SELECT * FROM lok_kabupaten");
		return $query;
	}

	public function cek_no_rm($table,$where)
	{
		return $this->db->get_where($table,$where);
	}

	public function tambah_data(){
		
		$data = array(
			'pas_id'		=> null,
			'pas_no_rm'		=> $this->input->post('no_rm'),
			'pas_nama'		=> $this->input->post('nama'),
			'pas_jenkel'	=> $this->input->post('jenkel'),
			'pas_tgl_lahir'	=> $this->input->post('tgl_lahir'),
			'pas_kab'		=> $this->input->post('kabupaten'),
			'pas_kec'		=> $this->input->post('kecamatan'),
			'pas_desa'		=> $this->input->post('desanya'),
			'pas_rt'		=> $this->input->post('rt'),
			'pas_rw'		=> $this->input->post('rw')
			);

		$this->db->insert('tbl_pasien',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('pas_id',$id);
        $this->db->delete('tbl_pasien');
    } 
}
?>