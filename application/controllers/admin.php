<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//kalau belum login, suruh login dulu
		if($this->user->get_current_user() === NULL)
		{
			redirect('main/login');
		} else {
			$user = $this->user->get_current_user();
			if($user['auth'] != 255)
			{
				die('kate lapo cok');
			}
		}
		
		$this->load->helper('user_helper');
	}
	 
	public function index()
	{
		//kalau belum login, suruh login dulu
		if($this->user->get_current_user() === NULL)
		{
			redirect('main/login');
		}
		else
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			
			$data['judul'] = "Admin Panel";
			$this->load->view('header', $data);
			$this->load->view('footer');
		}
		
	}
	
	public function users()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/admin/user', '', true);
		
		$dataTS['list'] = $this->users_model->get_all();
		$data['judul'] = "List User";
		$this->load->view('header', $data);
		$this->load->view('admin/list_user', $dataTS);
		$this->load->view('footer');
	}
	
	public function user_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah User";
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title();
			$this->load->view('admin/user_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->users_model->baru($this->input->post());
			redirect('admin/users/');
		}
	}
	
	public function edit_user($id = "")
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== FALSE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha');
			$this->form_validation->set_rules('password', 'Password', 'matches[repassword]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('auth', 'Auth', 'less_than[3]');
			
			$showForm = true;
			
			if ($this->form_validation->run() == FALSE)
			{
				$showForm = true;
			}
			else
			{
				if($this->input->post('email') != $user['email'])
				{
					$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
				}
				
				if($this->input->post('username') != $user['username'])
				{
					$this->form_validation->set_rules('username', 'Username', 'is_unique[users.username]');
				}
				
				if($this->form_validation->run() == FALSE)
				{
				}
				else
				{
					$this->users_model->edit($this->input->post());
					$this->session->set_flashdata('pesan', 'tersimpan');
					redirect('admin/edit_user/' . $id);
				}
			}
			
			if($showForm)
			{
				$data['user'] = $this->user->get_current_user();
				$data['sidebar'] = $this->user->get_sidebar($data);
			
				//pesan tersimpan notif
				$pesan = $this->session->flashdata('pesan');
				if($pesan !== FALSE) $data['pesan'] = $pesan;
				
				//header
				$data['judul'] = "Edit User";
				$this->load->view('header', $data);
				$data = $user;
				
				//setup auth dropdown
				$data['list_auth'] = get_list_job_title();
				
				//exclude admin
				if($user['auth'] != 255)
				{
					$data['list_auth'][255] = 'admin';
				}
				
				//show the rest
				$this->load->view('admin/edit_user', $data);
				$this->load->view('footer');
			}
		} else { die("user not found"); }
	}
	
	public function hapus_user($id)
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== NULL)
		{
			if($user["auth"] == 255)
			{
				return;
			}
			else 
			{
				$this->users_model->del_by_id($id);
				redirect('admin/users');
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */