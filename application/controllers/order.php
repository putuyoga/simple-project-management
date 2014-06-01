<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class order extends CI_Controller {
	public function list_order(){
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/order', '', true);
		
		$dataTS['list'] = $this->sales_model->getAll('order');
		$data['judul'] = "List Order";
		$this->load->view('header', $data);
		$this->load->view('sales/list_order', $dataTS);
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
	
	public function order_baru()
	{
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('id_project', 'ID Project', 'required');
		$this->form_validation->set_rules('pelanggan', 'Pelanggan', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Buat Order";
			$this->load->view('header', $data);
			
			$data['pelanggan']=$this->sales_model->get_column('nama','pelanggan','');
			$data['status'] = array(
				'dibuka' => 'dibuka',
				'dikerjakan' => 'dikerjakan',
				'selesai' => 'selesai'
			);
			//$data['list_auth'] = get_list_job_title();
			$this->load->view('sales/order_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->sales_model->insert_order($this->input->post());
			//redirect('order/list_order');
			/*
			echo "<br />".$this->input->post('pelanggan');
			echo "<br />".$this->input->post('status');
			echo "<br />".$this->input->post('harga');
			*/
		}
	}
	
	public function edit_order($id = "")
	{
		$user = $this->sales_model->get_by_id($id);
		if($user !== FALSE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('no_telp', 'No. Telp.', 'required');
			$this->form_validation->set_rules('website', 'Website', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			//$this->form_validation->set_rules('auth', 'Auth', 'less_than[3]');
			
			$showForm = true;
			
			if ($this->form_validation->run() == FALSE)
			{
				$showForm = true;
			}
			else
			{
				if($this->input->post('nama') != $user['nama'])
				{
					$this->form_validation->set_rules('nama', 'Nama', 'required');
				}
				if($this->input->post('email') != $user['email'])
				{
					$this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]');
				}
				
				if($this->input->post('no_telp') != $user['no_telp'])
				{
					$this->form_validation->set_rules('no_telp', 'No. Telp.', 'required');
				}
				if($this->input->post('website') != $user['website'])
				{
					$this->form_validation->set_rules('website', 'Website', 'required');
				}
				if($this->input->post('alamat') != $user['alamat'])
				{
					$this->form_validation->set_rules('alamat', 'Alamat', 'required');
				}
				
				if($this->form_validation->run() == FALSE)
				{
				}
				else
				{
					$this->sales_model->update_pelanggan($id);
					$this->session->set_flashdata('pesan', 'tersimpan');
					redirect('pelanggan/edit_pelanggan/' . $id);
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
				$data['judul'] = "Edit Pelanggan";
				$this->load->view('header', $data);
				$data = $user;
				
				//setup auth dropdown
				//$data['list_auth'] = get_list_job_title();
				
				//exclude admin
				/*if($user['auth'] != 255)
				{
					$data['list_auth'][255] = 'admin';
				}
				*/
				//show the rest
				$this->load->view('sales/edit_pelanggan', $data);
				$this->load->view('footer');
			}
		} else { die("user not found"); }
	}
	
	public function hapus_order($id)
	{
		$user = $this->sales_model->get_by_id($id,'order');
		if($user !== NULL)
		{
				$this->sales_model->del_by_id($id,'order');
				redirect('order/list_order');			
		}
	}
	
}