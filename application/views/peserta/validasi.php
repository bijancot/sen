<div class="card shadow mb-4">
  <div class="card-header py-3">
      
               <p><strong>STATUS :</strong>
            <?php
            if ($peserta->status==0) { ?>
            <font color="#FF0000"><strong>Akun Belum Aktif (Silahkan periksa email)</strong></font> <?php
            } else {
            if ($peserta->status==1) { ?>
            <font color="#0000FF"><strong>Belum Bayar (Silahkan lakukan pembayaran ke rekening BNI 0617552678 an APTISI Wilayah VII, lalu unggah buktinya </strong></font><strong><a href="<?=base_url();?>peserta"><font color="#FF0000">di sini</font></a>)</strong> <?php
            } else {
             if (($peserta->status==2) AND ($peserta->namaketua=='')) { ?>
            <font color="#FF8000"><strong>Menunggu verifikasi pembayaran dari panitia, namun Anda belum melengkapi biodata anggota tim, silahkan klik <a href="<?=base_url();?>anggota">di sini</a> untuk melengkapi biodata anggota tim.</strong></font> <?php  
            } else { 
            if ($peserta->status==2) { ?>
            <font color="#FF8000"><strong>Menunggu verifikasi pembayaran dari panitia</strong></font> <?php
            } else {    
            if (($peserta->status==3) AND ($peserta->namaketua=='')) { ?>
            <font color="#FF0000"><strong>Belum Unggah Karya dan Melengkapi Biodata Anggota Tim. Silahkan klik <a href="<?=base_url();?>anggota">di sini</a> untuk melengkapi biodata anggota tim.</strong></font> <?php  
            } else { 
            if ($peserta->status==3) { ?>
            <font color="#009900"><strong>Belum Unggah Karya (Silahkan klik <a href="<?=base_url();?>karya">di sini</a> untuk mengunggah karya, Surat Pernyataan dan manaruh link video teaser.</strong></font> <?php  
            } else { ?>
            <strong>Sudah Mengunggah Karya</strong><?php   
            }
            }
            }
            }
            }
            }
            ?></p>
            
    <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
    <small class="form-text text-muted">
      Gunakan halaman  ini untuk mengubah password atau identitas tim, serta dapat dipakai untuk unggah <strong>syarat adminstrasi</strong>.
    </small>
  </div>

  <div class="card-body">
    <?php
      echo $this->session->flashdata('message');
      echo validation_errors(); 
    
      $hidden = array('idpeserta' => $peserta->id);
      echo form_open_multipart("",'',$hidden);
    ?>

    <div class="row">     
      <div class="col-6">
        <?php
          echo form_input('namatim',$peserta->namatim,'readonly','Nama Tim',form_error('namatim'));
          echo form_input('',set_value('',$peserta->namaketua),'readonly','Nama Ketua');
          echo form_input('',$peserta->email,'readonly','Email',form_error('email'));
          echo form_input('nohp',set_value('nohp',$peserta->nohp),'readonly','No Handphone',form_error('nohp'));
          echo form_input('',$peserta->namapt,'readonly','Nama Perguruan Tinggi');
          echo form_input('',$peserta->namalomba,'readonly','Kategori Lomba');
        //   echo form_dropdown('idlomba', $lomba,set_value('idlomba',$peserta->idlomba),'','Kategori Lomba',form_error('idlomba'));                            
          ?>
      </div>
    
      <div class="col-4">
        <?php
            
            if($peserta->buktibayar){
                echo '<p><label for="bukti" class="font-weight-bold">Bukti Bayar</label><br><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->buktibayar).'</p>';
        ?>
                <img src="<?=base_url('').$peserta->buktibayar;?>" class="img-fluid">
        <?php
            } else {
                echo '<p><label for="bukti" class="font-weight-bold">Bukti Bayar</label><br><span class="text-danger"><i class="far fa-times-circle"></i>&nbsp;&nbsp;&nbsp; Belum ada</span></p>';
            }
          ?>
      </div>
    </div>
    <?php
    echo form_submit('valid','Valid','class="btn btn-primary px-5 mx-2 rounded-pill float-right "');
    echo anchor('dashboard', 'Kembali', 'class="btn btn-warning px-5 rounded-pill float-right "');
    // echo form_submit('','Kembali','class="btn btn-warning px-5 rounded-pill float-right "');
    echo form_close();
    ?>
  </div>
</div>