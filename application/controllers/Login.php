<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $is_admin = 0;
	private $nama = '';
	
	public function view()
	{	
		$this->load->library('table');
		$this->load->helper('url');
		//$this->load->model('user_model'); 
		

		$data = array(
			 //'title' => 'My Title',
			 'judul' => 'My Heading'
		);
		$data['message'] = 'My Message';

		$data['user'] = $this->user_model->get();

		$data['judul'] = 'Daftar User';
			
		/* $this->parser->parse('new_header',$data);
		$this->parser->parse('berita/view', $data);
		$this->parser->parse('new_footer',$data); */
		$this->template->view('login/view', $data);
  }
	public function index()
	{   
	    //Script Lama
// 	    if ($this->session->logged_in){
// 			redirect('peserta'); //berita adalah halaman utam
// 		}
		
		//Script Baru
		if ($this->session->logged_in){
		    if($this->is_admin){
				redirect('dashboard');
			}elseif ($this->session->userdata('role') == 2) {
				redirect('Lo_final');
			}elseif ($this->session->userdata('role') == 3) {
				redirect('Juri');
			}
			redirect('peserta'); //berita adalah halaman utam
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
        		
		if ($this->form_validation->run('login') == FALSE)
		{
			$this->load->view('auth_header');
			$this->load->view('login');
			$this->load->view('auth_footer');		
		} else {
			$email = $this->input->post('email');
					
			$sessiondata = array(
					'username'  => $email,
					'logged_in' => TRUE,
					'nama' => $this->nama,
					'role' => $this->is_admin
			);

			$this->session->set_userdata($sessiondata);
			
			if($this->is_admin){
				redirect('dashboard');
			}
			redirect('peserta');

		}


	}
	
	public function cek_password($password)
	{
		$email = $this->input->post('email');
		
		//cek admin dulu
		$this->load->model('admin_model');        
		$result = $this->admin_model->getByEmail($email);


//      Script lama		
// 		if ($result && password_verify($password,$result->password)){
// 				$this->is_admin = 1;
// 				$this->nama = $result->nama;
// 				return TRUE;
// 		} 

        //script baru		
		if ($result && password_verify($password,$result->password)){

			//Modify THIS ADMIN
			if ($result->status == 1) {
				$this->is_admin = 1;
				$this->nama = $result->nama;
				return TRUE;
			//LO
			}elseif($result->status == 2){
				$sessiondata = array(
						'username'  => $email,
						'logged_in' => TRUE,
						'nama' 		=> $result->nama,
						'role' 		=> $result->status
				);

				$this->session->set_userdata($sessiondata);

				redirect('Lo_final');

			//JURI - Under Construction
			}elseif($result->status == 3){
				$sessiondata = array(
						'username'  => $email,
						'logged_in' => TRUE,
						'nama' 		=> $result->nama,
						'role' 		=> $result->status
				);

				$this->session->set_userdata($sessiondata);

				redirect('Juri');
			}
		}
		
		//cek peserta
		
		
		$this->load->model('peserta_model');        
		$result = $this->peserta_model->getByEmail($email);
		if (!$result){
			// print_r($result);
			// die;
			$this->form_validation->set_message('cek_password', 
							"Username $email atau {field} tidak ditemukan");
				return FALSE;
		}
		if (password_verify($password,$result->password)){
			if ($result->status == 0){
			$this->form_validation->set_message('cek_password', 
							'This email has not been activated! <a href="resend/'.urlencode($email).'">Resend email</a>');
				return FALSE;
		} else 
				$this->is_admin = 0;
				$this->nama = $result->namatim;
				return TRUE;
		} else {
				$this->form_validation->set_message('cek_password', 
							'Username atau {field} Salah');
				return FALSE;
		}
			
	}
	
	public function logout(){
    $this->session->unset_userdata('logged_in');
    redirect('login');
	}
	
	public function lupa_password()
	{	
		$this->load->library('table');
		$this->load->helper('url');
		$this->load->helper('form');
		//$this->load->model('user_model'); 
		

		$data = array(
			 //'title' => 'My Title',
			 'judul' => 'Lupa Password'
		);
		$data['message'] = 'My Message';


			
		/* $this->parser->parse('new_header',$data);
		$this->parser->parse('berita/view', $data);
		$this->parser->parse('new_footer',$data); */
			$this->load->view('auth_header');
			$this->load->view('lupa_password');
			$this->load->view('auth_footer');	
  }


  	public function req_lupas()
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('Reset_password');  
	    $email = $this->input->post('email');
	    $findemail = $this->Reset_password->getEmail($email);
	    if ($findemail) {

	    	$this->sendToken($email);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Silahkan cek Email anda!</div>');	
redirect("login/lupa_password");
	    	
	    } else {
$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');	
redirect("login/lupa_password");
	    }
		
 	}

 	public function sendToken($email){
			$this->load->model('token_model');   
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
			$subject = 'oops, ada yang lupa password nih - SENCA 2020';
			$message = '
				Silakan ganti password anda dengan klik tautan berikut ini:<br><br>
				
				<a href="'.base_url().'login/ganti_password?email='.$email.'&token='.$token.'">Ganti Password</a><br><br>
				
				Tautan akan valid selama 24 jam. Jika Anda merasa tidak merasa melakukan lupa password akun LO KREATIF 2020, Anda dapat mengabaikan email ini.<br><br>
				
				
				Terima kasih. Semoga sukses. <br><br>
				
				Salam,<br>
				SENCA 2020<br>
				<a href="https://senca.web.id">senca.web.id</a><br>';
				
			$this->_sendEmail($token,$email,$subject, $message);
		}

 	private function _sendEmail($token ,$to, $subject, $message = ''){
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
			$this->email->from('sencaevent@gmail.com','SENCA 2020');
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

		public function ganti_password(){
			
			$this->load->model('token_model');  
			$this->load->library('table');
			$this->load->helper('url');
			$this->load->helper('form');
			$email = $this->input->get('email');
			$token = $this->input->get('token');
		
			
			$datatoken = $this->token_model->getByEmail($email);
			
			if($datatoken->token == $token){
				if(time() - $datatoken->date_created < (60*60*24)){

					$mail['mail'] = $email;
					$this->load->view('auth_header');
					$this->load->view('ganti_password', $mail);
					$this->load->view('auth_footer');
		
					$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Ganti Password anda!.</div>');
					
					
					} else {
					$this->token_model->hapus($email);
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Token kadaluarsa!</div>');
					redirect('/');
				}
				
				} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Gagal autentikasi / Token sudah digunakan.</div>');	
				redirect('/');
			}
			
		}

		public function update_pass(){
			$this->load->library('form_validation');
			$this->load->model('token_model');  
			$this->load->model('peserta_model'); 
			$this->load->model('Reset_password'); 
			$this->load->helper('url');
			$this->load->helper('form');

			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password]|min_length[6]|max_length[25]');	

			if($this->form_validation->run() != false){
				$email= $this->input->post('email');
				$pass = [
				'password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				];
				$this->Reset_password->changePass($email, $pass);
				$this->token_model->hapus($email);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');	
				redirect('/');
			}else{		
				echo "<script>window.alert('Password tidak sama/panjang password kurang dari 6!');javascript:history.back()</script>";
						
			}
	
		}
}
