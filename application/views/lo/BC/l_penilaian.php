<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-4">
		<h1 class="h3 mb-0 text-gray-800"><b>Penilaian</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-8 text-right">
		<a href="<?php echo site_url('Penilaian/Tahap');?>" class="d-none d-md-inline-block btn btn-sm btn-success shadow-sm mt-1"><i class="fa fa-paint-brush fa-sm text-white-50"></i> TAHAP penilaian</a>
		<a href="<?php echo site_url('Penilaian/Kriteria');?>" class="d-none d-md-inline-block btn btn-sm btn-info shadow-sm mt-1"><i class="fa fa-paint-brush fa-sm text-white-50"></i> KRITERIA penilaian</a>
		<a href="<?php echo site_url('Juri');?>" class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Juri</a>
		<button class="btn d-md-none btn-primary btn-block shadow-sm mt-2" data-toggle="modal" data-target="#mainmenu"><i class="fas fa-box-open fa-sm text-white-50"></i> PENILAIAN MAIN MENU</button>
	</div>
</div>
<!-- Content Row -->
<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (SIAP NILAI)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim;?> TIM</div>
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
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Jumlah Juri</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_juri;?> JURI</div>
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
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<!-- <div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-success text-uppercase mb-1">Tahap Penilaian</div>
						<div class="row no-gutters align-items-center">
							<?php
								if (!empty($get_stage)) {
										echo "<div class='h5 mb-0 mr-3 font-weight-bold text-gray-800'>".$get_stage."</div>";
								}else{
									echo "<div class='h5 mb-0 mr-3 font-weight-bold text-gray-800'>SELESAI</div>";
								}
							?>
						</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard fa-2x text-gray-300"></i>
					</div>
				</div> -->
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
<!-- 						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
	<div class="h5 mb-0 font-weight-bold text-gray-800">18</div> -->
</div>
<div class="col-auto">
	<!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
