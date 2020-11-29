<?php
	class Peserta_model extends CI_Model {
		
		/* public function __construct()
		{
			//$this->load->database();
		} */
		
		public function get_like($field, $str = ''){
			$this->db->like($field, $str);
			$query = $this->db->get('peserta');
			return $query->result();
		}
		
		public function get($id = FALSE){
				
			if ($id === FALSE)
			{
				$query = $this->db->get('peserta');
				return $query->result();
			}
			
			$query = $this->db->get_where('peserta', array('id' => $id));
			//echo $email;
			
			return $query->row();
		}
		
		public function getById($id = FALSE){
				
			if ($id === FALSE)
			{
				$query = $this->db->get('peserta');
				return $query->result();
			}
			
			$query = $this->db->get_where('peserta', array('id' => $id));
			//echo $email;
			
			return $query->row();
		}
		
		public function getByEmail($email = ''){			
			$query = $this->db->get_where('peserta', array('email' => $email));
			return $query->row();
		}
		
		public function get_dropdown($level = '2'){
			$this->db->select('id,namapeserta');
			
			if($level){
				$this->db->where('level',$level);
			}
			
			$query = $this->db->get('peserta');
			$result = $query->result();
			
			foreach ($result as $row){
				$peserta[$row->id] = $row->id . '-'. $row->namapeserta;
			}
			return $peserta;
		}
		
		public function simpan($data,$id = ''){
			if($id == ''){
        if ($result = $this->db->insert('peserta',$data)){
					$this->session->set_flashdata('success','Pendaftaran Berhasil, periksa email');
				}
			} else {
        $this->db->where('id',$id);
		$result = $this->db->update('peserta',$data);  
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Peserta berhasil disimpan</div>');
			}       
			return $result;
		}
		
		public function activate($email){
			$this->db->where('email',$email);
			$result = $this->db->update('peserta',['status' => '1']);  
			
			$this->db->delete('token',['email' => $email]);
			
			return $result;
		}
		
		public function hapus($email){
			$this->db->delete('peserta',['email' => $email]);
		}
		
	}
?>
