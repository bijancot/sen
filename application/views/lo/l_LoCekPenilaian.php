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
	<div class="col-lg-12">
		<h1 class="h3 mb-0 text-gray-800"><b>Cek Karya Penilaian</b> <span class="d-none d-md-inline-block">LO - Kreatif</span></h1>
	</div>
</div>

<div class="row mb-4">
	<div class="col-md-3">
		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-secondary text-center">Pilih TIM - <?php echo $lomba->namalomba;?></h6>
			</div>
			<div class="box-tim">
				<table class="table">
					<?php $no=1;foreach ($daftar as $key) { ?>
						<tr class="<?=($this->uri->segment(3) == "$key->id" ? ' text-white bg-primary' : '');?>">
							<td width="5%" class="pr-0">
								<?php echo $no;?>. 
							</td>
							<td width="95%">
								<a href="<?php echo site_url('Verifikasi/Penilaian/'.$key->id);?>#<?php echo $key->id;?>" class="text-none" id="<?php echo $key->id;?>">
									<div class="card-body p-0">
										<span class="font-weight-bold<?=($this->uri->segment(3) == "$key->id" ? ' text-white' : '');?>"><?php echo $key->namatim;?></span> <i class="<?=($this->uri->segment(3) == "$key->id" ? 'fa fa-check-circle-o text-white' : 'fa fa-circle-o text-gray-900');?>"></i>
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
					<!--<ul class="nav nav-pills pull-right">-->
					<!--	<li class="nav-item card shadow mr-1">-->
					<!--		<a class="nav-link active" href="#data" data-toggle="tab"><i class="icon-briefcase"></i> <strong>Karya TIM</strong></a>-->
					<!--	</li>-->
					<!--</ul>-->
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

