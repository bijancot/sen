<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-lg-12">
        <h1 class="h3 mb-0 text-gray-800"><b>LO - Kreatif</b></h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-4">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-left-success shadow py-2">
                    <div class="card-body pb-1 pt-2">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-success text-uppercase mb-1">Tahap Penilaian</div>
                                <?php if ($get_tahap == false) { echo "<b><center class='h5 mb-0 font-weight-bold'>Belum ada</center></b>";
                            }else{?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $get_tahap->nama_tahap;?></div>Berakhir <span class="text-danger"><b><?php echo $get_tahap->date_end;}?></b></span>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-gavel fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <?php if ($get_tahap != false) { ?><a href="<?php echo site_url('Juri/Penilaian');?>" class="btn btn-primary shadow-sm btn-block btn-sm"><i class="fa fa-paint-brush fa-sm text-white-50"></i> Mulai Penilaian</a><?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-left-warning shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">TIM (Yang harus dinilai)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $progress;?> / <?php echo $total_tim;?> TIM</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-sitemap fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if ($this->session->flashdata('notif')) { ?> 
            <!-- Menampilkan Notif -->
            <div class="alert alert-warning alert-icon shadow" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('notif'); ?>
            </div>
            <!-- Menampilkan Notif -->
            <br>
        <?php } ?>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-center">Hai selamat datang, <?php echo $username;?></h6>
            </div>
            <div class="card-body">
                <p class="font-weight-bold text-primary mt-0 mb-1">Bidang LOMBA yang harus dinilai:</p>
                <?php foreach ($daftar_bidang as $key) {?>
                    <p class="ml-2 mt-0 mb-1">- <?php echo $key->namalomba;?></p>
                <?php }?>
                <hr>
                <p>Anda dapat <u>mulai melakukan penilaian</u> dengan menekan tombol <b>"Mulai Penilaian"</b> atau masuk kedalam menu <b>"Lembar Penilaian"</b>.<br><b>Harap</b> menyelesaikan <u>penilaian</u> <b>sebelum tanggal yang telah ditentukan</b>. Jika terdapat <i>kendala</i> atau <i>masalah</i>, anda dapat <b>menghubungi Contact Person</b> kami:</p>
                <p class="mb-1"><b>HP/WA</b>: <i>087888895535</i> (Nana)</p>
                <p class="mb-0"><b>HP/WA</b>: <i>081350204469</i> (Suhendra)</p>
                <p class="mb-0"><b>HP/WA</b>: <i>085645548497</i> (Azizah)</p>
                <p class="mb-0"><b>HP/WA</b>: <i>085755241098</i> (Diyah)</p>
            </div>
        </div>
    </div>
</div>