<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juri extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model','M_juri','M_penilaian']);	
		$LO = $this->M_penilaian->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE){
			if (!$LO) {
				redirect('login');
			}
		}
		$this->load->library('template');

	}

	public function index(){

		if ($this->session->userdata('role') == 3) {
			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$data['get_tahap']	= $this->M_juri->get_tahap();
			$data['total_tim']	= $this->M_juri->total_tim($user->id);
			$data['progress']	= $this->M_juri->progress($user->id, $bidang_juri->id);
			$data['daftar_bidang']	= $this->M_juri->daftar_bidang($user->id);

			$data['controller']	= $this;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;

			$this->template->view('lo/juri_dashboard',$data);
		}else{
			$data['total_juri']			= $this->M_juri->total_juri();
			$data['get_juri']			= $this->M_juri->get_juri();
			$data['get_lomba']			= $this->M_juri->get_lomba();

			$data['controller']	= $this;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_juri',$data);
		}
	}

	public function Penilaian($id_peserta = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['controller']	= $this;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap();

			if ($cek_bidang > 1) {
				$data['bidang_juri']= $bidang_juri;
				$this->template->view('lo/pilih_bidang',$data);
			}else{
				if ($id_lomba == null) {
					$id_lomba = $bidang_juri->id;
				}
				$data['lomba']		= $this->M_juri->bidang_lomjur($id_lomba);
				$data['daftar']		= $this->M_juri->daftar($id_lomba, $user->id);
				$data['peserta']	= $this->M_juri->peserta($id_peserta);
				$data['keterangan']	= $this->M_juri->keterangan($id_lomba);
				$data['tahap']		= $tahap;
				$data['kriteria']	= $this->M_juri->get_kriteria($tahap->id_tahap, $id_lomba);
				$this->template->view('lo/juri_penilaian',$data);
			}
		}else{
			redirect('Juri');
		}
	}

	function KirimNilai($id_tahap){

		$email  			= $this->session->userdata('username');
		$user 				= $this->M_juri->get_id($email);

		if ($this->M_juri->KirimNilai($id_tahap, $user->id) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil memasukkan nilai !!');
			header('location:' . base_url() . 'Juri/Penilaian');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat memasukkan nilai, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri/Penilaian');
		}
	}

	function tambah_juri(){

		if ($this->M_juri->tambah_juri() == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menambah data !!');
			header('location:' . base_url() . 'Juri');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menambah data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri');
		}
	}

	function atur_juri($id_user){

		if ($this->M_juri->atur_juri($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengatur juri ke bidang lomba !!');
			header('location:' . base_url() . 'Juri');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengatur juri, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri');
		}
	}

	function edit_juri($id_user){

		if ($this->M_juri->edit_juri($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah data !!');
			header('location:' . base_url() . 'Juri');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri');
		}
	}

	function pass_juri($id_user){

		if ($this->M_juri->pass_juri($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah PASSWORD Juri !!');
			header('location:' . base_url() . 'Juri');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat Juri, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri');
		}
	}

	function hapus_juri($id_user){

		if ($this->M_juri->hapus_juri($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menghapus data !!');
			header('location:' . base_url() . 'Juri');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri');
		}
	}

	function hapus_pilih(){
		$data = count($this->input->post('idk'));
		if ($data > 0) {
			if ($this->M_juri->hapus_pilih() == TRUE){
				$this->session->set_flashdata('notif', 'Berhasil menghapus '.$data.' data !!');
				header('location:' . base_url() . 'Juri');
			}else{	
				$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
				header('location:' . base_url() . 'Juri');
			}
		}else{
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, tidak ada data yang dipilih !!');
			header('location:' . base_url() . 'Juri');
		}
	}

}
