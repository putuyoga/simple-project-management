<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks_model extends CI_Model {
	private $table;
	
	public function __construct()
	{
		parent::__construct();
		$this->set_table('task');
	}
	
	public function set_table($table)
	{
		$this->table = $table;
	}
	
	public function get_table()
	{
		return $this->table;
	}
	
	public function exists($compare, $field = 'id_project')
	{
		$field_array = array('id', 'id_project');
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
	
	public function get_all_by_id_project($id)
	{
		$this->db->order_by('id DESC');
		$this->db->where('id', $id);
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
	
	public function get_all_by_id_project_detail($id)
	{
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$this->db->select('id, id_project,' . $subquery . ',assigned_to, nama, prioritas, progress, deadline');
		
		$this->db->order_by('id DESC');
		$this->db->where('id_project', $id);
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
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$subquery2 = '(SELECT nama FROM project WHERE id = id_project) as nama_project';
		$this->db->select("id, id_project, $subquery, $subquery2, assigned_to, nama, prioritas, progress, deadline");
		
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
	
	public function get_all_notdone_detail()
	{
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$subquery2 = '(SELECT nama FROM project WHERE id = id_project) as nama_project';
		$this->db->select("id, id_project, $subquery, $subquery2, assigned_to, nama, prioritas, progress, deadline");
		$this->db->where('progress != 100');
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
	
	public function get_all_notdone_by_assigned_detail($id)
	{
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$subquery2 = '(SELECT nama FROM project WHERE id = id_project) as nama_project';
		$this->db->select("id, id_project, $subquery, $subquery2, assigned_to, nama, prioritas, progress, deadline");
		$this->db->where('assigned_to', $id);
		$this->db->where('progress != 100');
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
	
	public function get_all_by_assigned_detail($id)
	{
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$subquery2 = '(SELECT nama FROM project WHERE id = id_project) as nama_project';
		$this->db->select("id, id_project, $subquery, $subquery2, assigned_to, nama, prioritas, progress, deadline");
		$this->db->where('assigned_to', $id);
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
	
		
	public function get_all_by_pm_detail($id)
	{
		$subquery = '(SELECT username FROM users WHERE id = assigned_to) as assigned_username';
		$subquery2 = '(SELECT nama FROM project WHERE id = id_project) as nama_project';
		$this->db->select("id, id_project, $subquery, $subquery2, assigned_to, nama, prioritas, progress, deadline");
		$this->db->where_in("id_project = (SELECT id FROM project WHERE project_manager = '$id')");
		
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
			'id_project' => $data['id_project'],
			'nama' => $data['nama'],
			'deadline' => $data['deadline'],
			'assigned_to' => $data['assigned_to'],
			'prioritas' => $data['prioritas'],
			'deskripsi' => $data['deskripsi']
		);
		$this->db->insert($this->get_table(), $data);
	}
	
	public function edit(array $data_baru)
	{
		$data = array(
			'id_project' => $data_baru['id_project'],
			'nama' => $data_baru['nama'],
			'deadline' => $data_baru['deadline'],
			'assigned_to' => $data_baru['assigned_to'],
			'prioritas' => $data_baru['prioritas'],
			'progress' => $data_baru['progress'],
			'deskripsi' => $data_baru['deskripsi']
		);
		
		$this->db->where('id', $data_baru['id']);
		$this->db->update($this->get_table(), $data);
	}
	
	public function edit_as_member(array $data_baru)
	{
		$data = array(
			'progress' => $data_baru['progress']
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