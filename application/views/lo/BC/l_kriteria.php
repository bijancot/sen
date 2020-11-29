<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h3 mb-0 text-gray-800"><b>Atur KRITERIA PENILAIAN</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-6 text-right">
		<a href="<?php echo site_url('Juri');?>" class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Juri</a>
	</div>
</div>
<hr>
<div class="alert alert-primary alert-icon" role="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	Pilih tahap penilaian yang akan diset kategori -> pilih bidang lomba -> kemudian tambah/ubah data kategori penilaian
</div>
<br>
<div class="row">
	<div class="col-xl-4">
		<div class="card shadow show-grid">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Pilih tahap penilaian</h6>
			</div>

			<?php $no = 1; foreach ($tahap_penilaian as $key) { if ($cek_tahap == 0) {?>
				<div class="card-body p-3 mt-2 border-bottom">
					<div class="media-body mr-3">
						<p>Harap buat minimal <strong>1 Tahap Penilaian</strong></p>
						<button class="d-inline-block btn btn-sm btn-primary btn-block shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Tahap</button>
					</div>
				</div>
			<?php }else{?>
				<a href="#" class="card-body text-none p-3 mt-2 border-bottom tab-a" data-id="tab<?php echo $no;?>">
					<div class="media-body ml-2">
						<h5 class="media-heading"><strong>Tahap <?php echo $no;?></strong> - <span class="mb-2"><?php echo $key->nama_tahap;?>
						<?php if($key->aktif == 0){?><span class="badge badge-secondary btn-block pull-right mt-2">BELUM AKTIF</span>
						<?php }elseif($key->aktif == 1){?><span class="badge badge-primary btn-block pull-right mt-2">AKTIF</span>
						<?php }else{?><span class="badge badge-success btn-block pull-right mt-2">SELESAI</span>
					<?php }?>
				</h5>
			</div>
		</a>
		<?php $no++; } }?>

	</div>
</div>
<div class="col-lg-8 mb-4">
	<div class="card shadow show-grid">
		<div class="card-body">
			<div class="tab tab-active">
				<h5 class="text-center font-weight-bold mt-2">PILIH TAHAP PENILAIAN</h5>
			</div>
			<?php $no = 1; foreach ($tahap_penilaian as $key) { ?>
				<div class="tab" data-id="tab<?php echo $no;?>">
					<h5 class="mb-0 text-gray-800 font-weight-bold mt-2">Pilih bidang lomba untuk set kategori penilaian <span class="badge badge-warning d-inline">Tahap <?php echo $no;?> - <?php echo $key->nama_tahap;?></span></h5>
					<hr class="mt-2">

					<div class="row my-3">
						<?php if ($key->aktif == 2) { echo "<h3 class='col-md-12 mt-3'><center>TAHAP INI TELAH SELESAI</center></h3>";}else{
						foreach ($get_lomba as $lomba) { ?>
							<div class="col-md-4 mb-4">
								<a href="<?php echo site_url('Penilaian/DataKriteria/'.$key->id_tahap.'/'.$lomba->id);?>" class="card text-none text-center">
									<div class="card-block p-2">
										<h5 class="card-title"><?php echo $lomba->namalomba;?></h5>
										<h3><i class="fas fa-box-open fa-3x"></i></h3>
									</div>
								</a>
							</div>
						<?php } }?>
					</div>
				</div>
				<?php $no++; } ?>
			</div>
		</div>
	</div>
</div>