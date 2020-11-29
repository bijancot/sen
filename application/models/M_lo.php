<?php
class M_lo extends CI_Model {

	public function getByEmail($email = ''){			
		$query = $this->db->get_where('admin', ['email' => $email]);
		return $query->row();
	}

	public function jml_tim_final($id_lomba){	
		$query = $this->db->query("SELECT id FROM peserta WHERE idlomba = '$id_lomba' AND status = 7");
		return $query->num_rows();
	}

	public function jml_juri($id_lomba){	
		$query = $this->db->query("SELECT id FROM admin WHERE status = 3 AND id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = $id_lomba) AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'");
		return $query->num_rows();
	}

	public function get_webinar($status){
		$query = $this->db->query("SELECT b.nama AS namaweb, a.*, (CASE WHEN idpt IN (SELECT kodept FROM pt) THEN (SELECT namapt FROM pt b WHERE b.kodept = a.idpt) ELSE idpt END) AS namapts FROM ls_daftarseminar a LEFT JOIN ls_infoseminar b ON a.kode_seminar = b.kode_seminar WHERE a.status = '$status' AND bukti_bayar <>'Non-Sertifikat' ORDER BY a.kode_seminar ASC");
		$cek = $query->num_rows();

		if ($cek <= 0) {
			return false;
		}else{
			return $query->result();
		}
	}

	public function peserta($id_lomba){
		$query = $this->db->query("SELECT a.*, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.idlomba = '$id_lomba' AND a.status = '7' ORDER BY a.nourutfinalis ASC");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function instagram($id_lomba){
		$query = $this->db->query("SELECT (SELECT namatim FROM peserta WHERE id = l_IG.id_peserta) AS namatim, (SELECT b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.id = l_IG.id_peserta) AS namapt, teaser, CAST(likes AS INTEGER) AS likes, CAST(comments AS INTEGER) AS comments FROM l_IG WHERE id_lomba = '$id_lomba' ORDER BY likes DESC, comments DESC");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function instagram_admin(){
		$query = $this->db->query("SELECT (SELECT namatim FROM peserta WHERE id = l_IG.id_peserta) AS namatim, (SELECT b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.id = l_IG.id_peserta) AS namapt, teaser, CAST(likes AS INTEGER) AS likes, CAST(comments AS INTEGER) AS comments, CAST(videos AS INTEGER) AS videos, (likes+comments+videos) AS total FROM l_IG ORDER BY total DESC");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function instagram_mining($id_lomba){
		$query = $this->db->query("SELECT a.id,a.namatim, a.teaser, b.namapt FROM peserta a LEFT JOIN pt b ON a.idpt = b.kodept WHERE a.status BETWEEN 5 AND 7 AND a.idlomba = '$id_lomba' ORDER BY a.nourutfinalis ASC LIMIT 0, 100");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function kriteria($id_lomba){
		$query = $this->db->query("SELECT * FROM l_kriteriapenilaian WHERE id_lomba = '$id_lomba' AND id_tahap = 3");
		$cek = $query->num_rows();

		if ($cek > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	
	public function peserta_nilai_a($id_lomba, $id_tahap){
		$query = $this->db->query("SELECT (SELECT AVG(c.nilai_akhir) AS nilai_final FROM l_penilaian c WHERE c.id_peserta = a.id_peserta AND c.id_tahap = '$id_tahap') AS NILAI, a.*, b.*, d.namapt FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id LEFT JOIN pt d ON b.idpt = d.kodept WHERE a.id_peserta IN (SELECT id FROM peserta WHERE idlomba = '$id_lomba') AND a.id_tahap = '$id_tahap' GROUP BY a.id_peserta ORDER BY NILAI DESC");
		return $query->result();
	}
	
	public function get_peserta($id_lomba){
		$query = $this->db->query("SELECT id, namatim FROM peserta WHERE idlomba = '$id_lomba' AND status = 7");
		return $query->result();
	}

	public function pushnourut($id_lomba){
		if($this->input->post('nourut')){
			$nourut 		= $this->input->post('nourut', true);
			$id_peserta 	= $this->input->post('id_peserta', true);

			foreach ($nourut as $i => $a) {
				$data = array(
					'nourutfinalis'  => isset($nourut[$i]) ? $nourut[$i] : ''
				);
				$array = array('id' => isset($id_peserta[$i]) ? $id_peserta[$i] : '', 'status' => 7, 'idlomba' => $id_lomba);

				$this->db->where($array);
				$this->db->update('peserta',$data);
			}
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}
	
	
	
	public function terima($stats, $id_pendaftaran){
		$data = array('status' => $stats);
		
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('ls_daftarseminar', $data);
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function gkjelas($stats, $id_pendaftaran){
		$data = array('status' => $stats);
		
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('ls_daftarseminar', $data);
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	public function tolak($stats, $id_pendaftaran){
		$data = array('status' => $stats);
		
		$this->db->where('id_pendaftaran', $id_pendaftaran);
		$this->db->update('ls_daftarseminar', $data);
		
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}?>