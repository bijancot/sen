<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Bukti extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['menu_model','pt_model','lomba_model','peserta_model','admin_model']);	
			if ($this->session->logged_in == FALSE){
				redirect('login');
			}
			
			$this->load->library('template');
			
		}
		public function index(){
			$this->load->library('table');
			$email = $this->session->username;
			
			$admin = $this->admin_model->getByEmail($email);
			
			if(!$admin){redirect('login');}
			
			$data['username'] = $admin->nama;
			$data['menu'] = $this->menu_model->getByRole(0);
			$peserta = $this->peserta_model->get();
			$data['peserta'] = $peserta;
			$data['nama'] = $admin->nama;
			//print_r($peserta);
			$this->template->view('peserta/tables',$data);
			
		}
		public function list(){
			$this->load->library('table');
			$email = $this->session->username;
			
			$admin = $this->admin_model->getByEmail($email);
			
			if(!$admin){redirect('login');}
			
			$data['username'] = $admin->nama;
			$data['menu'] = $this->menu_model->getByRole(0);
			$peserta = $this->peserta_model->getBukti();
			$data['peserta'] = $peserta;
			$data['nama'] = $admin->nama;
			//print_r($peserta);
			$this->template->view('peserta/tables',$data);
		}
	}
