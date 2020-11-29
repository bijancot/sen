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
				//'idpt'=> htmlspecialchars($this->input->post('idpt')),
				//'idlomba'=> htmlspecialchars($this->input->post('idlomba')),
				'alasan' => htmlspecialchars($this->input->post('alasan')),
				'idebisnis' => htmlspecialchars($this->input->post('idebisnis')),
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
			$subject = 'Verifikasi Peserta SENCA 2020';
			$message = '
				Halo, Selamat data di SENCA 2020. Team anda telah melakukan proses pendaftara, untuk melanjutkan silahkan verifikasi akun anda menggunakan tautan berikut ini:<br><br>
				
				<a href="'.base_url().'activate?email='.$email.'&token='.$token.'">Verifikasi Akun</a><br><br>
				
				Tautan akan valid selama 24 jam. Jika Anda merasa tidak melakukan pendaftaran SENCA 2020, Anda dapat mengabaikan email ini.<br><br>
				
				Jika ada hal yang perlu ditanyakan lebih lanjut, silakan hubungi narahubung berikut:<br>
				- Bagus Kristomoyo (08113581650)<br>
				- <br>
				
				Terima kasih. Semoga sukses. <br><br>
				
				Salam,<br>
				SENCA 2020<br>
				<a href="https://senca.web.id/">senca.web.id</a><br>';
				
			$this->_sendEmail($token,$email,$subject, $message);
		}
		
		private function _sendEmail($token, $to, $subject, $message = ''){
			//type: 1 : registration
			//      2 : forgot password
			$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sencaevent@gmail.com',
			'smtp_pass' => 'auto1234509876',
			'smtp_port' => '465',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
			];
			$this->load->library('email',$config);
			$this->email->from('sencaevent@gmail.com','SENCA 2020 REGISTRATION');
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
					
					$subject = 'SENCA 2020 REGISTRATION Has Been Success!';
			$message = '
				<p><strong>Selamat!</strong> Anda sudah berhasil terdaftar sebagai peserta SENCA 2020. </p>

<p>Selanjutnya Anda dapat melakukan login ke dashboard SENCA 2020 dengan menggunakan email dan password yang didaftarkan ketika registrasi untuk melengkapi data tim dan dokumen lain.</p>


<p>Jika ada hal yang perlu ditanyakan lebih lanjut, silakan hubungi narahubung berikut:</p>
<ul>
<li>Bagus (08113581650)</li>
</ul>

<p>Terima kasih. Selamat mengikuti SENCA 2020. Semoga sukses.</p>

Salam,<br>
Panitia SENCA 2020<br>
<a href="https://senca.web.id/">senca.web.id</a>';
				
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
