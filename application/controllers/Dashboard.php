<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['menu_model', 'pt_model', 'lomba_model', 'peserta_model', 'admin_model']);
		if ($this->session->logged_in == FALSE) {
			redirect('login');
		}

		$this->load->library('template');
	}
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('table');
		$email = $this->session->username;

		$admin = $this->admin_model->getByEmail($email);

		if (!$admin) {
			redirect('login');
		}

		$data['username'] = $admin->nama;
		$data['menu'] = $this->menu_model->getByRole(0);
		$peserta = $this->peserta_model->get();
		$data['peserta'] = $peserta;
		$data['nama'] = $admin->nama;
		//print_r($peserta);
		$data['konfigurasi'] = $this->admin_model->getKonfigurasi('bukatutup');
		
		$this->template->view('peserta/tables', $data);
	}

	public function bukatutup(){
		
			$data['value'] = $this->input->post('batas');
			// print_r($data);
			// die();
			$this->admin_model->buka($data);
			redirect('dashboard');
		// }
	}
}
