<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model','M_penilaian', 'M_juri', 'M_verifikasi']);	
		$LO = $this->M_penilaian->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE){
			if (!$LO) {
				redirect('login');
			}
		}
		$this->load->library('template');

	}

	public function index(){
		$data['total_tim_all']      = $this->M_penilaian->total_tim_all();
		$data['total_tim']			= $this->M_penilaian->total_tim();
		$data['total_juri']			= $this->M_juri->total_juri();
		$data['cek_tahap']			= $this->M_penilaian->cek_tahap();
		$data['cek_siap']			= $this->M_penilaian->cek_siap();
		$data['get_stage']			= $this->M_penilaian->get_stage();
		$data['tahap_penilaian']	= $this->M_penilaian->get_tahap();

		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(0);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['lo']		  	= TRUE;

		$this->template->view('lo/l_penilaian',$data);
	}

	public function DetailStatistik(){
		$data['statistik']              = $this->M_penilaian->statistik();
		$data['tim_semua']              = $this->M_penilaian->tim_semua();
		$data['total_pt']               = $this->M_penilaian->total_pt();
		$data['total_juri']			    = $this->M_juri->total_juri();
		$data['total_lo']               = $this->M_verifikasi->total_lo();

		if ($this->session->userdata('role') == 2) {
		$data['menu']     	= $this->menu_model->getByRole(2);
		
		$data['lo']		  	= TRUE;
		$data['juri']		= TRUE;
		}else{
		$data['menu']     	= $this->menu_model->getByRole(0);
		}
		$data['username'] 	= $this->session->userdata('nama');
		$data['nama'] 	  	= $this->session->userdata('nama');
		
		$this->template->view('lo/l_statistik',$data);
	}

	public function Tahap(){
		$data['cek_tahap']			= $this->M_penilaian->cek_tahap();
		$data['cek_siap']			= $this->M_penilaian->cek_siap();
		$data['tahap_penilaian']	= $this->M_penilaian->get_tahap();
		$data['get_lomba']			= $this->M_penilaian->get_lomba();
		
		$data['username'] = $this->session->userdata('nama');
		$data['menu']     = $this->menu_model->getByRole(0);
		$data['nama'] 	  = $this->session->userdata('nama');
		$data['lo']		  = TRUE;
		//print_r($peserta);
		$this->template->view('lo/l_tahap',$data);
		// $this->load->view('l_penilaian', $data);
	}

	public function Kriteria(){
		$data['cek_tahap']			= $this->M_penilaian->cek_tahap();
		$data['cek_siap']			= $this->M_penilaian->cek_siap();
		$data['get_stage']			= $this->M_penilaian->get_stage();
		$data['tahap_penilaian']	= $this->M_penilaian->get_tahap();
		$data['get_lomba']			= $this->M_penilaian->get_lomba();
		
		$data['username'] = $this->session->userdata('nama');
		$data['menu']     = $this->menu_model->getByRole(0);
		$data['nama'] 	  = $this->session->userdata('nama');
		$data['lo']		  = TRUE;
		//print_r($peserta);
		$this->template->view('lo/l_kriteria',$data);
		// $this->load->view('l_penilaian', $data);
	}

	public function DataKriteria($id_tahap, $id_lomba){
		$data['get_kriteria']	= $this->M_penilaian->get_kriteria($id_tahap, $id_lomba);
		$data['get_curlomba'] 	= $this->M_penilaian->get_curlomba($id_lomba);
		// $data['get_kriteria'] 	= $this->M_penilaian->get_kriteria();

		$data['id_tahap']	= $id_tahap;
		$data['id_lomba']	= $id_lomba;

		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(0);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['lo']		  	= TRUE;
		//print_r($peserta);
		$this->template->view('lo/l_setkategori',$data);
		// $this->load->view('l_penilaian', $data);
	}

	public function updatekriteria(){
     // POST values
		$id 	= $this->input->post('id');
		$field 	= $this->input->post('field');
		$value 	= $this->input->post('value');

     // Update records
		$this->M_penilaian->updateUser($id, $field, $value);
		echo 1;
		exit;
	}

	public function deletekriteria(){
     // POST values
		$id 	= $this->input->post('id');

     // Update records
		$this->M_penilaian->deletekriteria($id);
		echo 1;
		exit;
	}

	function proses_make($id_tahap, $id_lomba){

		$data = count($this->input->post('kriteria'));
		if ($this->M_penilaian->push_kriteria($id_tahap, $id_lomba) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menambahkan '.$data.' data !!');
			header('location:' . base_url() . 'Penilaian/DataKriteria/'.$id_tahap.'/'.$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menambahkan data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Penilaian/DataKriteria/'.$id_tahap.'/'.$id_lomba);
		}
	}

	function tambah_tahap(){

		if ($this->M_penilaian->tambah_tahap() == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menambahkan data !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menambahkan data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}
	}

	function update_tahap($id_tahap){

		if ($this->M_penilaian->update_tahap($id_tahap) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menambahkan data !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menambahkan data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}
	}

	function tunda_tahap($id_tahap){

		if ($this->M_penilaian->tunda_tahap($id_tahap) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah data !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}
	}

	function hapus_tahap($id_tahap){

		if ($this->M_penilaian->hapus_tahap($id_tahap) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menghapus data !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Penilaian/Tahap');
		}
	}

	function hapus_kriteria_pilih($id_tahap, $id_lomba){
		$data = count($this->input->post('idk'));
		if ($data > 0) {
			if ($this->M_penilaian->hapus_kriteria_pilih($id_tahap, $id_lomba) == TRUE){
				$this->session->set_flashdata('notif', 'Berhasil menghapus '.$data.' data !!');
				header('location:' . base_url() . 'Penilaian/DataKriteria/'.$id_tahap.'/'.$id_lomba);
			}else{	
				$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
				header('location:' . base_url() . 'Penilaian/DataKriteria/'.$id_tahap.'/'.$id_lomba);
			}
		}else{
				$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, tidak ada data yang dipilih !!');
				header('location:' . base_url() . 'Penilaian/DataKriteria/'.$id_tahap.'/'.$id_lomba);
		}
	}

}
