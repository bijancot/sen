<?php
class Berita_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

public function get_like($field, $str = ''){
    $this->db->like($field, $str);
    $query = $this->db->get('berita');
    return $query->result();
}


	public function get($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('berita');
			return $query->result();
		}

		$query = $this->db->get_where('berita', array('id' => $id));
		return $query->row();
	}
	
	public function get_array($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('berita');
			return $query->result_array();
		}

		$query = $this->db->get_where('berita', array('id' => $id));
		return $query->row_array();
	}

  public function get_last_ten_entries()
  {
    $query = $this->db->get('berita', 10);
    return $query->result();
  }
	
	public function simpan($data,$id = ''){
    if($id == ''){
        $this->db->insert('berita',$data);
    } else {
        $this->db->where('id',$id);
        $this->db->update('berita',$data);  
    }       
}

}