<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-6">
		<h1 class="h3 mb-0 text-gray-800"><b>Tahap PENILAIAN</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-6 text-right">
		<a href="<?php echo site_url('Penilaian/Kriteria');?>" class="d-none d-md-inline-block btn btn-sm btn-info shadow-sm mt-1"><i class="fa fa-paint-brush fa-sm text-white-50"></i> KRITERIA penilaian</a>
		<button class="d-inline-block btn btn-sm btn-primary shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Tahap</button>
	</div>
</div>
<?php if ($this->session->flashdata('notif')) { ?> 
	<!-- Menampilkan Notif -->
	<div class="alert alert-warning shadow alert-icon" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
	<!-- Menampilkan Notif -->
<?php }else{ ?>
	<div class="alert alert-primary shadow alert-icon" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<b>SEMUA TAHAP</b> dibawah ini, dilakukan setelah <b>SELEKSI ADMINSITRASI SELESAI</b>, Fitur untuk mengecek hal tersebut secara otomatis masih belum dibuat. Mohon atur Tanggal Dimulai pada Tahap dibawah ini setelah batas waktu <b>SELEKSI ADMINSITRASI SELESAI.</b>
		<hr>
		<p><b>Status TAHAP</b> akan <u>otomatis</u> menjadi <b>AKTIF</b> saat <i>TANGGAL DIMULAI</i> sesuai dengan <u>realtime</u> saat ini & <u>otomatis</u> menjadi <b>SELESAI</b> saat <i>TANGGAL BERAKHIR</i> sesuai dengan <u>realtime</u> saat ini. <b>HARAP MENENTUKAN TANGGAL DIMULAI lebih dari saat mengatur TAHAP dan TANGGAL BERAKHIR lebih dari TANGGAL DIMULAI.</p>
	</div>
<?php }?>
<hr>
<div class="row">
	<div class="col-xl-4">
		<div class="card shadow show-grid">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Tahap penilaian</h6>
			</div>

			<?php $no = 1; foreach ($tahap_penilaian as $key) { if ($cek_tahap == 0) {?>
				<div class="card-body p-3 mt-2 border-bottom">
					<div class="media-body mr-3">
						<p>Harap buat minimal <strong>1 Tahap Penilaian</strong></p>
						<button class="d-inline-block btn btn-sm btn-primary btn-block shadow-sm mt-1" data-toggle="modal" data-target="#tambah"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Tahap</button>
					</div>
				</div>
			<?php }else{?>
				<a href="#<?php echo $no;?>" class="card-body text-none p-3 mt-2 border-bottom tab-a" data-id="tab<?php echo $no;?>">
					<div class="media-body ml-2">
						<h5 class="media-heading"><strong>Tahap <?php echo $no;?></strong> - <span class="mb-2"><?php echo $key->nama_tahap;?>
						<?php if($key->aktif == 0){?><span class="badge badge-secondary btn-block pull-right mt-2">BELUM AKTIF</span>
						<?php }elseif($key->aktif == 1){?><span class="badge badge-primary btn-block pull-right mt-2">AKTIF</span>
						<?php }else{?><span class="badge badge-success btn-block pull-right mt-2">SELESAI</span>
					<?php }?>
				</h5>
			</div>
		</a>
		<?php $no++; } }?>
	</div>
