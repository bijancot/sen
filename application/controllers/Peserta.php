<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Peserta extends CI_Controller {
		private $namalomba = '';
		private $namatim = '';
		private $idpt = '';

		private $foldername;

		public function __construct()
		{
			parent::__construct();
			$this->load->model(['menu_model','pt_model','lomba_model','peserta_model']);	
			if ($this->session->logged_in == FALSE){
				redirect('login');
			} 
			$this->load->library('template');
			
		}
		
		public function index($id = ''){
			
			if ($this->session->role == 1){
				redirect('dashboard');
			}
			$this->load->library('table');
			$this->load->helper('form');
			$this->load->library('form_validation');

			$email = $this->session->username;
			$data['menu'] = $this->menu_model->getByRole(1);
			
			$peserta = $this->peserta_model->getByEmail($email);
			$this->namatim = $peserta->namatim;
			$this->idpt = $peserta->idpt;
			$this->namalomba =$peserta->namalomba;
			

			if ($this->form_validation->run('bukti') == FALSE)
			{
				
				//$data['pt'] = $this->pt_model->get_dropdown();
				$data['lomba'] = $this->lomba_model->get_dropdown();
								

				$data['peserta'] = $peserta;
				$data['nama'] = $this->namatim;
			
				$this->template->view('peserta/single',$data);
			} else {
				
				$email = htmlspecialchars($this->input->post('email',true));
				
				$data = [
					
				'nohp'=> htmlspecialchars($this->input->post('nohp')),				
				'status' => $peserta->status<=2?2:$peserta->status
				];

				$path = $_FILES['bukti']['name'];
				if ($path){ 
					$data['buktibayar'] = $this->foldername."/".$this->upload->data('file_name');
				}
				
				$id = $this->input->post('idpeserta');
				$this->peserta_model->simpan($data,$id);
				redirect('peserta');
			}
			
		}

		public function detil($id = ''){
			if (!$this->session->role == 1){
				redirect('login');
			}
			$this->load->library('table');
			$this->load->helper('form');
			$this->load->library('form_validation');

			// $email = $this->session->username;
			$peserta = $this->peserta_model->get($id);
			$this->namatim = $peserta->namatim;
			$this->idpt = $peserta->idpt;
			$this->namalomba =$peserta->namalomba;
			
			if ($this->form_validation->run('valid') == FALSE)
			{
				
				//$data['pt'] = $this->pt_model->get_dropdown();
				//$data['lomba'] = $this->lomba_model->get_dropdown();
				$data['menu'] = $this->menu_model->getByRole(0);				

				$data['peserta'] = $peserta;
				$data['nama'] = $this->namatim;
			
				$this->template->view('peserta/validasi',$data);
			} else {
				$data = [									
				'status' => $peserta->status<=3?3:$peserta->status // sudah di validasi
				];				
				
				$id = $this->input->post('idpeserta');
				$this->peserta_model->simpan($data,$id);
				redirect('dashboard');
			}
			
		}
		
		public function cek_upload_bukti()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/bukti";
			if (!is_dir($foldername)) {
				$old = umask(0000);
				mkdir($foldername, 0777, true);
				umask($old);
			}
			$this->foldername = $foldername;
			// echo is_writable($foldername)?'bisa':'tidak';
			// die();
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 2048;
			$config['max_width']            = 1500;
			$config['max_height']           = 1500;
			$config['overwrite']			= true;

			$path = $_FILES['bukti']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "bukti_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$path && $this->input->post('bukti_')){ 
				return TRUE;
			}

			if ( ! $this->upload->do_upload('bukti'))
			{   
				$this->form_validation->set_message('cek_upload_bukti', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
			
			
			
	}
