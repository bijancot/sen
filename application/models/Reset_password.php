<?php
	class Reset_password extends CI_Model {
		
		
		public function getEmail($email){
			$this->db->select('email');
		    $this->db->from('peserta');
		    $this->db->where('email', $email);
		    $query=$this->db->get();
		    return $query->row_array();
		}

		public function changePass($email, $pass){
		$this->db->select("*");
		$this->db->from('peserta');
        $this->db->where('email', $email);
        $this->db->update('peserta', $pass);
		}

}