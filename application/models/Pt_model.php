<?php
class Pt_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

public function get_like($field, $str = ''){
    $this->db->like($field, $str);
    $query = $this->db->get('pt');
    return $query->result();
}


	public function get($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('pt');
			return $query->result();
		}

		$query = $this->db->get_where('pt', array('id' => $id));
		return $query->row();
	}
	
	public function get_dropdown(){
		$this->db->select('kodept,namapt');
		$query = $this->db->get('pt');
		$result = $query->result();
		
		foreach ($result as $row){
			$pt[$row->kodept] = $row->kodept . '-'. $row->namapt;
		}
		return $pt;
	}

	public function simpan($data,$id = ''){
    if($id == ''){
        $this->db->insert('pt',$data);
    } else {
        $this->db->where('id',$id);
        $this->db->update('pt',$data);  
    }       
}

}