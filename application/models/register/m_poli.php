<?php
class m_poli extends CI_Model
{	
	public function Lihat(){
		$query = $this->db->query("SELECT * FROM poli ORDER BY poli_id DESC");
		return $query;
	}

	public function HitungPoli()
	{
		$query = $this->db->query("SELECT *,count(poli_id) AS id FROM poli");
		return $query->result();
	}

	public function tambah_data(){
		
		$data = array(
			'poli_id'=>null,
			'poli_nama'=>$this->input->post('nama')
			);

		$this->db->insert('poli',$data);
	}

	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function hapus_data($id)
    {
        $this->db->where('poli_id',$id);
        $this->db->delete('poli');

        $this->db->where('poli_id',$id);
        $this->db->delete('dokter');
    } 
}
?>