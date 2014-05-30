<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('task_helper');
		$this->load->model('tasks_model');
	}
	
	public function index()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/tasks', '', true);
		$data['list'] = $this->tasks_model->get_all_detail();
		
		$data['judul'] = 'List Task';
		$this->load->view('header', $data);
		$this->load->view('tasks/list', $data);
		$this->load->view('footer');
	}
	
	public function baru($id_project = '')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('id_project', 'Project', 'required');
		$this->form_validation->set_rules('assigned_to', 'Assigned To', 'required');
		$this->form_validation->set_rules('deadline', 'Deadline', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('projects_model');
			if(!empty($id_project))
			{
				$selected_project = $this->projects_model->get_by_id($id_project);
				if($selected_project !== NULL)
				{
					$anggota_tim = explode('-',$selected_project['anggota_tim']);
					
					//pastikan anggota tim di project tidak kosong
					if(count($anggota_tim) > 0)
					{
						$data['anggota_tim'] = $this->users_model->get_by_id_array_simple($anggota_tim);
					}
					else
					{
						$data['anggota_tim'] = NULL;
					}
				}
			}
			
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Task Baru";
			$this->load->view('header', $data);
			
			//ambil semua project
			$data['project_list'] = $this->projects_model->get_all_simple($id_project);
			
			//buat prioritas list
			$data['prioritas_list'] = get_list_prioritas();
			$data['id'] = $id_project;
			$this->load->view('tasks/baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$data_post = $this->input->post();
			$data_post['id_project'] = $id_project;
			$this->tasks_model->baru($data_post);
			redirect('projects/task/' . $id_project);
		}
	}
	
	public function detail($id)
	{
		$data = $this->tasks_model->get_by_id($id);
		if($data !== NULL)
		{
			$this->load->model('projects_model');
			
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = $data['nama'];
			$this->load->view('header', $data);
			
			//ambil data user assigned
			$data['assigned_to'] = $this->users_model->get_by_id($data['assigned_to']);
			
			//ambil data project
			$data['project'] = $this->projects_model->get_by_id($data['id_project']);
			
			$this->load->view('tasks/detail', $data);
			$this->load->view('footer');
		}
		else
		{
			die("task not found");
		}
	}
	
	public function edit($id)
	{
		$task = $this->tasks_model->get_by_id($id);
		if($task != NULL)
		{
			$data = $task;
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('id_project', 'Project', 'required');
			$this->form_validation->set_rules('assigned_to', 'Assigned To', 'required');
			$this->form_validation->set_rules('deadline', 'Deadline', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->model('projects_model');
				
				//check perubahan project
				if($this->input->get('set_project') !== FALSE)
				{
					$data['id_project'] = $this->input->get('set_project');
				}
				
				//load detil project dari database
				$selected_project = $this->projects_model->get_by_id($data['id_project']);
				if($selected_project !== NULL)
				{
					$anggota_tim = explode('-',$selected_project['anggota_tim']);
					
					//pastikan anggota tim di project tidak kosong
					if(count($anggota_tim) > 0)
					{
						$data['anggota_tim'] = $this->users_model->get_by_id_array_simple($anggota_tim);
					}
					else
					{
						$data['anggota_tim'] = NULL;
					}
				}
				
				$data['user'] = $this->user->get_current_user();
				$data['sidebar'] = $this->user->get_sidebar($data);
				$data['judul'] = "Edit Task";
				
				//set pesan notifikasi
				$pesan = $this->session->flashdata('pesan');
				if($pesan !== FALSE) $data['pesan'] = $pesan;
				$this->load->view('header', $data);
				
				//ambil semua project
				$data['project_list'] = $this->projects_model->get_all_simple($id);
				
				//buat prioritas list
				$data['prioritas_list'] = get_list_prioritas();
				$data['id'] = $id;
				$this->load->view('tasks/edit', $data);
				$this->load->view('footer');
			}
			else
			{
				$data_post = $this->input->post();
				$data_post['id'] = $id;
				$this->tasks_model->edit($data_post);
				$this->session->set_flashdata('pesan', 'tersimpan');
				redirect('tasks/edit/' . $id);
			}
		}
		else
		{
			die("task not found");
		}
	}
	
	public function hapus($id)
	{
		$task = $this->tasks_model->get_by_id($id);
		if($task !== NULL)
		{
			$this->tasks_model->del_by_id($id);
			if($this->input->get('from') !== FALSE)
			{
				$from = $this->input->get('from');
				if($from == 'task')
				{
					redirect('tasks');
				}
				elseif($from == 'task_project')
				{
					redirect('projects/task/' . $task['id_project']);
				}
			}
			else
			{	
				redirect('tasks');
			}
		}
		else
		{
			die('task not found');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/tasks.php */