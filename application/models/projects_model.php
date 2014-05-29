<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_model extends CI_Model {
	private $table;
	
	public function __construct()
	{
		parent::__construct();
		$this->set_table('project');
	}
	
	public function set_table($table)
	{
		$this->table = $table;
	}
	
	public function get_table()
	{
		return $this->table;
	}
	
	public function exists($compare, $field = 'username')
	{
		$field_array = array('id', 'username', 'email', 'auth');
		if( ! in_array($field, $field_array))
		{
			die('Field tidak diketahui');
			return;
		}
		
		$this->db->where($field, $compare);
		$query = $this->db->get($this->get_table(), 1);
		
		if($query->num_rows() === 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->get_table(), 1);
		if($query->num_rows() === 1)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_by_id_order($id)
	{
		$this->db->where('id_order', $id);
		$query = $this->db->get($this->get_table(), 1);
		if($query->num_rows() === 1)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}
	
	
	public function get_all_at($page, $banyak)
	{
		$awal = ($page - 1) * $banyak;
		$this->db->order_by('id DESC');
		$query = $this->db->get($this->get_table(), $banyak, $awal);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}
	
	public function get_all()
	{
		$this->db->order_by('id DESC');
		$query = $this->db->get($this->get_table());
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}
	
	public function get_all_detail()
	{
		$select = 'id, id_order, (SELECT username FROM users WHERE id = project_manager) as pm,' .
		' nama, tanggal_mulai, tanggal_selesai, anggota_tim';
		$this->db->select($select);
		$this->db->order_by('id DESC');
		$query = $this->db->get($this->get_table());
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		}
	}
	
	public function get_all_simple()
	{
		$users = $this->get_all();
		$baru = array();
		if($users !== NULL)
		{
			foreach($users as $user)
			{
				$baru[$user['id']] = $user['nama'];
			}
			return $baru;
		}
		else
		{
			return NULL;
		}
	}
	
	public function total_row()
	{
		$query = $this->db->get($this->get_table());
		return $query->num_rows();
	}
	
	public function baru(array $data)
	{
		$data = array(
			'id_order' => $data['id_order'],
			'nama' => $data['nama'],
			'tanggal_mulai' => $data['tanggal_mulai'],
			'tanggal_selesai' => $data['tanggal_selesai'],
			'project_manager' => $data['project_manager'],
			'anggota_tim' => implode('-', $data['anggota_tim'])
		);
		$this->db->insert($this->get_table(), $data);
	}
	
	public function edit(array $data_baru)
	{
		$data = array(
			'id_order' => $data_baru['id_order'],
			'nama' => $data_baru['nama'],
			'tanggal_mulai' => $data_baru['tanggal_mulai'],
			'tanggal_selesai' => $data_baru['tanggal_selesai'],
			'project_manager' => $data_baru['project_manager'],
			'anggota_tim' => implode('-', $data_baru['anggota_tim'])
		);
		
		$this->db->where('id', $data_baru['id']);
		$this->db->update($this->get_table(), $data);
	}
	
	public function del_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->get_table());
	}
	
	public function del_all()
	{
		$this->db->empty_table($this->get_table());
	}
}