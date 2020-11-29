<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model', 'M_penilaian','M_verifikasi', 'M_juri']);	
		$LO = $this->M_verifikasi->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE){
			if (!$LO) {
				redirect('login');
			}
		}
		$this->load->library('template');

	}

	public function index(){
		$data['get_lomba']	= $this->M_verifikasi->get_lomba();
		$data['controller']	= $this;
		$data['total_tim_rec']	= $this->M_verifikasi->total_tim_rec();
		$data['total_tim_ver']	= $this->M_verifikasi->total_tim_ver();
		$data['total_tim_siap']	= $this->M_verifikasi->total_tim_siap();
		$data['total_tim']	= $this->M_verifikasi->total_tim();
		$data['total_lo']	= $this->M_verifikasi->total_lo();
		$data['get_lo']		= $this->M_verifikasi->get_lo();

		if ($this->session->userdata('role') == 2) {

			redirect('Verifikasi/LoDashboard');
		}else{

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_verifikasi',$data);
		}
	}

	public function Penilaian($id_peserta = null, $id_lomba = null){

		if ($this->session->userdata('role') == 2) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_lo  		= $this->M_juri->bidang_lo($user->id);
			$tahap				= $this->M_juri->get_tahap();

			if ($tahap == FALSE) {
				$this->session->set_flashdata('notif', 'Tahap PENILIAN, belum dimulai !!');
				header('location:' . base_url() . 'Verifikasi');
			}else{
				if ($cek_bidang > 1) {
					$data['bidang_juri']= $bidang_juri;
					$this->template->view('lo/pilih_bidang',$data);
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_lo->id;
					}
					$data['lomba']		= $this->M_juri->bidang_lomlo($id_lomba);
					$data['daftar']		= $this->M_juri->daftar_lo($id_lomba, $user->id);
					$data['peserta']	= $this->M_juri->peserta($id_peserta);
					$data['keterangan']	= $this->M_juri->keterangan($id_lomba);
					$data['tahap']		= $tahap;
					$data['kriteria']	= $this->M_juri->get_kriteria($tahap->id_tahap, $id_lomba);
					$this->template->view('lo/l_LoCekPenilaian',$data);
				}
			}
		}else{
			redirect('Juri');
		}
	}

	public function LoDashboard(){

		if ($this->session->userdata('role') == 2) {
		$data['controller']	= $this;

			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$lo_lomba 			= $this->M_verifikasi->lo_lomba($user->id);

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($lo_lomba->id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($lo_lomba->id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba->id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($lo_lomba->id_lomba);
			$data['peserta']	= $this->M_verifikasi->peserta_all($lo_lomba->id_lomba);

			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($lo_lomba->id_lomba);
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;
			$data['juri']		= TRUE;

			$this->template->view('lo/l_LoDashboard',$data);
		}else{

			redirect('login/logout');
		}
	}

	public function DaftarPeserta($id_lomba = null){

		$data['controller']	= $this;

		if ($this->session->userdata('role') == 2) {

			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$lo_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
            
            if($this->input->post('status')){
                $status = $this->input->post('status');
            }else{
                $status = 0;
            }
            
			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($lo_lomba->id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($lo_lomba->id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba->id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($lo_lomba->id_lomba);
			$data['peserta']	= $this->M_verifikasi->peserta_all_daftar($lo_lomba->id_lomba, $status);

			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($lo_lomba->id_lomba);
            
            $data['status']     = $status;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;
			$data['juri']		= TRUE;

			$this->template->view('lo/l_LoPeserta',$data);
		}else{
			$data['get_lomba']	= $this->M_verifikasi->get_lomba();

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($id_lomba);
			$data['peserta']	= $this->M_verifikasi->peserta_all($id_lomba);
			$data['namalomba']	= $this->M_verifikasi->namalomba($id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_daftarpeserta',$data);
		}
	}

	public function BerkasPeserta($id_lomba = null){

		$data['controller']	= $this;

		if ($this->session->userdata('role') == 2) {

			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$lo_lomba 			= $this->M_verifikasi->lo_lomba($user->id);

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($lo_lomba->id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($lo_lomba->id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba->id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($lo_lomba->id_lomba);
			$data['peserta']	= $this->M_verifikasi->Bpeserta($lo_lomba->id_lomba);

			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($lo_lomba->id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;
			$data['juri']		= TRUE;

			$this->template->view('lo/l_LoVerifikasi',$data);
		}else{
			$data['get_lomba']	= $this->M_verifikasi->get_lomba();

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($id_lomba);
			$data['peserta']	= $this->M_verifikasi->Bpeserta($id_lomba);
			$data['namalomba']	= $this->M_verifikasi->namalomba($id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_berkas',$data);
		}
	}

	public function DataVerifikasi($id_lomba = null){

		$data['controller']	= $this;

		if ($this->session->userdata('role') == 2) {

			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$lo_lomba 			= $this->M_verifikasi->lo_lomba($user->id);

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($lo_lomba->id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($lo_lomba->id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba->id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($lo_lomba->id_lomba);
			$data['peserta']	= $this->M_verifikasi->Vpeserta($lo_lomba->id_lomba);

			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($lo_lomba->id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;
			$data['juri']		= TRUE;

			$this->template->view('lo/l_LoRiwayat',$data);
		}else{
			$data['get_lomba']	= $this->M_verifikasi->get_lomba();

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($id_lomba);
			$data['peserta']	= $this->M_verifikasi->Vpeserta($id_lomba);
			$data['namalomba']	= $this->M_verifikasi->namalomba($id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_riwayatberkas',$data);
		}
	}

	public function DataReject($id_lomba = null){

		$data['controller']	= $this;

		if ($this->session->userdata('role') == 2) {

			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$lo_lomba 			= $this->M_verifikasi->lo_lomba($user->id);

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($lo_lomba->id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($lo_lomba->id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($lo_lomba->id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($lo_lomba->id_lomba);
			$data['peserta']	= $this->M_verifikasi->Rpeserta($lo_lomba->id_lomba);

			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($lo_lomba->id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;
			$data['juri']		= TRUE;

			$this->template->view('lo/l_LoReject',$data);
		}else{
			$data['get_lomba']	= $this->M_verifikasi->get_lomba();

			$data['total_tim_rec']	= $this->M_verifikasi->Btotal_tim_rec($id_lomba);
			$data['total_tim_ver']	= $this->M_verifikasi->Btotal_tim_ver($id_lomba);
			$data['total_tim_all']	= $this->M_verifikasi->Btotal_tim_all($id_lomba);
			$data['total_tim']	= $this->M_verifikasi->Btotal_tim($id_lomba);
			$data['peserta']	= $this->M_verifikasi->Rpeserta($id_lomba);
			$data['namalomba']	= $this->M_verifikasi->namalomba($id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_rejectberkas',$data);
		}
	}

	function VerifikasiPeserta($id_peserta, $id_lomba){

		if ($this->M_verifikasi->VerifikasiPeserta($id_peserta) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil Verifikasi BERKAS PESERTA !!');
			header('location:' . base_url() . 'Verifikasi/BerkasPeserta/'.$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat Verifikasi BERKAS Peserta, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi/BerkasPeserta/'.$id_lomba);
		}
	}

	function ResetPeserta($id_peserta, $id_lomba){

		if ($this->M_verifikasi->ResetPeserta($id_peserta) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil MERESET STATUS VERIFIKASI PESERTA !!');
			header('location:' . base_url() . 'Verifikasi/DataVerifikasi/'.$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat MERESET STATUS VERIFIKASI Peserta, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi/DataVerifikasi/'.$id_lomba);
		}
	}

	function ResetPesertaR($id_peserta, $id_lomba){

		if ($this->M_verifikasi->ResetPeserta($id_peserta) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil MERESET STATUS VERIFIKASI PESERTA !!');
			header('location:' . base_url() . 'Verifikasi/DataReject/'.$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat MERESET STATUS VERIFIKASI Peserta, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi/DataReject/'.$id_lomba);
		}
	}

	function RejectPeserta($id_peserta, $id_lomba){

		if ($this->M_verifikasi->RejectPeserta($id_peserta) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil MEREJECT BERKAS PESERTA !!');
			header('location:' . base_url() . 'Verifikasi/BerkasPeserta/'.$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat MEREJECT BERKAS Peserta, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi/BerkasPeserta/'.$id_lomba);
		}
	}

	function tambah_lo(){

		if ($this->M_verifikasi->tambah_lo() == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menambah data !!');
			header('location:' . base_url() . 'Verifikasi');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menambah data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

	function atur_lo($id_user){

		if ($this->M_verifikasi->atur_lo($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengatur lo ke bidang lomba !!');
			header('location:' . base_url() . 'Verifikasi');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengatur lo, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

	function edit_lo($id_user){

		if ($this->M_verifikasi->edit_lo($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah data !!');
			header('location:' . base_url() . 'Verifikasi');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

	function pass_lo($id_user){

		if ($this->M_verifikasi->pass_lo($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah PASSWORD Verifikasi !!');
			header('location:' . base_url() . 'Verifikasi');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat Verifikasi, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

	function hapus_lo($id_user){

		if ($this->M_verifikasi->hapus_lo($id_user) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil menghapus data !!');
			header('location:' . base_url() . 'Verifikasi');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

	function hapus_pilih(){
		$data = count($this->input->post('idk'));
		if ($data > 0) {
			if ($this->M_verifikasi->hapus_pilih() == TRUE){
				$this->session->set_flashdata('notif', 'Berhasil menghapus '.$data.' data !!');
				header('location:' . base_url() . 'Verifikasi');
			}else{	
				$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, coba lagi beberapa saat nanti !!');
				header('location:' . base_url() . 'Verifikasi');
			}
		}else{
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat menghapus data, tidak ada data yang dipilih !!');
			header('location:' . base_url() . 'Verifikasi');
		}
	}

}
