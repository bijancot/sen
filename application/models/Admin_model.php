<?php
	class Admin_model extends CI_Model {
		
		
		public function get_like($field, $str = ''){
			$this->db->like($field, $str);
			$query = $this->db->get('admin');
			return $query->result();
		}
		
		public function get($email = FALSE){
				
			if ($email === FALSE)
			{
				$query = $this->db->get('admin');
				return $query->result();
			}
			
			$query = $this->db->get_where('admin', array('email' => $email));
			//echo $email;
			
			return $query->row();
		}
		
		public function getByEmail($email = ''){			
			$query = $this->db->get_where('admin', ['email' => $email]);
			return $query->row();
		}
				
		
		public function simpan($data,$id = ''){
			if($id == ''){
        if ($result = $this->db->insert('admin',$data)){
					$this->session->set_flashdata('success','Pendaftaran Berhasil, periksa email');
				}
			} else {
        $this->db->where('id',$id);
        $result = $this->db->update('admin',$data);  
			}       
			return $result;
		}
		
		
		public function hapus($email){
			$this->db->delete('admin',['email' => $email]);
		}
		
		public function buka($data){
			$this->db->where('keterangan','bukatutup');
			$this->db->update('konfigurasi',$data);
		}

		public function getKonfigurasi($keterangan = '' ){
			if ($keterangan === FALSE)
			{
				$query = $this->db->get('konfigurasi');
				return $query->result();
			}
			
			$query = $this->db->get_where('konfigurasi', array('keterangan' => $keterangan));
			return $query->row();			
		}
	}
?>