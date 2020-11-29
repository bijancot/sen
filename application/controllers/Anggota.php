<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Anggota extends CI_Controller {
		private $namalomba = '';
		private $namatim = '';
		private $idpt = '';

		private $foldername;
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['menu_model','anggota_model','peserta_model']);	
			if ($this->session->logged_in == FALSE){
				redirect('login');
			} 
			$this->load->library('template');

		}
		public function detil($id){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$data['menu'] = $this->menu_model->getByRole(0);
			
			
			if($peserta = $this->peserta_model->get($id)){
				$this->namatim = $peserta->namatim;
				//$this->idpt = $peserta->idpt;
				//$this->namalomba =$peserta->namalomba;

				$data['peserta'] = $peserta;
				if($data['anggota'] = $this->anggota_model->get($peserta->id)){
					$this->template->view('peserta/detil_anggota',$data);	
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Anggota tidak ditemukan</div>');
					redirect('dashboard');	
				}
				
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Peserta tidak ditemukan</div>');
				redirect('dashboard');	
			}
			
		}
			
		public function index($id = ''){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$data['menu'] = $this->menu_model->getByRole(1);
			
			
			if($id){
				$peserta = $this->peserta_model->get($id);
			} else {
				$email = $this->session->username;
				$peserta = $this->peserta_model->getByEmail($email);
				$this->namatim = $peserta->namatim;
				//$this->idpt = $peserta->idpt;
				//$this->namalomba =$peserta->namalomba;
				
			}
			
				
			if ($this->form_validation->run('anggota') == FALSE)
			{				
				
				$data['peserta'] = $peserta;
				$data['anggota'] = $this->anggota_model->get($peserta->id);
				
				if(!$data['anggota']){  redirect('anggota/add'); }//jika data anggota tidak ada
				
				$this->template->view('peserta/edit_anggota',$data);
				} else {
				//$email = htmlspecialchars($this->input->post('email',true));			
				$data['namaketua'] = htmlspecialchars($this->input->post('namaketua',true));
				$data = [
				'idpeserta' => $peserta->id,
				'namaketua' => htmlspecialchars($this->input->post('namaketua',true)),
				'anggota2' => htmlspecialchars($this->input->post('anggota2',true)),
				'email2'=> htmlspecialchars($this->input->post('email2',true)),
				'nohp2'=> htmlspecialchars($this->input->post('nohp2',true)),
				
				'anggota3' => htmlspecialchars($this->input->post('anggota3',true)),
				'email3'=> htmlspecialchars($this->input->post('email3',true)),
				'nohp3'=> htmlspecialchars($this->input->post('nohp3',true)),
				
				'anggota4' => htmlspecialchars($this->input->post('anggota4',true)),
				'email4'=> htmlspecialchars($this->input->post('email4',true)),
				'nohp4'=> htmlspecialchars($this->input->post('nohp4',true)),

				'anggota5' => htmlspecialchars($this->input->post('anggota5',true)),
				'email5'=> htmlspecialchars($this->input->post('email5',true)),
				'nohp5'=> htmlspecialchars($this->input->post('nohp5',true)),
				
				//'nidn' => htmlspecialchars($this->input->post('nidn',true)),
				//'pembimbing'=> htmlspecialchars($this->input->post('pembimbing',true)),
				//'instagram'=>htmlspecialchars($this->input->post('instagram', true)),
				
				];
				
				$path = $_FILES['ktm']['name'];	
				if ($path){

					$data['ktm'] = $this->foldername."/".$this->upload->data('file_name');
					
				}
 				
				$this->anggota_model->simpan($data, $peserta->id);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Anggota berhasil disimpan</div>');
				redirect('anggota');
				
			}
		}

		public function add(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			$data['menu'] = $this->menu_model->getByRole(1);
			
			$email = $this->session->username;
			$peserta = $this->peserta_model->getByEmail($email);
			
			$this->namatim = $peserta->namatim;
			//$this->idpt = $peserta->idpt;
			//$this->namalomba =$peserta->namalomba;

			$data['peserta'] = $peserta;
			
			
		  if ($this->form_validation->run('anggota') == FALSE)
			{												
				$data['anggota'] = $this->anggota_model->get($peserta->email);
				
				$this->template->view('peserta/tambah_anggota',$data);
				
				} else {
				//$email = htmlspecialchars($this->input->post('email',true));			
				$data['namaketua'] = htmlspecialchars($this->input->post('namaketua',true));
				$data = [
				'idpeserta' => $peserta->id,
				'namaketua' => htmlspecialchars($this->input->post('namaketua',true)),
				'anggota2' => htmlspecialchars($this->input->post('anggota2',true)),
				'email2'=> htmlspecialchars($this->input->post('email2',true)),
				'nohp2'=> htmlspecialchars($this->input->post('nohp2',true)),
				
				'anggota3' => htmlspecialchars($this->input->post('anggota3',true)),
				'email3'=> htmlspecialchars($this->input->post('email3',true)),
				'nohp3'=> htmlspecialchars($this->input->post('nohp3',true)),
				
				'anggota4' => htmlspecialchars($this->input->post('anggota4',true)),
				'email4'=> htmlspecialchars($this->input->post('email4',true)),
				'nohp4'=> htmlspecialchars($this->input->post('nohp4',true)),

				'anggota5' => htmlspecialchars($this->input->post('anggota4',true)),
				'email5'=> htmlspecialchars($this->input->post('email4',true)),
				'nohp5'=> htmlspecialchars($this->input->post('nohp4',true)),
				
				//'nidn' => htmlspecialchars($this->input->post('nidn',true)),
				//'pembimbing'=> htmlspecialchars($this->input->post('pembimbing',true)),
				//'ktm'=>  $this->foldername."/".$this->upload->data('file_name'),
				//'instagram'=>htmlspecialchars($this->input->post('instagram', true)),
				
				];
 				
				$this->anggota_model->simpan($data);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Anggota berhasil ditambahkan.</div>');
				redirect('anggota');
			} 			
		}
		
		
	}
		
