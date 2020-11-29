<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SeminarH extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['menu_model','M_seminar']);	
		$LO = $this->M_penilaian->getByEmail($this->session->username);

		if ($this->session->logged_in == FALSE){
			if (!$LO) {
				redirect('login');
			}
		}
		$this->load->library('template');

	}
	
	public function index(){

		$data['username'] 	= $this->session->userdata('nama');
		$data['menu']     	= $this->menu_model->getByRole(0);
		$data['nama'] 	  	= $this->session->userdata('nama');
		$data['lo']		  	= TRUE;

		$this->template->view('lo/l_seminar',$data);
	}

}
