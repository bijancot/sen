<?php
	class Token_model extends CI_Model {
		
		public function __construct()
		{
			$this->load->database();
		}
				
		public function get_like($field, $str = ''){
			$this->db->like($field, $str);
			$query = $this->db->get('token');
			return $query->result();
		}
		
		public function get($id = FALSE){
			if ($id === FALSE)
			{
				$query = $this->db->get('token');
				return $query->result();
			}
			
			$query = $this->db->get_where('token', array('id' => $id));
			return $query->row();
		}
		
		public function getByEmail($email = ''){			
			$query = $this->db->get_where('token', array('email' => $email));
			return $query->row();
		}
				
		public function simpan($data,$id = ''){
			if($id == ''){
        if ($result = $this->db->insert('token',$data)){
					$this->session->set_flashdata('success','Pendaftaran Berhasil');
				}
			} else {
        $this->db->where('id',$id);
        $result = $this->db->update('token',$data);  
			}       
			return $result;
		}
		
		public function hapus($email){
			$this->db->delete('token',['email' => $email]);
		}
		
	}
?>