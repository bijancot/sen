<?php
class M_verifikasi extends CI_Model {


	public function get_id($email){
		$query = $this->db->query("SELECT id FROM admin WHERE email = '$email'");
		return $query->row();
	}

	public function lo_lomba($id_user){			
		$query = $this->db->query("SELECT id_lomba FROM l_bidanglo WHERE id_user = '$id_user'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_lomba_loo($id_lomba){			
		$query = $this->db->query("SELECT * FROM lomba WHERE id = '$id_lomba'");
		return $query->row();
	}

	public function getByEmail($email = ''){			
		$query = $this->db->get_where('admin', ['email' => $email]);
		return $query->row();
	}

	public function Btotal_tim_all($id_lomba){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status > 1 AND idlomba = '$id_lomba'");
		return $query->num_rows();
	}

	public function Btotal_tim($id_lomba){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status > 3 AND idlomba = '$id_lomba'");
		return $query->num_rows();
	}
	public function Btotal_tim_ver($id_lomba){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 5 AND idlomba = '$id_lomba'");
		return $query->num_rows();
	}
	public function Btotal_tim_rec($id_lomba){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 10 AND idlomba = '$id_lomba'");
		return $query->num_rows();
	}

	public function namalomba($id_lomba){			
		$query = $this->db->query("SELECT id,namalomba FROM lomba WHERE id = '$id_lomba'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function peserta_all_daftar($id_lomba, $status){
	   // if($status == 2){
		  //  $query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status BETWEEN 2 AND 3");
	   // }else{
		  //  $query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = '$status'");
	   // }
		    $query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = '$status'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function peserta_all($id_lomba){			
		$query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status > 1");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function Bpeserta($id_lomba){			
		$query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = 4 ORDER BY a.namatim ASC");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function Vpeserta($id_lomba){			
		$query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = 7");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function Rpeserta($id_lomba){			
		$query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = 10");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function get_insta($id_peserta){			
		$query = $this->db->query("SELECT instagram FROM anggota WHERE idpeserta = '$id_peserta'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_pembimbing($id_peserta){			
		$query = $this->db->query("SELECT pembimbing, nidn FROM anggota WHERE idpeserta = '$id_peserta'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_anggota($id_peserta){			
		$query = $this->db->query("SELECT * FROM anggota WHERE idpeserta = '$id_peserta'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_ktm($id_peserta){			
		$query = $this->db->query("SELECT ktm FROM anggota WHERE idpeserta = '$id_peserta'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function total_lo(){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 2 AND id IN (SELECT id_user FROM l_bidanglo)");
		return $query->num_rows();
	}

	public function total_tim_siap(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 4");
		return $query->num_rows();
	}

	public function total_tim(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status > 2 AND status < 5");
		return $query->num_rows();
	}
	public function total_tim_ver(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 5");
		return $query->num_rows();
	}
	public function total_tim_rec(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 10");
		return $query->num_rows();
	}

	public function get_lo(){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 2");
		return $query->result();
	}

	public function get_lomba(){			
		$query = $this->db->query("SELECT * FROM lomba");
		return $query->result();
	}

	public function get_lomlo($id_lo){			
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidanglo WHERE id_user = '$id_lo')");
		return $query->result();
	}

	public function cek_lomlo($id, $id_lo){			
		$query = $this->db->query("SELECT id FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidanglo WHERE id_lomba = '$id' AND id_user = '$id_lo')");
		return $query->row();
	}

	public function VerifikasiPeserta($id_peserta){

		$data = array(
			'status'	=> 5
		);

		$this->db->where('id', $id_peserta);
		$this->db->update('peserta', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function ResetPeserta($id_peserta){
    
        if(!empty($id_peserta) AND $id_peserta != null){
    		$data = array(
    			'status'	=> 4
    		);
    
    		$this->db->where('id', $id_peserta);
    		$this->db->update('peserta', $data);
    		return ($this->db->affected_rows() != 1) ? false : true;
        }else{
            return false;
        }
	}

	public function RejectPeserta($id_peserta){

		$data = array(
			'status'	=> 10
		);

		$this->db->where('id', $id_peserta);
		$this->db->update('peserta', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function tambah_lo(){
		$nama		= $this->input->post('nama_lo');
		$email		= $this->input->post('email_lo');
		$password	= $this->input->post('password_lo');

		$password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'nama'		=> $nama,
			'email'		=> $email,
			'password'	=> $password,
			'status'	=> 2
		);

		$this->db->insert('admin', $data);

		$cek = ($this->db->affected_rows() != 1) ? false : true;
		
		if ($cek == TRUE) {
			if($this->input->post('bidang_lomba')){

				$query 		= $this->db->query("SELECT id FROM admin WHERE email = '$email' AND status = 2");
				$find 		= $query->row();

				$id_user	= $find->id;
				$bidang_lomba 		= $this->input->post('bidang_lomba', true);

				$lomba = array(
					'id_user'  	=> $id_user,
					'id_lomba' 	=> $bidang_lomba
				);
				$this->db->insert('l_bidanglo',$lomba);

				return ($this->db->affected_rows() != 1) ? false : true;
			}else{
				return TRUE;
			}
		}else{
			return false;
		}
	}

	public function atur_lo($id_lo){

	}

	public function edit_lo($id_lo){
		$nama		= $this->input->post('nama_lo');
		$email		= $this->input->post('email_lo');
		// $password	= $this->input->post('password_lo');

		// $password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'nama'		=> $nama,
			'email'		=> $email,
			// 'password'	=> $password,
			// 'status'	=> 3
		);

		$this->db->where('id', $id_lo);
		$this->db->update('admin', $data);

		if($this->input->post('bidang_lomba')){

			$this->db->where('id_user', $id_lo);
			$this->db->delete('l_bidanglo');

			$bidang_lomba 		= $this->input->post('bidang_lomba', true);

			$lomba = array(
				'id_user'  	=> $id_lo,
				'id_lomba' 	=> $bidang_lomba
			);
			$this->db->insert('l_bidanglo',$lomba);
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			return TRUE;
		}
	}

	public function pass_lo($id_lo){
		$password	= $this->input->post('password_lo');

		$password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'password'	=> $password
		);

		$this->db->where('id', $id_lo);
		$this->db->update('admin', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function hapus_lo($id_lo){
		$this->db->where('id', $id_lo);
		$this->db->delete('admin');
		$cek = ($this->db->affected_rows() != 1) ? false : true;
		if ($cek == TRUE) {
			$this->db->where('id_user', $id_lo);
			$this->db->delete('l_bidanglo');
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			return TRUE;
		}
	}

	function hapus_pilih() {
		$delete = $this->input->post('idk');
		for ($i=0; $i < count($delete) ; $i++) { 
			$this->db->where('id', $delete[$i]);
			$this->db->delete('admin');
		}
		$cek = ($this->db->affected_rows() != 1) ? false : true;

		if ($cek == TRUE) {
			for ($i=0; $i < count($delete) ; $i++) { 
				$this->db->where('id_user', $delete[$i]);
				$this->db->delete('l_bidanglo');
			}
			return true;
		}else{
			return true;
		}
	}
}?>