<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h3 mb-0 text-gray-800"><b>Verifikasi BERKAS TIM</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-6 text-right">
		<button class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan AKUN LO</button>
	</div>


	<!-- MODAL Tambah -->
	<div id="tambah" class="modal fade" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-lg" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Tambah AKUN LO - LO KREATIF</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo site_url('Verifikasi/tambah_lo');?>" method="POST">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="font-weight-bold">Nama LO</label> <small class="text-danger">*</small>
									<input type="text" class="form-control" name="nama_lo" placeholder="Masukkan nama LO">
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Email LO</label> <small class="text-danger">*</small>
									<input type="email" class="form-control" name="email_lo" placeholder="Masukkan Email LO">
								</div>
								<div class="form-group">
									<label class="font-weight-bold">Password LO</label> <small class="text-danger">*</small>
									<input type="password" class="form-control" name="password_lo" placeholder="Masukkan Password LO">
								</div>
							</div>
							<div class="col-lg-6 border-left">
								<div class="form-group">
									<label class="font-weight-bold">Pilih Bidang Lomba LO</label> <small class="text-danger">*</small>
									<br>
									<div class="row">
										<div class="col-lg-12">
											<select name="bidang_lomba" class="custom-select">
												<?php
												foreach ($get_lomba as $value) { ?>
													<option value="<?php echo $value->id;?>"><?php echo $value->namalomba;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary btn-sm">Tambahkan LO</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Content Row -->
<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-success text-uppercase mb-1">Akun LO</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_lo;?> LO</div>
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
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (Siap Verif)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim_siap;?> / <?php echo $total_tim;?> TIM</div>
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
						<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">TIM <span class="text-success"><i class="fa fa-check-circle-o text-success"></i> Verifikasi</span></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_tim_ver;?> TIM</div>
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
		<div class="card border-left-danger shadow h-100 py-2">
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
<?php }?>
<div class="row mb-3">
	<div class="col-lg-12">
		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Data AKUN LO - KREATIF <button class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#semua">Hapus Data Terpilih</button></h6>
			</div>
			<div class="card-body">

				<form action="<?php echo site_url('Verifikasi/hapus_pilih'); ?>" method="post">
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
								<th width="25%">Nama LO</th>
								<th width="30%">Email</th>
								<th width="20%">Bidang Lomba</th>
								<th width="18%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($get_lo as $key) { ?>
								<tr>
									<td><input type="checkbox" name="idk[]" value="<?php echo $key->id;?>"></td>

								</form>
								<td><?php echo $no;?></td>
								<td><?php echo $key->nama;?></td>
								<td><?php echo $key->email;?></td>
								<td>
									<?php $lomba = $controller->M_verifikasi->get_lomlo($key->id);
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
												<h5 class="modal-title">Edit data LO - <?php echo $nama;?></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="<?php echo site_url('Verifikasi/edit_lo/'.$key->id);?>" method="POST">
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<div class="form-group">
																<label class="font-weight-bold">Nama LO</label> <small class="text-danger">*</small>
																<input type="text" class="form-control" name="nama_lo" value="<?php echo $key->nama;?>">
															</div>
															<div class="form-group">
																<label class="font-weight-bold">Email LO</label> <small class="text-danger">*</small>
																<input type="email" class="form-control" name="email_lo" value="<?php echo $key->email;?>">
															</div>
														</div>
														<div class="col-lg-6 border-left">
															<div class="form-group">
																<label class="font-weight-bold">Pilih Bidang Lomba LO</label> <small class="text-danger">*</small>
																<br>
																<div class="row">
																	<div class="col-lg-12">
																		<select name="bidang_lomba" class="custom-select">
																			<?php
																			foreach ($get_lomba as $value) { ?>
																				<option value="<?php echo $value->id;?>"><?php echo $value->namalomba;?></option>
																			<?php } ?>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-info btn-sm">Edit LO</button>
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
												<h5 class="modal-title">Ubah PASSWORD LO</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="<?php echo site_url('Verifikasi/pass_lo/'.$key->id);?>" method="POST">
												<div class="modal-body">
													<p>Ubah PASSWORD lo, atas nama: <b class="text-danger"><?php echo $key->nama;?></b></p>
													<div class="form-group">
														<label class="font-weight-bold">Password Baru LO</label> <small class="text-danger">*</small>
														<input type="password" class="form-control" name="password_lo" placeholder="Masukkan Password LO">
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-primary btn-sm">Ubah Password LO</button>
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
												<h5 class="modal-title">Hapus data LO</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="<?php echo site_url('Verifikasi/hapus_lo/'.$key->id);?>" method="POST">
												<div class="modal-body">
													<p>Apakah anda yakin akan menghapus data dari: <b class="text-danger"><?php echo $key->nama;?></b></p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-danger btn-sm">Hapus LO</button>
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