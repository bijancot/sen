<script type="text/javascript">
	tinymce.init({
		selector: "#richTextArea",
		height: 250,
		plugins : 'autolink hr advlist lists textcolor colorpicker textpattern',
		menubar: false,
		branding: false,
		toolbar : 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat',
		// automatic_uploads: true,
		// image_advtab: true,
		// images_upload_url: "<?php echo base_url()?>hic/tinymce_upload",
		// file_picker_types: 'image', 
		// paste_data_images:true,
		// relative_urls: false,
		// remove_script_host: false,
		//   file_picker_callback: function(cb, value, meta) {
		// 	 var input = document.createElement('input');
		// 	 input.setAttribute('type', 'file');
		// 	 input.setAttribute('accept', 'image/*');
		// 	 input.onchange = function() {
		// 		var file = this.files[0];
		// 		var reader = new FileReader();
		// 		reader.readAsDataURL(file);
		// 		reader.onload = function () {
		// 		   var id = 'post-image-' + (new Date()).getTime();
		// 		   var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
		// 		   var blobInfo = blobCache.create(id, file, reader.result);
		// 		   blobCache.add(blobInfo);
		// 		   cb(blobInfo.blobUri(), { title: file.name });
		// 		};
		// 	 };
		// 	 input.click();
		//   }
	});
</script>
<style type="text/css">
	.select2-container--bootstrap{
		width: 100% !important;
	}
</style>
<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-12">
		<h1 class="h3 mb-0 text-gray-800"><b>Rekap Nilai Peserta</b> <span class="d-none d-md-inline-block">LO - KREATIF</span></h1>
		<h5>Gunakan halaman ini untuk Memilih & Melihat Finalis/Juara setelah Tahap penilaian selesai</h5>
		<small class="text-warning">Harap Memilih FINALIS SETELAH TAHAP yang dipilih menjadi status <b>SELESAI</b></small>
	</div>
</div>
<!-- MODAL Tambah -->
<div id="finalis" class="modal fade" role="dialog" >
	<div class="modal-dialog" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title"><b>Pemilihan peserta sesuai dengan jumlah yang dipilih</b></h5>
				<button type="button" class="close closetab" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-5 pl-5">
				<form action="<?php echo site_url('Juri/TahapAkhir');?>" method="post">
					<div class="form-group">
						<label class="font-weight-bold">Pilih Quota Finalis:</label>
						<select class="form-control" name="jml_finalis">
							<option value="3">3</option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="15">15</option>
						</select>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Pilih Bidang Lomba:</label>
						<input type="hidden" name="id_lomba" class="form-control" value="all">
						<input type="text" name="id_lomba" class="form-control" value="Semua Lomba" readonly="readonly">
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Pilih Asal Tahap Pemilihan:</label>
						<select class="form-control" name="id_tahap">
							<?php foreach($tahap as $key){?>
								<option value="<?php echo $key->id_tahap ;?>"><?php echo $key->nama_tahap;?></option>
							<?php }?>
						</select>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm closetab" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-danger btn-sm">Pilih Peserta</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- MODAL Tambah -->
<div id="resetdata" class="modal fade" role="dialog" >
	<div class="modal-dialog" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title"><b>RESET DATA FINALIS!!!</b></h5>
				<button type="button" class="close closetab" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-5 pl-5">
				<p class="text-danger">APAKAH ANDA YAKIN AKAN MERESET DATA FINALIS?</p>
				<small class="text-secondary">Mereset data finalis, beresiko membuat data peserta menjadi crash.</small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm closetab" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-danger btn-sm">Yakin dan lanjutkan</button>
			</div>
		</div>
	</div>
