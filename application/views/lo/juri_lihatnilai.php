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

<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-md-10 offset-1">
		<h1 class="h3 mb-0 text-gray-800"><b>Edit Nilai Peserta</b> <span class="d-none d-md-inline-block">LO - Kreatif</span></h1>
	</div>
</div>

<div class="row mb-4">
		<div class="col-md-10 offset-1">
			<?php if ($this->session->flashdata('notif')) { ?> 
				<!-- Menampilkan Notif -->
				<div class="alert alert-warning alert-icon shadow" role="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo $this->session->flashdata('notif'); ?>
				</div>
				<!-- Menampilkan Notif -->
				<br>
			<?php } ?>
			<div class="row mb-4">
				<div class="col-md-5">
					<div class="card shadow border-left-primary">
						<div class="card-body">
							<label>Nama TIM</label>
							<h4 class="font-weight-bold mb-0"><?php if($peserta != false){echo $peserta->namatim;}else{echo "<b class='h4 font-weight-bold'><center>Pilih TIM</center></b>";} ?></h4>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<ul class="nav nav-pills pull-right">
						<li class="nav-item card shadow mr-1">
							<a class="nav-link" href="<?php echo site_url('Juri/DaftarNilai/'.$id_tahap);?>"><i class="icon-briefcase"></i> <strong>Kembali</strong></a>
						</li>
						<li class="nav-item card shadow mr-1">
							<a class="nav-link active" href="#data" data-toggle="tab"><i class="icon-briefcase"></i> <strong>Karya TIM</strong></a>
						</li>
						<?php if ($peserta != false) { ?>
							<li class="nav-item card shadow">
								<a class="nav-link" href="#nilai" data-toggle="tab"><i class="icon-clipboard"></i> <strong>Lembar Penilaian</strong></a>
							</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="card shadow">
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane active" id="data">
									<?php if($peserta == false){echo "<b class='h5 font-weight-bold'><center>Pilih TIM</center></b>";}else{
										if (!empty($peserta->karya2) AND $lomba->id == 4) {
											echo '<a href="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya2.'" class="btn btn-success" target="_blank">Download .zip file UI/UX</a>';
										}

										$file = explode(".", substr($peserta->karya, -4));

										if(end($file) == "pdf"){
											echo '<p>Download Karya: <a href="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" target="_blank">TIM - '.$peserta->namatim.'</a><p>';
											echo '<iframe frameborder="0" src="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" style="height:450px;width:100%" title="Surat Pernyataan"></iframe>';
										}elseif(end($file) == "jpg" || end($file) == "png" || end($file) == "jpeg"){
											echo '<p>Download Karya: <a href="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" target="_blank">TIM - '.$peserta->namatim.'</a><p>';
											echo '<img src="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" class="img-fuild">';
										}elseif(end($file) == "mp4" || end($file) == "avi" || end($file) == "AVI" || end($file) == "MP4" || end($file) == "MPEG" || end($file) == "mpeg"){
											if (isset($peserta->youtube)) {
												echo '<p>Visit page: <a href="'.$peserta->youtube.'" target="_blank">TIM - '.$peserta->namatim.'</a><p>';

												$yt = explode("/", $peserta->youtube);

												echo '<iframe width="100%" height="450px" src="https://www.youtube.com/embed/'.end($yt).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
											}else{
												echo '<p>Download Karya: <a href="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" target="_blank">TIM - '.$peserta->namatim.'</a><p>';
												echo '<iframe src="'.base_url('').'berkas/'.str_replace("/", "", $lomba->namalomba).'/'.$peserta->namatim.'('.$peserta->idpt.')/karya/'.$peserta->karya.'" style="height:450px;width:100%"></iframe>';
											}
										}else{
											echo "Undefined Type of FILE (BELUM ADA FILE KARYA).";
										}
									}?>
								</div>
								<div class="tab-pane" id="nilai">
									<form action="<?php echo site_url('Juri/UpdateNilai/'.$tahap->id_tahap);?>" method="POST">
										<input type="hidden" name="id_peserta" value="<?php if($peserta != false){echo $peserta->id;}?>">
										<h5 class="font-weight-bold">Lembar Penilaian <button type="button" class="btn btn-success btn-sm pull-right font-weight-bold text-white" style="margin-top: -8px" data-toggle="modal" data-target="#kirim">Submit Nilai</button></h5>
										<table class="table table-bordered color-black">
											<thead class="text-center">
												<tr>
													<td colspan="5" class="text-left"><b>Keterangan:</b> <?php if($keterangan != false){echo $keterangan->keterangan;};?></td>
												</tr>
												<tr style="background-color: #d4d4d4;">
													<th width="5%">No</th>
													<th width="50%">Kriteria Penilaian</th>
													<th width="15%">Bobot</th>
													<th width="15%">Nilai Peserta</th>
													<th width="15%">Ubah Nilai</th>
												</tr>
											</thead>
											<tbody>
													<input type="hidden" name="id_penilaian" value="<?php echo $id_penilaian;?>">
												<?php $no=1; foreach ($kriteria_edit as $value) { ?>
													<input type="hidden" name="id_detail[]" value="<?php echo $value->id_detail;?>">
													<input type="hidden" name="bobot[]" value="<?php echo $value->bobot;?>">
													<tr>
														<td rowspan="2" class="text-center"><?php echo $no;?></td>
														<td><b><?php echo $value->kriteria;?></b></td>
														<td rowspan="2" class="text-center"><?php echo $value->bobot;?>%</td>
														<td rowspan="2" class="text-center"><?php echo $value->nilai_murni;?></td>
														<td rowspan="2" class="text-center">
															<select class="form-control btn-block" name="nilai[]">
															    <optgroup>
																<option value="<?php echo $value->nilai_murni;?>"><?php echo $value->nilai_murni;?></option>
															    </optgroup>
															    <optgroup>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															    </optgroup>
															</select>
														</td>
													</tr>
													<tr>
														<td><span class="ml-2"><?php echo $value->keterangan;?></span></td>
													</tr>
													<?php $no++;} ?>
												</tbody>
											</table>


											<!-- MODAL Tambah -->
											<div id="kirim" class="modal fade" role="dialog" tabindex="-1" >
												<div class="modal-dialog modal-lg" role="document">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header bg-info text-white">
															<h5 class="modal-title">Kirim Hasil Penilaian</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<p class="mb-2">Yakin kirim hasil penilaian anda terhadap tim - <b class="text-warning"><?php if($peserta != false){echo $peserta->namatim;}?></b>?</p>
															<hr class="mb-1">
															<label class="font-weight-bold">Ubah nilai peserta ini?</label>
															<!-- <small class="text-info">anda dapat mengubah nilai ini pada menu - <b>Riwayat Nilai</b></small> -->
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
															<button type="submit" class="btn btn-info btn-sm font-weight-bold text-white">Yakin dan kirim</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

