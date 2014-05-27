<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	 
	public function index()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->user->get_sidebar($data);
		$data['judul'] = 'List Project';
		$this->load->view('header', $data);
		$this->load->view('footer');
	}
	
	public function baru()
	{
	}
	
	public function edit($id)
	{
	}
	
	public function hapus($id)
	{
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/projects.php */