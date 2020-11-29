<div class="card shadow mb-4">
  <div class="card-header py-3">
      
                  <p><strong>Halo Team, </strong>
            <?php
            echo $peserta->namatim;
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
      echo form_open_multipart("peserta",'',$hidden);
    ?>

    <div class="row">     
      <div class="col-6">
        <?php    
          echo form_input('',$peserta->namatim,'readonly','Nama Tim',form_error('namatim'));
          echo form_input('',$peserta->email,'readonly','Email',form_error('email'));
          echo form_input('nohp',set_value('nohp',$peserta->nohp),'','No Handphone',form_error('nohp'));
          //echo form_input('',$peserta->namapt,'readonly','Nama Perguruan Tinggi');
          //echo form_input('',$peserta->namalomba,'readonly','Kategori Lomba');
          // echo form_dropdown('idlomba', $lomba,set_value('idlomba',$peserta->idlomba),'','Kategori Lomba',form_error('idlomba'));                            
          ?>
      </div>
    
      <div class="col-4">
        <?php
          echo form_hidden('bukti_',set_value('bukti_',$peserta->buktibayar, FALSE));
          if ($peserta->status<3){
            echo form_upload('bukti','','','Bukti Bayar',form_error('bukti'),"Bukti bayar berupa file jpg atau png, dengan ukuran maksimal 500kb");
          }
          echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->buktibayar).'</p>';
          if($peserta->buktibayar){
            ?>
    		<p>CV sudah diterima, terimakasih!</p>
        <?php
          }
          ?>
      </div>
    </div>
    <?php
    echo form_submit('','Simpan','class="btn btn-primary px-5 rounded-pill float-right "');
    echo form_close();
    ?>
  </div>
</div>
