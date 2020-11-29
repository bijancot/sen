
<?php
$data['konfigurasi'] = $konfigurasi;
$this->load->view('batas',$data);
?>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta</h6>
            </div>
			<?= $this->session->flashdata('message'); ?>
            <div class="card-body">
			  <div class="table-responsive">
                  <?php
		// menampilkan data berita menggunakan library table
		$template = array('table_open' => '<table id="dataTable" class="table table-striped table-bordered1 table-sm table-hover">',
		                  'thead_open' => '<thead class="thead-dark">');
		$this->table->set_template($template);
		$this->table->set_heading('Nama Tim','Nama Ketua','Email','PT','Lomba','Status','Aksi');
		$this->table->set_footer(array('Nama Tim','Nama Ketua','Email','PT','Lomba','Status','Aksi'));
		
		foreach ($peserta as $row)
		{
			$this->table->add_row(
				$row->namatim,
				$row->namaketua,
				$row->email,
				$row->namapt,
				$row->namalomba,
				$row->status,
				anchor("peserta/$row->id",'Validasi','class="btn btn-primary btn-sm"') ."  ". anchor("anggota/detil/$row->id",'Anggota','class="btn btn-primary btn-sm"')
			);
			
		} 
		
		echo $this->table->generate();
	?>
	
              </div>
            </div>
          </div>