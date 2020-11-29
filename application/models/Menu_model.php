<?php
	class Menu_model extends CI_Model {
		
		/* public function __construct()
		{
			//$this->load->database();
		} */
		
		public function get_like($field, $str = ''){
			$this->db->like($field, $str);
			$query = $this->db->get('menu');
			return $query->result();
		}
		
		public function get($id = FALSE){	
			if ($id === FALSE)
			{
				$query = $this->db->get('menu');
				return $query->result();
			}
			$query = $this->db->get_where('menu', array('id' => $idpeserta));
			return $query->row();
			
		}
		
		public function getByRole($role = ''){			
			$this->db->order_by('posisi', 'ASC');		
			$query = $this->db->get_where('menu', array('role' => $role));
			return $query->result();
		}
		
		public function simpan($data,$idpeserta = ''){
			if($id == ''){
        if ($result = $this->db->insert('menu',$data)){
					$this->session->set_flashdata('success','Pendaftaran Berhasil, periksa id');
				}
			} else {
        $this->db->where('id',$idpeserta);
        $result = $this->db->update('menu',$data);  
			}       
			return $result;
		}
				
		public function hapus($id){
			$this->db->delete('menu',['id' => $id]);
		}
		
	}
?>