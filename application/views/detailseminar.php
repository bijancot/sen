

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/som-components/css">
<link href="<?=base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
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
	.text-14{
		font-size: 14px !important;
	}
	@media (max-width:767px) {
		.up {
			top: 80px !important;
			position: relative;
		}
		.iblock{
			display: inline-block;
		}
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

<!-- ***** Welcome Area End ***** -->
<section class="section" id="about">
	<div class="container up">
		<?php foreach ($seminar as $value) { ?>
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-6 mb-2">
					<h5 class="display-4 mb-0"><strong style="color: #007bff;"><?php echo $value->nama;?></strong> <a href="https://api.whatsapp.com/send?text=<?php echo base_url(uri_string()); ?>" target="_blank" class="text-secondary pull-right"><i class="fa fa-whatsapp"></i></a></h5>
					<p class="mt-0 mb-2"><?php echo $value->tema;?></p>
					<hr>
						<img src="<?php echo base_url();?>assets/images/seminar/<?php echo $value->header;?>" style="width: 100%; border-radius: 6px;">
				</div>
				<div class="col-md-6">
				    <hr>
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
									<small class="text-secondary">Bagi mahasiswa non peserta lomba yang <b class="text-danger">INGIN MENDAPATKAN</b> <strong class="text-primary">E-SERTIFIKAT</strong> harap melakukan <b class="text-danger">pembayaran</b> sebesar <strong>Rp. 10.000</strong> ke nomor rekening:<br> <b class="text-danger">BNI 0617552678 an APTISI Wilayah VII</b>, Dengan keterangan "Pembayaran WEBINAR I"<br><br>
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
			<hr>
			<div class="row">
				<div class="col-md-12">
					<table class="table">
						<tbody style="border: 1px solid #ddd;">
							<tr>
								<td colspan="3">
									<h5 class="display-4 mb-0"><strong style="color: #007bff;"><?php echo $value->nama;?></strong> <span style="font-size: 18px" class="iblock"><i><?php echo $value->tema;?></i></span><a href="https://api.whatsapp.com/send?text=<?php echo base_url(uri_string()); ?>" target="_blank" class="text-secondary pull-right"><i class="fa fa-whatsapp"></i></a></h5>
								</td>
							</tr>
							<tr>
								<td width="35%"><strong>Tag</strong></td>
								<td width="30%"><strong>Tanggal & Waktu</strong></td>
								<td><strong>NaraSumber</strong></td>
							</tr>
							<tr style="border-top: 1px solid #ddd;">
								<td><h4 class="badge badge-success text-14" style="display: inline-block;">Berkarya</h4> <h4 class="badge badge-info text-14">LoKreatif</h4> <h4 class="badge badge-primary text-14">Nasional</h4></td>
								<td><?php echo $value->tanggal;?></td>
								<td><?php if ($this->uri->segment(2) == "WB-NS-01") { ?>
									<ul>
										<li><b>Livi Zheng</b>,</li>
										<li><b>Miftah Faridh Oktofani</b>,</li>
										<li><b>Dessy Aliandrina</b></li>
									</ul>
								<?php }else{?>
									<ul>
										<li><b>Atmaji Sapto Anggoro</b>,</li>
										<li><b>Sunavip Ra Indrata, S. Kom</b>,</li>
										<li><b>Bimoyadi</b></li>
										</ul>  <?php }?>
									</td>
									<br>
								</tr>
								<tr>
									<td colspan="3"><strong>Tema</strong> <i style="font-size: 18px"><?php echo $value->tema;?></i></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<br>
				<br>
				<h5 class="text-center" style="color: #007bff; font-size: 38px;"><strong>NaraSumber WEBINAR</strong></h5>
				<br>
				<div class="row">
					<?php if ($this->uri->segment(2) == "WB-NS-01") { ?>
						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/livi.jpg" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Livi Zheng</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">Producer & Director</p>

								</div>

							</div>

						</div>

						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/Miftah.jpg" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Miftah Faridh Oktofani</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">Co-Founder & CBDO PT. Indonesia Digital Ent (IDE Music)<br>Founder & CEO PT. Trinusa Sosialoka Indonesia (sosialoka.id)</p>

								</div>

							</div>

						</div>

						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/dessy.jpeg" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Dessy Aliandrina</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">Designer and Social Entrepreneur</p>

								</div>

							</div>

						</div>
					<?php }else{?>

						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/sunavip.jpeg" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Sunavip Ra Indrata, S. Kom</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">Direktur PT Arema Televisi Malang (Arema TV), PT Radio Andhika Lugas Swara (Radio City Guide 911 FM), dan Arema Media Grup<br>Wartawan Malang Post</p>

								</div>

							</div>

						</div>
						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/atmaji.jpg" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Atmaji Sapto Anggoro</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">CEO tirto.id</p>

								</div>

							</div>

						</div>

						<div class="col-md-4 col-xs-12">

							<div class="card">

								<img class="rounded-circle" src="<?= base_url(); ?>assets/images/juri/bimoyadi.png" alt="Circle image" style="margin: 15px auto; width: 300px; height: 300px;">

								<div class="card-body text-center">

									<h5 class="card-title">Bimoyadi</h5>

									<p style="font-style:italic; font-size: small; margin-top: -10px; margin-bottom: 10px;" class="card-text">Audio Visual Producer (Indo-Ad/Ogivly & Mather, Lowe Lintas/LOWE)<br>Executive Producer (Pyramid Post, Making Name Production, Imagen Pictures)</p>

								</div>

							</div>

						</div>
					<?php }?>

				</div>
				<hr>
				<p><?php echo $value->keterangan;?></p>
				<br>
				<hr>
				<p><?php echo $value->syarat;?></p>
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
			</div>
		</section>

		<div id="daftarbinar" class="modal fade" role="dialog" tabindex="-1" >
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
								<small class="text-secondary">Setelah melakukan <b>pembayaran biaya pendaftaran WEBINAR</b>. Anda <b>dapat mengisi</b> form <i>registrasi</i>/<i>pendaftaran</i> dibawah ini, untuk mengikuti webinar.</small>
							</div>
							<div class="form-group">
								<label for="webinar" class="font-weight-bold">Pilih Series WEBINAR</label>
								<select name="kodeseminar" class="custom-select" data-placeholder="Pilih Series WEBINAR" required="required" >
									<?php if ($seminar == false){
										echo "<option value='0'>Belum ada WEBINAR</option>";
									}else{?>
										<option value="0">Pilih Series WEBINAR</option>
										<?php foreach ($seminar as $key) {?>
											<option value="<?php echo $key->kode_seminar?>,<?php echo $key->nama?>"><?php echo $key->nama?></option>
										<?php }}?>
									</select>
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
								<div class="form-group mb-0">
									<div class="row mb-1">
										<div class="col-md-12">
											<img id="previewImg" class="prev-img hidden" src="https://www.tutorialrepublic.com/examples/images/transparent.png" alt="Placeholder">
										</div>
									</div>
									<div class="row mb-0 mt-0">
										<div class="col-md-6">
											<div class="upload-btn-wrapper">
												<button class="btnup" type="button">Upload bukti</button>
												<input type="file" name="bk_bayar" onchange="previewFile(this);">
											</div>
										</div>
										<div class="col-md-6">
											<button class="btn btn-primary px-5 rounded-pill float-right" type="submit">Daftar</button>
										</div>
									</div>
								</div>
								<small class="text-warning">Upload bukti pembayaran berupa file gambar, *) <span class="text-danger">JPG</span>, <span class="text-danger">PNG</span>, <span class="text-danger">JPEG</span>.</small>
								<hr class="mb-1 mt-1">
								<div style="font-size: 11px; text-align: center; margin-top: 50px;">
									Copyright © 2020 LO Kreatif. All Rights Reserved.
								</div>
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
		<?php }?>
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