</div>
</div>
</div>
</div>
</div>
</div>
<hr>
<div class="row">

	<div class="col-xl-4">
		<ul class="card shadow show-grid">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Tahap Penilaian</h6>
			</div>
			<?php if($cek_tahap > 0){ if($cek_siap == TRUE){ ?>
				<div class="card-body">
					<div class="pull-left" href="#">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<div class="media-body">
						<p>Harap <strong>LENGKAPI</strong> <span class="text-danger">KRITERIA penilaian</span> dalam <span class="text-success">setiap bidang lomba</span> agar Tahap penilaian dapat berjalan tanpa <b class="text-danger">ERROR</b></p>
						<a href="<?php echo site_url('Penilaian/Kriteria');?>" class="btn btn-primary btn-sm btn-block">Atur KRITERIA</a>
					</div>
				</div>
			<?php }else{ $no = 1; foreach ($tahap_penilaian as $key) { if($key->aktif == 0){$aktif = "inactive"; $tahap = "";}elseif($key->aktif== 1){$aktif = "text-primary"; $tahap = "<small class='badge badge-primary d-inline'>BERLANGSUNG</small>";}else{$aktif = ""; $tahap = "<small class='badge badge-warning d-inline'>SELESAI</small>";}?>
			<li id="tahap1" class="col-md-12 border-bottom <?php echo $aktif;?>">
				<div class="media ml-2">
					<div class="pull-left" href="#">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<div class="media-body">
						<h5 class="media-heading"><strong>Tahap <?php echo $no;?></strong> - <?php echo $key->nama_tahap;?></h5><?php echo $tahap;?>
					</div>
				</div>
			</li>
			<?php $no++; }}}else{?>
				<div class="card-body">
					<div class="pull-left" href="#">
						<span class="glyphicon glyphicon-user"></span>
					</div>
					<div class="media-body">
						<p>Harap buat minimal <strong>1 Tahap Penilaian</strong></p>
						<a href="<?php echo site_url('Penilaian/Tahap');?>" class="btn btn-primary btn-sm btn-block">Set Tahap</a>
					</div>
				</div>
			<?php }?>
		</ul>
	</div>
	<div class="col-lg-8 mb-4">
		<!-- Illustrations -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
			</div>
			<div class="card-body">
				<p><b class="text-primary">BAGIAN PENILAIAN</b> ini masih dalam <b class="text-warning"><u>TAHAP UJI COBA</u></b>, setelah semua fitur yang telah <u>selesai</u> telah di <i>TES</i> dan dipastikan <b class="text-success">AMAN</b>. <b>BAGIAN PENILAIAN</b> ini akan memasuki <b class="text-info">TAHAP DEMO</b> dimana dilakukan penambahan <i>fitur</i> hingga dianggap <b>SIAP</b>.</p>
				<p><b>Fitur utama dalam bagian ini yaitu</b>:</p>
				<ul>
					<li>Managemen <b class="text-success">TAHAP PENILAIAN</b> (<i>Tambah</i>, <i>tunda</i>, <i>ubah</i>, <i>hapus</i>) -> Fitur ini merupakan fitur <b>PONDASI</b> fitur lain. <u>HARAP IKUTI PETUNJUK</u> pada panel <b class="text-primary">TAHAP PENILAIAN</b> pada saat memakai.</li>
					<li>Managemen <b class="text-info">KRITERIA PENILAIAN</b> (<i>Tambah</i>, <i>ubah</i>, <i>hapus</i>) -> Harap melengkapi semua <u><i>KRITERIA PENILAIAN</i></u> pada setiap bidang lomba serta mengisi <b>SEBELUM</b> <i class="text-danger">WAKTU TAHAP</i> yang dipilih <u>memasuki</u> Tahap <b>AKTIF</b> / <b>SELESAI</b>!</li>
				</ul>
			</div>
		</div>
		<section class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary text-center">Cortana</h6>
			</div>
			<div class="container work-process  pb-5 pt-5">
				<!-- ============ step 1 =========== -->
				<div class="row proccess--bottom">
					<div class="col-md-5">
						<div class="process--box process--left" data-aos="fade-right" data-aos-duration="1000">
							<div class="row">
								<div class="col-md-5">
									<div class="process--step">
										<p class="m-0 p-0">Step</p>
										<h2 class="m-0 p-0">01</h2>
									</div>
								</div>
								<div class="col-md-7">
									<h5 class="font-weight-bold">Atur Tahap Penilaian</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ============ step 2 =========== -->
				<div class="row proccess--bottom process--up">
					<div class="col-md-5 offset-md-7">
						<div class="process--box process--right" data-aos="fade-left" data-aos-duration="1000">
							<div class="row">
								<div class="col-md-5">
									<div class="process--step">
										<p class="m-0 p-0">Step</p>
										<h2 class="m-0 p-0">02</h2>
									</div>
								</div>
								<div class="col-md-7">
									<h5 class="font-weight-bold">Atur Kriteria Penilaian</h5>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- ============ step 3 =========== -->
				<div class="row proccess--bottom">
					<div class="col-md-5">
						<div class="process--box process--left" data-aos="fade-right" data-aos-duration="1000">
							<div class="row">
								<div class="col-md-5">
									<div class="process--step">
										<p class="m-0 p-0">Step</p>
										<h2 class="m-0 p-0">03</h2>
									</div>
								</div>
								<div class="col-md-7">
									<h5 class="font-weight-bold">Tambahkan Juri</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ============ step 4 =========== -->
				<div class="row proccess--bottom process--up">
					<div class="col-md-5 offset-md-7">
						<div class="process--box process--right" data-aos="fade-left" data-aos-duration="1000">
							<div class="row">
								<div class="col-md-5">
									<div class="process--step">
										<p class="m-0 p-0">Step</p>
										<h2 class="m-0 p-0">04</h2>
									</div>
								</div>
								<div class="col-md-7">
									<h5 class="font-weight-bold">Assign & Notify Juri</h5>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</section>
	</div>
</div>

<!-- MODAL -->
<div id="mainmenu" class="modal fade" role="dialog" tabindex="-1" >
	<div class="modal-dialog modal-dialog-centered modal-sm m-auto" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<a href="#" class="btn btn-sm btn-primary btn-block shadow-sm"><i class="fa fa-paint-brush fa-sm text-white-50"></i> Set kategori penilaian</a>
				<a href="#" class="btn btn-sm btn-warning btn-block shadow-sm"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Juri</a>
				<a href="#" class="btn btn-sm btn-success btn-block shadow-sm"><i class="fa fa-file-excel-o fa-sm text-white-50"></i> Download file EXCEL</a>
				<a href="#" class="btn btn-sm btn-danger btn-block shadow-sm"><i class="fa fa-refresh fa-sm text-white-50"></i> one click reset</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm btn-block" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>