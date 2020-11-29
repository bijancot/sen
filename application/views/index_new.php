

<div class="welcome-area" id="welcome">

	<!-- ***** Header Text Start ***** -->
	<div class="header-text">
		<div class="container">
			<div class="row">
				<div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
					<h1>WEBINAR SERIES LOMBA NASIONAL KREATIFITAS MAHASISWA</h1>
					<h3>LO KREATIF 2020</h3><p></p>
					<a type="button" class="main-button-slider" data-toggle="modal" data-target="#daftarbinar">Daftar</a>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
					<img src="<?=base_url();?>assets/images/s_h.png" class="rounded img-fluid d-block mx-auto mt-4" alt="First Vector Graphic">
				</div>
			</div>
		</div>
	</div>
	<!-- ***** Header Text End ***** -->


	<!-- ***** Features Big Item Start ***** -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/som-components/css">
	<script src="https://digitalguidelines.michigan.gov/cdn/3.2.0/som-components.js"></script>
	<style type="text/css">
		.upload-btn-wrapper {
			position: relative;
			overflow: hidden;
			display: inline-block;
		}

		.btnup {
			border: 2px solid #ced4da;
			color: gray;
			background-color: white;
			padding: 5px 15px;
			border-radius: 50px;
		}

		.upload-btn-wrapper input[type=file] {
			font-size: 100px;
			position: absolute;
			left: 0;
			top: 0;
			opacity: 0;
		}

		.select2-container--bootstrap {
			display: inline-block;
			width: 100% !important;
		}

		.hide-pt{
			display: none !important;
		}

		.show-pt{
			display: block;
		}
	</style>

	<!-- ***** Welcome Area Start ***** -->

</div>

