<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lo_final extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model','M_lo', 'M_verifikasi', 'M_penilaian', 'M_juri']);	
		$LO = $this->M_lo->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE AND !$this->session->userdata('role') == 2 || !$this->session->userdata('role') == 1){
			if (!$LO) {
				redirect('login');
			}
		}
		$this->load->library('template');

	}

	public function index(){
		$data['nourut']     = $this->session->userdata('nourut');
		$email  			= $this->session->userdata('username');
		$user 				= $this->M_verifikasi->get_id($email);
		$id_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
		$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);

		$data['tim_final']  = $this->M_lo->jml_tim_final($id_lomba->id_lomba);
		$data['jml_juri']   = $this->M_lo->jml_juri($id_lomba->id_lomba);
		
		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(2);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['juri']		= TRUE;
		$data['id_lomba']	= $id_lomba->id_lomba;
		$this->template->view('lo/l_LoFinalDashboard',$data);
	}

	public function VerifikasiWebinar(){
		if($this->input->post('status')){
		    $status = $this->input->post('status');
		}else{
		    $status = null;
		}
		
		$data['get_webinar']	= $this->M_lo->get_webinar($status);
		
		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(0);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['juri']		= TRUE;
		$data['controller']	= $this;
		$data['status']     = $status;
		$this->template->view('lo/l_verifwebinar',$data);
	}

	public function DaftarPeserta(){
		$email  			= $this->session->userdata('username');
		$user 				= $this->M_verifikasi->get_id($email);
		$id_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
		$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);

		$data['peserta']	= $this->M_lo->peserta($id_lomba->id_lomba);
		
		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(2);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['juri']		= TRUE;
		$data['controller']	= $this;
		$data['id_lomba']	= $id_lomba->id_lomba;
		$this->template->view('lo/l_LoFinalDaftarPeserta',$data);
	}

	public function Kriteria(){
		$email  			= $this->session->userdata('username');
		$user 				= $this->M_verifikasi->get_id($email);
		$id_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
		$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);

		$data['kriteria']	= $this->M_lo->kriteria($id_lomba->id_lomba);
		
		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(2);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['juri']		= TRUE;
		$data['controller']	= $this;
		$data['id_lomba']	= $id_lomba->id_lomba;
		$this->template->view('lo/l_LoFinalKriteria',$data);
	}
	
	public function IGMENANG(){
		$id_lomba = 2;
		$instagram = $this->M_lo->instagram_mining($id_lomba);
		foreach ($instagram as $key) { 
			if (strpos($key->teaser, "instagram")) {
				$first = explode("?", $key->teaser);
				if(@file_get_contents($first[0]."?__a=1")){
					$response = file_get_contents($first[0]."?__a=1");
					if ($response !== false) {
						$data = json_decode($response, true);
						if ($data !== null) {
							$like       = $data['graphql']['shortcode_media']['edge_media_preview_like']['count'];
							$comment    = $data['graphql']['shortcode_media']['edge_media_to_parent_comment']['count'];

							$data = array(
								'id_peserta' 	=> $key->id, 
								'id_lomba'	 	=> $id_lomba,
								'teaser'	 	=> $key->teaser,
								'likes' 		=> $like,
								'comments'   	=> $comment 
							);

							$this->db->insert('l_IG', $data);
						}
					}
				 }
			}
		}
	}

	public function IgWinner(){
		if($this->session->userdata('role') == 1 ){
			$data['namalomba']	= "ALL LOMBA";

			$data['instagram']	= $this->M_lo->instagram_admin();

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$data['controller']	= $this;
			$this->template->view('lo/l_LoFinalWinnerIg',$data);
		}else{
			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$id_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);

			$data['instagram']	= $this->M_lo->instagram($id_lomba->id_lomba);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$data['controller']	= $this;
			$data['id_lomba']	= $id_lomba->id_lomba;
			$this->template->view('lo/l_LoFinalWinnerIg',$data);
		}
	}

	public function DaftarNilai($id_tahap = 3){
		if($this->session->userdata('role') == 2){
			$email  			= $this->session->userdata('username');
			$user 				= $this->M_verifikasi->get_id($email);
			$id_lomba 			= $this->M_verifikasi->lo_lomba($user->id);
			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);

			$data['get_juri']	= $this->M_juri->get_jurinil($id_lomba->id_lomba);
			$tahap				= $this->M_juri->get_tahap_r();
			$data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba->id_lomba);
			$data['peserta']	= $this->M_lo->peserta_nilai_a($id_lomba->id_lomba, $id_tahap);

			$data['id_tahap']   = $id_tahap;
			$data['tahap']		= $tahap;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$data['controller']	= $this;
			$data['id_lomba']	= $id_lomba->id_lomba;
			$this->template->view('lo/l_LoFinalDaftarNilai',$data);
		}
	}
	
	public function HasilPenilaian(){


		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(2);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['juri']		  	= TRUE;
		$this->template->view('lo/l_LoHasilPenilaian',$data);
	}

	function pushnourut($id_lomba){
		$this->session->set_userdata('nourut') == TRUE;
		if ($this->M_lo->pushnourut($id_lomba) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengatur no URUT !!');
			header('location:' . base_url() . 'Lo_final/DaftarPeserta');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat  no URUT, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Lo_final/DaftarPeserta');
		}
	}

	function terima($stats, $id_pendaftaran){
		if ($this->M_lo->terima($stats, $id_pendaftaran) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah status !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah status, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}
	}

	function gkjelas($stats, $id_pendaftaran){
		if ($this->M_lo->gkjelas($stats, $id_pendaftaran) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah status !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah status, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}
	}

	function tolak($stats, $id_pendaftaran){
		if ($this->M_lo->tolak($stats, $id_pendaftaran) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah status !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengubah status, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Lo_final/VerifikasiWebinar');
		}
	}





}
