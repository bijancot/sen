<?php
class M_juri extends CI_Model {



	function import_data(){

        $fileName = time().$_FILES['file']['name'];

        $config['upload_path'] = 'excel/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data('file');
        $inputFileName = 'excel/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 5; $row <= $highestRow; $row++){                  //  <- memilih row tempat data berada                
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database 0, no kolom                                
                 $data = array(
                    "nama"	        => $rowData[0][2],
                    "email"	        => $rowData[0][3],
                    "password"		=> $rowData[0][4],
                    "status"	    => 3
                );
                 
                //sesuaikan nama dengan nama tabel
                $this->db->insert("adminn",$data);
                     
            }
    }

	//JURI

	public function get_tahap_r(){
        date_default_timezone_set("Asia/Jakarta");
        $harini = date("d/m/Y");
		$query = $this->db->query("SELECT id_tahap, nama_tahap, date_end FROM l_tahappenilaian WHERE aktif >= 1 AND id_tahap != 2 AND id_tahap != 1 ORDER BY id_tahap DESC");
			return $query->result();
	}

	public function get_id_nilai($id_peserta){
		$query = $this->db->query("SELECT id_penilaian FROM l_penilaian WHERE id_peserta = '$id_peserta'");
			return $query->row();
	}

	public function get_detail_nilai($id_penilaian){
		$query = $this->db->query("SELECT b.kriteria, a.nilai, a.nilai_murni, a.id_penilaian, b.keterangan FROM l_detailnilai a LEFT JOIN l_kriteriapenilaian b ON a.id_kriteria = b.id_kategori WHERE a.id_penilaian = '$id_penilaian'");
			return $query->result();
	}

	public function get_tahap(){
        date_default_timezone_set("Asia/Jakarta");
        $harini = date("d/m/Y");
		$query = $this->db->query("SELECT id_tahap, nama_tahap, date_end, time_end FROM l_tahappenilaian WHERE aktif = 1");
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

	public function progress($id_user, $id_lomba, $tahap){
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND id IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$id_user' AND id_tahap = '$tahap') AND status = 7");
		return $query->num_rows();
	}

	public function total_tim($id_user){
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND status = 7");
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

	public function bidang_lo($id_user){
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidanglo WHERE id_user = '$id_user')");
		return $query->row();
	}

	public function bidang_juri($id_user){
		$query = $this->db->query("SELECT * FROM lomba WHERE id IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user')");
		return $query->row();
	}

	public function bidang_lomjur($id_lomba){
		$query = $this->db->query("SELECT * FROM lomba WHERE id = '$id_lomba'");
		return $query->row();
	}

	public function bidang_lomlo($id_lomba){
		$query = $this->db->query("SELECT * FROM lomba WHERE id = '$id_lomba'");
		return $query->row();
	}

	public function daftar($id_lomba, $id_user){
		$query      = $this->db->query("SELECT id_tahap FROM l_tahappenilaian WHERE aktif = 1");
		$id_tahap   =  $query->row();
	   
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$id_user' AND id_tahap = '$id_tahap->id_tahap') AND status = 7 ORDER BY nourutfinalis ASC");
		return $query->result();
	}

	public function daftar_lo($id_lomba, $id_user){
		$query      = $this->db->query("SELECT id_tahap FROM l_tahappenilaian WHERE aktif = 1");
		$id_tahap   =  $query->row();
	   
		$query = $this->db->query("SELECT * FROM peserta WHERE idlomba = '$id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidanglo WHERE id_user = '$id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$id_user' AND id_tahap = '$id_tahap->id_tahap') AND status = 5 ORDER BY namatim ASC");
		return $query->result();
	}
	public function stts_thp($id_tahap){
		$query = $this->db->query("SELECT stts_finalis FROM l_tahappenilaian WHERE id_tahap = '$id_tahap'");
		return $query->row();
	}
	public function peserta_nilai_rekap($id_lomba){
		$query = $this->db->query("SELECT (SELECT AVG(c.nilai_akhir) AS nilai_final FROM l_penilaian c WHERE c.id_peserta = a.id_peserta) AS NILAI, a.*, b.* FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id WHERE a.id_peserta IN (SELECT id FROM peserta WHERE idlomba = '$id_lomba') AND b.status = 7 GROUP BY a.id_peserta ORDER BY NILAI DESC");
		return $query->result();
	}

	public function TahapAkhir($jml, $idl, $thp){

		//Create ID
		
		$query = $this->db->query("SELECT id FROM lomba");
		$lomba = $query->result();
		
		foreach ($lomba as $value) {
			$query = $this->db->query("SELECT b.id, b.namatim, (SELECT AVG(c.nilai_akhir) AS nilai_final FROM l_penilaian c WHERE c.id_peserta = a.id_peserta) AS NILAI FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id WHERE a.id_peserta IN (SELECT id FROM peserta WHERE idlomba = '$value->id') GROUP BY a.id_peserta ORDER BY NILAI DESC LIMIT 0 , ".$jml);
			$get_fin = $query->result();

			foreach ($get_fin as $key) {
				$data = array('status' => 7);
				$this->db->where('id', $key->id);
				$this->db->update('peserta', $data);
			}
		}
		$data = array('stts_finalis' => 1);
		$this->db->where('id_tahap', $thp);
		$this->db->update('l_tahappenilaian', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function peserta_nilai_a($id_tahap, $id_lomba){
		$query = $this->db->query("SELECT (SELECT AVG(c.nilai_akhir) AS nilai_final FROM l_penilaian c WHERE c.id_peserta = a.id_peserta AND c.id_tahap = '$id_tahap') AS NILAI, a.*, b.*, d.namapt FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id LEFT JOIN pt d ON b.idpt = d.kodept WHERE a.id_peserta IN (SELECT id FROM peserta WHERE idlomba = '$id_lomba') AND a.id_tahap = '$id_tahap' GROUP BY a.id_peserta ORDER BY NILAI DESC");
		return $query->result();
	}

	// public function peserta_nilai_a($id_lomba){
	// 	$query = $this->db->query("SELECT * FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id WHERE a.id_peserta IN (SELECT id FROM peserta WHERE idlomba = '$id_lomba') GROUP BY a.id_peserta");
	// 	return $query->result();
	// }

	public function peserta_nilai($id_tahap, $id_user){			
		$query = $this->db->query("SELECT * FROM l_penilaian a LEFT JOIN peserta b ON a.id_peserta = b.id WHERE a.id_tahap = '$id_tahap' AND a.id_user = '$id_user' ORDER BY a.nilai_akhir DESC");
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

	public function get_kriteria_edit($id_tahap, $id_lomba, $id_penilaian){			
		$query = $this->db->query("SELECT * FROM l_kriteriapenilaian a LEFT JOIN l_detailnilai b ON a.id_kategori = b.id_kriteria WHERE b.id_penilaian = '$id_penilaian'");
		return $query->result();
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

	public function UpdateNilai($id_tahap, $id_user){

		//Create ID

		if($this->input->post('id_detail')){

			$id_penilaian 	= $this->input->post('id_penilaian', true);

			$final	= 0;
			$id_detail 	    = $this->input->post('id_detail', true);
			$bobot 			= $this->input->post('bobot', true);
			$nilai 			= $this->input->post('nilai', true);

			foreach ($id_detail as $i => $a) {

				$data = array(
					'nilai'  		=> $bobot[$i]*$nilai[$i]/100,
					'nilai_murni'  	=> $nilai[$i]
				);
				$final = $final+($bobot[$i]*$nilai[$i]/100);
				$this->db->where('id_detail',$id_detail[$i]);
				$this->db->update('l_detailnilai',$data);
			}

			$data = array(
				'nilai_akhir'	=> $final
			);
			$this->db->where('id_penilaian',$id_penilaian);
			$this->db->update('l_penilaian',$data);
			$this->db->save_queries = FALSE;
			return ($this->db->affected_rows() != 1) ? false : true;
		}
	}

// 	public function KirimNilai($id_tahap, $id_user){

// 		//Create ID

// 		$base	= rand(10,100);
// 		$id 	= $id_user.$id_tahap.$base+1;

// 		$id_peserta = $this->input->post('id_peserta');
// 		$note 		= $this->input->post('note');

// 		$final	= 0;

// 		if($this->input->post('id_kriteria')){
// 			$id_kriteria 	= $this->input->post('id_kriteria', true);
// 			$bobot 			= $this->input->post('bobot', true);
// 			$nilai 			= $this->input->post('nilai', true);

// 			foreach ($id_kriteria as $i => $a) {

// 				$data = array(
// 					'id_penilaian'  => $id,
// 					'id_kriteria'  	=> isset($id_kriteria[$i]) ? $id_kriteria[$i] : '',
// 					'nilai'  		=> $bobot[$i]*$nilai[$i]/100,
// 					'nilai_murni'  	=> $nilai[$i]
// 				);
// 				$final = $final+($bobot[$i]*$nilai[$i]/100);
// 				$this->db->insert('l_detailnilai',$data);
// 			}

// 			$data = array(
// 				'id_penilaian'  => $id,
// 				'id_tahap'		=> $id_tahap,
// 				'id_user'		=> $id_user,
// 				'id_peserta'	=> $id_peserta,
// 				'nilai_akhir'	=> $final,
// 				'note'			=> $note
// 			);
// 			$this->db->insert('l_penilaian',$data);
// 			return ($this->db->affected_rows() != 1) ? false : true;
// 		}
// 	}

	public function KirimNilai($id_tahap, $id_user, $id, $final){

		//Create ID

			$id_peserta = $this->input->post('id_peserta', true);
			$note 		= $this->input->post('note', true);
			
			$data = array(
				'id_penilaian'  => $id,
				'id_tahap'		=> $id_tahap,
				'id_user'		=> $id_user,
				'id_peserta'	=> $id_peserta,
				'nilai_akhir'	=> $final,
				'note'			=> $note
			);

			$idnya = $id;
			$this->db->insert('l_penilaian',$data);
			$this->db->save_queries = FALSE;
			return ($this->db->affected_rows() != 1) ? false : true;
	}

	//ADMIN

	public function total_juri(){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 3 AND id IN (SELECT id_user FROM l_bidangjuri)");
		return $query->num_rows();
	}

	public function get_jurinilall($id_lomba){			
		$query = $this->db->query("SELECT * FROM admin WHERE status = 3 AND id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$id_lomba') AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'");
		return $query->num_rows();
	}

	public function get_jurinilpes($id_lomba, $id_peserta){			
		$query = $this->db->query("SELECT * FROM admin a LEFT JOIN l_penilaian b ON a.id = b.id_user WHERE a.id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$id_lomba') AND STATUS = 3 AND b.id_peserta = '$id_peserta' AND b.id_tahap = 3 AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra' GROUP BY a.id");
		return $query->num_rows();
	}

	public function get_nilaiakhir($id_peserta){			
		$query = $this->db->query("SELECT AVG(nilai_akhir) as nilai_final FROM l_penilaian WHERE id_peserta = '$id_peserta'");
		return $query->row();
	}

	public function get_jurinil($id_lomba){			
		$query = $this->db->query("SELECT * FROM admin WHERE id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$id_lomba') AND status = 3 AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'");
		return $query->result();
	}

	public function get_juridetnil($id_lomba, $id_peserta){			
		$query = $this->db->query("SELECT * FROM admin a LEFT JOIN l_penilaian b ON a.id = b.id_user WHERE a.id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$id_lomba') AND STATUS = 3 AND b.id_tahap = 3 AND b.id_peserta = '$id_peserta' AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra' GROUP BY a.id");
		return $query->result();
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

	public function ResetNilai($id_penilaian){
		$this->db->where('id_penilaian', $id_penilaian);
		$this->db->delete('l_detailnilai');
		$this->db->where('id_penilaian', $id_penilaian);
		$this->db->delete('l_penilaian');
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