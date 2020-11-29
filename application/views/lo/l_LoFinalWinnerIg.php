<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-9">
		<h1 class="h3 mb-0 text-gray-800"><b>IG RANK</b> - <strong><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></strong></h1>
	</div>
	<div class="col-lg-3 text-right">
		<a href="javascript:window.history.go(-1);" class="d-none d-md-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fa fa-step-backward fa-sm text-white-50"></i> Kembali</a>
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
				<h5 class="m-0 font-weight-bold text-primary">IG RANK - Bidang Lomba <span class="badge badge-primary h4"><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "ALL LOMBA";}?></span></h5>
				<small class="text-danger">Diambil pada 17 November 2020, 14:59 WIB</small>
			</div>
			<div class="card-body">
				<table id="dataTable" class="table table-bordered table-sm table-hover">
					<thead>
						<tr>
							<th width="5%" class="text-center">No</th>
							<th>Nama TIM</th>
							<th>PTS</th>
							<th>Teaser</th>
							<th>LIKE</th>
							<th>Comment</th>
							<th>View Videos</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($instagram == null) {echo "<tr class='mt-2 mb-2 pt-1 pb-1' height='40px'><td colspan='8'><center class='font-weight-bold text-secondary h5'>Tidak ada Data</center></td></tr>";
                            # code...
					}else{ $no=1; foreach ($instagram as $key) { ?>
						<tr <?php if($no == 1){echo "class='table-warning font-weight-bold text-dark'";}?>>
							<td class="text-center"><?php echo $no;?></td>
							<td><?php echo $key->namatim;?></td>
							<td><?php echo $key->namapt;?></td>
							<td><?php echo $key->teaser;?></td>
							<td class="text-center table-secondary"><?php echo $key->likes;?></td>
							<td class="text-center table-info"><?php echo $key->comments;?></td>
							<td class="text-center table-danger"><?php echo $key->videos;?></td>
							<td class="text-center table-success"><?php echo $key->total;?></td>
						</tr>
						<?php $no++;}}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>