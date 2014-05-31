<?php
class sales_model extends CI_Model{
	public function getAll(){
		//$this->db->order_by('id','ASC');
		$query = $this->db->get('pelanggan');
		return $query->result_array();
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('pelanggan', 1);
		if($query->num_rows() === 1)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function del_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pelanggan');
	}
	
	public function insert_pelanggan(array $data_pelanggan)
	{
		
		$data = array(
			'nama' => $data_pelanggan['nama'],
			'email' => $data_pelanggan['email'],
			'no_telp' => $data_pelanggan['no_telp'],
			'website' => $data_pelanggan['website'],
			'alamat' => $data_pelanggan['alamat'],
		);
		$this->db->insert('pelanggan', $data);
	}
}

?>