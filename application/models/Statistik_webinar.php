<?php

class Statistik_webinar extends CI_Model{

      function get_all(){

        return $this->db->get('peserta')->result();

      }  
      
            
     function get_pt_webinar(){

        $query=$this->db->query("SELECT *, count(namapt) as jmlh FROM pt as i left join ls_daftarseminar as u on i.kodept=u.idpt where u.status=1 and u.bukti_bayar <> 'Non-Sertifikat' group by namapt order by jmlh desc");
        return $query->result();

      }

      function get_peserta_webinar1(){

        $query=$this->db->query("SELECT idpt, nama, namapt, email, no_telp, bukti_bayar FROM `ls_daftarseminar` left join pt on ls_daftarseminar.idpt = pt.kodept WHERE kode_seminar = 'WB-NS-01' and status=1 and bukti_bayar <> 'Non-Sertifikat' order by id_pendaftaran");
        return $query->result();

      }
      
     function get_pt_webinar1(){

        $query=$this->db->query("SELECT *, count(namapt) as jmlh FROM pt as i left join ls_daftarseminar as u on i.kodept=u.idpt where u.kode_seminar = 'WB-NS-01' and u.status=1 and u.bukti_bayar <> 'Non-Sertifikat' group by namapt order by jmlh desc");
        return $query->result();

      }
      
      function get_peserta_webinar2(){

        $query=$this->db->query("SELECT idpt, nama, namapt, email, no_telp, bukti_bayar FROM `ls_daftarseminar` left join pt on ls_daftarseminar.idpt = pt.kodept WHERE kode_seminar = 'WB-NS-02' and status=1 and bukti_bayar <> 'Non-Sertifikat' order by id_pendaftaran");
        return $query->result();

      }
      
     function get_pt_webinar2(){

        $query=$this->db->query("SELECT *, count(namapt) as jmlh FROM pt as i left join ls_daftarseminar as u on i.kodept=u.idpt where u.kode_seminar = 'WB-NS-02' and u.status=1 and u.bukti_bayar <> 'Non-Sertifikat' group by namapt order by jmlh desc");
        return $query->result();

      }
      
      function get_pt_webinar12(){

        $query=$this->db->query("SELECT *, count(namapt) as jmlh FROM pt as i left join ls_daftarseminar as u on i.kodept=u.idpt where u.status=1 and u.bukti_bayar <> 'Non-Sertifikat' group by namapt order by jmlh desc");
        return $query->result();

      }
      
      function get_jmlh_peserta1(){

        $query=$this->db->query("SELECT *, count(id_pendaftaran) as jmlh FROM ls_daftarseminar where kode_seminar = 'WB-NS-01' and status=1 and bukti_bayar <> 'Non-Sertifikat'");
        return $query->result();

      }
      
     function get_jmlh_peserta2(){

        $query=$this->db->query("SELECT *, count(id_pendaftaran) as jmlh FROM ls_daftarseminar where kode_seminar = 'WB-NS-02' and status=1 and bukti_bayar <> 'Non-Sertifikat'");
        return $query->result();

      }
      
      function get_jmlh_peserta(){

        $query=$this->db->query("SELECT *, count(id_pendaftaran) as jmlh FROM ls_daftarseminar where status=1 and bukti_bayar <> 'Non-Sertifikat'");
        return $query->result();

      }
      
      function get_jmlh_reqver(){

        $query=$this->db->query("SELECT *, count(id_pendaftaran) as jmlh FROM ls_daftarseminar where status=0 and bukti_bayar <> 'Non-Sertifikat'");
        return $query->result();

      }
      
}

?>