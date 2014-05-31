<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pelanggan extends CI_Controller {
	public function list_pelanggan(){
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/pelanggan', '', true);
		
		$dataTS['list'] = $this->sales_model->getAll();
		$data['judul'] = "List Pelanggan";
		$this->load->view('header', $data);
		$this->load->view('sales/list_pelanggan', $dataTS);
		$this->load->view('footer');
	}
	
	public function hapus_pelanggan($id)
	{
		$user = $this->sales_model->get_by_id($id);
		if($user !== NULL)
		{
				$this->sales_model->del_by_id($id);
				redirect('pelanggan/list_pelanggan');
			
		}
	}
	
	public function pelanggan_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		//$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Tambah Pelanggan";
			$this->load->view('header', $data);
			$data['list_auth'] = get_list_job_title();
			$this->load->view('sales/pelanggan_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->sales_model->insert_pelanggan($this->input->post());
			redirect('pelanggan/list_pelanggan/');
		}
	}
	
}