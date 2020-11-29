<div class="card shadow mb-4">
	<div class="card-header bg-warning py-3">
		<h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
		<small class="form-text text-muted">
      		Gunakan halaman  ini untuk mengisi data anggota dan pembimbing.
    	</small>
	</div>
    <div class="card-body">
		<?php
			echo $this->session->flashdata('message');
			echo validation_errors(); 
			echo form_open_multipart("");
		?>
		<div class="row">
			<div class="col-5">
<?php		
    echo form_input('namaketua',set_value('namaketua',$anggota->namaketua),'readonly','Nama Ketua',form_error('namaketua'));
	echo form_input('',$peserta->email,'readonly','Email Ketua',form_error('email'));
	echo form_input('nohp',set_value('nohp',$peserta->nohp),'readonly','No HP Ketua',form_error('nohp'));
	echo "<div class=\"bg-light p-2\">".form_input('anggota2',set_value('anggota2',$anggota->anggota2),'readonly','Nama Anggota 2',form_error('anggota2'));
	echo form_email('email2',set_value('email2',$anggota->email2),'readonly','Email Anggota 2',form_error('email2'));
	echo form_input('nohp2',set_value('nohp2',$anggota->nohp2),'readonly','No HP Anggota 2',form_error('nohp2'));
	echo "</div>".form_input('anggota3',set_value('anggota3',$anggota->anggota3),'readonly','Nama Anggota 3',form_error('anggota3'));
	echo form_email('email3',set_value('email2',$anggota->email3),'readonly','Email Anggota 3',form_error('email3'));
	echo form_input('nohp3',set_value('nohp3',$anggota->nohp3),'readonly','No HP Anggota 3',form_error('nohp3'));
	?>			
			</div>
			<div class="col-5">
<?php
	echo "<div class=\"bg-light p-2\">".form_input('anggota4',set_value('anggota4',$anggota->anggota4),'readonly','Nama Anggota 4',form_error('anggota4'));
	echo form_email('email4',set_value('email2',$anggota->email4),'readonly','Email Anggota 4',form_error('email4'));
	echo form_input('nohp4',set_value('nohp4',$anggota->nohp4),'readonly','No HP Anggota 4',form_error('nohp4'));

	echo "</div><div class=\" p-2\">".form_input('anggota5',set_value('anggota5',$anggota->anggota5),'readonly','Nama Anggota 5',form_error('anggota5'));
	echo form_email('email5',set_value('email5',$anggota->email5),'readonly','Email Anggota 5',form_error('email5'));
	echo form_input('nohp5',set_value('nohp5',$anggota->nohp5),'readonly','No HP Anggota 5',form_error('nohp5'))."</div>";

	echo "<div class=\"bg-light p-2\">".form_input('instagram',set_value('instagram',$anggota->instagram),'readonly','Nama instagram',form_error('instagram'));
	
	//echo form_hidden('ktm_',set_value('ktm_',$anggota->ktm, FALSE));
	// echo form_upload('ktm','readonly','readonly','KTM',form_error('ktm'),"Kumpulan semua KTM anggota termasuk ketua tim dalam bentuk <strong class=\"text-danger\">file pdf</strong>, dengan ukuran maksimal 500kb.  Nama file dapat dikosongi jika pernah mengunggahnya");
	echo '<p><label for="ktm" class="font-weight-bold">KTM</label><br><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;'.basename($anggota->ktm).'</p></div>';

	echo form_input('pembimbing',set_value('pembimbing',$anggota->pembimbing),'readonly','Nama Pembimbing',form_error('pembimbing'));		
	echo form_input('nidn',set_value('nidn',$anggota->nidn),'readonly','NIDN',form_error('nidn'));		
	?>			
			</div>
		</div>
<?php
    echo anchor('dashboard', 'Kembali', 'class="btn btn-primary px-5 rounded-pill float-right"');
    // echo form_submit('','Simpan','class="btn btn-primary px-5 rounded-pill float-right"');
    echo form_close();
?>
    </div>

</div>
