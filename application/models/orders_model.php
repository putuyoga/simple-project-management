<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {
	private $table;
	
	public function __construct()
	{
		parent::__construct();
		$this->set_table('order');
	}
	
	public function set_table($table)
	{
		$this->table = $table;
	}
	
	public function get_table()
	{
		return $this->table;
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
	
	public function get_all_simple()
	{
		$this->db->order_by('id DESC');
		$this->db->select('id, nama');
		$query = $this->db->get($this->get_table());
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
}
	
?>