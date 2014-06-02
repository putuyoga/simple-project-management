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
		$this->form_validation->set_rules('id_user', 'id_user', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('gaji', 'Gaji', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah Daftar Payroll";
			$this->load->view('header', $data);
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
			$this->form_validation->set_rules('id_user', 'id_user', 'required');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
			$this->form_validation->set_rules('gaji', 'Gaji', 'required');
			
			$showForm = true;
			
			if ($this->form_validation->run() == FALSE)
			{
				$showForm = true;
			}
			else
			{
				if($this->form_validation->run() == FALSE)
				{
				}
				else
				{
					$this->users_model->payroll_edit($id_payroll,$this->input->post());
					$this->session->set_flashdata('pesan', 'tersimpan');
					redirect('payroll/edit_payroll/' . $id_payroll);
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
				$data['judul'] = "Edit Payroll id " . $id_payroll;
				$this->load->view('header', $data);
				$data = $user;
				
				//setup dropdown
				$data['list_status'] = get_list_status();
				$data['em_list'] = $this->users_model->get_by_auth_simple(1);
				
				//show the rest
				$this->load->view('hr_manager/payroll_edit', $data);
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