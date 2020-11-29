<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juri extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model','M_juri','M_penilaian', 'M_verifikasi']);	
		$LO = $this->M_penilaian->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE){
			if (!$LO) {
				redirect('login');
			}
		}
		
		$this->load->library('template');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));	

	}

	public function index(){
        $tahap = 3;
		if ($this->session->userdata('role') == 3) {
			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$data['get_tahap']	= $this->M_juri->get_tahap();
			$data['total_tim']	= $this->M_juri->total_tim($user->id);
			$data['progress']	= $this->M_juri->progress($user->id, $bidang_juri->id, $tahap);
			$data['daftar_bidang']	= $this->M_juri->daftar_bidang($user->id);

			$data['controller']	= $this;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;

			$this->template->view('lo/juri_dashboard',$data);
		}elseif($this->session->userdata('role') == 1){
			$data['total_juri']			= $this->M_juri->total_juri();
			$data['get_juri']			= $this->M_juri->get_juri();
			$data['get_lomba']			= $this->M_juri->get_lomba();

			$data['controller']	= $this;
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['lo']		  	= TRUE;

			$this->template->view('lo/l_juri',$data);
		}else{
			$this->session->set_flashdata('notif', 'WOPSSS !!');
			header('location:' . base_url() . 'Login');
		}
	}

	public function Penilaian($id_peserta = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap();

			if ($tahap == FALSE) {
				$this->session->set_flashdata('notif', 'Tahap PENILIAN, belum dimulai !!');
				header('location:' . base_url() . 'Juri');
			}else{
				if ($cek_bidang > 1) {
					$data['bidang_juri']= $bidang_juri;
					$this->template->view('lo/pilih_bidang',$data);
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_juri->id;
					}
					if($id_lomba == 1 || $id_lomba == 5){
            			$this->session->set_flashdata('notif', 'Tahap penilaian bidang lomba anda telah selesai');
            			header('location:' . base_url() . 'Juri');
					}else{
					$data['lomba']		= $this->M_juri->bidang_lomjur($id_lomba);
					$data['daftar']		= $this->M_juri->daftar($id_lomba, $user->id);
					$data['peserta']	= $this->M_juri->peserta($id_peserta);
					$data['keterangan']	= $this->M_juri->keterangan($id_lomba);
					$data['tahap']		= $tahap;
					$data['kriteria']	= $this->M_juri->get_kriteria($tahap->id_tahap, $id_lomba);
					$this->template->view('lo/juri_penilaian',$data);
					}
				}
			}
		}else{
			redirect('Juri');
		}
	}

	public function DaftarNilai2($id_tahap = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap_r();

				if ($cek_bidang > 1) {
				$this->session->set_flashdata('notif', 'Something wrong... !!');
				header('location:' . base_url() . 'Juri');
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_juri->id;
					}
					$data['peserta']	= $this->M_juri->peserta_nilai($id_tahap, $user->id);
					$data['controller']	= $this;
					$data['id_lomba']   = $id_lomba;
					$data['id_tahap']   = $id_tahap;
					$data['tahap']		= $tahap;
					$this->template->view('lo/juri_daftarnilai',$data);
				}
		}elseif($this->session->userdata('role') == 2){
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$data['get_juri']			= $this->M_juri->get_jurinil($id_lomba);
			$tahap				= $this->M_juri->get_tahap_r();
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_a($id_lomba);
					$data['controller']	= $this;
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_LoNilai',$data);
		}else{
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$tahap				= $this->M_juri->get_tahap_r();
			$data['get_juri']			= $this->M_juri->get_jurinil($id_lomba);
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_a($id_lomba);
					$data['controller']	= $this;
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_daftarnilaijuri',$data);
				
		}
	}

	public function RekapNilai($id_tahap = null, $id_lomba = null){

		if($this->session->userdata('role') == 2){
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$tahap				= $this->M_juri->get_tahap_r();
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_rekap($id_lomba);
					$data['controller']	= $this;
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_LoRekap',$data);
		}else{
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$tahap				= $this->M_juri->get_tahap_r();
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_rekap($id_lomba);
					$data['controller']	= $this;
					$data['stts_thp']   = $this->M_juri->stts_thp($id_tahap);
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_rekapnilaiadmin',$data);
				
		}
	}

	function TahapAkhir(){
		$jml = 0;
		$idl = $this->input->post('id_lomba');
		$thp = $this->input->post('id_tahap');
		$jml = $this->input->post('jml_finalis');
		if ($this->M_juri->TahapAkhir($jml, $idl, $thp) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil memilih '.$jml.' peserta !!');
			header('location:' . base_url() . 'Juri/RekapNilai/'.$thp);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat memilih '.$jml.', coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri/RekapNilai/'.$thp);
		}
	}

    public function HasilPenilaian($id_tahap = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap_r();

				if ($cek_bidang > 1) {
				$this->session->set_flashdata('notif', 'Something wrong... !!');
				header('location:' . base_url() . 'Juri');
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_juri->id;
					}
					$data['peserta']	= $this->M_juri->peserta_nilai($id_tahap, $user->id);
					$data['controller']	= $this;
					$data['id_lomba']   = $id_lomba;
					$data['id_tahap']   = $id_tahap;
					$data['tahap']		= $tahap;
					$this->template->view('lo/juri_daftarnilai_diskusi',$data);
				}
		}
    }

	public function DaftarNilai($id_tahap = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap_r();

				if ($cek_bidang > 1) {
				$this->session->set_flashdata('notif', 'Something wrong... !!');
				header('location:' . base_url() . 'Juri');
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_juri->id;
					}
					$data['peserta']	= $this->M_juri->peserta_nilai($id_tahap, $user->id);
					$data['controller']	= $this;
					$data['id_lomba']   = $id_lomba;
					$data['id_tahap']   = $id_tahap;
					$data['tahap']		= $tahap;
					$this->template->view('lo/juri_daftarnilai',$data);
				}
		}elseif($this->session->userdata('role') == 2){
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(2);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$data['get_juri']			= $this->M_juri->get_jurinil($id_lomba);
			$tahap				= $this->M_juri->get_tahap_r();
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_a($id_tahap, $id_lomba);
					$data['controller']	= $this;
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_LoNilai',$data);
		}else{
            
            $data['get_lomba']          = $this->M_penilaian->get_lomba();
            
            if($this->input->post('id_lomba')){
                $id_lomba  = $this->input->post('id_lomba');
            }
            
			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(0);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$tahap				= $this->M_juri->get_tahap_r();
			$data['get_juri']			= $this->M_juri->get_jurinil($id_lomba);
            $data['namalomba']	= $this->M_verifikasi->get_lomba_loo($id_lomba);
					$data['peserta']	= $this->M_juri->peserta_nilai_a($id_tahap, $id_lomba);
					$data['controller']	= $this;
					$data['id_tahap']   = $id_tahap;
					$data['id_lomba']   = $id_lomba;
					$data['tahap']		= $tahap;
					$this->template->view('lo/l_daftarnilaijuri',$data);
				
		}
	}

	public function EditNilai($id_peserta = null, $id_tahap = null, $id_penilaian = null, $id_lomba = null){

		if ($this->session->userdata('role') == 3) {

			$email  			= $this->session->userdata('username');

			$user 				= $this->M_juri->get_id($email);

			$cek_bidang 		= $this->M_juri->cek_bidang($user->id);

			$data['username'] 	= $this->session->userdata('nama');
			$data['menu']     	= $this->menu_model->getByRole(3);
			$data['nama'] 	  	= $this->session->userdata('nama');
			$data['juri']		= TRUE;
			$bidang_juri  		= $this->M_juri->bidang_juri($user->id);
			$tahap				= $this->M_juri->get_tahap();

			if ($tahap == FALSE) {
				$this->session->set_flashdata('notif', 'Tahap PENILIAN, belum dimulai !!');
				header('location:' . base_url() . 'Juri');
			}else{
				if ($cek_bidang > 1) {
					$data['bidang_juri']= $bidang_juri;
					$this->template->view('lo/pilih_bidang',$data);
				}else{
					if ($id_lomba == null) {
						$id_lomba = $bidang_juri->id;
					}
					$data['lomba']		= $this->M_juri->bidang_lomjur($id_lomba);
					$data['daftar']		= $this->M_juri->daftar($id_lomba, $user->id);
					$data['id_tahap']   = $id_tahap;
					$data['peserta']	= $this->M_juri->peserta($id_peserta);
					$data['keterangan']	= $this->M_juri->keterangan($id_lomba);
					$data['id_penilaian']= $id_penilaian;
					$data['tahap']		= $tahap;
					$data['kriteria_edit']	= $this->M_juri->get_kriteria_edit($tahap->id_tahap, $id_lomba, $id_penilaian);
					$this->template->view('lo/juri_lihatnilai',$data);
				}
			}
		}else{
			redirect('Juri');
		}
	}

	function ResetNilai($id_tahap, $id_lomba, $id_penilaian){
		if ($this->M_juri->ResetNilai($id_penilaian) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mereset nilai !!');
			header('location:' . base_url() . 'Juri/DaftarNilai/'.$id_tahap."/".$id_lomba);
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi mereset saat memasukkan nilai, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri/DaftarNilai/'.$id_tahap."/".$id_lomba);
		}
	}

