<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeminarH extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['M_seminar']);	
	}

	public function DaftarSeminar(){

		$email  	= $this->input->post('email');
		$nama 		= $this->input->post('nama');
		$webinar 	= $this->input->post('kodeseminar');
		$pts 	    = $this->input->post('pts');
		$ptn 	    = $this->input->post('ptn');
		
		if(empty($ptn) AND empty($pts)){
			$this->session->set_flashdata('notif', 'HARAP MEMILIH ASAL PERGURUAN TINGGI, <b>PTN</b> atau <b>PTS</b>!!');
			header('location:' . base_url());
		    
		}else{
		    if ($webinar == "0") {
    			$this->session->set_flashdata('notif', 'Harap pilih WEBINAR!!');
    			header('location:' . base_url());
    		}else{
    			$binar = explode(",", $webinar);
    
    			if ($this->M_seminar->cek_email($email, $binar[0]) == TRUE) {
    				
    				$fetchfile = $_FILES['bk_bayar']['name'];
    				$ext = pathinfo($fetchfile, PATHINFO_EXTENSION);
    				
    				$this->load->library('upload');
    				$dir			= "berkas/BuktiBayarSeminar";
    				if (!is_dir($dir)){
    					mkdir($dir, 0777, true);
    				}
    
    				    $dir_exist = true; // flag for checking the directory exist or not
    				    if (!is_dir($dir)){
    				    	mkdir($dir, 0777, true);
    				        $dir_exist = false; // dir not exist
    				    }
    				    $file 						= $binar[0]."-".date("His")."-".date("dm")."_".preg_replace('/\s+/', '', $nama)."_".preg_replace('/\s+/', '_', $fetchfile);
    
    					$config['upload_path'] 		= $dir; //path folder
    					$config['allowed_types'] 	= 'png|jpg|jpeg'; //type yang dapat diakses bisa anda sesuaikan
    					$config['max_size'] 		= '2048'; //maksimum besar file 2M
    					$config['file_name'] 		= $file;
    					$this->upload->initialize($config);
    
    					if ($this->upload->do_upload('bk_bayar')){
    			            $wb = explode(",", $webinar);
    						if ($this->M_seminar->DaftarSeminar($email, $nama, $wb[0], $dir."/".$file) == TRUE){
    
    							$subject = 'Pendaftaran WEBINAR '.end($binar);
    							$message = '
    							<p><strong>Selamat!</strong> Anda sudah berhasil melakukan pendaftaran untuk mengikuti WEBINAR -'.end($binar).'. </p>
    
    							<p>Selanjutnya Anda akan mendapatkan email berupa info lebih lanjut tentang seminar ini.
    
    							<p>Jika ada hal yang perlu ditanyakan lebih lanjut, silakan hubungi narahubung berikut:</p>
    							<ul>
    							<li>Nana (087888895535)</li>
    							<li>Hendra (081350204469)</li>
    							<li>Azizah (085645548497)</li>
    							<li>Diyah (085755241098)</li>
    							</ul>
    
    							<p>Terima kasih. Selamat mengikuti WEBINAR SERIES '.end($binar).'. Semoga sukses.</p>
    
    							Salam,<br>
    							Panitia LO KREATIF 2020<br>
    							www.aptisi7jatim.org';
    
    							$this->_sendEmail($email, $subject, $message);
    
    							$this->session->set_flashdata('success', 'Berhasil mengirim data pendaftaran, Anda akan menerima email beberapa saat lagi !!');
    							header('location:' . base_url());
    						}else{	
    							$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengirim data pendaftaran, coba lagi beberapa saat nanti, atau hubungi Contact Person Kami !!');
    							header('location:' . base_url());
    						}
    					}else{
    			            $wb = explode(",", $webinar);
    						if ($this->M_seminar->DaftarSeminar($email, $nama, $wb[0], "Non-Sertifikat") == TRUE){
    
    							$subject = 'Pendaftaran WEBINAR '.end($binar);
    							$message = '
    							<p><strong>Selamat!</strong> Anda sudah berhasil melakukan pendaftaran <b>Non-Sertifikat</b> untuk mengikuti WEBINAR -'.end($binar).'. </p>
    
    							<p>Anda dapat melihat webinar ini melalui akun Youtube: LO Kreatif 2020</p>
    
    							<p>Terima kasih. Selamat mengikuti WEBINAR SERIES '.end($binar).'. Semoga sukses.</p>
    
    							Salam,<br>
    							Panitia LO KREATIF 2020<br>
    							www.aptisi7jatim.org';
    
    							$this->_sendEmail($email, $subject, $message);
    
    							$this->session->set_flashdata('success', 'Berhasil mengirim data pendaftaran - Sebagai peserta <b>NON-SERTIFIKAT</b>, Anda akan menerima email beberapa saat lagi !!');
    							header('location:' . base_url());
    						}else{	
    							$this->session->set_flashdata('notif', 'Terjadi kesalahan saat mengirim data pendaftaran, coba lagi beberapa saat nanti, atau hubungi Contact Person Kami !!');
    							header('location:' . base_url());
    						}
    					}
    
    				}else{
    					$this->session->set_flashdata('notif', 'Data pendaftaran atas nama email:'.$email.' telah terdaftar, harap gunakan email lain !!');
    					header('location:' . base_url());
    				}
    			}
		}

		
		}

		private function _sendEmail($to, $subject, $message = ''){
			//type: 1 : registration
			//      2 : forgot password
			$config = [
				'protocol' 	=> 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_user' => 'lokreatif7@gmail.com',
				'smtp_pass' => 'paksugeng',
				'smtp_port' => '465',
				'mailtype' 	=> 'html',
				'charset' 	=> 'utf-8',
				'newline' 	=> "\r\n"
			];
			$this->load->library('email',$config);
			$this->email->from('noreplay-lokreatif@gmail.com','Panitia LO KREATIF 2020');
			$this->email->to($to);
			
			$this->email->subject($subject);
			$this->email->message($message);	 
			if($this->email->send()){
				return true;
			} else {
				echo $this->email->print_debugger();
				die();
			}
		}

	}
