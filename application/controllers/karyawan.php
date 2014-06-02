<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	 
	public function index()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('hr_manager/karyawan.php', '', true);
		$data['judul'] = 'List Karyawan';
		$dataTS['list'] = $this->users_model->get_karyawan();
		$this->load->view('header', $data);
		$this->load->view('hr_manager/list_karyawan', $dataTS);
		$this->load->view('footer');
	}
	
	public function karyawan_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah Karyawan";
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title_excpt_admin();
			$this->load->view('hr_manager/karyawan_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->users_model->karyawan_baru($this->input->post());
			redirect('karyawan/index/');
		}
	}
	
	
	public function edit_karyawan($id)
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== FALSE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha');
			$this->form_validation->set_rules('password', 'Password', 'matches[repassword]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			//$this->form_validation->set_rules('auth', 'Auth', 'less_than[3]');
			
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
					redirect('karyawan/edit_karyawan/' . $id);
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
				$data['judul'] = "Edit Karyawan";
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
				$this->load->view('hr_manager/edit_karyawan', $data);
				$this->load->view('footer');
			}
		} else { die("user not found"); }
	}
	
	public function hapus_karyawan($id)
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== NULL)
		{
			if($user["auth"] == 3)
			{
				return;
			}
			else 
			{
				$this->users_model->del_by_id($id);
				redirect('karyawan/index');
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/karyawan.php */