// 	function KirimNilai($id_tahap){

// 		$email  			= $this->session->userdata('username');
// 		$user 				= $this->M_juri->get_id($email);

// 		if ($this->M_juri->KirimNilai($id_tahap, $user->id) == TRUE){
// 			$this->session->set_flashdata('notif', 'Berhasil memasukkan nilai !!');
// 			header('location:' . base_url() . 'Juri/Penilaian');
// 		}else{	
// 			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat memasukkan nilai, coba lagi beberapa saat nanti !!');
// 			header('location:' . base_url() . 'Juri/Penilaian');
// 		}
// 	}

	function KirimNilai($id_tahap){

		$email  			= $this->session->userdata('username');
		$user 				= $this->M_juri->get_id($email);


		if($this->input->post('id_kriteria')){


			$final	= 0;

			$id_kriteria 	= $this->input->post('id_kriteria', true);
			$bobot 			= $this->input->post('bobot', true);
			$nilai 			= $this->input->post('nilai', true);

			$id 	= time().$user->id.$id_tahap.rand(0,100)+1;

			foreach ($id_kriteria as $i => $a) {

				$data = array(
					'id_penilaian'  => $id,
					'id_kriteria'  	=> isset($id_kriteria[$i]) ? $id_kriteria[$i] : '',
					'nilai'  		=> $bobot[$i]*$nilai[$i]/100,
					'nilai_murni'  	=> $nilai[$i]
				);
				$final = $final+($bobot[$i]*$nilai[$i]/100);
				$this->db->insert('l_detailnilai',$data);
			}
		}

		if ($this->M_juri->KirimNilai($id_tahap, $user->id, $id, $final) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil memasukkan nilai !!');
			header('location:' . base_url() . 'Juri/Penilaian');
		}else{	
			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat memasukkan nilai, coba lagi beberapa saat nanti !!');
			header('location:' . base_url() . 'Juri/Penilaian');
		}
	}

	function UpdateNilai($id_tahap){

		$email  			= $this->session->userdata('username');
		$user 				= $this->M_juri->get_id($email);

		if ($this->M_juri->UpdateNilai($id_tahap, $user->id) == TRUE){
			$this->session->set_flashdata('notif', 'Berhasil mengubah nilai !!');
			header('location:' . base_url() . 'Juri/DaftarNilai');
		}else{	
			$this->session->set_flashdata('notif', 'Nilai yang dimasukkan sama, data tidak mengalami perubahan !!');
			header('location:' . base_url() . 'Juri/DaftarNilai');
		}
	}

	function import_data(){
$this->M_juri->import_data();
// 		if ( == TRUE){
// 			$this->session->set_flashdata('notif', 'Berhasil mengimpor data !!');
// 			header('location:' . base_url() . 'Juri');
// 		}else{	
// 			$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengimpor data, coba lagi beberapa saat nanti !!');
// 			header('location:' . base_url() . 'Juri');
// 		}
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
