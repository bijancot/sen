<!-- Page Heading -->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
    <div class="col-lg-6">
        <h1 class="h3 mb-0 text-gray-800"><b>Verifikasi BERKAS TIM</b> | LO - Kreatif</h1>
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
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar peserta WEBINAR - NON PESERTA - LO KREATIF</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('Lo_final/VerifikasiWebinar');?>" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="title">Pilih Status Peserta: </label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="status">
                                    <optgroup>
                                        <option
                                        <?php
                                        if($status == 0){
                                            echo "value='0'>Belum Verifikasi";
                                        }elseif($status == 1){
                                            echo "value='2'>Sudah Verifikasi";
                                        }elseif($status == 7){
                                            echo "value='7'>Bukti ERROR";
                                        }elseif($status == 10){
                                            echo "value='10'>DITOLAK";
                                        }?></option>
                                    </optgroup>
                                    <optgroup>
                                        <option value="0">Belum Verifikasi</option>
                                        <option value="1">Sudah Verifikasi</option>
                                        <option value="7">Bukti ERROR</option>
                                        <option value="10">DITOLAK</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar peserta WEBINAR - NON PESERTA - LO KREATIF - 
                    <?php
                    if($status == 0){
                        echo "<span class='badge badge-secondary'>Belum Verifikasi</span>";
                    }elseif($status == 1){
                        echo "<span class='badge badge-success'>Sudah Verifikasi</span>";
                    }elseif($status == 7){
                        echo "<span class='badge badge-warning'>Bukti ERROR</span>";
                    }elseif($status == 10){
                        echo "<span class='badge badge-danger'>DITOLAK</span>";
                    }?></h6>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Series WEBINAR</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Nama PT</th>
                                <th>Bukti Bayar</th>
                                <th>Status</th>
                                <th>Verifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($get_webinar == FALSE || empty($get_webinar)) {
                                echo "<tr><td colspan='9'><center>Tidak ada Data/Pilih Status</center></td></tr>";
                            }else{$no = 1; foreach ($get_webinar as $key) { ?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $key->namaweb;?></td>
                                    <td><?php echo $key->nama;?></td>
                                    <td><?php echo $key->email;?></td>
                                    <td><?php echo $key->no_telp;?></td>
                                    <td><?php if($key->namapts != null || !empty($key->namapts)){ echo $key->namapts;}else{echo $key->idpt;}?></td>
                                    <td><?php if($key->bukti_bayar == "Non-Sertifikat"){echo "Non - Sertifikat";}else{?><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#bukti<?php echo $no;?>"><i class="fa fa-eye fa-sm"></i></button><?php }?></td>
                                    <?php if($key->status == 0){echo " <td class='table-secondary'>Belum Verifikasi</td>";}elseif($key->status == 7){echo " <td class='table-warning'>Bukti Tidak Tampil</td>";}elseif($key->status == 10){echo " <td class='table-danger'>DITOLAK</td>";}elseif($key->status == 1){echo " <td class='table-success'>Sudah Verifikasi</td>";}else{echo " <td class='table-dark'>".$key->status."</td>";}?></td>
                                    <td><button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#verif<?php echo $no;?>"><i class="fa fa-gavel fa-sm"></i></button></td>
                                </tr>


                                <!-- MODAL Tambah -->
                                <div id="bukti<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">Bukti bayar peserta WEBINAR</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="prev-img" width="100%" src="<?php

                                                $awal = explode(".", $key->bukti_bayar);
                                                $cek = str_replace(".", "_", $awal[0]);
                                                 echo base_url()."".$cek.".".$awal[1];?>" alt="Bukti Bayar Peserta">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- MODAL Tambah -->
                                <div id="verif<?php echo $no;?>" class="modal fade" role="dialog" tabindex="-1" >
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header bg-info text-white">
                                                <h5 class="modal-title">Verifikasi bukti peserta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-2">Ganti STATUS - <b><?php echo $nama;?></b>, Menjadi?</p>
                                                <center>
                                                <a href="<?php echo site_url('Lo_final/terima/1/'.$key->id_pendaftaran);?>" class="btn btn-success btn-sm shadow-sm">Terima Bukti</a>
                                                <a href="<?php echo site_url('Lo_final/gkjelas/7/'.$key->id_pendaftaran);?>" class="btn btn-warning btn-sm shadow-sm">Bukti tidak tampil</a>
                                                <a href="<?php echo site_url('Lo_final/tolak/10/'.$key->id_pendaftaran);?>" class="btn btn-danger btn-sm shadow-sm">TOLAK</a></center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++; }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>