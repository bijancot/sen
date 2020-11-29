<?php
	class anggota_model extends CI_Model {
		
		/* public function __construct()
		{
			//$this->load->database();
		} */
		
		public function get_like($field, $str = ''){
			$this->db->like($field, $str);
			$query = $this->db->get('anggota');
			return $query->result();
		}
		
		public function get($idpeserta = FALSE){	
			$query = $this->db->get_where('anggota', array('idpeserta' => $idpeserta));
			return $query->row();
			
		}
		
		public function getByid($id = ''){			
			$query = $this->db->get_where('anggota', array('id' => $id));
			return $query->row();
		}
		
		public function simpan($data,$idpeserta = ''){
			if($id == ''){
        if ($result = $this->db->insert('anggota',$data)){
					$this->session->set_flashdata('success','Pendaftaran Berhasil, periksa id');
				}
			} else {
        $this->db->where('idpeserta',$idpeserta);
        $result = $this->db->update('anggota',$data);  
			}       
			return $result;
		}
				
		public function hapus($id){
			$this->db->delete('anggota',['id' => $id]);
		}
		
	}
?>