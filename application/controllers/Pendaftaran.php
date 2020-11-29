<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pendaftaran extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model(['pt_model','lomba_model','peserta_model','token_model']);	
			if ($this->session->isdaftar){
				redirect('login');
			}
			
			//		$this->load->model('berita_model');	
			
			//$this->load->library('parser');
			//$this->parser->set_delimiters('{{','}}');    
			
			//$this->load->library('template');
		}
		public function index()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			if ($this->form_validation->run('pendaftaran') == FALSE)
			{
				$data['pt'] = $this->pt_model->get_dropdown();
				$data['lomba'] = $this->lomba_model->get_dropdown();
				//print_r($data['pt']);
				
				$this->load->view('header');
				$this->load->view('pendaftaran1',$data);
				$this->load->view('footer');
				
			} else {
			
				$email = htmlspecialchars($this->input->post('email',true));
				
				$data = [
				'namatim' => htmlspecialchars($this->input->post('namatim',true)),
				'email'=> $email,
				'nohp'=> htmlspecialchars($this->input->post('nohp')),
				'idpt'=> htmlspecialchars($this->input->post('idpt')),
				'idlomba'=> htmlspecialchars($this->input->post('idlomba')),
				'password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'status'=> 0,
				];
				
				$this->peserta_model->simpan($data);
				
				$this->sendToken($email);
				
				redirect('/');
			} 
			
			//$this->load->view('home');
		}
		
		function cek_dropdown($value)
		{			
			if($value=="none"){
				$this->form_validation->set_message('cek_dropdown', '%s harus diisi.');
				return false;
			} else{ return true; }
		}

		public function resend($email){ 
			$result = $this->peserta_model->getByEmail(urldecode($email));
			if ($result->status == 0){
				$this->sendToken(urldecode($email));
				redirect('/');
			}
		}
		
		public function sendToken($email){
			
			$datatoken = $this->token_model->getByEmail($email);
			
			if($datatoken){
				$token = $datatoken->token;
			
			} else {
			
				$token = bin2hex(random_bytes(32));
				$datatoken = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
				];
				
				$this->token_model->simpan($datatoken);
			}
			$subject = 'Verifikasi Akun LO KREATIF 2020';
			$message = '
				Anda telah melakukan pendaftaran akun LO KREATIF 2020. Silakan lakukan verifikasi akun dengan klik tautan berikut ini:<br><br>
				
				<a href="'.base_url().'activate?email='.$email.'&token='.$token.'">Verifikasi Akun</a><br><br>
				
				Tautan akan valid selama 24 jam. Jika Anda merasa tidak melakukan pendaftaran LO KREATIF 2020, Anda dapat mengabaikan email ini.<br><br>
				
				Jika ada hal yang perlu ditanyakan lebih lanjut, silakan hubungi narahubung berikut:<br>
				- Nana (087888895535)<br>
				- Hendra (081350204469)<br>
				- Azizah (085645548497)<br>
				- Diyah (085755241098)<br><br>
				
				Terima kasih. Semoga sukses. <br><br>
				
				Salam,<br>
				Panitia LO KREATIF 2020<br>
				<a href="http://aptisi7jatim.org/">www.aptisi7jatim.org</a><br>';
				
			$this->_sendEmail($token,$email,$subject, $message);
		}
		
		private function _sendEmail($token, $to, $subject, $message = ''){
			//type: 1 : registration
			//      2 : forgot password
			$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'lokreatif7@gmail.com',
			'smtp_pass' => 'paksugeng',
			'smtp_port' => '465',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
			];
			$this->load->library('email',$config);
			$this->email->from('lokreatif@gmail.com','Panitia LO KREATIF 2020');
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
		
		public function activate(){
			$email = $this->input->get('email');
			$token = $this->input->get('token');
			
			$datatoken = $this->token_model->getByEmail($email);
			
			if($datatoken->token == $token){
				if(time() - $datatoken->date_created < (60*60*24)){
					$this->peserta_model->activate($email);
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Akun berhasil diaktifkan. Terima kasih.</div>');
					
					$subject = 'Pendaftaran LO KREATIF 2020 Berhasil';
			$message = '
				<p><strong>Selamat!</strong> Anda sudah berhasil terdaftar sebagai peserta Lomba Nasional Kreativitas Mahasiswa (LO KREATIF) 2020. </p>

<p>Selanjutnya Anda dapat melakukan login ke dashboard LO KREATIF 2020 dengan menggunakan email dan password yang didaftarkan ketika registrasi untuk melengkapi data tim dan dokumen lain.</p>

Di bawah ini adalah jadwal kegiatan LO KREATIF 2020:
<ul>
<li> Pendaftaran Peserta : 28 September - 31 Oktober 2020 </li>
<li> Webinar Sosialisasi : 5 Oktober 2020 </li>
<li> Seleksi Karya : 1 - 10 November 2020</li>
<li> Pengumuman Finalis dan SEMNAS Seri 1: 12 November 2020</li>
<li> Technical Meeting Finalis: 13 November 2020</li>
<li> Pelaksanaan Final : 16 November 2020 </li>
<li> Pengumuman Pemenang dan SEMNAS Seri 2: 18 November 2020</li>
</ul>

<p>Jika ada hal yang perlu ditanyakan lebih lanjut, silakan hubungi narahubung berikut:</p>
<ul>
<li>Nana (087888895535)</li>
<li>Hendra (081350204469)</li>
<li>Azizah (085645548497)</li>
<li>Diyah (085755241098)</li>
</ul>

<p>Terima kasih. Selamat mengikuti Lomba Nasional Kreativitas Mahasiswa (LO KREATIF) 2020. Semoga sukses.</p>

Salam,<br>
Panitia LO KREATIF 2020<br>
<a href="http://aptisi7jatim.org/">www.aptisi7jatim.org</a>';
				
			$this->_sendEmail($token,$email,$subject, $message);
					
					} else {
					$this->token_model->hapus($email);
					$this->peserta->hapus($email);
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Token kadaluarsa!</div>');
				}
				
				} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal!</div>');	
			}
			redirect('/');
		}
	}
