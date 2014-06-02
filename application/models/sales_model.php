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
	
	public function get_detail_by_id($id,$table)
	{
		$subquery = '(SELECT nama FROM pelanggan WHERE id = order.id_pelanggan) as nama_pelanggan';
		$this->db->select("id, nama, $subquery, status, harga, tanggal, sales_person, catatan");
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
		$this->load->helper('user_helper');
		$user = $this->user->get_current_user();
		
		$data = array(
			'id_pelanggan' => $data_order['id_pelanggan'],
			'nama' => $data_order['nama'],
			'sales_person' => $user['username'],
			'status' => $data_order['status'],
			'harga' => $data_order['harga'],
			'tanggal' => $data_order['tanggal'],
			'catatan' => $data_order['catatan']
		);
		$this->db->insert('order', $data);
		
		//dapatkan id_order terakhir insert
		$id_order_akhir = $this->db->insert_id();
		
		//input id_order & nama project ke tabel project
		$data_project = array(
			'id_order' => $id_order_akhir,
			'nama' => $data_order['nama']
		);
		$this->db->insert('project',$data_project);
		
		//dapatkan id_project terakhir insert
		$id_project_akhir = $this->db->insert_id();
		
		//update id_project pada order terakhir insert
		$data_id_project = array(
			'id_project' => $id_project_akhir
		);
		$this->db->update('order', $data_id_project, "id = ".$id_order_akhir);
	}
	
	public function get_all_simple()
	{
		$this->db->order_by('id DESC');
		$this->db->select('id, nama');
		$query = $this->db->get('pelanggan');
		if($query->num_rows() > 0)
		{
			$data = array();
			foreach($query->result_array() as $item)
			{
				$data[$item['id']] = $item['nama'];
			}
			return $data;
		}
		else
		{
			return NULL;
		}
	}
	
	public function update_order($id)
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'status' => $this->input->post('status'),
			'harga' => $this->input->post('harga'),
			'tanggal' => $this->input->post('tanggal'),
			'catatan' => $this->input->post('catatan')
		);
		//update tabel order
		$this->db->where('id', $id);
		$this->db->update('order', $data);
		
		//update tabel project
		$data_project = array(
			'nama' => $this->input->post('nama')
		);
		//update tabel order
		$this->db->where('id_order', $id);
		$this->db->update('project', $data_project);
	}
	
	public function get_all_detail(){	
		$subquery = '(SELECT nama FROM pelanggan WHERE id = order.id_pelanggan) as nama_pelanggan';
		$this->db->select("id, nama, $subquery, status, harga, tanggal, sales_person");
		$this->db->order_by('id DESC');
		$query = $this->db->get('order');
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}
}

?>