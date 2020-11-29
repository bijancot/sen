<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-9">
		<h1 class="h3 mb-0 text-gray-800"><b>Dashboard LO</b> | <strong><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></strong></h1>
	</div>
</div>
<!-- Content Row -->
<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (TOTAL TIM)</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim_all;?> TIM</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (Siap VERIF)</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim;?> / <?php echo $total_tim_all;?> TIM</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-sitemap fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">TIM <span class="text-success"><i class="fa fa-check-circle-o text-success"></i> Verifikasi</span></div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim_ver;?> / <?php echo $total_tim;?> TIM</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-gavel fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-sm font-weight-bold text-danger text-uppercase mb-1">TIM <span class="text-danger"><i class="fa fa-eraser text-danger"></i> DIREJECT</span></div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim_rec;?> TIM</div>
						</div>
						<div class="col-auto">
							<i class="fa fa-eraser fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php if ($this->session->flashdata('notif')) { ?> 
		<!-- Menampilkan Notif -->
		<div class="alert alert-warning shadow alert-icon" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php echo $this->session->flashdata('notif'); ?>
		</div>
		<!-- Menampilkan Notif -->
		<br>
	<?php }else{ ?>
	<div class="alert alert-primary shadow alert-icon" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<b>Harap matikan IDM Integration di menu Opsi -> Kemudian uncheck Google Chrome/Microsoft Edge/Mozilla Firefox Sesuai Web Browser yang anda gunakan.</b>
		<hr class="mt-1 mb-2">
		<b>Disarankan menggunakan Tab samaran jika menggunakan web browser chrome.</b>
	</div>
	<br>
	<?php }?>
	<div class="row mb-3">
		<div class="col-lg-12">
			<div class="card shadow">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Cortana</h5>
				</div>
				<div class="card-body">
					<p><b>Mengacu pada pedoman, maka</b> :</p>
					<ol>
						<li>Data Anggota yg diisikan di web harus sama dengan KTM yg diunggah</li>
						<li>Poster dan Video Teaser</li>
						<li>Hashtag dan tag</li>
						<li>Karya tidak mengandung sara, pornografi dan sejenisnya</li>
						<li>Karya tidak plagiat dan belum pernah memenangkan lomba apapun (cek Surat Pernyataan)</li>
						<li>Poster, Video Teaser dan Karya harus memuat logo APTISI Wilayah VII, LO KREATIF dan kampus masing2</li>
						<li>Jumlah like, komen atau share Video Teaser (masih proses build systemnya)</li>
					</ol>

					<p>Semua peserta yg <u>masuk ke seleksi berkas</u> adalah peserta yg <b>sudah bayar dan divalidasi</b></p>

					<p>Apabila ada dokumen yg tidak lengkap, peserta diberi toleransi oleh LO untuk segera melengkapi, jika tidak mampu melengkapi hingga batas waktu yg diberikan maka akan direject dan tidak masuk ke seleksi tahap I.</p>
				</div>
			</div>
		</div>
	</div>