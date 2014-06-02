<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll extends CI_Controller {
	 
	public function index()
	{

		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		
		$data['judul'] = 'List Payroll';

		//set content view
		if($data['user']['auth'] == 255)
		{
			//$data['list'] = $this->users_model->get_payroll();
			$data['topbar'] = $this->load->view('hr_manager/payroll', '', true);
			$dataTS['list'] = $this->users_model->get_payroll();
			$this->load->view('header', $data);
			$this->load->view('hr_manager/list_payroll', $dataTS);
		}
		elseif($data['user']['auth'] == 3)
		{
			//$data['list'] = $this->users_model->get_payroll();
			$data['topbar'] = $this->load->view('hr_manager/payroll', '', true);
			$dataTS['list'] = $this->users_model->get_payroll();
			$this->load->view('header', $data);
			$this->load->view('hr_manager/list_payroll', $dataTS);
		}
		else
		{
			$this->load->view('header', $data);
			//$data_member['list'] = $this->users_model->get_member_payroll_detail();
			$dataTS['list'] = $this->users_model->get_member_payroll_detail($data['user']['username']);

			$this->load->view('hr_manager/list_payroll_member', $dataTS);
		}
		$this->load->view('footer');
	
	}
	
	public function payroll_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('gaji', 'Gaji', 'required');
		$this->form_validation->set_rules('bonus', 'Bonus', '');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
		$this->form_validation->set_rules('status', 'Status', '');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah Daftar Payroll";
			$this->load->view('header', $data);
			//$data['list_auth'] = get_list_job_title();
			$data['list_status'] = get_list_status();
			
			//ambil semua user dengan auth karyawan
			$data['em_list'] = $this->users_model->get_by_auth_simple(1);

			$this->load->view('hr_manager/payroll_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->users_model->payroll_baru($this->input->post());
			redirect('payroll/index/');
		}
	}
	
	public function edit_payroll($id_payroll)
	{
		$user = $this->users_model->get_payroll_by_id($id_payroll);
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
				$this->load->view('hr_manager/edit_payroll', $data);
				$this->load->view('footer');
			}
		} else { die("user not found"); }
	}
	
	public function hapus_payroll($id_payroll)
	{
		$user = $this->users_model->get_payroll_by_id($id_payroll);
		if($user !== NULL)
		{
			if($user["auth"] == 3)
			{
				return;
			}
			else 
			{
				$this->users_model->del_payroll_by_id($id_payroll);
				redirect('payroll/index');
			}
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/payroll.php */