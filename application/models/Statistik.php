<?php

class Statistik extends CI_Model{

      function get_all(){

        return $this->db->get('peserta')->result();

      }  

      function get_peserta(){

        $query=$this->db->query("SELECT * FROM peserta AS u LEFT JOIN pt AS i ON u.idpt = i.kodept LEFT JOIN lomba AS a ON u.idlomba = a.id where u.namatim<>'hubla' and u.namatim<>'Superman' and u.namatim<>'test hendra' order by u.id");
        return $query->result();

      }
      
      function get_lomba(){

        $query=$this->db->query("SELECT *, count(idlomba) as jmlh FROM `peserta` as u left join lomba as a on u.idlomba=a.id where u.namatim<>'hubla' and u.namatim<>'Superman' group by idlomba");
        return $query->result();
        
      }
      
      function get_provinsi(){

        $query=$this->db->query("SELECT *, count(provinsi) as jmlh FROM pt as i left join peserta as u on i.kodept=u.idpt where u.namatim<>'hubla' and u.namatim<>'Superman' and u.namatim<>'test hendra' group by provinsi order by jmlh desc");
        return $query->result();
        
      }
      
      function get_pt(){

        $query=$this->db->query("SELECT *, count(namapt) as jmlh FROM pt as i left join peserta as u on i.kodept=u.idpt where u.namatim<>'hubla' and u.namatim<>'Superman' and status>2 and u.namatim<>'test hendra' group by namapt order by jmlh desc");
        return $query->result();
        
      }
      
      function get_bayar(){

        $query=$this->db->query("SELECT count(id) as jumlah FROM peserta where status>2 and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'");
        return $query->result();
        
      }
      
      function get_belumverifikasi(){

        $query=$this->db->query("SELECT count(id) as jumlah FROM peserta where status=2 and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'");
        return $query->result();
        
      }
      
      function get_belumbayar(){

        $query=$this->db->query("SELECT count(id) as jumlah FROM peserta where status<2 and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'");
        return $query->result();
        
      }
      
      function get_jmlhpeserta(){

        $query=$this->db->query("SELECT count(distinct namaketua) as a1, count(distinct anggota2) AS a2, count(distinct anggota3) as a3, count(distinct anggota4) as a4, count(distinct anggota5) as a5 from anggota where idpeserta<>13 or idpeserta<>22 or idpeserta<>116");
        return $query->result();
        
      }
	  
	  function get_jmlhtim(){

        $query=$this->db->query("SELECT count(namatim) as jmlhtim from peserta where namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'");
        return $query->result();
        
      }
	  
	  function get_jmlhkarya(){

        $query=$this->db->query("select COUNT(DISTINCT karya) as jmlhkarya from peserta where namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'");
        return $query->result();
        
      }

}