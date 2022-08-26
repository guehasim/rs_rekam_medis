<?php
class m_dokter extends CI_Model
{	
	public function Lihat(){
		$query = $this->db->query("SELECT i.dokter_id, i.dokter_nama, ii.poli_nama, i.poli_id
									FROM dokter i
									INNER JOIN poli ii ON i.poli_id = ii.poli_id
									ORDER BY i.dokter_id DESC");
		return $query;
	}

	public function HitungDokter()
	{
		$query = $this->db->query("SELECT *,count(dokter_id) AS idd FROM dokter");
		return $query->result();
	}

	public function tambah_data(){
		
		$data = array(
			'dokter_id'=>null,
			'poli_id'=>$this->input->post('poli'),
			'dokter_nama'=>$this->input->post('nama')
			);

		$this->db->insert('dokter',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('dokter_id',$id);
        $this->db->delete('dokter');
    } 
}
?>