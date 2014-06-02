<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class order extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		//kalau belum login, suruh login dulu
		if($this->user->get_current_user() === NULL)
		{
			redirect('main/login');
		} else {
			$user = $this->user->get_current_user();
			if($user['auth'] == 255 || $user['auth'] == 4 || $user['auth'] == 5){
			}
			else
			{
				die('Anda Tidak Memiliki Hak Akses!');
			}
		}
		
		$this->load->helper('user_helper');
	}
	 
	public function list_order(){
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/order', '', true);
		
		$dataTS['list'] = $this->sales_model->get_all_detail();
		$user = $this->user->get_current_user();
		//jika sales officer
		if($user['auth'] == 5){
			//sisipkan user yg aktif ke array
			$dataTS['list'][0]['user'] = $user['username'];
		}
		
		$data['judul'] = "List Order";
		$this->load->view('header', $data);
		if($user['auth'] == 5){
			$this->load->view('sales/list_order_officer', $dataTS);
		}
		else{
			$this->load->view('sales/list_order', $dataTS);
		}
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
		$this->form_validation->set_rules('id_pelanggan', 'Pelanggan', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['sidebar'] = $this->user->get_sidebar($data);
			$data['judul'] = "Buat Order";
			$this->load->view('header', $data);
			
			$data['pelanggan']=$this->sales_model->get_all_simple();
			$data['status'] = array(
				'dibuka' => 'dibuka',
				'dikerjakan' => 'dikerjakan',
				'selesai' => 'selesai'
			);
			$this->load->view('sales/order_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->sales_model->insert_order($this->input->post());
			redirect('order/list_order');
		}
	}
	
	public function edit_order($id = "")
	{
		$order = $this->sales_model->get_by_id($id,'order');
		//$order = $this->sales_model->get_edit($id);
		if($order !== FALSE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama', 'Nama Project', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
			
			$showForm = true;
			
			if ($this->form_validation->run() == FALSE)
			{
				$showForm = true;
			}
			else
			{
				if($this->input->post('nama') != $order['nama'])
				{
					$this->form_validation->set_rules('nama', 'Nama Project', 'required');
				}				
				if($this->input->post('status') != $order['status'])
				{
					$this->form_validation->set_rules('status', 'Status', 'required');
				}
				if($this->input->post('harga') != $order['harga'])
				{
					$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
				}
				if($this->input->post('tanggal') != $order['tanggal'])
				{
					$this->form_validation->set_rules('tanggal', 'Tanggal');
				}
				
				if($this->form_validation->run() == FALSE)
				{
				}
				else
				{
					$this->sales_model->update_order($id);
					$this->session->set_flashdata('pesan', 'tersimpan');
					redirect('order/edit_order/' . $id);
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
				$data['judul'] = "Edit Order: ".$id;
				$this->load->view('header', $data);
				$data = $order;
		
				$data['pelanggan']=$this->sales_model->get_all_simple();
				$data['status'] = array(
					'dibuka' => 'dibuka',
					'dikerjakan' => 'dikerjakan',
					'selesai' => 'selesai'
				);
				
				//show the rest
				$this->load->view('sales/edit_order', $data);
				$this->load->view('footer');
			}
		} else { die("order not found"); }
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
	
	public function detail_order($id){
		$data['list'] = $this->sales_model->get_detail_by_id($id,'order');
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['judul'] = "Detail Order: ".$data['list']['nama'];
		$this->load->view('header', $data);
		
		$this->load->view('sales/detail_order',$data);
		$this->load->view('footer');
	}
	
}