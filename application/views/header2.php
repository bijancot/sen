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
    <meta name="description" content="">
    <meta name="author" content="Template Mo">
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
	  
    <link href='<?php echo base_url(); ?>assets/js/autocomplete/jquery.autocomplete.css' rel='stylesheet' type="text/css"/>
	</head>
	
	<body>
		
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
								
								<li class="scroll-to-section"><a href="pendaftaran">Daftar</a></li>
								<li class="scroll-to-section"><a href="login">Login</a></li>
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
		
