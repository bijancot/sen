<?php
class Lomba_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

public function get_like($field, $str = ''){
    $this->db->like($field, $str);
    $query = $this->db->get('lomba');
    return $query->result();
}


	public function get($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('lomba');
			return $query->result();
		}

		$query = $this->db->get_where('lomba', array('id' => $id));
		return $query->row();
	}
	
	public function get_dropdown($level = '2'){
		$this->db->select('id,namalomba');
		
		if($level){
				$this->db->where('level',$level);
		}
		
		$query = $this->db->get('lomba');
		$result = $query->result();
		
		foreach ($result as $row){
			$lomba[$row->id] = $row->id . '-'. $row->namalomba;
		}
		return $lomba;
	}

	public function simpan($data,$id = ''){
    if($id == ''){
        $this->db->insert('lomba',$data);
    } else {
        $this->db->where('id',$id);
        $this->db->update('lomba',$data);  
    }       
}

}