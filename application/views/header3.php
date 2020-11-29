<!DOCTYPE html>
<html lang="en">
	
  <head>
      
      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179522066-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-179522066-1');
</script>

		
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta property="og:title" content="Example Page">
<meta property="og:image" content="http://aptisi7jatim.org/assets/images/seminar/ew1.jpg">
<meta property="og:description" content="This is just an example page.">
<meta property="og:url" content="http://aptisi7jatim.org/Seminar/WB-NS-01">
<meta name="twitter:card" content="summary_large_image">
		<link rel="icon" href="<?=base_url();?>assets/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
		
    <title>LO KREATIF</title>
		<!--
			
			ART FACTORY
			
			https://templatemo.com/tm-537-art-factory
			
		-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/font-awesome.css">
		
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/owl-carousel.css">
		<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
		
		<!-- select2 -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		
		<!-- select2-bootstrap4-theme -->
		<link href="<?=base_url();?>assets/css/select2-bootstrap.css" rel="stylesheet"> <!-- for local development env -->
	  <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/templatemo-art-factory.css">
	  <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/custom-fd.css">
	</head>
	
	<body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
			<div class="jumper">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>  
    <!-- ***** Preloader End ***** -->
		
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky <?=$this->uri->segment(1) == 'pendaftaran'?'background-header':'';?> <?=$this->uri->segment(1) == 'Seminar'?'background-header':'';?>">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav class="main-nav">
							<!-- ***** Logo Start ***** -->
							
							<a class="navbar-brand" href="/">
								<img src="https://senca.web.id/wp-content/uploads/2020/11/stiki-senca.png" width="160" height="60" alt="">
							</a>
							<!-- ***** Logo End ***** -->
							<!-- ***** Menu Start ***** -->
							<ul class="nav">
							    <li class="scroll-to-section"><a href="<?=base_url();?>">Home</a></li>
								<li class="submenu">
									<a href="javascript:;">Update</a>
									<ul>
										<li><a href="<?php echo base_url();?>pengumuman">Pengumuman</a></li>
										<li><a href="<?php echo base_url();?>jadwal">Jadwal</a></li>
										<li><a href="<?php echo base_url();?>info_lomba">Info Lomba</a></li>
										<li><a href="<?php echo base_url();?>info_juri">Info Juri</a></li>
										<li><a href="<?php echo base_url();?>info_webinar">Info Webinar</a></li>
									</ul>
								</li>
                                <li class="submenu">
									<a href="javascript:;">Statistik</a>
									<ul>
										<li><a href="statistik">Lomba</a></li>
										<li><a href="statistik_webinar">Seminar</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="javascript:;">Download</a>
									<ul>
										<li><a href="http://aptisi7jatim.org/Panduan%20Lokreatif%202020%20rev%203.0.pdf">Buku Panduan</a></li>
										<li><a href="http://aptisi7jatim.org/Lampiran A Surat Pernyataan LO KREATIF 2020.docx">Surat Pernyataan</a></li>
										<li><a href="http://aptisi7jatim.org/Logo.rar">Logo</a></li>
									    <li><a href="http://aptisi7jatim.org/E-Flyer%20LO%20KREATIF%202020.jpeg">E-Flier</a></li>
										<li><a href="http://aptisi7jatim.org/Video%20Opening.mp4">Video Opening</a></li>
									</ul>
								</li>
								<li class="scroll-to-section"><a href="<?php echo base_url();?>tentang">Tentang</a></li>
								<li class="scroll-to-section"><a href="<?php echo base_url();?>info_webinar">Daftar</a></li>
								<li class="scroll-to-section"><a href="<?php echo base_url();?>login">Login</a></li>
							</ul>
							<a class='menu-trigger'>
								<span>Menu</span>
							</a>
							<!-- ***** Menu End ***** -->
						</nav>
					</div>
				</div>
			</div>
		</header>
    <!-- ***** Header Area End ***** -->
		
		<?php
			echo $this->session->flashdata('message');
		?>
		
