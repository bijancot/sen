<style type="text/css">

	.select2-container--bootstrap {
		display: inline-block;
		width: 100% !important;
	}</style>

	<!-- MODAL Tambah -->
	<div id="nourut" class="modal fade" role="dialog">
		<div class="modal-dialog" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-info text-white">
					<h5 class="modal-title">Atur No Urut Peserta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo site_url('Lo_final/pushnourut/'.$id_lomba);?>" method="POST">
					<div class="modal-body">
						<table width="100%">
							<?php
							$jmltim = $this->M_lo->jml_tim_final($id_lomba);
							for ($nor=1; $nor <= $jmltim ; $nor++) {
								?>
								<tr>
									<td width="20%">No Urut <?php echo $nor;?>
									<input type="hidden" name="nourut[]" value="<?php echo $nor;?>">
								</td>
								<td>
									<select name="id_peserta[]" class="form-control">
										<?php $get_peserta = $controller->M_lo->get_peserta($id_lomba);
										foreach ($get_peserta as $urut) {
											?>
											<option value="<?php echo $urut->id;?>"><?php echo $urut->namatim;?></option>
										<?php }?>
									</select>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-info btn-sm font-weight-bold text-white">Yakin dan kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-7">
		<h1 class="h3 mb-0 text-gray-800"><b>DAFTAR PESERTA</b> - <strong><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></strong></h1>
	</div>
	<div class="col-lg-5 text-right">
		<a href="javascript:window.history.go(-1);" class="d-none d-md-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fa fa-step-backward fa-sm text-white-50"></i> Kembali</a>
		<button class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1" data-toggle="modal" data-target="#nourut"><i class="fa fa-gavel fa-sm text-white-50"></i> Atur No URUT Peserta</button>
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
				<h5 class="m-0 font-weight-bold text-primary">Daftar PESERTA - Bidang Lomba <span class="badge badge-primary h4"><?php if(!empty($namalomba->namalomba)){echo $namalomba->namalomba;}else{echo "Pilih Bidang Lomba";}?></span></h5>
			</div>
			<div class="card-body">
				<table id="dataTable" class="table table-stripped table-sm table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama TIM</th>
							<th>Anggota</th>
							<th>KTM</th>
							<th>Teaser</th>
							<th>Karya</th>
							<th width="8%">Chat</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($peserta == null) {echo "<tr class='mt-2 mb-2 pt-1 pb-1' height='40px'><td colspan='8'><center class='font-weight-bold text-secondary h5'>Tidak ada Data</center></td></tr>";
							# code...
					}else{ $no=1; foreach ($peserta as $key) { ?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $key->namatim;?></td>
							<td>
								<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#anggota<?php echo $no;?>">Lihat</button>
							</td>
								<td>
									<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#ktm<?php echo $no;?>">Lihat</button>
								</td>
							<td>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#teaser<?php echo $no;?>">Lihat</button>
							</td>
							<td>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#karya<?php echo $no;?>">Lihat</button>
							</td>
							<td>
								<?php 
								$wa = preg_replace('/^0/', '62', $key->nohp);
								?>
								<a href="https://api.whatsapp.com/send?phone=<?php echo $wa;?>" data-toggle="tooltip" data-placement="top" title="Kirim Pesan Whatsapp" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-whatsapp"></i></a>
								<a href="mailto:<?php echo $key->email;?>" data-toggle="tooltip" data-placement="top" title="Kirim EMAIL" target="_blank" class="btn btn-secondary btn-sm"><i class="fa fa-mail-forward"></i></a>
							</td><!-- MODAL KTM -->
									<div id="ktm<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
										<div class="modal-dialog modal-xl" role="document">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header bg-primary text-white">
													<h5 class="modal-title">SOFTFILE KTM - TIM <b><?php echo $key->namatim;?></b></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<?php $get_ktm = $controller->M_verifikasi->get_ktm($key->id);
													if (!empty($get_ktm->ktm)) {
														echo '<iframe width="100%" frameborder="0" height="450px" src="'.base_url('').$get_ktm->ktm.'"></iframe>';
														echo '<p>Download KTM: <a href="'.base_url().$get_ktm->ktm.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
													}else{
														echo "<center>Belum upload KTM</center>";
													}
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
												</div>
											</div>
										</div>
									</div>


									<!-- MODAL Pernyataan -->
									<div id="pernyataan<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
										<div class="modal-dialog modal-xl" role="document">
											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header bg-primary text-white">
													<h5 class="modal-title">Surat PERNYATAAN - TIM <b><?php echo $key->namatim;?></b></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<?php
													if (!empty($key->pernyataan)) {
														echo '<iframe width="100%" height="450px" frameborder="0" src="'.base_url('')."berkas/".str_replace("/","", $namalomba->namalomba)."/".$key->namatim."(".$key->idpt.")/karya/".$key->pernyataan.'"></iframe>';
														echo '<p>Download Surat Pernyataan: <a href="'.base_url('')."berkas/".str_replace("/","", $namalomba->namalomba)."/".$key->namatim."(".$key->idpt.")/karya/".$key->pernyataan.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
													}else{
														echo "<center>Belum upload Surat Pernyataan</center>";
													}
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
												</div>
											</div>
										</div>
									</div>


							<!-- MODAL ANGGOTA -->
							<div id="anggota<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
								<div class="modal-dialog modal-xl" role="document">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header bg-primary text-white">
											<h5 class="modal-title">Data ANGGOTA - TIM <b><?php echo $key->namatim;?></b></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-4"><b>Nama TIM</b></div>
														<div class="col">: <?php echo $key->namatim;?></div>
													</div>
													<div class="row">
														<div class="col-md-4"><b>Perguruan TINGGI</b></div>
														<div class="col">: <?php echo $key->namapt;?></div>
													</div>
													<div class="row">
														<div class="col-md-4"><b>Instagram</b></div>
														<div class="col">: <?php
														$a 		= $controller->M_verifikasi->get_insta($key->id);
														if ($a != null){echo $a->instagram;}else{echo "Belum Menambahkan Instagram";}?></div>
													</div>
													<div class="row">
														<div class="col-md-4"><b>No TELP TIM</b></div>
														<div class="col">: <?php echo $key->nohp;?></div>
													</div>
													<div class="row">
														<div class="col-md-4"><b>Email TIM</b></div>
														<div class="col">: <?php echo $key->email;?></div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-md-4"><b>Nama Pembimbing</b></div>
														<div class="col">: <?php
														$a 		= $controller->M_verifikasi->get_pembimbing($key->id);
														if ($a != null){echo $a->pembimbing;}else{echo "Belum Mengisi data Pembimbing";}?></div>
													</div>
													<div class="row">
														<div class="col-md-4"><b>NIDN Pembimbing</b></div>
														<div class="col"><?php
														$a 		= $controller->M_verifikasi->get_pembimbing($key->id);
														if ($a != null){echo ": ".$a->nidn;}?></div>
													</div>
												</div>
											</div>
											<hr>
											<?php
											$anggota = $controller->M_verifikasi->get_anggota($key->id);
											if ($anggota != null) {
												if(!empty($anggota->namaketua)){
													?>
													<div class="row mt-1 mb-2">
														<div class="col-md-1 text-center"><b>No</b></div>
														<div class="col"><b>Nama</b></div>
														<div class="col"><b>Email</b></div>
														<div class="col"><b>Nomor HP</b></div>
													</div>
													<hr>
													<div class="row mt-0 mb-2">
														<div class="col-md-1 text-center">1</div>
														<div class="col"><?php echo $anggota->namaketua;?> <b>(Ketua)</b></div>
														<div class="col"><?php echo $key->email;?></div>
														<div class="col"><?php echo $key->nohp;?></div>
													</div>
													<hr>
												<?php }else{echo "Belum Menambahkan data Anggota";} if (!empty($anggota->anggota2)) { ?>
													<div class="row mt-0 mb-2">
														<div class="col-md-1 text-center">2</div>
														<div class="col"><?php echo $anggota->anggota2;?></div>
														<div class="col"><?php echo $anggota->email2;?></div>
														<div class="col"><?php echo $anggota->nohp2;?></div>
													</div>
													<hr>
												<?php } if (!empty($anggota->anggota3)) { ?>
													<div class="row mt-0 mb-2">
														<div class="col-md-1 text-center">3</div>
														<div class="col"><?php echo $anggota->anggota3;?></div>
														<div class="col"><?php echo $anggota->email3;?></div>
														<div class="col"><?php echo $anggota->nohp3;?></div>
													</div>
													<hr>
												<?php } if (!empty($anggota->anggota4)) { ?>
													<div class="row mt-0 mb-2">
														<div class="col-md-1 text-center">4</div>
														<div class="col"><?php echo $anggota->anggota4;?></div>
														<div class="col"><?php echo $anggota->email4;?></div>
														<div class="col"><?php echo $anggota->nohp4;?></div>
													</div>
													<hr>
												<?php } if (!empty($anggota->anggota5)) { ?>
													<div class="row mt-0 mb-2">
														<div class="col-md-1 text-center">5</div>
														<div class="col"><?php echo $anggota->anggota5;?></div>
														<div class="col"><?php echo $anggota->email5;?></div>
														<div class="col"><?php echo $anggota->nohp5;?></div>
													</div>
												<?php }}else{echo "<center>Belum menambahkan Data Anggota</center>";}?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
											</div>
										</div>
									</div>
								</div>


								<!-- MODAL TEASER -->
								<div id="teaser<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
									<div class="modal-dialog" role="document">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header bg-primary text-white">
												<h5 class="modal-title">Teaser - TIM <b><?php echo $key->namatim;?></b></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
												if (!empty($key->teaser)) {

													if (strpos($key->teaser, "instagram")) {
														$first = explode("?", $key->teaser);

														echo '<iframe width="100%" style="height: -webkit-fill-available;" src="'.$first[0]."embed/".'" frameborder="0"></iframe>';
														echo '<p>Visit Page: <a href="'.$first[0]."embed/".'" target="_blank">TIM - '.$key->namatim.'</a><p>';
													}else{
														echo 'The link given is not an instagram embed feed, Please Visit this link for verification: <a href="'.$key->teaser.'" target="_blank">visit link</a>';
														strpos("instagram", $key->teaser);
													}
												}else{
													echo "<center>Belum upload Instagram Feed Teaser</center>";
												}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
											</div>
										</div>
									</div>
								</div>


								<!-- MODAL karya -->
								<div id="karya<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
									<div class="modal-dialog modal-lg" role="document">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header bg-primary text-white">
												<h5 class="modal-title">Karya - TIM <b><?php echo $key->namatim;?></b></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php
												$file = explode(".", substr($key->karya, -5));

												if (!empty($key->karya2) AND $this->uri->segment(3) == 4) {
													echo '<a href="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya2.'" class="btn btn-success">Download .zip file</a>';
												}
												if(end($file) == "pdf"){
													echo '<p>Open at new page: <a href="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
													echo "<hr>";
													echo '<iframe src="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" style="height:450px;width:100%" frameborder="0" title="Surat Pernyataan"></iframe>';
												}elseif(end($file) == "jpg" || end($file) == "png" || end($file) == "jpeg" || end($file) == "JPG" || end($file) == "JPEG" || end($file) == "PNG"){
													echo '<p>Open at new page: <a href="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
													echo "<hr>";
													echo '<img src="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" class="img-fuild">';
												}elseif(end($file) == "mp4" || end($file) == "avi" || end($file) == "MP4" || end($file) == "AVI" || end($file) == "MPEG" || end($file) == "mpeg"){
													if (isset($key->youtube)) {

														$yt = explode("/", $key->youtube);

														echo '<p>Visit page: <a href="'.$key->youtube.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
														echo "<hr>";
														echo '<iframe width="100%" height="450px" src="https://www.youtube.com/embed/'.end($yt).'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
													}else{
														echo '<p>Open at new page: <a href="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" target="_blank">TIM - '.$key->namatim.'</a><p>';
														echo '<iframe src="'.base_url('').'berkas/'.str_replace("/", "", $namalomba->namalomba).'/'.$key->namatim.'('.$key->idpt.')/karya/'.$key->karya.'" style="height:450px;width:100%" frameborder="0"></iframe>';
													}
												}else{
													echo "Undefined Type of FILE (Hubungi ADMIN).";
													echo "<br>Link karya:".$key->karya;
												}
												?>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
											</div>
										</div>
									</div>
								</div>

							</tr>
							<?php $no++;}}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>