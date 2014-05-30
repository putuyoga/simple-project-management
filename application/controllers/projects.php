<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}
	
	public function index()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/projects', '', true);
		$data['list'] = $this->projects_model->get_all_detail();
		$data['judul'] = 'List Project';
		$this->load->view('header', $data);
		$this->load->view('projects/list', $data);
		$this->load->view('footer');
	}
	
	public function baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
		$this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('orders_model');
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Project Baru";
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title();
			
			//ambil semua user dengan auth projet manager
			$data['pm_list'] = $this->users_model->get_by_auth_simple(2);
			
			//ambil semua user dengan auth karyawan
			$data['em_list'] = $this->users_model->get_by_auth_simple(1);
			
			$data['order_list'] = $this->orders_model->get_all_simple();
		
			$this->load->view('projects/baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->projects_model->baru($this->input->post());
			redirect('projects');
		}
	}
	
	public function edit($id)
	{
		$data = $this->projects_model->get_by_id($id);
		if($data !== NULL)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
			$this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
			}
			else
			{
				$data_post = $this->input->post();
				$data_post['id'] = $id;
				$this->projects_model->edit($data_post);
				$this->session->set_flashdata('pesan', 'tersimpan');
				redirect('projects/edit/' . $id);
			}
			
			//pesan tersimpan notif
			$this->load->model('orders_model');
			
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Edit Project";
			$pesan = $this->session->flashdata('pesan');
			if($pesan !== FALSE) $data['pesan'] = $pesan;
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title();
			
			//ambil semua user dengan auth projet manager
			$data['pm_list'] = $this->users_model->get_by_auth_simple(2);
			
			//ambil semua user dengan auth karyawan
			$data['em_list'] = $this->users_model->get_by_auth_simple(1);
			$data['anggota_tim'] = explode('-',$data['anggota_tim']);
			$data['order_list'] = $this->orders_model->get_all_simple();
		
			$this->load->view('projects/edit', $data);
			$this->load->view('footer');
		}
	}
	
	public function hapus($id)
	{
		$project = $this->projects_model->get_by_id($id);
		if($project !== NULL)
		{
			$this->projects_model->del_by_id($id);
			redirect('projects');
		}
	}
	
	public function detail($id)
	{
		$this->load->model('orders_model');
		$data = $this->projects_model->get_by_id($id);
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['judul'] = $data['nama'];
		$this->load->view('header', $data);
		$data['list_auth'] = get_list_job_title();
		
		//ambil data user dari project manager
		$data['project_manager'] = $this->users_model->get_by_id($data['project_manager']);
		$data['order'] = $this->orders_model->get_by_id($data['id_order']);
		
		//ambil semua user dengan auth karyawan
		$array_id = explode('-', $data['anggota_tim']);
		$data['anggota_tim'] = $this->users_model->get_by_id_array($array_id);
	
		$this->load->view('projects/detail', $data);
		$this->load->view('footer');
	}
	
	public function task($id_project)
	{
		$project = $this->projects_model->get_by_id($id_project);
		if($project !== NULL)
		{
			$this->load->model('tasks_model');
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['id'] = $id_project;
			$data['topbar'] = $this->load->view('menu/project_task', $data, true);
			$data['list'] = $this->tasks_model->get_all_by_id_project_detail($id_project);
			
			$data['judul'] = 'List Task : ' . $project['nama'];
			$this->load->view('header', $data);
			$this->load->view('projects/task_list', $data);
			$this->load->view('footer');
		}
		else
		{
			die("project not found");
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/projects.php */