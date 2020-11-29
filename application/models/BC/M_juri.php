<?php
class M_juri extends CI_Model {


	//JURI

	public function get_tahap(){
        date_default_timezone_set("Asia/Jakarta");
        $harini = date("d/m/Y");
		$query = $this->db->query("SELECT id_tahap, nama_tahap, date_end FROM l_tahappenilaian WHERE aktif = 1 AND date_start <= '$harini' AND date_end <= '$harini'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_id($email){
		$query = $this->db->query("SELECT id FROM admin WHERE email = '$email'");
		return $query->row();
	}

	public function progress($id_user, $id_lomba){
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$id_user') AND status = 4");
		return $query->num_rows();
	}

	public function total_tim($id_user){
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND status = 4");
		return $query->num_rows();
	}

	public function cek_bidang($id_user){
		$query = $this->db->query("SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user'");
		return $query->num_rows();
	}

	public function daftar_bidang($id_user){
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user')");
		return $query->result();
	}

	public function bidang_juri($id_user){
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user')");
		return $query->row();
	}

	public function bidang_lomjur($id_lomba){
		$query = $this->db->query("SELECT * FROM lomba WHERE id = '$id_lomba'");
		return $query->row();
	}

	public function daftar($id_lomba, $id_user){			
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$id_user') AND status = 4");
		return $query->result();
	}

	public function peserta($id_peserta){			
		$query = $this->db->query("SELECT * FROM peserta WHERE id = '$id_peserta'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function get_kriteria($id_tahap, $id_lomba){			
		$query = $this->db->query("SELECT * FROM l_kriteriapenilaian WHERE id_tahap = '$id_tahap' AND id_lomba = '$id_lomba'");
		return $query->result();
	}

	public function keterangan($id_lomba){
		$query = $this->db->query("SELECT keterangan FROM l_keterangannilai WHERE id_lomba = '$id_lomba'");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->row();
		}else{
			return false;
		}
	}

	public function KirimNilai($id_tahap, $id_user){

		//Create ID

		$base	= rand(10,100);
		$id 	= $id_user.$id_tahap.$base+1;

		$id_peserta = $this->input->post('id_peserta');
		$note 		= $this->input->post('note');

		$final	= 0;

		if($this->input->post('id_kriteria')){
			$id_kriteria 	= $this->input->post('id_kriteria', true);
			$bobot 			= $this->input->post('bobot', true);
			$nilai 			= $this->input->post('nilai', true);

			foreach ($id_kriteria as $i => $a) {

				$data = array(
					'id_penilaian'  => $id,
					'id_kriteria'  	=> isset($id_kriteria[$i]) ? $id_kriteria[$i] : '',
					'nilai'  		=> $bobot[$i]*$nilai[$i]/100
				);
				$final = $final+($bobot[$i]*$nilai[$i]/100);
				$this->db->insert('l_detailnilai',$data);
			}

			$data = array(
				'id_penilaian'  => $id,
				'id_tahap'		=> $id_tahap,
				'id_user'		=> $id_user,
				'id_peserta'	=> $id_peserta,
				'nilai_akhir'	=> $final,
				'note'			=> $note
			);
			$this->db->insert('l_penilaian',$data);
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}

	//ADMIN

	public function total_juri(){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 3 AND id IN (SELECT id_user FROM l_bidangjuri)");
		return $query->num_rows();
	}

	public function get_juri(){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 3");
		return $query->result();
	}

	public function get_lomba(){			
		$query = $this->db->query("SELECT * FROM lomba");
		return $query->result();
	}

	public function get_lomjur($id_juri){			
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_juri')");
		return $query->result();
	}

	public function cek_lomjur($id, $id_juri){			
		$query = $this->db->query("SELECT id FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidangjuri WHERE id_lomba = '$id' AND id_user = '$id_juri')");
		return $query->row();
	}

	public function tambah_juri(){
		$nama		= $this->input->post('nama_juri');
		$email		= $this->input->post('email_juri');
		$password	= $this->input->post('password_juri');

		$password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'nama'		=> $nama,
			'email'		=> $email,
			'password'	=> $password,
			'status'	=> 3
		);

		$this->db->insert('admin', $data);

		$cek = ($this->db->affected_rows() != 1) ? false : true;
		
		if ($cek == TRUE) {
			if($this->input->post('bidang_lomba')){

				$query 		= $this->db->query("SELECT id FROM admin WHERE email = '$email' AND status = 3");
				$find 		= $query->row();

				$id_user	= $find->id;
				$bidang_lomba 		= $this->input->post('bidang_lomba', true);

				foreach ($bidang_lomba as $i => $a) {
					$lomba = array(
						'id_user'  	=> $id_user,
						'id_lomba' 	=> isset($bidang_lomba[$i]) ? $bidang_lomba[$i] : ''
					);
					$this->db->insert('l_bidangjuri',$lomba);
				}
				return ($this->db->affected_rows() != 1) ? false : true;
			}else{
				return TRUE;
			}
		}else{
			return false;
		}
	}

	public function atur_juri($id_juri){

	}

	public function edit_juri($id_juri){
		$nama		= $this->input->post('nama_juri');
		$email		= $this->input->post('email_juri');
		// $password	= $this->input->post('password_juri');

		// $password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'nama'		=> $nama,
			'email'		=> $email,
			// 'password'	=> $password,
			// 'status'	=> 3
		);

		$this->db->where('id', $id_juri);
		$this->db->update('admin', $data);

		if($this->input->post('bidang_lomba')){

			$this->db->where('id_user', $id_juri);
			$this->db->delete('l_bidangjuri');

			$bidang_lomba 		= $this->input->post('bidang_lomba', true);

			foreach ($bidang_lomba as $i => $a) {
				$lomba = array(
					'id_user'  	=> $id_juri,
					'id_lomba' 	=> isset($bidang_lomba[$i]) ? $bidang_lomba[$i] : ''
				);
				$this->db->insert('l_bidangjuri',$lomba);
			}
			return ($this->db->affected_rows() != 1) ? false : true;
		}else{
			return TRUE;
		}
	}

	public function pass_juri($id_juri){
		$password	= $this->input->post('password_juri');

		$password 	= password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'password'	=> $password
		);

		$this->db->where('id', $id_juri);
		$this->db->update('admin', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function hapus_juri($id_juri){
		$this->db->where('id', $id_juri);
		$this->db->delete('admin');
		$cek = ($this->db->affected_rows() != 1) ? false : true;
		if ($cek == TRUE) {
			$this->db->where('id_user', $id_juri);
			$this->db->delete('l_bidangjuri');
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
				$this->db->delete('l_bidangjuri');
			}
			return true;
		}else{
			return true;
		}
	}
}?>