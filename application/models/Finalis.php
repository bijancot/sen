<?php

class Finalis extends CI_Model{

      function get_all(){

        return $this->db->get('peserta')->result();

      }  

      function get_bisnis(){
        $query=$this->db->query("SELECT * from peserta left join pt on peserta.idpt = pt.kodept where idlomba=1 and status=7 order by namatim");
        return $query->result();
      }

      function get_poster(){
        $query=$this->db->query("SELECT * from peserta left join pt on peserta.idpt = pt.kodept where idlomba=2 and status=7 order by namatim");
        return $query->result();
      }

      function get_aplikasi(){
        $query=$this->db->query("SELECT * from peserta left join pt on peserta.idpt = pt.kodept where idlomba=3 and status=7 order by namatim");
        return $query->result();
      }

      function get_uiux(){
        $query=$this->db->query("SELECT * from peserta left join pt on peserta.idpt = pt.kodept where idlomba=4 and status=7 order by namatim");
        return $query->result();
      }	 
      
      function get_video(){
        $query=$this->db->query("SELECT * from peserta left join pt on peserta.idpt = pt.kodept where idlomba=5 and status=7 order by namatim");
        return $query->result();
      }	

}