<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Unggah Karya</h6>
    <small class="form-text text-muted">
      Gunakan halaman  ini untuk mengubah password atau identitas tim, serta dapat dipakai untuk unggah <strong>syarat adminstrasi</strong>.
    </small>
  </div>

  <div class="card-body">
    <?php
      echo $this->session->flashdata('message');
      echo validation_errors(); 
    
      $hidden = array('idpeserta' => $peserta->id);
      echo form_open_multipart("karya",'',$hidden);
    ?>

    <div class="row">     
      <div class="col-6">
        <?php    
          echo form_input('',$peserta->namatim,'readonly','Nama Tim',form_error('namatim'));
		  echo form_input('',$peserta->namalomba,'readonly','Kategori Lomba');
		  echo form_input('teaser',set_value('teaser',@$peserta->teaser),'','Link Video Teaser',form_error('teaser'));

		  echo form_hidden('pernyataan_',set_value('pernyataan_',@$peserta->pernyataan, FALSE));
          echo form_upload('pernyataan','','','Surat Pernyataan',form_error('pernyataan'),"File Surat pernyataan berupa file pdf, dengan ukuran maksimal 1Mb");
		  //echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename(@$peserta->pernyataan).'</p>';
		  
          if(@$peserta->pernyataan){
            echo '<small class="fomr-text text-success"><i class="fas fa-file-alt"></i> <label class="font-weight-bold">File : </label>&nbsp;&nbsp;&nbsp;'.basename($peserta->pernyataan).'</small>';
		  }

          // echo form_dropdown('idlomba', $lomba,set_value('idlomba',$peserta->idlomba),'','Kategori Lomba',form_error('idlomba'));                            
          ?>
      </div>
    
      <div class="col-4">
        <?php
          
		  
		  $this->load->view('peserta/kategori'.$peserta->idlomba);

		  
          ?>
      </div>
    </div>
    <?php
    echo form_submit('','Simpan','class="btn btn-primary px-5 rounded-pill float-right "');
    echo form_close();
    ?>
  </div>
</div>