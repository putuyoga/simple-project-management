<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		
		//kalau belum login, suruh login dulu
		if($this->user->get_current_user() === NULL)
		{
			redirect('main/login');
		} else {
			$user = $this->user->get_current_user();
			if($user['auth'] != 255)
			{
				die('kate lapo cok');
			}
		}
		
		$this->load->helper('user_helper');
	}
	 
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
			$data['sidebar'] = $this->load->view('menu/top', $data, true);
			$data['sidebar'] .= $this->load->view('menu/' . $data['user']['auth'], '',true);
			
			$data['judul'] = "Admin Panel";
			$this->load->view('header', $data);
			$this->load->view('footer');
		}
		
	}
	
	public function users()
	{
		$data['user'] = $this->user->get_current_user();
		$data['sidebar'] = $this->load->view('menu/top', $data, true);
		$data['sidebar'] .= $this->load->view('menu/' . $data['user']['auth'], '',true);
			
		
		$dataTS['list'] = $this->users_model->get_all();
		$data['judul'] = "List User";
		$this->load->view('header', $data);
		$this->load->view('admin/list_user', $dataTS);
		$this->load->view('footer');
	}
	
	public function user_baru()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|alpha');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[repassword]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['user'] = $this->user->get_current_user();
			$data['menu'] = $this->load->view('menu', $data, TRUE);
			$data['judul'] = "Tambah User";
			$this->load->view('header', $data);
			$data['list_auth'] = array('1' => 'kantor', '2' => 'remote', '255' => 'admin');
			$this->load->view('admin/user_baru', $data);
			$this->load->view('footer');
		}
		else
		{
			$this->users_model->baru($this->input->post());
			redirect('admin/users/');
		}
	}
	
	public function edit_user($id = "")
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== FALSE)
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|alpha');
			$this->form_validation->set_rules('password', 'Password', 'matches[repassword]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('auth', 'Auth', 'less_than[3]');
			
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
					redirect('admin/edit_user/' . $id);
				}
			}
			
			if($showForm)
			{
				$data['user'] = $this->user->get_current_user();
				$data['sidebar'] = $this->load->view('menu/top', $data, true);
				$data['sidebar'] .= $this->load->view('menu/' . $data['user']['auth'], '',true);
			
				//pesan tersimpan notif
				$pesan = $this->session->flashdata('pesan');
				if($pesan !== FALSE) $data['pesan'] = $pesan;
				
				//header
				$data['judul'] = "Edit User";
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
				$this->load->view('admin/edit_user', $data);
				$this->load->view('footer');
			}
		} else { die("user not found"); }
	}
	
	public function timesheet($type_filter = '', $value = '')
	{
		//init
		$date = date('Y-m-d', time());
		$month = date('F', time());
		$year = date('Y', time());
		
		if($type_filter == 'date')
		{
			$date = $value;
		}
		elseif($type_filter == 'month')
		{
			$month = $value;
		}
		elseif($type_filter == 'year')
		{
			$year = $value;
		}
		
		$this->load->model('timesheet_model');
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);
		
		$dataTS['list'] = $this->timesheet_model->get_all_nice_ringkas($type_filter, $value);
		$data['judul'] = "List Timesheet";
		$data['select_date'] = $date;
		$data['select_month'] = $month;
		$data['select_year'] = $year;
		$data['select_filter'] = $type_filter;
		$this->load->view('header', $data);
		$this->load->view('admin/list_timesheet', $dataTS);
		$this->load->view('footer');
		/*
		$this->load->model('timesheet_model');
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);
		
		$dataTS['list'] = $this->timesheet_model->get_all_nice();
		$dataTS['is_ringkas'] = false;
		$data['judul'] = "List Timesheet";
		$this->load->view('header', $data);
		$this->load->view('admin/list_timesheet', $dataTS);
		$this->load->view('footer');
		*/
	}
	
	public function list_ts($id_user)
	{
		$this->load->model('timesheet_model');
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);
		
		$dataTS['list'] = $this->timesheet_model->get_by_user($id_user);
		if($dataTS['list'] == NULL) return;
		$user = $this->users_model->get_by_id($id_user);
		
		$data['judul'] = "List Timesheet : " . $user['username'];
		$this->load->view('header', $data);
		$this->load->view('admin/list_user_timesheet', $dataTS);
		$this->load->view('footer');
	}
	
	public function edit_ts($id)
	{
		$this->load->model('timesheet_model');
		if($this->input->post('do-save') !== FALSE)
		{
			$this->timesheet_model->edit($this->input->post());
			$data['pesan'] = 'tersimpan';
		}
		
		//menu
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);
		
		$data['judul'] = "Edit Timesheet";
		$this->load->view('header', $data);
		
		//load timesheet yg dimaksud
		$this->load->helper('form');
		$data = $this->timesheet_model->get_by_id($id);
		$data['list_user'] = $this->users_model->get_all_simple();
		$this->load->view('admin/edit_timesheet', $data);
		$this->load->view('footer');
	}
	
	public function hapus_td($id)
	{
		$this->load->model('timesheet_model');
		$ts = $this->timesheet_model->get_by_id($id);
		
		if($ts !== NULL)
		{
			$this->timesheet_model->del_by_id($id);
			redirect('admin/timesheet');
		}
	}
	
	public function hapus_user($id)
	{
		$user = $this->users_model->get_by_id($id);
		if($user !== NULL)
		{
			if($user["auth"] == 255)
			{
				return;
			}
			else 
			{
				$this->users_model->del_by_id($id);
				redirect('admin/users');
			}
		}
	}
	
	public function poin($type_filter = '', $value = '')
	{
		//init
		$date = date('Y-m-d', time());
		$month = date('F', time());
		$year = date('Y', time());
		
		if($type_filter == 'date')
		{
			$date = $value;
		}
		elseif($type_filter == 'month')
		{
			$month = $value;
		}
		elseif($type_filter == 'year')
		{
			$year = $value;
		}
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);

		$dataTS['list'] = $this->users_model->get_all_with_poin($type_filter, $value);
		$data['judul'] = "Poin " . $value;
		$data['select_date'] = $date;
		$data['select_month'] = $month;
		$data['select_year'] = $year;
		$data['select_filter'] = $type_filter;
		$this->load->view('header', $data);
		$this->load->view('admin/list_poin', $dataTS);
		$this->load->view('footer');
	}
	
	public function beri_poin($id_user)
	{
		if($this->input->post('do-give') !== FALSE)
		{
			$this->load->model('poin_model');
			$data = $this->input->post();
			$this->poin_model->add($id_user, 1, $data['poin']);
			redirect('admin/poin/');
		}
		$data['user'] = $this->user->get_current_user();
		$data['menu'] = $this->load->view('menu', $data, TRUE);
		$dataTS = $this->users_model->get_by_id_with_poin($id_user);
		$data['judul'] = "Beri poin";
		$this->load->view('header', $data);
		$this->load->view('admin/beri_poin', $dataTS);
		$this->load->view('footer');
	}
	
	public function stop_ts($id_user = '')
	{
		$user = $this->users_model->get_by_id($id_user);
		if($user !== FALSE)
		{
			$this->load->model('timesheet_model');
			$this->timesheet_model->stop($user['id']);
			redirect('admin/timesheet');
		}
	}
	
	public function delete()
	{
		
	}
	
	/*
	public function stop_ts($id_ts = '', $id_user = '')
	{
		$this->load->model('timesheet_model');
		$this->load->model('poinrules_model');
		$this->load->model('poin_model');
		if(empty(trim($id_user)))
		{
			$ts = $this->timesheet_model->get_by_id($id_ts);
			$id_user = $ts['id_user'];
		}
		$user = $this->users_model->get_by_id($id_user);
		
		if($user !== FALSE)
		{
			$this->timesheet_model->stop($user['id']);
			
			//load rules
			$rules = $this->poinrules_model->get_all();
			
			//check total work time
			if($this->timesheet_model->is_enough_work($user['id'], $user['auth'], $rules))
			{
				$poin = $this->timesheet_model->get_poin_sukses($user['id'], $user['auth'], $rules);
				$this->poin_model->add($user['id'], 2, $poin);
			}
			//jika waktu habis
			elseif($this->poinrules_model->is_end_worktime($user['auth']))
			{
				$poin = $this->timesheet_model->get_poin_gagal($user['id'], $user['auth'], $rules);
				$this->poin_model->add($user['id'], 2, $poin);
			}
		
		}
		redirect('admin/timesheet');
	}*/

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */