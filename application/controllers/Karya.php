<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Karya extends CI_Controller {
		private $namalomba = '';
		private $namatim = '';
		private $idpt = '';

		private $foldername;

		private $file_pernyataan;
		private $file_karya;
		private $file_karya2;


		public function __construct()
		{
			parent::__construct();
			$this->load->model(['menu_model','pt_model','lomba_model','peserta_model','admin_model']);	

			if ($this->session->logged_in == FALSE){
				redirect('login');
			}
			$this->load->library('form_validation');
			$this->load->library('template');
			
		}

		public function daftar(){
			if(!$this->session->role){
				redirect('login');
			}
			
			$this->load->library('table');
			$email = $this->session->username;			
			$admin = $this->admin_model->getByEmail($email);			
			
			$data['username'] = $admin->nama;
			$data['menu'] = $this->menu_model->getByRole(0);
			$peserta = $this->peserta_model->get();
			$data['peserta'] = $peserta;			
			$data['nama'] = $admin->nama;
			//print_r($peserta);
			$this->template->view('peserta/tables',$data);
			
		}
		
		public function index($id = ''){
			if($this->session->role){
				redirect('karya/daftar');
			}			
			$this->load->helper('form');
			
			$this->load->library('form_validation');
			$data['menu'] = $this->menu_model->getByRole(1);
			
			$email = $this->session->username;
			$peserta = $this->peserta_model->getByEmail($email);
			
			if($peserta->status < 3){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Maaf, Bukti bayar belum divalidasi.</div>');
				redirect('peserta');
			}

			$buka = $this->admin_model->getKonfigurasi('bukatutup');
			if(!$buka->value){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Maaf, Batas unggah karya telah <strong>ditutup</strong>.</div>');
				redirect('peserta');
			}

			$this->namatim = $peserta->namatim;
			$this->idpt = $peserta->idpt;
			$this->namalomba =$peserta->namalomba;

			$data['peserta'] = $peserta;
			
			
		  	if ($this->form_validation->run('kategori'.$peserta->idlomba) == FALSE)
			{												
				$this->template->view('peserta/karya',$data);				
			} else {
				$data = [				
					'teaser' => $this->input->post('teaser'),
					'pernyataan' => $this->file_pernyataan,
					'karya'=>  $this->file_karya, //$this->foldername."/".$this->upload->data('file_name'),
					'karya2' => $this->file_karya2,
					'youtube' => $this->input->post('youtube'),
					'status' => $peserta->status<=4?4:$peserta->status
				];

				
				$this->peserta_model->simpan($data,$peserta->id);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data karya berhasil disimpan.</div>');
				redirect('karya');
			} 			
		}

		public function cek_upload_poster()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 10240;
			$config['overwrite']			= true;

			$path = $_FILES['karya']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "poster_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$path && $this->input->post('karya_')){ 
				$this->file_karya = $this->input->post('karya_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('karya'))
			{   
				$this->form_validation->set_message('cek_upload_poster', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{	
				
				$this->file_karya = $this->upload->data('file_name');			
				return TRUE;
			}
		}

		public function cek_upload_proposal()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10240;
			$config['overwrite']			= true;

			$path = $_FILES['karya']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "proposal_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$path && $this->input->post('karya_')){ 
				$this->file_karya = $this->input->post('karya_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('karya'))
			{   
				$this->form_validation->set_message('cek_upload_proposal', 
														 'Proposal : '.$this->upload->display_errors());
				return FALSE;
			}
			else
			{				
				$this->file_karya = $this->upload->data('file_name');
				return TRUE;
			}
		}

		public function cek_upload_pernyataan()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10240;
			$config['overwrite']			= true;

			$path = $_FILES['pernyataan']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "pernyataan_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$path && $this->input->post('pernyataan_')){ 
				$this->file_pernyataan = $this->input->post('pernyataan_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('pernyataan'))
			{   
				$this->form_validation->set_message('cek_upload_pernyataan', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{				
				$this->file_pernyataan = $this->upload->data('file_name'); 
				return TRUE;
			}
		}

		
		public function cek_upload_proposal1()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 25600;
			$config['overwrite']			= true;

			$path = $_FILES['karya']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "proposal_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$path && $this->input->post('karya_')){ 
				$this->file_karya = $this->input->post('karya_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('karya'))
			{   
				$this->form_validation->set_message('cek_upload_proposal1', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{
				$this->file_karya = $this->upload->data('file_name');
				return TRUE;
			}
		}

		public function cek_upload_karya2()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = 'rar|zip';
			$config['max_size']             = 102400;
			$config['overwrite']			= true;

			$path = $_FILES['karya2']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "desain_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$path && $this->input->post('karya2_')){ 
				$this->file_karya2 = $this->input->post('karya2_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('karya2'))
			{   
				$this->form_validation->set_message('cek_upload_karya2', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{
				$this->file_karya2 = $this->upload->data('file_name');
				return TRUE;
			}
		}

		public function cek_upload_video()
		{
			$namalomba = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namalomba);
			$namalomba = mb_ereg_replace("([\.]{2,})", '', $namalomba);

			$namatim = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $this->namatim);
			$namatim = mb_ereg_replace("([\.]{2,})", '', $namatim);

			$foldername = "berkas/{$namalomba}/{$namatim}({$this->idpt})/karya";
			if (!is_dir($foldername)) {
				mkdir($foldername, 0777, true);
			}
			$this->foldername = $foldername;
			
			$config['upload_path']          = $foldername;
			$config['allowed_types']        = '*|mp4|avi|mpg|mpeg';
			$config['max_size']             = 256000;
			$config['overwrite']			= true;

			$path = $_FILES['karya']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$config['file_name']			= "video_{$this->namatim}.{$ext}";						

			$this->load->library('upload', $config);
			$this->upload->initialize($config,TRUE);

			if (!$path && $this->input->post('karya_')){ 
				$this->file_karya = $this->input->post('karya_');
				return TRUE;
			}

			if ( ! $this->upload->do_upload('karya'))
			{   
				$this->form_validation->set_message('cek_upload_video', 
														 $this->upload->display_errors());
				return FALSE;
			}
			else
			{
				$this->file_karya = $this->upload->data('file_name');
				return TRUE;
			}
		}
	}