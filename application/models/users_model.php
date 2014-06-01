<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	private $table;
	
	public function __construct()
	{
		parent::__construct();
		$this->set_table('users');
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
	
	public function is_user($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
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
	
	public function get_by_auth($auth)
	{
		$this->db->order_by('id DESC');
		$this->db->where('auth', $auth);
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
	
	public function get_by_id_array(array $data)
	{
		$this->db->order_by('id DESC');
		$this->db->where_in('id', $data);
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
				$baru[$user['id']] = $user['username'];
			}
			return $baru;
		}
		else
		{
			return NULL;
		}
	}
	
	public function get_by_auth_simple($auth)
	{
		$users = $this->get_by_auth($auth);
		if($users !== NULL)
		{
			$baru = array();
			foreach($users as $user)
			{
				$baru[$user['id']] = $user['username'];
			}
			return $baru;
		}
		else
		{
			return NULL;
		}
	}
	
	public function get_by_id_array_simple(array $data)
	{
		$users = $this->get_by_id_array($data);
		if($users !== NULL)
		{
			$baru = array();
			foreach($users as $user)
			{
				$baru[$user['id']] = $user['username'];
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
	
	public function baru(array $data_user)
	{
		
		$data = array(
			'username' => $data_user['username'],
			'email' => $data_user['email'],
			'auth' => $data_user['auth'],
		);
		if(trim($data_user['password']) != '')
		{
			$data['password'] = md5($data_user['password']);
		}
		$this->db->insert($this->get_table(), $data);
	}
	
	public function edit($data_user)
	{
		$data = array(
			'username' => $data_user['username'],
			'email' => $data_user['email'],
			'auth' => $data_user['auth']
		);
		//if(!empty(trim($data_user['password'])))
		if(!empty($data_user['password']))
		{
			$data['password'] = md5($data_user['password']);
		}
		
		$this->db->where('id', $data_user['id']);
		$this->db->update($this->get_table(), $data);
	}
	
	public function edit_profil($id, $email, $password = '')
	{
		$data = array(
			'email'	=> $email
		);
		if(trim($password) !== '')
		{
			$data['password'] = md5($password);
		}
		$this->db->where('id', $id);
		$this->db->update($this->get_table(), $data);
		
	}
	
	public function update_password($id, $password)
	{
		$data = array(
			'password' => md5($password)
		);
		$this->db->where('id', $id);
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

	public function get_karyawan()
	{
		$this->db->order_by('id DESC');
		$this->db->where('auth', '1');
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

	public function karyawan_baru(array $data_user)
	{
		
		$data = array(
			'username' => $data_user['username'],
			'email' => $data_user['email'],
			'auth' => $data_user['auth'],
		);
		if(trim($data_user['password']) != '')
		{
			$data['password'] = md5($data_user['password']);
		}
		$this->db->insert($this->get_table(), $data);
	}

	public function get_payroll()
	{
		
		$this->db->order_by('id DESC');
		$this->db->where('auth', '1');
		//$this->db->select('*');
		//$this->db->from('users');
		$this->db->join('payroll', 'id_user = id');
		//$query = $this->db->get();
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

	public function payroll_baru(array $data_user)
	{
		
		$data = array(
			'username' => $data_user['username'],
			'email' => $data_user['email'],
			'auth' => $data_user['auth'],
		);
		if(trim($data_user['password']) != '')
		{
			$data['password'] = md5($data_user['password']);
		}
		$this->db->insert($this->get_table(), $data);
	}

	public function get_payroll_by_id($id_payroll)
	{
		$this->db->where('id_payroll', $id_payroll);
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

	public function del_payroll_by_id($id_payroll)
	{
		$this->db->where('id_payroll', $id_payroll);
		$this->db->delete($this->get_table());
	}

}