<?php
class M_seminar extends CI_Model {

	public function get_dropdown(){
		$query = $this->db->query("SELECT kodept as pt, namapt FROM pt");
		return $query->result();
	}

	public function get_detailseminar($kode_seminar){
		$query = $this->db->query("SELECT * FROM ls_infoseminar WHERE kode_seminar = '$kode_seminar'");
		return $query->result();
	}

	public function get_seminar(){
		$query = $this->db->query("SELECT * FROM ls_infoseminar");
		$cek = $query->num_rows();

		if ($cek > 0) {
		    return $query->result();
		}else{
			return false;
		}
	}
	
	public function get_seminar_one(){
		$query = $this->db->query("SELECT * FROM ls_infoseminar WHERE status = 1");
		$cek = $query->num_rows();

		if ($cek > 0) {
		    return $query->result();
		}else{
			return false;
		}
	}
	
	public function cek_email($email, $kode_seminar){			
		$query = $this->db->query("SELECT email FROM ls_daftarseminar WHERE email = '$email' AND kode_seminar = '$kode_seminar'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return false;
		}else{
			return true;
		}
	}	
	
	public function DaftarSeminar($email, $nama, $kode, $file){
		$nohp 			= $this->input->post('nohp', true);

		if (!empty($this->input->post('ptn'))) {
			$ptnya 	= $this->input->post('ptn');
		}else{
			$pt 	= $this->input->post('pts');
			$idpt 	= explode("-", $pt);
			$ptnya	= $idpt[0];
		}

		$data = array(
			'kode_seminar'  => $kode,
			'email' 		=> $email,
			'nama'  		=> $nama,
			'idpt'  		=> $ptnya,
			'no_telp'  		=> $nohp,
			'bukti_bayar'  	=> $file,
		);
		$this->db->insert('ls_daftarseminar',$data);
		$this->db->save_queries = FALSE;
		return ($this->db->affected_rows() != 1) ? false : true;
	}




}?>