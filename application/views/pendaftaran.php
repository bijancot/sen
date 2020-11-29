<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Login | Lo Kreatif</title>

    <!-- Icons font CSS-->
    <link href="<?=base_url();?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url();?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="<?=base_url();?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?=base_url();?>assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?=base_url();?>assets/css/main.css" rel="stylesheet" media="all">
</head>

<body background="<?=base_url();?>assets/images/banner-bg2.png">
    <div class="page-wrapper p-t-15 p-b-100 font-poppins"><br>
        <center>
            <a href="index.html"><img src="<?=base_url();?>assets/images/aptisi.png" width="70"></a>           
        </center><br>
				
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title" style="text-align: center;">Form Pendaftaran</h2>
                    <form method="POST">
                        <div class="input-group">
                            <!--<label class="label">Nama Tim</label>-->
                            <div class="rs-select2 js-select-simple select--no-search">
                                <input class="input--style-4" type="text" name="" placeholder="Nama Tim">
                            </div>
                        </div>
                        <div class="input-group">
                            <!--<label class="label">Email Ketua Tim</label>-->
                            <div class="rs-select2 js-select-simple select--no-search">
                                <input class="input--style-4" type="text" name="" placeholder="Email">
                            </div>
                        </div>
                        <div class="input-group">
                            <!--<label class="label">Nomor Handphone Ketua Tim</label>-->
                            <div class="rs-select2 js-select-simple select--no-search">
                                <input class="input--style-4" type="text" name="" placeholder="Nomor Handphone">
                            </div>
                        </div>
                        <div class="input-group">
                            <!--<label class="label">Nama Perguruan Tinggi</label>-->
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="subject">
                                    <option disabled="disabled" selected="selected">Nama Perguruan Tinggi</option>
                                    <option>Subject 1</option>
                                    <option>Subject 2</option>
                                    <option>Subject 3</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <!--<label class="label">Kategori Lomba </label>-->
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="subject">
                                    <option disabled="disabled" selected="selected">Kategori Lomba</option>
                                    <option>Subject 1</option>
                                    <option>Subject 2</option>
                                    <option>Subject 3</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Daftar</button>
                        </div>
                        <div class="p-t-15">
                            Sudah mempunyai akun ? <a href="login.html" style="text-decoration: none;">Login</a>
                        </div>
                        <div style="font-size: 11px; text-align: center; margin-top: 50px;">
                            Copyright © 2020 LO Kreatif. All Rights Reserved.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="<?=base_url();?>assets/vendor/select2/select2.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datepicker/moment.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="<?=base_url();?>assets/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->