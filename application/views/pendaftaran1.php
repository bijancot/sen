
<section class="section" id="about">
	<div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="<?=base_url();?>assets/images/left-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text col-lg-5 col-md-12 col-sm-12 mobile-top-fix">
                    <div class="left-heading">
                        <h5>Pendaftaran</h5>
                    </div>
                    <div class="left-text">
											<div class="flash-data" data-flashdata="<?=$this->session->flashdata('success');?>"></div>
										
                        <p>Pendaftaran dibuka mulai tanggal 30 November 2020 sampai pada tanggal 8 Desember 2020.</p>
                        
<?php
		
    echo form_open("pendaftaran");
    echo form_input('namatim',set_value('namatim'),'','Nama Tim',form_error('namatim'));
		echo form_input('email',set_value('email'),'','Email Ketua Tim',form_error('email'));
		echo form_password('password',set_value('password'),'','Password',form_error('password'));
		echo form_input('nohp',set_value('nohp'),'','No Handphone Ketua Tim',form_error('nohp'));
		
		//echo form_dropdown('idpt', $pt,set_value('idpt'),'required="required"','Nama Perguruan Tinggi',form_error('idpt'));
		//echo form_dropdown('idlomba', $lomba,set_value('idlomba'),'required="required"','Kategori Lomba',form_error('idlomba'));
   
    echo form_submit('','Daftar','class="btn btn-primary px-5 rounded-pill float-right "');
    echo form_close();
?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
			</div>
            </div>
        </div>
    </section>
    
    
<section class="section" id="about">

    <div class="container">

        
     
    </div>
</section>
