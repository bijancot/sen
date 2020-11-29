<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h3 mb-0 text-gray-800"><b>Admin SIDE JURI</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-6 text-right">
		<button class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Juri</button>
	</div>


	<!-- MODAL Tambah -->
	<div id="impor" class="modal fade" role="dialog" tabindex="-1" >
		<div class="modal-dialog" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<h5 class="modal-title">Impor Data JURI - LO KREATIF</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
					<div class="modal-body">
						<form action="<?php echo site_url('Juri/import_data');?>" enctype="multipart/form-data" method="post">
								<div class="form-group">
									<label class="font-weight-bold">Pilih File Excel:</label> <small class="text-danger">*</small>
									<input type="file" class="form-control" name="file">
								</div>
					        	<div class="modal-footer">
					        		<p class="pull-left">Contoh Format File Excel <a href="<?php echo base_url();?>mahendra/contoh-format-juri.xlsx"><code class="text-success">Format Import Excel</code></a></p>
					                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					                <button type="submit" name="import" class="btn btn-success">Import Data</button>
					         	</div>
				        	</form>
					</div>
			</div>
		</div>
	</div>


	<!-- MODAL Tambah -->
	<div id="tambah" class="modal fade" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-lg" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Tambah JURI - LO KREATIF</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo site_url('Juri/tambah_juri');?>" method="POST">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="font-weight-bold">Nama Juri</label> <small class="text-danger">*</small>
									<input type="text" class="form-control" name="nama_juri" placeholder="Masukkan nama Juri">
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Email Juri</label> <small class="text-danger">*</small>
									<input type="email" class="form-control" name="email_juri" placeholder="Masukkan Email Juri">
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Password Juri</label> <small class="text-danger">*</small>
									<input type="password" class="form-control" name="password_juri" placeholder="Masukkan Password Juri">
								</div>
							</div>
							<div class="col-lg-6 border-left">
								<div class="form-group">
									<label class="font-weight-bold">Pilih Bidang Lomba Juri</label> <small class="text-danger">*</small>
									<?php
									foreach ($get_lomba as $value) { ?>
										<div class="checkbox">
											<label><input type="checkbox" name="bidang_lomba[]" value="<?php echo $value->id;?>"> <?php echo $value->namalomba;?></label>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary btn-sm">Tambahkan Juri</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<hr>
<?php if ($this->session->flashdata('notif')) { ?> 
	<!-- Menampilkan Notif -->
	<div class="alert alert-warning alert-icon" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<!-- Menampilkan Notif -->
	<br>
<?php }?>
<div class="row mb-3">
	<div class="col-lg-12">
		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data JURI LO - KREATIF <button class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#semua">Hapus Data Terpilih</button></h6>
			</div>
			<div class="card-body">

				<form action="<?php echo site_url('Juri/hapus_pilih'); ?>" method="post">
					<div class="modal fade" id="semua" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-dialog-centered m-auto" role="document">
							<div class="modal-content">
								<div class="modal-header bg-danger text-white">
									<h5 class="modal-title font-weight-bold">Hapus Data Terpilih</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>Apakah anda yakin akan menghapus data yang terpilih ?</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-danger btn-sm">Hapus Data</button>
								</div>
							</div>
						</div>
					</div>
					<table id="dataTable" class="table table-bordered table-sm table-hover">
						<thead>
							<tr>
								<th width='4%'><input type="checkbox" id="checkAll" name="checkAll"></th>
								<th width="3%">No</th>
								<th width="28%">Nama Juri</th>
								<th width="30%">Email</th>
								<th width="20%">Bidang Lomba</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($get_juri as $key) { ?>
								<tr>
									<td><input type="checkbox" name="idk[]" value="<?php echo $key->id;?>"></td>

								</form>
								<td><?php echo $no;?></td>
								<td><?php echo $key->nama;?></td>
								<td><?php echo $key->email;?></td>
								<td>
									<?php $lomba = $controller->M_juri->get_lomjur($key->id);
									if (empty($lomba)) {
										echo "<span class='badge badge-warning'>Bidang lomba belum di atur</span>";
									}else{
										foreach($lomba as $value){?>
											<span class="badge badge-primary"><?php echo $value->namalomba;?></span>
										<?php } }?>
									</td>
									<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?php echo $no;?>"><i class="fa fa-edit fa-sm"></i></button> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $no;?>"><i class="fa fa-trash-o fa-sm"></i></button> <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pass<?php echo $no;?>"><i class="fa fa-key fa-sm"></i></button>
									<a href="mailto:<?php echo $key->email;?>" data-toggle="tooltip" data-placement="top" title="Kirim EMAIL" target="_blank" class="btn btn-secondary btn-sm"><i class="fa fa-mail-forward"></i></a></td>
								</tr>

								<!-- MODAL Tambah -->
								<div id="edit<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
									<div class="modal-dialog modal-lg" role="document">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header bg-info text-white">
												<h5 class="modal-title">Edit data JURI - <?php echo $nama;?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="<?php echo site_url('Juri/edit_juri/'.$key->id);?>" method="POST">
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label class="font-weight-bold">Nama Juri</label> <small class="text-danger">*</small>
																<input type="text" class="form-control" name="nama_juri" value="<?php echo $key->nama;?>">
															</div>
															<div class="form-group">
																<label class="font-weight-bold">Email Juri</label> <small class="text-danger">*</small>
																<input type="email" class="form-control" name="email_juri" value="<?php echo $key->email;?>">
															</div>
														</div>
														<div class="col-lg-6 border-left">
															<div class="form-group">
																<label class="font-weight-bold">Pilih Bidang Lomba Juri</label> <small class="text-danger">*</small>
																<?php
																foreach ($get_lomba as $value) {
																	$lomba = $this->M_juri->cek_lomjur($value->id, $key->id);

																	if (!empty($lomba->id)) {
																		?>
																		<div class="checkbox">
																			<label><input type="checkbox" name="bidang_lomba[]" value="<?php echo $value->id;?>"checked> <?php echo $value->namalomba;?></label>
																		</div>
																	<?php }else{ ?>
																		<div class="checkbox">
																			<label><input type="checkbox" name="bidang_lomba[]" value="<?php echo $value->id;?>" > <?php echo $value->namalomba;?></label>
																		</div>
																	<?php }}?>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-info btn-sm">Edit Juri</button>
													</div>
												</form>
											</div>
										</div>
									</div>


									<!-- MODAL Tambah -->
									<div id="pass<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
										<div class="modal-dialog modal-dialog-centered" role="document">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header bg-primary text-white">
													<h5 class="modal-title">Ubah PASSWORD JURI</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action="<?php echo site_url('Juri/pass_juri/'.$key->id);?>" method="POST">
													<div class="modal-body">
														<p>Ubah PASSWORD juri, atas nama: <b class="text-danger"><?php echo $key->nama;?></b></p>
														<div class="form-group">
															<label class="font-weight-bold">Password Baru Juri</label> <small class="text-danger">*</small>
															<input type="password" class="form-control" name="password_juri" placeholder="Masukkan Password Juri">
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-primary btn-sm">Ubah Password Juri</button>
													</div>
												</form>
											</div>
										</div>
									</div>


									<!-- MODAL Tambah -->
									<div id="hapus<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
										<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h5 class="modal-title">Hapus data JURI</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action="<?php echo site_url('Juri/hapus_juri/'.$key->id);?>" method="POST">
													<div class="modal-body">
														<p>Apakah anda yakin akan menghapus data dari: <b class="text-danger"><?php echo $key->nama;?></b></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-danger btn-sm">Hapus Juri</button>
													</div>
												</form>
											</div>
										</div>
									</div>
									<?php $no++; }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$("input[name='checkAll']").click(function() {
						var checked = $(this).attr("checked");
						$("#table tr td input:checkbox").attr("checked", checked);
					});
				});
				$("#checkAll").click(function(){
					$('input:checkbox').not(this).prop('checked', this.checked);
				});
			</script>

	<script type="text/javascript">
	$(document).ready(function(){

	     $("button[name='import']").click(function(){
	         $('#images').show();
	         if(valid)
	            return true;
	         else
	            {
	              $(this).removeAttr('disabled');
	              $('#images').hide();     
	              return false;
	            }
	     });
		 
	});
		 
	</script>