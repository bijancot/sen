<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Aktivasi Lomba</h6>
    <small class="form-text text-muted">
      Digunakan untuk membuka dan menutup event lomba (tidak dapat unggah karya).
    </small>
  </div>

  <div class="card-body">
    <?php
      echo $this->session->flashdata('message');
      echo validation_errors(); 
    
      
      echo form_open("batas"); //diatur di config/route ke dashborad/bukatutup
    ?>

    <div class="row">     
      <div class="col-6">
        <div class="form-group">
            <label for="batas" class="font-weight-bold">Lomba dibuka</label>
            <input type="hidden" value="0" name="batas">            
            <?php    
             echo form_checkbox('batas', set_value('batas',1), $konfigurasi->value,'data-toggle="toggle" data-onstyle="primary"');
        //   echo form_input('tglmulai',set_value('tglmulai',@$batas->tglmulai),'','Tanggal Mulai',form_error('tglmulai'));
        //   echo form_input('tglakhir',set_value('tglakhir',@$batas->tglakhir),'','Tanggal Akhir',form_error('tglakhir'));
            echo form_submit('','Simpan','class="btn btn-primary px-5 rounded-pill float-right "');
          ?>
        </div>
      </div>
    
    </div>
    <?php
    
    echo form_close();
    ?>
  </div>
</div>