<!-- ***** Welcome Area End ***** -->
<section class="section" id="about">
	<div class="container">
		<?php foreach ($seminar as $value) { ?>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-6">
					<h4 class="display-4 text-center" style="color: #007bff;"><strong><?php echo $value->nama;?></strong></h4>
					<hr>

					<p><?php echo str_replace("<b>", "", substr($value->keterangan, 0, 250));?>...</p>
						<a href="<?php echo site_url('Seminar/'.$value->kode_seminar);?>" type="button" class="btn btn-info text-center bdr-50 cap" style="margin-right: 10px">Detail Seminar</a>
						<a href="<?php echo site_url('Seminar/'.$value->kode_seminar);?>" type="button" class="main-button-slider text-white btnn cap">Daftar Seminar</a>
					</div>
					<div class="col-md-6">
					<?php if ($this->uri->segment(2) == "WB-NS-01") { ?>
						<img src="<?php echo base_url();?>assets/images/seminar/<?php echo $value->header;?>" style="width: 100%; border-radius: 6px;">
					<?php }else{?>
						<img src="<?php echo base_url();?>assets/images/seminar/s_1.jpg" style="width: 100%; border-radius: 6px;">
					<?php }?>
					</div>
				</div>
				<hr>
			<?php }?>
			<!--	<br>-->

			<!--	<h4 class="display-4 text-center" style="color: #007bff;"><strong>Webinar Seri 2</strong></h4>-->

			<!--	<br><br>-->

			<!--	<p style="text-indent: 50px;">Seminar Nasional Daring Seri 2 ini akan mengangkat tema <strong>“Membangun-->
				<!--	Personal Branding melalui Karya Kreatif”</strong>. Kegiatan akan dilaksanakan pada-->
				<!--	pukul 13.00 – 17.00. Peserta kegiatan seminar ini adalah seluruh peserta-->
				<!--	lomba, mahasiswa lain non peserta lomba, perwakilan perguruan tinggi, tamu-->
				<!--	undangan lain serta panitia.-->
				<!--</p>-->

				<br>

				<!-- jadwal -->
				<h4 class="display-4 text-center" style="color: #007bff;"><strong>Jadwal Webinar Series</strong></h4>
				<br><br>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Kegiatan</th>
							<th scope="col">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Webinar Seri 1: <strong>“Berkarya Kreatif
							pada abad 21”</strong></td>
							<td>12 November 2020</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Webinar Seri 2: <strong>“Membangun
							Personal Branding melalui Karya Kreatif”</strong></td>
							<td>18 November 2020</td>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
		<div id="daftarbinar" class="modal fade" role="dialog" >
			<div class="modal-dialog" role="document">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Pendaftaran Series WEBINAR</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
					<form method="POST" action="<?php echo site_url('SeminarH/DaftarSeminar');?>" enctype="multipart/form-data">
						<div class="form-group">
							<small class="text-dark">Bagi <b class="text-danger">Peserta LOMBA LO - Kreatif</b>, yang telah melakukan pembayaran lomba - <i>tidak perlu melakukan pendaftaran WEBINAR</i>.</small>
						</div>
						<div class="form-group">
							<label for="kodeseminar" class="font-weight-bold">Series WEBINAR</label> <small class="text-danger">*</small>
							<input type="hidden" name="kodeseminar" class="form-control" value="<?php echo $value->kode_seminar;?>,<?php echo $value->nama;?>" required="required" readonly="readonly">
							<input type="text" class="form-control" value="<?php echo $value->nama;?> - <?php echo $value->tema;?>" required="required" readonly="readonly">
						</div>
						<div class="form-group">
							<label for="pt" class="font-weight-bold">Pilih Asal Perguruan Tinggi</label><br class="mb-0 mt-0"><small class="text-secondary">PTN (Perguruan Tinggi Negeri) / PTS (Perguruan Tinggi Swasta)</small><br>

							<button type="button" class="btn btn-primary btn-sm mr-1" id="ptn">PTN</button>
							<button type="button" class="btn btn-primary btn-sm" id="pts">PTS</button>
							<br><br>
							<select name="pts" id="i-pts" class="form-control hide-pt" data-placeholder="Pilih Asal Perguruan Tinggi SWASTA">
								<option value="0">Pilih Asal Perguruan Tinggi SWASTA</option>
								<?php foreach ($pt as $key) {?>
									<option value="<?php echo $key?>"><?php echo $key?></option>
								<?php }?>
							</select>
							<input type="text" id="i-ptn" name="ptn" class="form-control hide-pt" placeholder="Nama Perguruan Tinggi Negeri">
						</div>
						<div class="form-group">
							<label for="nama" class="font-weight-bold">Nama Lengkap</label> <small class="text-danger">*</small>
							<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" required="required">
						</div>
						<div class="form-group">
							<label for="email" class="font-weight-bold">Alamat Email</label> <small class="text-danger">*</small>
							<input type="email" name="email" class="form-control" placeholder="Alamat Email Anda" required="required">
						</div>
						<div class="form-group">
							<label for="nohp" class="font-weight-bold">Nomor Telepon</label> <small class="text-danger">*</small>
							<input type="number" name="nohp" class="form-control" placeholder="Nomor Telepon Anda" required="required">
						</div>
								<div class="form-group">
									<small class="text-secondary">Bagi mahasiswa non peserta lomba yang <b>INGIN MENDAPATKAN</b> E-sertifikat harap melakukan <b>pembayaran</b> sebesar <strong>Rp. 10.000</strong> ke nomor rekening <b>BNI 0617552678 an APTISI Wilayah VII</b><br><br>
										<span class="text-danger">*)</span> <i>Harap mengecek NO REK dan An. sebelum mentransfer</i>.</small>
									</div>
						<div class="form-group mb-0">
							<div class="row mb-1">
								<div class="col-md-12">
									<img id="previewImg" class="prev-img hidden" src="https://www.tutorialrepublic.com/examples/images/transparent.png" alt="Placeholder">
								</div>
							</div>
							<div class="row mb-0 mt-0">
								<div class="col-md-12">
									<div class="upload-btn-wrapper">
										<button class="btnup" type="button">Upload bukti</button>
										<input type="file" name="bk_bayar" onchange="previewFile(this);">
									</div>
									<button class="btn btn-primary px-5 rounded-pill pull-right" type="submit">Daftar</button>
								</div>
							</div>
						</div>
						<small class="text-warning">Upload bukti pembayaran berupa file gambar, *) <span class="text-danger">JPG</span>, <span class="text-danger">PNG</span>, <span class="text-danger">JPEG</span>. Max 2MB.</small>
						<hr class="mb-1 mt-1">
					</form>
							</div>
						</div>
					</div>
				</div>
				<?php if ($this->session->flashdata('notif')) { ?> 
					<div class="modal hide fade" id="notifikasi" role="dialog" tabindex="-1" >
						<div class="modal-dialog modal-dialog-centered" role="document">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-body" style="padding-bottom: 0px !important;">
									<button type="button" class="close alcs" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<som-alert type="warning" headline="Notifikasi!"><?php echo $this->session->flashdata('notif'); ?>
								</som-alert>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(window).on('load',function(){
						$('#notifikasi').modal('show');
					});
				</script>
			<?php }elseif($this->session->flashdata('success')) { ?>
				<div class="modal hide fade" id="notifikasi" role="dialog" tabindex="-1" >
					<div class="modal-dialog modal-dialog-centered" role="document">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-body" style="padding-bottom: 0px !important;">
								<button type="button" class="close alcs" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<som-alert type="success" headline="Notifikasi!"><?php echo $this->session->flashdata('success'); ?>
							</som-alert>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(window).on('load',function(){
					$('#notifikasi').modal('show');
				});
			</script>
		<?php }?>
		<script>
			$(window).on('load',function(){
				$('.select2-container--bootstrap').addClass('hide-pt');
			});
			$(document).ready(function() {
				$('#ptn').click(function() {
					$("#i-ptn").removeClass('hide-pt');
					$('.select2-container--bootstrap').addClass('hide-pt');
				});
				$('#pts').click(function() {
					$('.select2-container--bootstrap').removeClass('hide-pt');
					$("#i-ptn").addClass('hide-pt');
				});
			});
		</script>
		<script>
			function previewFile(input){
				$(".prev-img").removeClass('hidden');
				var file = $("input[type=file]").get(0).files[0];

				if(file){
					var reader = new FileReader();

					reader.onload = function(){
						$("#previewImg").attr("src", reader.result);
					}

					reader.readAsDataURL(file);
				}
			}
		</script>
		<!-- ***** Features Big Item End ***** -->




		<section class="section" id="about">

			<div class="container">

				<h4 class="display-4 text-center" style="color: #007bff;"><strong>Co-Host</strong></h4><br>
				<div class="text-center">
					<img src="/img/cohost/UMM.png" alt="UMM" height="100" width="100">
					<img src="/img/cohost/Stiki.png" alt="STIKI" height="100" width="100">
					<img src="/img/cohost/Hang Tuah.jpg" alt="Hang Tuah" height="100" width="100">
					<img src="/img/cohost/UNTAG.png" alt="UNTAG" height="100" width="100">
					<img src="/img/cohost/UWKS.png" alt="UWKS" height="100" width="110">
					<img src="/img/cohost/UNISMA.png" alt="UNISMA" height="100" width="100">
					<img src="/img/cohost/Adi Buana.png" alt="Adi Buana" height="110" width="100">
					<img src="/img/cohost/Logo Narotama.jpg" alt="NAROTAMA" height="100" width="300">
					<img src="/img/cohost/UBAYA.png" alt="UBAYA" height="100" width="100">
					<img src="/img/cohost/UNISBA.png" alt="UNISBA" height="100" width="100">
					<img src="/img/cohost/Universitas-Wisnuwardhana-Malang.jpg" alt="Universitas Wisnuwardhana Malang" height="100" width="100">
					<img src="/img/cohost/UNIVERSITAS KRISTEN PETRA.png" alt="UNIVERSITAS KRISTEN PETRA" height="100" width="100">
					<img src="/img/cohost/Universitas Widya Mandala Surabaya.png" alt="Universitas Widya Mandala Surabaya" height="100" width="100">
				    </br>
				    <img src="/img/cohost/UNIPMA.png" alt="UNIPMA" height="100" width="100">
				    <img src="/img/cohost/Universitas Kanjuruhan Malang.jpeg" alt="Universitas Kanjuruhan Malang" height="100" width="100">
				    <img src="/img/cohost/Logo-UNIPRA.png" alt="UNIPRA" height="100" width="100">
				</div></br></br></br>

				<h4 class="display-4 text-center" style="color: #007bff;"><strong>Media Partners</strong></h4></br>
				<div class="text-center">
					<img src="/img/media/Tirto.png" alt="Tirto" height="100" width="100">&nbsp;&nbsp;&nbsp;
					<img src="/img/media/Andi1.png" alt="Andi1" height="100" width="100">&nbsp;&nbsp;&nbsp;
					<img src="/img/media/Andi2.png" alt="Andi2" height="75" width="75">&nbsp;&nbsp;&nbsp;
					<img src="/img/media/Andi3.png" alt="Andi3" height="75" width="200">&nbsp;&nbsp;&nbsp;
					<img src="/img/media/Logo radar.png" alt="Radar Malang" height="50" width="325">&nbsp;&nbsp;&nbsp;
					<img src="/img/media/ameg.jpeg" alt="Ameg" height="75" width="149">
				</div></br></br></br>

				<h4 class="display-4 text-center" style="color: #007bff;"><strong>Industry Partners</strong></h4></br>
				<div class="text-center">
					<img src="/img/industry/Sosialoka - Vertical2.png" alt="Sosialoka" height="100" width="110">&nbsp;&nbsp;&nbsp;
					<img src="/img/industry/Telkomsel.jpeg" alt="Telkomsel" height="100" width="200">
				</div></br></br>
			</div>
		</section>