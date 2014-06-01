<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll extends CI_Controller {
	 
	public function index()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('hr_manager/payroll.php', '', true);
		$data['judul'] = 'List Payroll';
		$dataTS['list'] = $this->users_model->get_payroll();
		$this->load->view('header', $data);
		$this->load->view('hr_manager/list_payroll', $dataTS);
		$this->load->view('footer');
	}
	
	public function payroll_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah Daftar Payroll";
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title();
			$this->load->view('hr_manager/payroll_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->users_model->karyawan_baru($this->input->post());
			redirect('karyawan/index/');
		}
	}
	
	public function edit($id)
	{

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