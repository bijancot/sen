          

          <!-- DataTales Example -->

          <div class="card shadow mb-4">

            <div class="card-header py-3">

              <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>

            </div>

            <div class="card-body  col-7">

              <?php

		

    echo form_open_multipart("");
		//echo form_hidden('kategori',$peserta->namalomba);

    echo form_input('namaketua',set_value('namaketua'),'','Nama Ketua',form_error('namaketua'));

		echo form_input('',$peserta->email,'readonly','Email Ketua',form_error('email'));

		echo form_input('nohp',set_value('nohp',$peserta->nohp),'','No HP Ketua',form_error('nohp'));

		

		echo "<hr>".form_input('anggota2',set_value('anggota2'),'','Nama Anggota 2',form_error('anggota2'));

		echo form_email('email2',set_value('email2'),'','Email Anggota 2',form_error('email2'));

		echo form_input('nohp2',set_value('nohp2'),'','No HP Anggota 2',form_error('nohp2'));

		

		echo "<hr>".form_input('anggota3',set_value('anggota3'),'','Nama Anggota 3',form_error('anggota3'));

		echo form_email('email3',set_value('email3'),'','Email Anggota 3',form_error('email3'));

		echo form_input('nohp3',set_value('nohp3'),'','No HP Anggota 3',form_error('nohp3'));

		

		echo "<hr>".form_input('anggota4',set_value('anggota4'),'','Nama Anggota 4',form_error('anggota4'));

		echo form_email('email4',set_value('email4'),'','Email Anggota 4',form_error('email4'));

		echo form_input('nohp4',set_value('nohp4'),'','No HP Anggota 4',form_error('nohp4'));

		echo "<hr>".form_input('anggota5',set_value('anggota5'),'','Nama Anggota 5',form_error('anggota5'));

		echo form_email('email5',set_value('email5'),'','Email Anggota 5',form_error('email5'));

		echo form_input('nohp5',set_value('nohp5'),'','No HP Anggota 5',form_error('nohp5'));

		echo form_input('instagram',set_value('instagram'),'','Nama instagram',form_error('instagram'));

		//echo form_upload('ktm','','','KTM',form_error('ktm'),"File PDF yang berisi kumpulan semua KTM anggota termasuk ketua tim dalam bentuk file pdf, dengan ukuran maksimal 500kb");
		

		//echo form_input('pembimbing',set_value('pembimbing'),'','Nama Pembimbing',form_error('pembimbing'));		

		//echo form_input('nidn',set_value('nidn'),'','NIDN',form_error('nidn'));




    echo form_submit('','Simpan','class="btn btn-primary px-5 rounded-pill float-right "');

    echo form_close();

?>



            </div>

          </div>
