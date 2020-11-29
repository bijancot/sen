<?php

class Poster extends CI_Model{

      function get_all(){

        return $this->db->get('peserta')->result();

      }
      
      function get_poster(){

        $query=$this->db->query("select * from peserta where idlomba=2 and status=5 order by namatim");
        return $query->result();
        
      }
      
      
}