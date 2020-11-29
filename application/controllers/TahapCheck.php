<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahapCheck extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_penilaian');	

	}
	
	public function index(){
        date_default_timezone_set("Asia/Jakarta");
		$cek = $this->M_penilaian->get_tahap();

		foreach ($cek as $value) {

			$hari = "";$jam = "";$menit = "";$sisa_waktu = "";
			$time_now		= strtotime(date("H:i"));
			$hariini    	= date('d/m/Y');
			//Mulai
			$date_start 	= $value->date_start;
			$time_start	  	= strtotime($value->time_start);
			//Berakhir
			$date_end 		= $value->date_end;
			$time_end 	  	= strtotime($value->time_end);

			//Update Tahap ke AKTIF
			if ($date_start == $hariini && $value->aktif == 0) {
				if ($time_start == $time_now) {
					$this->M_penilaian->update_aktif($value->id_tahap, 1);
				}
			}

			//Update Tahap ke SELESAI
			if ($date_end == $hariini && $value->aktif == 1) {
				if ($time_end == $time_now) {
					$this->M_penilaian->update_aktif($value->id_tahap, 2);
				}
			}

			// if ($value->date_start == 0 && $value->time_start ==  ) {
			//         // will leave the foreach loop and also the if statement
			// 	return true;
			// 	break;
			// }
			    // echo $value->cek;
		}
		}
}?>