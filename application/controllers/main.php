<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	 
	public function index()
	{		
		//kalau belum login, suruh login dulu
		if($this->user->get_current_user() === NULL)
		{
			redirect('main/login');
		}
		else
		{
			$data['user'] = $this->user->get_current_user();
			$data['judul'] = 'ERP';
			$data['sidebar'] = $this->load->view('menu/top', $data, true);
			$data['sidebar'] .= $this->load->view('menu/' . $data['user']['auth'], '',true);
			
			$this->load->view('header', $data);
			$this->load->view('welcome_message', $data);
			$this->load->view('footer');
		}
	}
	
	public function login()
	{
		if($this->input->post('do-login') !== FALSE)
		{
			$data = $this->input->post();
			
			$cek_login = $this->users_model->is_user($data['username'], $data['password']);
			
			//kalau udah bener
			if($cek_login !== FALSE)
			{
				$this->user->set_current_user($cek_login);
				redirect('main');					
				
			}
		}
		$data['judul'] = "Login";
		$this->load->view('header', $data);
		$this->load->view('login_form');
		$this->load->view('footer');
	}
	
	public function edit_profil()
	{
		$user = $this->user->get_current_user();
		if($user !== NULL)
		{
			if($this->input->post('do-change'))
			{
				$post = $this->input->post();
				
				if($post['password'] != $post['repassword'])
				{
					$this->session->set_flashdata('pesan2', 'password tidak sama');
					redirect('welcome/edit_profil');
				}
				else
				{
					$config['upload_path'] = './images/avatar/';
					$config['allowed_types'] = 'jpg';
					$config['max_width']  = '150';
					$config['max_height']  = '150';
					$config['overwrite'] = TRUE;
					$config['file_name'] = $user['id'];
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('avatar'))
					{	
						if($this->upload->display_errors('','') != 'You did not select a file to upload.')
						{
							$this->session->set_flashdata('pesan2', $this->upload->display_errors('',''));
						}
						else
						{
							$this->users_model->edit_profil($user['id'], $post['email'], $post['password']);
							$this->session->set_flashdata('pesan', 'disimpan');
						}
					}
					else
					{
						$this->users_model->edit_profil($user['id'], $post['email'], $post['password']);
						$this->session->set_flashdata('pesan', 'disimpan');
					}
					redirect('welcome/edit_profil');
				}
			}
			$data['user'] = $user;
			$data['sidebar'] = $this->load->view('menu/top', $data, true);
			$data['sidebar'] .= $this->load->view('menu/' . $data['user']['auth'], '',true);
			
			//pesan tersimpan notif
			$pesan = $this->session->flashdata('pesan');
			if($pesan !== FALSE) $data['pesan'] = $pesan;
			
			//header
			$data['judul'] = "Setting";
			$this->load->view('header', $data);
			$data = $user;
			
			//show the rest
			$data['pesan'] = $pesan = $this->session->flashdata('pesan2');
			$this->load->view('edit_profil', $data);
			$this->load->view('footer');
		}
		else
		{
			die('MATAAMU');
		}
	}
	
	public function close()
	{
		$data['judul'] = "Tutup";
		$this->load->view('header', $data);
		$this->load->view('pesan_tutup');
		$this->load->view('footer');
	}
	
	public function logout()
	{
		$user = $this->user->get_current_user();
		$this->user->clear_current_user();
		
		redirect('/');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/main.php */