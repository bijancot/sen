<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['pt_model', 'lomba_model', 'peserta_model', 'Statistik', 'Poster', 'M_seminar', 'Statistik_webinar', 'Finalis']);	
		}
		public function index(){
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			if ($this->form_validation->run('pendaftaran') == FALSE)
			{
				$data['pt'] = $this->pt_model->get_dropdown();
				$data['lomba'] = $this->lomba_model->get_dropdown();
		        $data['seminar'] = $this->M_seminar->get_seminar();
		        $data['seminarone'] = $this->M_seminar->get_seminar_one();
				//print_r($data['pt']);
				
				$this->load->view('header',$data);
				$this->load->view('index_new',$data);
				$this->load->view('footer',$data);
				
				} else {
				$data['namatim'] = $this->input->post('namatim');
				$data['idpt'] = $this->input->post('idpt');
				$data['idlomba'] = $_POST['idlomba'];
				
				$this->peserta_model->simpan($data);
				redirect('home');
			}
			
		}
		
		public function tentang(){
			$this->load->view('header');
			$this->load->view('tentang');
			$this->load->view('footer');
		}
		
		public function statistik(){
			$this->load->view('header');
			$x['data']=$this->Statistik->get_all();
		    $x['data2']=$this->Statistik->get_peserta();
		    $x['data3']=$this->Statistik->get_lomba();
		    $x['data4']=$this->Statistik->get_provinsi();
		    $x['data5']=$this->Statistik->get_pt();
		    $x['data6']=$this->Statistik->get_bayar();
		    $x['data7']=$this->Statistik->get_belumverifikasi();
		    $x['data8']=$this->Statistik->get_belumbayar();
		    $x['data9']=$this->Statistik->get_jmlhpeserta();
		    $x['data10']=$this->Statistik->get_jmlhtim();
		    $x['data11']=$this->Statistik->get_jmlhkarya();
			$this->load->view('statistik',$x);
			$this->load->view('footer');
		}
		
		public function statistik_webinar(){
			$this->load->view('header');
			$x['data']=$this->Statistik_webinar->get_all();
			$x['pt_webinar']=$this->Statistik_webinar->get_pt_webinar();
		    $x['peserta_webinar1']=$this->Statistik_webinar->get_peserta_webinar1();
		    $x['pt_webinar1']=$this->Statistik_webinar->get_pt_webinar1();
		    $x['peserta_webinar2']=$this->Statistik_webinar->get_peserta_webinar2();
		    $x['pt_webinar2']=$this->Statistik_webinar->get_pt_webinar2();
		    $x['pt_webinar12']=$this->Statistik_webinar->get_pt_webinar12();
		    $x['jmlh_peserta1']=$this->Statistik_webinar->get_jmlh_peserta1();
		    $x['jmlh_peserta2']=$this->Statistik_webinar->get_jmlh_peserta2();
		    $x['jmlh_peserta']=$this->Statistik_webinar->get_jmlh_peserta();
		    $x['jmlh_reqver']=$this->Statistik_webinar->get_jmlh_reqver();
			$this->load->view('statistik_webinar',$x);
			$this->load->view('footer');
		}
		
		public function finalis(){
			$this->load->view('header');
			$x['data']=$this->Finalis->get_all();
		    $x['bisnis']=$this->Finalis->get_bisnis();
			$x['poster']=$this->Finalis->get_poster();
			$x['aplikasi']=$this->Finalis->get_aplikasi();
			$x['uiux']=$this->Finalis->get_uiux();
			$x['video']=$this->Finalis->get_video();
			$this->load->view('finalis',$x);
			$this->load->view('footer');
		}
		
		public function poster(){
			$this->load->view('header');
			$x['poster']=$this->Poster->get_poster();
			$this->load->view('poster',$x);
			$this->load->view('footer');
		}
		
		public function info_juri(){
			$this->load->view('header');
			$this->load->view('info_juri');
			$this->load->view('footer');
		}
		
		public function info_lomba(){
			$this->load->view('header');
			$this->load->view('info_lomba');
			$this->load->view('footer');
		}
		
		public function info_webinar(){
		    $data['pt'] = $this->pt_model->get_dropdown();
		    $data['seminar'] = $this->M_seminar->get_seminar();
		    $data['seminarone'] = $this->M_seminar->get_seminar_one();
		    
			$this->load->view('header');
			$this->load->view('info_webinar2', $data);
			$this->load->view('footer');
		}
		
		public function pengumuman(){
			$this->load->view('header');
			$this->load->view('pengumuman');
			$this->load->view('footer');
		}
		
		public function jadwal(){
			$this->load->view('header');
			$this->load->view('jadwal');
			$this->load->view('footer');
		}
		
		public function juara(){
			$this->load->view('header');
			$this->load->view('juara');
			$this->load->view('footer');
		}
		
		
	}