</div>
<div class="col-lg-8 mb-4">
	<div class="card shadow show-grid">
		<div class="card-body">
			<div class="tab tab-active">
				<h5 class="text-center font-weight-bold mt-2">PILIH TAHAP PENILAIAN</h5>
			</div>
			<?php
            date_default_timezone_set("Asia/Jakarta");
			$bulan = array(
				'01' => 'Januari',
				'02' => 'Februari',
				'03' => 'Maret',
				'04' => 'April',
				'05' => 'Mei',
				'06' => 'Juni',
				'07' => 'Juli',
				'08' => 'Agustus',
				'09' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember',
			);
			$no = 1; foreach ($tahap_penilaian as $key) {
				//Init
                $hari = "";$jam = "";$menit = "";$sisa_waktu = "";
				$time_now		= strtotime(date("H:i"));
                $time_start	  	= strtotime($key->time_start);
                $time_end 	  	= strtotime($key->time_end);
				$hariini    	= date('Y')."-".date('m')."-".date('d');
                
				$pcs_start	 	= explode("/", $key->date_start);
				$pcs_end 		= explode("/", $key->date_end);
				
				$date_start 	= $pcs_start[2]."-".$pcs_start[1]."-".$pcs_start[0];
			    $date_end	 	= $pcs_end[2]."-".$pcs_end[1]."-".$pcs_end[0];
				
                
				if ($key->aktif == 0 ) {
                	$interval   = $time_start - $time_now;
					$datediff 	= abs(strtotime($date_start) -  strtotime($hariini));
				}elseif ($key->aktif == 1) {
                	$interval   = $time_end - $time_now;
					$datediff 	= abs(strtotime($date_end) -  strtotime($hariini));
				}else{
                	$interval   = $time_now-$time_now;
					$datediff 	= abs(strtotime($hariini) -  strtotime($hariini));
				}
				$sisa_waktu = $datediff / (60 * 60 * 24);
					if ($sisa_waktu > 0) {
							$sisa_waktu = $sisa_waktu." Hari";
					}else{
						if ($interval > 0) {
	                        if(gmdate("i", $interval) != 00 ){
	                            $menit  = gmdate("i", $interval)." Menit";
	                        }

	                        if(gmdate("H", $interval) != 00 ){
	                            $jam    = gmdate("H", $interval)." Jam";
	                        }
	                        $sisa_waktu	= $jam." ".$menit;
						}
					}
				?>
				<div class="tab" data-id="tab<?php echo $no;?>" id="<?php echo $no;?>">
					<h5 class="mb-3 text-gray-800 mt-2">Detail <b>Tahap <?php echo $no;?> - <?php echo $key->nama_tahap;?></b> 
						<?php if ($key->aktif != 3) { ?>
						<button class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#hapus<?php echo $no; ?>">Hapus</button>
						<button class="btn btn-warning btn-sm pull-right mr-2" data-toggle="modal" data-target="#tunda<?php echo $no; ?>">TUNDA</button>
						<button class="btn btn-info btn-sm pull-right mr-2" data-toggle="modal" data-target="#edit<?php echo $no; ?>">Edit</button>
						<?php } ?></h5>
						<table class="table">
							<tr>
								<th width="50%" colspan="2">Keterangan</th>
								<th width="25%" colspan="1">
								</th>
								<th width="25%" colspan="1"> Status
									<?php if($key->aktif == 0){?><span class="badge badge-secondary">BELUM AKTIF</span>
									<?php }elseif($key->aktif == 1){?><span class="badge badge-primary">AKTIF</span>
									<?php }else{?><span class="badge badge-success">SELESAI</span>
								<?php }?>
							</th>
						</tr>
						<tr>
							<td colspan="4"><?php echo $key->keterangan;?></td>
						</tr>
						<tr>
							<th colspan="2">Tanggal Dimulai</th>
							<th colspan="2">Tanggal Berakhir</th>
						</tr>
						<tr>
							<td><?php echo $date_start;?></td>
							<td><?php echo $key->time_start;?> WIB</td>
							<td><?php echo $date_end;?></td>
							<td><?php echo $key->time_end;?> WIB</td>
						</tr>
						    <tr>
						        <th colspan="4">Catatan: Akan Masuk kedalam Tahap <?php if($key->aktif+1 == 1){?><span class="badge badge-primary">AKTIF</span> - dalam <b><?php echo $sisa_waktu;?></b>
											<?php }elseif($key->aktif+1 == 2){?><span class="badge badge-success">SELESAI</span> - dalam <b><?php echo $sisa_waktu;?></b>
										<?php }else{ echo "WEW";}?></th>
						    </tr>

					</table>
				</div>

				<!-- MODAL Tambah -->
				<div id="edit<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
					<div class="modal-dialog modal-dialog-centered modal-lg m-auto" role="document">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit TAHAP PENILAIAN</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?php echo site_url('penilaian/update_tahap/'.$key->id_tahap);?>" method="POST">
								<div class="modal-body">
									<div class="form-group">
										<label class="font-weight-bold">Nama Tahap Penilaian</label> <small class="text-danger">*</small>
										<input type="rext" class="form-control" name="nama_tahap" value="<?php echo $key->nama_tahap;?>">
										<small class="form-text text-muted">Ubah nama TAHAP seperti <u>penyisihan</u>, <u>final</u>, etc <b>BUKAN</b><span class="text-danger"> Tahap 1</span>, <span class="text-danger">2</span>, etc.</small>
									</div>
									<div class="row col-md-12 mb-3">
										<small class="form-text text-muted">Gunakan fitur <b class="text-warning">TUNDA Tahap</b> untuk mengubah <u>Data Jadwal</u> <b>Tahap <?php echo $key->nama_tahap;?></b></small>
									</div>
									<div class="form-group">
										<label class="font-weight-bold">Keterangan</label> <small class="text-warning">Opsional</small>
										<textarea type="text" class="form-control" name="keterangan"><?php echo $key->keterangan;?></textarea>
										<small class="form-text text-muted">Tahap ini akan <b>OTOMATIS</b> masuk terbuka atau <u>aktif</u> sesuai <span class="text-primary"><b>Tanggal</b></span> dan <span class="text-primary"><b>Waktu</b> Dimulai</span>, dan <b>OTOMATIS</b> tertutup <u>selesai</u> sesuai <span class="text-danger"><b>Tanggal</b></span> dan <span class="text-danger"><b>Waktu</b> Berakhir</span>. Tetapi, anda dapat <b>MENUNDA</b> status Tahap ini (<i>Aktif</i>/<i>Selesai</i>) pada fitur <b class="text-warning">TUNDA Tahap</b>. </small>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-primary btn-sm">Tambah</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="tunda<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header bg-warning text-white">
								<h5 class="modal-title font-weight-bold">Tunda TAHAP PENILAIAN</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="<?php echo site_url('Penilaian/tunda_tahap/'.$key->id_tahap);?>" enctype="multipart/form-data" method="post" class="form-horizontal" />
									<p>Apakah anda yakin akan menunda <b>Tahap <?php echo $no;?> <span class="text-danger"><?php echo $key->nama_tahap; ?></span></b></p>
									<table class="table mb-0">
										<tr>
											<th>Tahap SAAT ini</th>
											<th>Tahap SELANJUTNYA</th>
										</tr>
										<tr>
											<td>
												<?php if($key->aktif == 0){?><span class="badge badge-secondary">BELUM AKTIF</span>
												<?php }elseif($key->aktif == 1){?><span class="badge badge-primary">AKTIF</span>
												<?php }else{?><span class="badge badge-success">SELESAI</span>
											<?php }?>
										</td>
										<td>
											<?php if($key->aktif+1 == 1){?><span class="badge badge-primary">AKTIF</span> - dalam <b><?php echo $sisa_waktu;?></b>
											<?php }elseif($key->aktif+1 == 2){?><span class="badge badge-success">SELESAI</span> - dalam <b><?php echo $sisa_waktu;?></b>
										<?php }else{ echo "WEW";}?>
									</td>
								</tr>
							</table>
							<input type="hidden" class="form-control" name="aktif" value="<?php echo $key->aktif;?>">
							<div class="col-md-12 border-top">
							  <div class="form-group mt-3 row">
							    <label class="col-sm-5 col-form-label font-weight-bold">Tunda selama</label>
							    <div class="col-sm-5">
							      <input type="hidden" class="form-control" name="hari_dimulai" value="<?php echo $key->date_start;?>">
							      <input type="hidden" class="form-control" name="hari_berakhir" value="<?php echo $key->date_end;?>">
							      <input type="number" class="form-control" name="tunda_hari">
							    </div>
							    <label class="col-sm-2 col-form-label">Hari</label>
							  </div>
							</div>
							<div class="col-md-12 border-top">
							  <div class="form-group mt-3 row">
							    <label class="col-sm-5 col-form-label font-weight-bold">Ganti waktu</label>
							    <div class="col-sm-5">
							      <input type="hidden" class="form-control" name="jam_dimulai" value="<?php echo $key->time_start;?>">
							      <input type="hidden" class="form-control" name="jam_berakhir" value="<?php echo $key->time_end;?>">
							      <input type="time" class="form-control" name="ganti_jam">
							    </div>
							    <label class="col-sm-2 col-form-label">WIB</label>
							  </div>
							</div>
							<div class="col-md-12 border-top pt-2 mb-2">
								<small class="form-text text-muted">Masukkan nilai <b class="text-success">+ (<i>positif</i>)</b> untuk <u>MENUNDA</u> dan nilai <b class="text-primary">- (<i>negatif</i>)</b> untuk <u>MEMPERCEPAT</u> ke tahap selanjutnya.</small>
							</div>
							<div class="col-md-12 border-top">
								<small class="form-text text-muted">Tahap hanya bisa <b>ditunda</b> (<i>Menambahkan Hari</i>) atau <b>dipercepat</b> (<i>Mengurangi Hari</i>), <b><span class="text-danger">TIDAK BISA</span></b> di-<i>REWIND</i> atau <b>KEMBALI LAGI</b> ke <u>TAHAP</u> <i>sebelumnya</i>.</small>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-warning btn-sm">TUNDA</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="hapus<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger text-white">
						<h5 class="modal-title">Hapus TAHAP PENILAIAN</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?php echo site_url('Penilaian/hapus_tahap/'.$key->id_tahap);?>" enctype="multipart/form-data" method="post" class="form-horizontal" />
							<p>Apakah anda yakin akan menghapus <b>Tahap <?php echo $no;?> <span class="text-danger"><?php echo $key->nama_tahap; ?></span></b> ?</p>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php $no++; } ?>
	</div>
