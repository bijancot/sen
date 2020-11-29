<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-8">
		<h1 class="h3 mb-0 text-gray-800"><b>Data Kategori/Kriteria Penilaian</b> | LO - Kreatif</h1>
	</div>
	<div class="col-lg-4 text-right">
		<a href="<?php echo site_url('Penilaian/Kriteria');?>" class="d-none d-md-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fa fa-step-backward fa-sm text-white-50"></i> Kembali</a>
		<a href="<?php echo site_url('Juri');?>" class="d-none d-md-inline-block btn btn-sm btn-warning shadow-sm mt-1"><i class="fa fa-user-plus fa-sm text-white-50"></i> Tambahkan Juri</a>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card shadow mb-3">
			<div class="card-body">
				<label>Bidang Lomba</label>
				<h4 class="font-weight-bold mb-0"><?php echo $get_curlomba->namalomba;?></h4>
			</div>
		</div>
		<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambah">Tambah Kriteria</button>
	</div>
	<div class="col-md-9">
		<?php if ($this->session->flashdata('notif')) { ?> 
			<!-- Menampilkan Notif -->
			<div class="alert alert-warning alert-icon" role="alert">
				<?php echo $this->session->flashdata('notif'); ?>
			</div>
			<!-- Menampilkan Notif -->
		<?php }else{ ?>
			<div class="alert alert-primary alert-icon mb-3" role="alert">
				Klik pada value/item yang ingin dirubah/diedit
			</div>
		<?php }?>
		<br>
		<div class="card shadow mb-3">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Kriteria Bidang Lomba <?php echo $get_curlomba->namalomba;?> </h6>
			</div>
			<div class="card-body">
					<table id="dataTable" class="table table-bordered table-sm table-hover">
						<thead>
							<tr>
								<th width='25%'>Kriteria</th>
								<th width='45%'>Keterangan</th>
								<th width='25%'>Bobot Nilai (%)</th>
								<th width='5%'>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomer = 1;
       // User List
							foreach($get_kriteria as $data){

								echo "<tr>";
								echo "<td>
								<span class='edit' data-toggle='tooltip' data-placement='top' title='Klik untuk mengubah'>".$data->kriteria."</span>
								<input type='text' class='txtedit form-control' data-toggle='tooltip' data-placement='top' title='Klik diluar untuk menyimpan' data-id='".$data->id_kategori."' data-field='kriteria' id='namatxt_".$data->id_kategori."' value='".$data->kriteria."' >
								</td>";
								echo "<td>
								<span class='edit' data-toggle='tooltip' data-placement='top' title='Klik untuk mengubah'>".$data->keterangan."</span>
								<input type='text' class='txtedit form-control' data-toggle='tooltip' data-placement='top' title='Klik diluar untuk menyimpan' data-id='".$data->id_kategori."' data-field='keterangan' id='keterangantxt_".$data->id_kategori."' value='".$data->keterangan."' >
								</td>";
								echo "<td>
								<span class='edit' data-toggle='tooltip' data-placement='top' title='Klik untuk mengubah'>".$data->bobot."</span>
								<input type='text' class='txtedit form-control' data-toggle='tooltip' data-placement='top' title='Klik diluar untuk menyimpan' data-id='".$data->id_kategori."' data-field='bobot' id='bobottxt_".$data->id_kategori."' value='".$data->bobot."' >
								</td>";
								echo "<td>
								<button type='button' class='btn btn-sm btn-block btn-danger' data-toggle='modal' data-target='#hapus".$nomer."'><i class='fa fa-trash-o'></i></button>
								</td>";
								echo "</tr>";
								?>
								<div class="modal fade" id="hapus<?php echo $nomer; ?>" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header bg-danger text-white">
												<h5 class="modal-title">Hapus KRITERIA PENILAIAN</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p>Apakah anda yakin akan menghapus <b><span class="text-danger"><?php echo $data->kriteria; ?></span></b> ?</p>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
													<button class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top" title="Klik untuk menghapus" data-field="id_kategori" data-id="<?php echo $data->id_kategori;?>" id="hpusbtn_'<?php echo $data->id_kategori?>"><i class="fa fa-trash-o"></i> Hapus Kategori</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php $nomer++; } ?>
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>


	<!-- MODAL -->
	<div id="tambah" class="modal fade" role="dialog" tabindex="-1" >
		<div class="modal-dialog modal-dialog-centered modal-lg m-auto" role="document">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<h5 class="modal-title font-weight-bold">Tambah KRITERIA PENILAIAN</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo site_url('penilaian/proses_make/'.$id_tahap.'/'.$id_lomba);?>" method="POST">
					<div class="modal-body">
						<div class="table-responsive">  
							<table class="table" id="dynamic_field">  
								<tr>
									<td width="40%">
										<input type="text" name="kriteria[]" placeholder="Kriteria 1" class="form-control name_list mb-3" />
										<input type="number" name="bobot[]" placeholder="Bobot %" class="form-control name_list" />
									</td>
									<td width="60%">
										<textarea type="text" name="keterangan[]" placeholder="Keterangan" rows="3" class="form-control name_list" /></textarea>
									</td>
								</tr>
							</table>   
						</div>  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary btn-sm">Tambah</button>
						<button type="button" name="add" id="add" class="btn btn-success btn-sm">Tambahkan Field</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>  
		$(document).ready(function(){  
			var i=1;  
			$('#add').click(function(){  
				i++;  

				$('#dynamic_field').append('<tr id="row'+i+'"><td width="40%"><input type="text" name="kriteria[]" placeholder="Kriteria '+i+'" class="form-control name_list mb-3" /><input type="number" name="bobot[]" placeholder="Bobot %" class="form-control name_list" /><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn-block mt-3 btn_remove"><span class="icon text-white-50"><i class="fas fa-trash"></i> Hilangkan Kolom ini</button></td><td width="60%"><textarea type="text" name="keterangan[]" placeholder="Keterangan" rows="3" class="form-control name_list" /></textarea></td></tr>');  
			});  
			$(document).on('click', '.btn_remove', function(){  
				var button_id = $(this).attr("id");   
				$('#row'+button_id+'').remove();  
			});  
		});  
	</script>
	<!-- Script -->
	<script type="text/javascript">
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		$(document).ready(function(){

       // On text click
       $('.edit').click(function(){
          // Hide input element
          $('.txtedit').hide();

          // Show next input element
          $(this).next('.txtedit').show().focus();

          // Hide clicked element
          $(this).hide();
      });

       // Focus out from a textbox
       $('.txtedit').focusout(function(){
          // Get edit id, field name and value
          var edit_id = $(this).data('id');
          var fieldname = $(this).data('field');
          var value = $(this).val();

          // assign instance to element variable
          var element = this;

          // Send AJAX request
          $.ajax({
          	url: '<?= base_url() ?>Penilaian/updatekriteria',
          	type: 'post',
          	data: { field:fieldname, value:value, id:edit_id },
          	success:function(response){

              // Hide Input element
              $(element).hide();

              // Update viewing value and display it
              $(element).prev('.edit').show();
              $(element).prev('.edit').text(value);
          }
      });
      });

       // Focus out from a textbox
       $('.hapus').click(function(){
          // Get edit id, field name and value
          var hapus_id = $(this).data('id');

          // assign instance to element variable
          var element = this;

          // Send AJAX request
          $.ajax({
          	url: '<?= base_url() ?>Penilaian/deletekriteria',
          	type: 'post',
          	data: { id:hapus_id },
          	success:function(response){ 
          		location.reload(); 
          	}
          });
      });

   });
</script>