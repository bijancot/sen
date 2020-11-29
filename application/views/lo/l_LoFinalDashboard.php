<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-9">
		<h1 class="h3 mb-0 text-gray-800"><b>Dashboard LO</b> | <strong><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></strong></h1>
	</div>
</div>
<!-- Content Row -->
<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (TIM FINAL)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tim_final;?> TIM</div>
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
		<div class="card border-left-warning shadow py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Juri</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_juri;?> Juri</div>
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
		<div class="card border-left-info shadow py-2">
			<div class="card-body pb-1">
				<div class="row no-gutters align-items-center mb-2">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-info text-uppercase mb-1"></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Daftar Penilaian</div>
					</div>
					<div class="col-auto">
						<i class="fa fa-gavel fa-2x text-gray-300"></i>
					</div>
				</div>
				<a href="<?php echo site_url('Lo_final/DaftarNilai');?>" class="btn btn-info btn-sm shadow-sm btn-block mb-0">Daftar Penilaian</a>
			</div>
		</div>
	</div>
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow py-2">
			<div class="card-body pb-1">
				<div class="row no-gutters align-items-center mb-2">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-success text-uppercase mb-1"></div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">Hasil Penilaian</div>
					</div>
					<div class="col-auto">
						<i class="fa fa-eraser fa-2x text-gray-300"></i>
					</div>
				</div>
				<a href="<?php echo site_url('Lo_final/DaftarNilai');?>" class="btn btn-success btn-sm shadow-sm btn-block mb-0">Hasil Penilaian</a>
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
<?php } if($nourut == FALSE){ ?>
	<div class="alert alert-primary shadow alert-icon" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<b>Harap mengatur Giliran/No Urut Peserta. Klik <a href="<?php echo site_url('Lo_final/DaftarPeserta');?>" class="text-warning">disini</a> untuk mengatur Giliran/No Urut Peserta</b>
	</div>
	<br>
<?php }?>
<div class="row mb-3">
	<div class="col-lg-5">
		<div class="card shadow">
			<div class="card-header py-3">
				<h5 class="m-0 font-weight-bold text-primary">Cortana</h5>
			</div>
			<div class="card-body">
				<p><b>Harap Cross Check Hal Berikut</b> :</p>
				<ol>
					<li>Pastikan kriteria penilaian telah benar, cek <a href="<?php echo site_url('Lo_final/Kriteria');?>" class="text-primary">disini</a></li>
					<li>Pastikan telah mengkonfirmasi dewan juri</li>
					<li>Pastikan No urut peserta telah benar, cek <a href="<?php echo site_url('Lo_final/DaftarPeserta');?>" class="text-primary">disini</a></li>
					<li>Sistem penilaian pada JURI hanya berisi LAMAN PENILAIAN, presentasi karya peserta mengikuti kebijakan masing-masing. Jika ingin menggunakan sistem sebagai media presentasi, mohon menghubungi admin.</li>
				</ol>

				<p class="text-secondary">PM ME if something wrong</p>
				<br>
				<p class="text-right">Regards, Mahe'</p>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="card shadow mb-3">
			<div class="card-body">
				<table id="dataTable" width="100%" class="table table-stripped table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Juri</th>
							<th>Tim Final</th>
							<th>Belum Dinilai</th>
							<th>Sudah Dinilai</th>
							<th>Chat</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$gj = $this->db->query("SELECT * FROM l_bidangjuri AS a, admin AS b, lomba AS c WHERE a.id_user = b.`id` AND  a.`id_lomba` = c.`id` AND a.id_lomba = '$id_lomba' AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'");
						$juri = $gj->result();
						
						foreach($juri as $row){
							$harus_dinilai = $this->db->query("SELECT  COUNT(*) AS jumlah FROM peserta AS a, lomba AS b WHERE a.idlomba='$row->id_lomba' AND `status` = '7' AND a.`idlomba` = b.`id`")->row();
							$lb = $this->db->query("SELECT COUNT(*) as jumlah FROM peserta WHERE idlomba = '$row->id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$row->id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$row->id_user') AND STATUS = 5");
							$lomba = $lb->row();
							$sudah_dinilai = $harus_dinilai->jumlah - $lomba->jumlah;
							?>
							<tr class="<?php if($sudah_dinilai == 0){echo "table-warning";}?>">
								<td><?php echo $no; ?></td>
								<td><?php echo $row->nama; ?></td>
								<td><?php echo $harus_dinilai->jumlah; ?></td>
								<td class="table-danger"><?php echo $lomba->jumlah; ?></td>
								<td class="table-success"><?php echo $sudah_dinilai; ?></td>
								<td><a href="mailto:<?php echo $row->email;?>" data-toggle="tooltip" data-placement="top" title="Kirim EMAIL" target="_blank" class="btn btn-secondary btn-sm"><i class="fa fa-mail-forward"></i></a></td>
							</tr>
							<?php $no++; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>