</div>
</div>
</div>


<!-- MODAL Tambah -->
<div id="tambah" class="modal fade" role="dialog" tabindex="-1" >
	<div class="modal-dialog modal-dialog-centered modal-lg m-auto" role="document">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah TAHAP PENILAIAN</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('penilaian/tambah_tahap');?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label class="font-weight-bold">Nama Tahap Penilaian</label> <small class="text-danger">*</small>
						<input type="rext" class="form-control" name="nama_tahap" placeholder="Masukkan nama tahap penilaian">
						<small class="form-text text-muted">Masukkan nama TAHAP seperti <u>penyisihan</u>, <u>final</u>, etc <b>BUKAN</b><span class="text-danger"> Tahap 1</span>, <span class="text-danger">2</span>, etc.</small>
					</div>
					<div class="row mb-3">
						<div class="col-md-4">
							<div class="form-group mb-0">
								<label class="font-weight-bold">Tanggal Dimulai</label> <small class="text-danger">*</small>
								<input type="date" class="form-control" id="date_start" name="date_start" placeholder="Masukkan nama tahap penilaian">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group mb-0">
								<label class="font-weight-bold">Waktu</label> <small class="text-danger">*</small>
								<input type="time" class="form-control" name="time_start" placeholder="Masukkan nama tahap penilaian">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group mb-0">
								<label class="font-weight-bold">Tanggal Berakhir</label> <small class="text-danger">*</small>
								<input type="date" class="form-control" name="date_end" placeholder="Masukkan nama tahap penilaian">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group mb-0">
								<label class="font-weight-bold">Waktu</label> <small class="text-danger">*</small>
								<input type="time" class="form-control" name="time_end" placeholder="Masukkan nama tahap penilaian">
							</div>
						</div>
						<div class="col-md-12">
							<small class="form-text text-muted">Klik pada icon <u>kalender</u> atau <u>jam</u> untuk <b>MEMILIH</b> tanggal dan waktu. Jika menggunakan <b>Web Browser CHROME</b></small>
						</div>
					</div>
					<div class="form-group">
						<label class="font-weight-bold">Keterangan</label> <small class="text-warning">Opsional</small>
						<textarea type="text" class="form-control" name="keterangan" placeholder="Tambahkan keterangan"></textarea>
						<small class="form-text text-muted">Tahap ini akan <b>OTOMATIS</b> masuk terbuka atau <u>aktif</u> sesuai <span class="text-primary"><b>Tanggal</b></span> dan <span class="text-primary"><b>Waktu</b> Dimulai</span> (<b>JIKA SEMUA KRITERIA PENILAIAN TELAH TERISI PADA SETIAP BIDANG LOMBA)</b>, dan <b>OTOMATIS</b> tertutup <u>selesai</u> sesuai <span class="text-danger"><b>Tanggal</b></span> dan <span class="text-danger"><b>Waktu</b> Berakhir</span>. Tetapi, anda dapat <b>MENUNDA</b> status Tahap ini (<i>Aktif</i>/<i>Selesai</i>) nanti. </small>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary btn-sm">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(document.getElementById('date_start')).focusout(function(){
		  var startDate = new Date(document.getElementById('date_start').value);
		  var today = new Date();
		  if (startDate.getTime() < today.getTime()) {
		    alert("Tanggal yang anda masukkan sama dengan hari ini: "+today);
		  }
    	});  
	});
</script>