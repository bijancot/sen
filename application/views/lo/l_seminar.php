<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h3 mb-0 text-gray-800"><b>Admin SIDE JURI</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-6 text-right">
		<button class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Data Seminar</button>
	</div>

	<!-- MODAL Tambah -->
	<div id="tambah" class="modal fade" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-lg" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h5 class="modal-title">Tambah Data SEMINAR - LO KREATIF</h5>
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
				<h6 class="m-0 font-weight-bold text-primary">Data Seminar LO - KREATIF</h6>
			</div>
			<div class="card-body">
					<table id="dataTable" class="table table-bordered table-sm table-hover">
						<thead>
							<tr>
								<th width="3%">No</th>
								<th width="28%">Nama Seminar</th>
								<th width="30%">Tema</th>
								<th width="20%">Tanggal</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; foreach ($get_seminar as $key) { ?>
								<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $key->nama;?></td>
								<td><?php echo $key->tanggal;?></td>
									<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?php echo $no;?>"><i class="fa fa-edit fa-sm"></i></button> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $no;?>"><i class="fa fa-trash-o fa-sm"></i></button></td>
								</tr>

								<!-- MODAL Tambah -->
								<div id="edit<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
									<div class="modal-dialog modal-lg" role="document">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header bg-info text-white">
												<h5 class="modal-title">Edit data</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="<?php echo site_url('SeminarH/edit_sem/'.$key->kode_seminar);?>" method="POST">
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">

														</div>
														<div class="col-lg-6 border-left">
															
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
									<div id="hapus<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
										<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header bg-danger text-white">
													<h5 class="modal-title">Hapus data</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<form action="<?php echo site_url('SeminarH/hapus_sem/'.$key->kode_seminar);?>" method="POST">
													<div class="modal-body">
														<p>Apakah anda yakin akan menghapus data dari: <b class="text-danger"><?php echo $key->nama;?></b></p>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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