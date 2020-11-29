
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
		
    $alasan = array(
        'name'        => 'alasan',
        'id'          => 'alasan',
        'value'       => set_value('alasan'),
        'rows'        => '50',
        'cols'        => '10',
        'style'       => 'width:50%',
        'class'       => 'form-control'
    );

    $idebisnis = array(
        'name'        => 'idebisnis',
        'id'          => 'idebisnis',
        'value'       => set_value('idebisnis'),
        'rows'        => '50',
        'cols'        => '10',
        'style'       => 'width:50%',
        'class'       => 'form-control'
    );
    echo form_open("pendaftaran");
    echo form_input('namatim',set_value('namatim'),'','Nama Start-up kamu (contoh : samsan-tech)',form_error('namatim'));
		echo form_input('email',set_value('email'),'','Email Kamu',form_error('email'));
		echo form_password('password',set_value('password'),'','Password',form_error('password'));
		echo form_input('nohp',set_value('nohp'),'','No Handphone',form_error('nohp'));
		//echo form_textarea($alasan);
		echo "<div class=\"form-group\"><label for=\"alasan\" class=\"font-weight-bold\">Ceritakan Alasan kamu ikut SENCA 2020</label>";
		echo form_textarea('alasan',set_value('alasan'),'','Ceritakan Alasan kamu ikut SENCA 2020',form_error('alasan'));
		echo "</div>";
		echo "<div class=\"form-group\"><label for=\"idebisnis\" class=\"font-weight-bold\">Kasih Tau Ide Bisnis Kamu dong! (MAX 1000 kata)</label>";
                echo form_textarea('alasan',set_value('alasan'),'','Kasih Tau Ide Bisnis Kamu dong!',form_error('alasan'));
                echo "</div>";
		//echo form_textarea('alasan',set_value('alasan'),'','Ceritakan Alasan kamu ikut SENCA 2020',form_error('alasan'));	
		//echo form_textarea('idebisnis',set_value('idebisnis'),'','Kasih Tau Ide Bisnis Kamu dong!',form_error('idebisnis')) </br>;
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
