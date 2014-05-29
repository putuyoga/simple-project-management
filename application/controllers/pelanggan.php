<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pelanggan extends CI_Controller {
	public function list_pelanggan(){
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['topbar'] = $this->load->view('menu/admin/user', '', true);
		
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
	
}