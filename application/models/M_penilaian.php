<?php
class M_penilaian extends CI_Model {
    
    public function statistik(){		
		$query = $this->db->query("SELECT b.id, b.namalomba, count(*) as TIM, (SELECT COUNT(*) as aktif FROM peserta WHERE status > 0 AND idlomba = b.id and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra') as AKTIF, (SELECT COUNT(*) as bayar FROM peserta WHERE status > 2 AND idlomba = b.id and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra') as BAYAR, (SELECT COUNT(*) as unggah FROM peserta WHERE status > 3 AND idlomba = b.id and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra') as UNGGAH, (SELECT COUNT(*) as berkas FROM peserta WHERE status > 4 AND idlomba = b.id and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra') as BERKAS, (SELECT COUNT(*) as reject FROM peserta WHERE status = 10 AND idlomba = b.id and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra') as REJECT FROM peserta a LEFT JOIN lomba b ON a.idlomba = b.id GROUP BY a.idlomba");
		return $query->result();
    }
    
	public function cek_ketarangan_kriteria($id_lomba){			
		$query = $this->db->query("SELECT keterangan FROM l_kriteriapenilaian WHERE id_lomba = '$id_lomba'");
		$cek =  $query->result();
		
		foreach($cek as $val){
		    if($val->keterangan != null){
		        return true;
		        break;
		    }elseif($val->keterangan == null){
		        return false;
		        break;
		    }else{
		        return 0;
		        break;
		    }
		}
	}
    
	public function tim_semua(){			
		$query = $this->db->query("SELECT * FROM peserta");
		return $query->num_rows();
	}

	public function jnilai($id_lomba){			
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND id IN (SELECT id_peserta FROM l_penilaian)");
		return $query->num_rows();
	}

	public function total_pt(){			
		$query = $this->db->query("SELECT * FROM pt WHERE kodept IN (SELECT idpt FROM peserta)");
		return $query->num_rows();
	}

	public function tim_belum_aktivasi(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 0");
		return $query->num_rows();
	}


	public function tim_sudah_aktivasi(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 1");
		return $query->num_rows();
	}


	public function tim_sudah_validasi(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 3");
		return $query->num_rows();
	}


	public function tim_sudah_unggah(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 4");
		return $query->num_rows();
	}


	public function tim_sudah_berkas(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 5");
		return $query->num_rows();
	}


	public function tim_sudah_dinilai(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status > 5 AND status < 10");
		return $query->num_rows();
	}


	public function tim_direject(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 10");
		return $query->num_rows();
	}
	
	//IMPORTANT!!! BAGIAN CRON C-Panel - HAPUS/UBAH MATI X(

	public function update_aktif($id_tahap, $aktif){

		$data = array('aktif' => $aktif);
		$this->db->where('id_tahap',$id_tahap);
		$this->db->update('l_tahappenilaian',$data);
	}

	//Campuran :v

	public function getByEmail($email = ''){			
		$query = $this->db->get_where('admin', ['email' => $email]);
		return $query->row();
	}

	//SIAP NILAI
	public function total_tim_all(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status > 2 AND status < 5");
		return $query->num_rows();
	}
	public function total_tim(){			
		$query = $this->db->query("SELECT * FROM peserta WHERE status = 5");
		return $query->num_rows();
	}

	public function cek_tahap(){			
		$query = $this->db->query("SELECT * FROM l_tahappenilaian");
		return $query->num_rows();
	}

	public function cek_siap(){			
		$query = $this->db->query("SELECT case when a.id_lomba is null then 0 else 1 end as cek FROM l_kriteriapenilaian a RIGHT JOIN lomba b ON a.id_lomba = b.id");
		$cek = $query->result();

		foreach ($cek as $value) {
			if ($value->cek == 0 ) {
			        // will leave the foreach loop and also the if statement
				return true;
				break;
			}
			    // echo $value->cek;
		}
	}	

	public function get_stage(){			
		$query = $this->db->query("SELECT aktif, nama_tahap FROM l_tahappenilaian WHERE aktif > 0");
		$cek =  $query->result();
		foreach ($cek as $value) {
			if ($value->aktif == 1 ) {
			        // will leave the foreach loop and also the if statement
				return $value->nama_tahap;
				break;
			}
		}
	}

	public function get_tahap(){			
		$query = $this->db->query("SELECT * FROM l_tahappenilaian a  ORDER BY a.order ASC");
		return $query->result();
	}

	public function get_lomba(){			
		$query = $this->db->query("SELECT * FROM lomba");
		return $query->result();
	}

	public function get_curlomba($id_lomba){			
		$query = $this->db->query("SELECT namalomba FROM lomba WHERE id = '$id_lomba'");
		return $query->row();
	}

	public function get_kriteria($id_tahap, $id_lomba){			
		$query = $this->db->query("SELECT * FROM l_kriteriapenilaian a WHERE a.id_tahap = '$id_tahap' AND a.id_lomba = '$id_lomba' ORDER BY a.id_kategori ASC");
		return $query->result();
	}

	//TAHAP