</div>
<div class="row mb-4">
	<div class="col-md-3">
		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary text-center">Pilih TAHAP</h6>
			</div>
			<div class="box-tim">
				<table class="table">
					<?php $no=1;foreach ($tahap as $key) { ?>
						<tr class="<?=($this->uri->segment(3) == "$key->id_tahap" ? ' text-white bg-primary' : '');?>">
							<td width="5%" class="pr-0">
								<?php echo $no;?>. 
							</td>
							<td width="95%">
								<a href="<?php echo site_url('Juri/RekapNilai/'.$key->id_tahap);?>" class="text-none">
									<div class="card-body p-0">
										<span class="font-weight-bold<?=($this->uri->segment(3) == "$key->id_tahap" ? ' text-white' : '');?>"><?php echo $key->nama_tahap;?></span> <i class="<?=($this->uri->segment(3) == "$key->id_tahap" ? 'fa fa-check-circle-o text-white' : 'fa fa-circle-o text-gray-900');?>"></i>
									</div>
								</a>
							</td>
						</tr>
						<?php $no++;}?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<?php if ($this->session->flashdata('notif')) { ?> 
				<!-- Menampilkan Notif -->
				<div class="alert alert-warning alert-icon shadow" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo $this->session->flashdata('notif'); ?>
				</div>
				<!-- Menampilkan Notif -->
				<br>
			<?php } ?>

			<div class="card shadow mb-3">
				<div class="card-body pb-0">
					<div class="form-group">
						<form action="<?php echo site_url('Juri/RekapNilai/'.$id_tahap);?>" method="post">
							<div class="row">
								<?php if ($id_tahap == null) {
									echo "<div class='col-md-12'><h5 class='text-warning text-center'><b>Harap Pilih TAHAP</b></h5></div>";
								}else{?>
									<div class="col-md-2">
										<label class="title">Pilih Lomba: </label>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="id_lomba">
											<?php foreach($get_lomba as $key){?>
												<option value="<?php echo $key->id ;?>"><?php echo $key->namalomba;?></option>
											<?php }?>
										</select>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
									</div>
									<div class="col-md-2">

										<?php if ($stts_thp->stts_finalis == 1) { ?>
											<button type="button" data-toggle="modal" data-target="#finalis" class="btn btn-danger btn-block" disabled="disabled">Pilih Finalis</button>
										<?php }else{?>
											<button type="button" data-toggle="modal" data-target="#finalis" class="btn btn-danger btn-block">Pilih Finalis</button>
										<?php } ?>
									</div>
									<div class="col-md-2">
										<button type="button" data-toggle="modal" data-target="#resetdata" class="btn btn-danger btn-block">RESET</button>
									</div>
								<?php }?>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="card shadow">
				<div class="card-header py-3">
					<h5>Menampilkan data finalis bidang lomba - <span class="badge badge-primary h4"><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></span></h5>
				</div>
				<div class="card-body">
					<table id="dataTable" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Tim</th>
								<th>Nama Sekolah</th>
								<th width="20%">Detail Kriteria</th>
								<th width="10%">Total Nilai</th>
								<th width="20%">Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach($peserta as $key){ ?>
								<tr>
									<td class="text-center"><?php echo $no?></td>
									<td><?php echo $key->namatim?></td>
									<td><?php echo $key->idpt?></td>
									<td><button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#nilai<?php echo $no;?>"><i class="fa fa-tasks"></i> Lihat Detail</button></td>
									<td class="text-center"><b><?php
									$na = $controller->M_juri->get_nilaiakhir($key->id_peserta);
									echo round($na->nilai_final,2);?></b> 
								</td>
								<td class="text-right">(<i><?php
									$js = $controller->M_juri->get_jurinilpes($id_lomba, $key->id_peserta);
									echo $js;?> of <?php
									$jal = $controller->M_juri->get_jurinilall($id_lomba);
									echo $jal;?> Judge</i>)</td>
								</tr>
								<!-- MODAL Tambah -->
								<div id="nilai<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
									<div class="modal-dialog modal-xl" role="document">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header bg-info text-white">
												<h5 class="modal-title">Menampilkan Detail Penilaian dari peserta <b><?php echo $key->namatim;?></b></h5>
												<button type="button" class="close closetab" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body pr-5 pl-5">
												<div class="row mb-3">
													<div class="col-md-3">
														<ul class="nav flex-column">
															<?php

															$kriteriajuri = $controller->M_juri->get_juridetnil($id_lomba, $key->id_peserta);

															$noju=0; foreach($kriteriajuri as $juria){ ?>
																<li class="nav-item border-top border-bottom border-left border-right mb-1">
																	<a class="nav-link tab-a" data-id="tab<?php echo $juria->id;?>" href="#<?php echo $noju;?>"><?php echo $juria->nama;?></a>
																</li>
																<?php $noju++;} ?>
															</ul>
														</div>
														<div class="col-md-9">
															<div class="awal tab tab-active">
																<div class="row border-top bottom-2 border-bottom">
																	<div class="col-md-12 p-2 border-left border-right">Pilih <b>Detail Penilaian Juri</b></div>
																</div>
															</div>
															<?php

															$kriteriajuri = $controller->M_juri->get_juridetnil($id_lomba, $key->id_peserta);

															$noju=0; foreach($kriteriajuri as $juria){ ?>
																<div class="tab" data-id="tab<?php echo $juria->id;?>" id="<?php echo $juria->id;?>">
																	<div class="row border-top">
																		<div class="col-md-12 p-2 border-left border-right"><b>Detail Penilaian Juri</b> - <i><?php echo $juria->nama;?></i> <small><?php echo $juria->id_penilaian;?></small></div>
																	</div>

																	<div class="row border-top bottom-2 border-bottom">
																		<div class="col-md-12 p-2 border-left border-right"><b>Komentar:</b> <?php echo $juria->note;?></div>
																	</div>

																	<div class="row border-top bottom-2 border-bottom font-weight-bold">
																		<div class="col-md-1 p-2 border-left border-right text-center">No</div>
																		<?php $ket = $this->M_penilaian->cek_ketarangan_kriteria($id_lomba);
																		if($ket == TRUE){?>
																			<div class="col-md-4 p-2 border-right">Kriteria</div>
																			<div class="col-md-5 p-2 border-right">Keterangan</div>
																		<?php }else{ ?>
																			<div class="col-md-9 p-2 border-right">Kriteria</div>
																		<?php }?>
																		<div class="col-md-2 p-2 border-right text-center">Nilai</div>
																	</div>
																	<?php 

																	$kriteria = $controller->M_juri->get_detail_nilai($juria->id_penilaian);
																	$nomor=1;
																	foreach($kriteria as $detail){ ?>
																		<div class="row border-bottom">
																			<div class="col-md-1 p-2 border-left border-right text-center"><?php echo $nomor;?></div>
																			<?php $ket = $this->M_penilaian->cek_ketarangan_kriteria($id_lomba);
																			if($ket == TRUE){?>
																				<div class="col-md-4 p-2 border-right"><?php echo $detail->kriteria;?></div>
																				<div class="col-md-5 p-2 border-right"><?php if($detail->keterangan == null){ echo "<center><b>-</b></center>";}else{echo $detail->keterangan;}?></div>
																			<?php }else{ ?>
																				<div class="col-md-9 p-2 border-right"><?php echo $detail->kriteria;?></div>
																			<?php }?>
																			<div class="col-md-2 p-2 border-right text-center"><?php echo $detail->nilai_murni;?>/5</div>
																		</div>

																		<?php $nomor++;}?>	
																		<div class="row border-bottom border-left border-right">
																			<div class="col-md-10 p-3"><b><center>Total Nilai</center></b></div>
																			<div class="col-md-2 p-3 border-left"><strong><center><?php echo $juria->nilai_akhir;?></center></strong></div>
																		</div>
																	</div>
																	<?php $noju++;} ?>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary btn-sm closetab" data-dismiss="modal">Tutup</button>
														</div>
													</div>
												</div>
											</div>
											<?php $no++;}?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
