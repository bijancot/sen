<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
	<div class="col-lg-9">
		<h1 class="h3 mb-0 text-gray-800"><b>Data Statistik LO</b> | LO Kreatif</h1>
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
						<div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (TOTAL TIM)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tim_semua;?> TIM</div>
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
		<div class="card border-left-info shadow py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-info text-uppercase mb-1">PT (TOTAL PT)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_pt;?> PT</div>
					</div>
					<div class="col-auto">
						<i class="fa fa-building-o fa-2x text-gray-300"></i>
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
						<div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Juri (TOTAL JURI)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_juri;?> Juri</div>
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
		<div class="card border-left-secondary shadow py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-sm font-weight-bold text-secondary text-uppercase mb-1">LO (TOTAL LO)</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_lo;?> LO</div>
					</div>
					<div class="col-auto">
						<i class="fa fa-gavel fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card shadow mb-3">
            <div class="card-body">
                <table id="dataTableX" width="100%" class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bidang Lomba</th>
                            <th>Total TIM</th>
                            <th>Akun Aktif</th>
                            <th>Bayar & Validasi</th>
                            <th>Unggah Karya</th>
                            <th>Verifikasi Berkas</th>
                            <th>Reject</th>
                            <th>Lolos Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $jtim=0;$jaktif=0;$jbayar=0;$junggah=0;$jberkas=0;$jreject=0;$jlolos=0;$ts=0; $no=1; foreach ($statistik as $data){?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $data->namalomba;?></td>
                            <td><?php echo $data->TIM;?></td>
                            <td><?php echo $data->AKTIF;?></td>
                            <td><?php echo $data->BAYAR;?></td>
                            <td><?php echo $data->UNGGAH;?></td>
                            <td><?php echo $data->BERKAS;?></td>
                            <td class="table-danger"><?php echo $data->REJECT;?></td>
                            <td class="table-success"><?php echo $lolos = $data->BERKAS-$data->REJECT?>
                            </td>
                        </tr>
                        <?php 
                        $jtim = $jtim+$data->TIM;
                        $jaktif = $jaktif+$data->AKTIF;
                        $jbayar = $jbayar+$data->BAYAR;
                        $junggah = $junggah+$data->UNGGAH;
                        $jberkas = $jberkas+$data->BERKAS;
                        $jreject = $jreject+$data->REJECT;
                        $jlolos = $jlolos+$lolos;
                        $no++; }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2"><center>Total</center></th>
                            <th><?php echo $jtim;?></th>
                            <th><?php echo $jaktif;?></th>
                            <th><?php echo $jbayar;?></th>
                            <th><?php echo $junggah;?></th>
                            <th><?php echo $jberkas;?></th>
                            <th><?php echo $jreject;?></th>
                            <th><?php echo $jlolos;?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="card shadow mb-4">
        	<div class="card-header py-3">
        		<h6 class="m-0 font-weight-bold text-primary">Progress Penjurian Juri LO KREATIF <a href="<?php echo site_url('Juri/RekapNilai');?>" class="btn btn-success btn-sm pull-right font-weight-bold text-white shadow-sm">Pilih FINALIS dari peserta?</a></h6>
        	</div>
        	<div class="card-body">
        		<div class="table-responsive">
        			
        			<table id="dataTable"  class="table table-striped table-hover">
        				<thead>
        					<tr>
        						<th scope="col">No.</th>
        						<th scope="col">Nama Juri</th>
        						<th scope="col">Bidang Lomba</th>
        						<th scope="col">Yang Harus Dinilai</th>
        						<th scope="col">Sudah Dinilai</th>
        						<th scope="col">Belum Dinilai</th>
        					</tr>
        				</thead>
        				<tbody>
        					<?php
        					$no = 1;
        					$gj = $this->db->query("SELECT * FROM l_bidangjuri AS a, admin AS b, lomba AS c WHERE a.id_user = b.`id` AND  a.`id_lomba` = c.`id` AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'");
        					$juri = $gj->result();
        					
        					foreach($juri as $row){
        						$harus_dinilai = $this->db->query("SELECT  COUNT(*) AS jumlah FROM peserta AS a, lomba AS b WHERE a.idlomba='$row->id_lomba' AND `status` = '7' AND a.`idlomba` = b.`id`")->row();
        						$lb = $this->db->query("SELECT COUNT(*) as jumlah FROM peserta WHERE idlomba = '$row->id_lomba' AND idlomba IN (SELECT id_lomba FROM l_bidangjuri WHERE id_user = '$row->id_user') AND id NOT IN (SELECT id_peserta FROM l_penilaian WHERE id_user = '$row->id_user' AND id_tahap = 3) AND STATUS = 7");
        						$lomba = $lb->row();
        						$sudah_dinilai = $harus_dinilai->jumlah - $lomba->jumlah;
        						?>
        						<tr class="<?php if($sudah_dinilai == 0){echo "table-warning";}?>">
        							<td><?php echo $no; ?></td>
        							<td><?php echo $row->nama; ?></td>
        							<td><?php echo $row->namalomba; ?></td>
        							<td><?php echo $harus_dinilai->jumlah; ?></td>
        							<td style="color:green;" ><?php echo $sudah_dinilai; ?></td>
        							<td style="color:red;"><?php echo $lomba->jumlah; ?></td>
        						</tr>
        						<?php $no++; } ?>
        					</tbody>
        				</table>
        
        			</div>
        		</div>
        	</div>
        	
        	<div class="row mb-4">
            	<!-- Bar Chart -->
            	<div class="col-xl-6">
            		<div class="card shadow mb-4">
            			<div class="card-header py-3">
            				<h6 class="m-0 font-weight-bold text-primary">Berkas Terverifikasi</h6>
            			</div>
            			<div class="card-body">
            				<div class="chart-bar">
            					<div id="chart"></div>
            				</div>
            			</div>
            		</div>
            	</div>
            	
            	<!-- Project Card Example -->
            	<div class="col-xl-6">
            		<div class="card shadow mb-4">
            			<div class="card-header py-3">
            				<h6 class="m-0 font-weight-bold text-primary">Progres Penilaian</h6>
            			</div>
            			<?php $query = $this->db->query("SELECT * FROM lomba"); 
            			$lb= $query->result();
            			?>
            			<div class="card-body">
            				<?php foreach($lb as $row){ ?>
            					<?php 
            					
            					
            					
            					
            					$juri = $this->db->query("SELECT  COUNT(*) AS jumlah FROM admin WHERE `status` = '3' AND id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$row->id') AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra'")->row();
            					$count = $this->db->query("SELECT  (COUNT(*)*'$juri->jumlah') AS jumlah FROM peserta WHERE `status` = '7' AND idlomba = '$row->id' and namatim<>'hubla' and namatim<>'Superman' and namatim<>'test hendra'")->row();
            					$done = $this->db->query("SELECT count(DISTINCT id_user,id_peserta) AS jumlah FROM l_penilaian WHERE id_user IN (SELECT id FROM admin WHERE id IN (SELECT id_user FROM l_bidangjuri WHERE id_lomba = '$row->id') AND STATUS = '3' AND nama<>'Juri Ide Bisnis' AND nama<>'Juri Desain Poster' AND nama<>'Juri Aplikasi Mobile/Web' AND nama<>'Juri Desain UI/UX Aplikasi Mobile/Web' AND nama<>'Juri Video Pendek' AND nama<>'Mahendra') AND id_tahap = 3;")->row();
            					$total =   round($done->jumlah / $count->jumlah*100,1);
            					
            					$c='';
            					if ($total==100){
            						$total = "100";
            						$c='Selesai!';
            					}
            					?>
            					<h4 class="small font-weight-bold"><?php echo $row->namalomba ?> <span class="float-right"><?php echo $c ?> <?php echo $total ?> %</span></h4>
            					<div class="progress mb-4">
            						<div class="progress-bar bg-<?php if($row->id==1){echo 'primary';}else if($row->id==2){echo 'success';}else if($row->id==3){echo 'warning';}else if($row->id==4){echo 'danger';}else if($row->id==5){echo 'secondary';}?> progress-bar-striped active" role="progressbar" style="width:<?php echo $total ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            					</div>
            					<?php } ?><br>
            					<a href="<?php echo base_url() ?>Juri/DaftarNilai" type="button" class="btn btn-primary btn-block btn-sm shadow-sm">Daftar Penilaian</a>
            				</div>
            			</div>
            		</div>
            		
            	</div>
        
    </div>
</div>
			<?php 
			$query1 = $this->db->query("SELECT idlomba, COUNT(*) AS jumlah FROM peserta WHERE `status`BETWEEN 5 AND 7 GROUP BY idlomba");
			?>
<script>
  var options = {
	  plotOptions: {
			pie: {
			donut: {

						labels: {
							show: true,
							name: {
								show: false
							},
							value: {
								offsetY: -1,
								show: true
							},
							total: {
								show: true
							}
							}
						}

				}
			},
			labels: [
							<?php
							$lomba = $query->result();
					foreach ($lomba as $t) {
						echo "'" . $t->namalomba . "' ,";
					}
					?>
			],
          series: [
						<?php
						$jumlah = $query1->result();
					foreach ($jumlah as $r) {
						echo $r->jumlah . ",";
					}
					?>
		  ],
          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 170,
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
		
		
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>
<script>
    $(document).ready(function() {
        $('#dataTableX').DataTable( {
            "scrollX": true
        } );
    } );
</script>