	public function tambah_tahap(){
		$nama_tahap 		= $this->input->post('nama_tahap');
		$date_start 		= $this->input->post('date_start');
		$time_start 		= $this->input->post('time_start');
		$date_end 			= $this->input->post('date_end');
		$time_end 			= $this->input->post('time_end');
		$keterangan 		= $this->input->post('keterangan');

		$date_start = DateTime::createFromFormat("Y-m-d", $date_start);
		$date_start = date_format($date_start,"d/m/Y");

		$date_end 	= DateTime::createFromFormat("Y-m-d", $date_end);
		$date_end 	= date_format($date_end,"d/m/Y");

		$query 		= $this->db->query("SELECT * FROM l_tahappenilaian");
		$counter 	= $query->num_rows();

		$order 		= $counter+1;

		$data = array(
			'nama_tahap'  	=> $nama_tahap,
			'date_start'  	=> $date_start,
			'time_start'  	=> $time_start,
			'date_end'		=> $date_end,
			'time_end'		=> $time_end,
			'keterangan'  	=> $keterangan,
			'order'			=> $order
		);
		$this->db->insert('l_tahappenilaian',$data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function update_tahap($id_tahap){
		$nama_tahap 		= $this->input->post('nama_tahap');
		$keterangan 		= $this->input->post('keterangan');

		$data = array('nama_tahap' => $nama_tahap, 'keterangan' => $keterangan);
		$this->db->where('id_tahap',$id_tahap);
		$this->db->update('l_tahappenilaian',$data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function tunda_tahap($id_tahap){
        date_default_timezone_set("Asia/Jakarta");
		$hari_dimulai	= $this->input->post('hari_dimulai');
		$hari_berakhir	= $this->input->post('hari_berakhir');
		$jam_dimulai	= $this->input->post('jam_dimulai');
		$jam_berakhir	= $this->input->post('jam_berakhir');
		$tunda_hari		= $this->input->post('tunda_hari');
		$ganti_jam		= $this->input->post('ganti_jam');
		$aktif 			= $this->input->post('aktif');

		if ($aktif == 0) {
			$hari = $hari_dimulai;
			$jam  = $jam_dimulai;
		}elseif ($aktif == 1) {
			$hari = $hari_berakhir;
			$jam  = $jam_berakhir;
		}

		if (!empty($tunda_hari)) {

			$hari 	= DateTime::createFromFormat("d/m/Y", $hari);
			$hari 	= date_format($hari,"m/d/Y");

			if ($tunda_hari > 0) {
				$dimulai_new	= date('d/m/Y',strtotime($hari . "+".$tunda_hari." days"));
			}else{
				$dimulai_new	= date('d/m/Y',strtotime($hari . "-".abs($tunda_hari)." days"));
			}
		}else{
			$dimulai_new = $hari;
		}

		if (!empty($ganti_jam)) {
			$jam_new = $ganti_jam;
		}else{
			$jam_new = $jam;
		}

		if ($aktif == 0) {
			$data = array('time_start' => $jam_new, 'date_start' => $dimulai_new);
		}elseif($aktif == 1){
			$data = array('time_end' => $jam_new, 'date_end' => $dimulai_new);
		}

		$this->db->where('id_tahap',$id_tahap);
		$this->db->update('l_tahappenilaian',$data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function hapus_tahap($id_tahap) {
		$this->db->where('id_tahap', $id_tahap);
		$this->db->delete('l_tahappenilaian');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	//KRITERIA

	// public function get_kriteria(){		
	// 	$query = $this->db->query("SELECT * FROM l_kriteriapenilaian");
	// 	return $query->result();

	//     // Fetch users
	// 		// $this->db->select('*');
	// 		// $fetched_records = $this->db->get('l_kriteriapenilaian');
	// 		// $kriteria = $fetched_records->result_array();

	// 		// return $kriteria;
	// }

	public function push_kriteria($id_tahap, $id_lomba){
		if($this->input->post('kriteria')){
			$kriteria 		= $this->input->post('kriteria', true);
			$keterangan 	= $this->input->post('keterangan', true);
			$bobot 			= $this->input->post('bobot', true);

			foreach ($kriteria as $i => $a) {
				$data = array(
					'id_tahap'  => $id_tahap,
					'id_lomba'  => $id_lomba,
					'kriteria' 	=> isset($kriteria[$i]) ? $kriteria[$i] : '',
					'keterangan'=> isset($keterangan[$i]) ? $keterangan[$i] : '',
					'bobot' 	=> isset($bobot[$i]) ? $bobot[$i] : ''
				);
				$this->db->insert('l_kriteriapenilaian',$data);
			}
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}

	public function updateUser($id,$field,$value){

			    // Update
		$data=array($field => $value);
		$this->db->where('id_kategori',$id);
		$this->db->update('l_kriteriapenilaian',$data);
	}

	public function deletekriteria($id){

			    // Update
		$this->db->where('id_kategori',$id);
		$this->db->delete('l_kriteriapenilaian');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function hapus_kriteria_pilih() {
		$delete = $this->input->post('idk');
		for ($i=0; $i < count($delete) ; $i++) { 
			$this->db->where('id_kategori', $delete[$i]);
			$this->db->delete('l_kriteriapenilaian');
		}
		return ($this->db->affected_rows() != 1) ? false : true;
	}




}?>