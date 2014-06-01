<?php
class sales_model extends CI_Model{
	public function getAll($table){
		//$this->db->order_by('id','ASC');
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function get_by_id($id,$table)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($table, 1);
		if($query->num_rows() === 1)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function del_by_id($id,$table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
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
	
	public function update_pelanggan($id)
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'no_telp' => $this->input->post('no_telp'),
			'website' => $this->input->post('website'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id', $id);
		$this->db->update('pelanggan', $data);
	}

	
	public function get_column($column,$table,$where){
		$query = $this->db->query('select '.$column.' from '.$table.' '.$where);
		return $query->result_array();
	}
	
	public function insert_order(array $data_order)
	{
		$pelanggan = $data_order['pelanggan'];
		$id_pelanggan = $this->get_column('id','pelanggan','where nama = '.$pelanggan);
		$data['id_pelanggan'] = $id_pelanggan;
		echo $pelanggan."<br />";
		print_r($data['id_pelanggan']);
		echo "<br />".$this->input->post('status');
		/*
		$data = array(
			'status' => $data_order['status'],
			'harga' => $data_order['harga'],
			'tanggal' => $data_order['tanggal'],
			'catatan' => $data_order['catatan'],
		);
		$this->db->insert('order', $data);*/
	}
}

?>