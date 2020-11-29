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

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<meta name="description" content="">

		<meta name="author" content="">

		

		<title>LO KREATIF Dashboard</title>

		

		<!-- Custom fonts for this template-->

		<link href="<?=base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		

		

	  <link href="<?=base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

		<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

		

		<!-- select2 -->

		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

		

		<!-- select2-bootstrap4-theme -->

		<link href="<?=base_url();?>assets/css/select2-bootstrap.css" rel="stylesheet"> <!-- for local development env -->

		

		<!-- Custom styles for this template-->

		<link href="<?=base_url();?>assets/css/sb-admin-2.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
		<?php if(!empty($lo)){ ?>
		<link href="<?=base_url();?>assets/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url();?>assets/css/custom-lo.css" rel="stylesheet" type="text/css">
		<?php }?>

<!-- Bootstrap core JavaScript-->

<script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>

<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	</head>

	

	<body id="page-top">

		

		<!-- Page Wrapper -->

		<div id="wrapper">

			

			<!-- Sidebar -->

			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

				

				<!-- Sidebar - Brand -->

				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

					<div class="sidebar-brand-icon rotate-n-15">

						

						<img src="https://senca.web.id/wp-content/uploads/elementor/thumbs/senca_fullname-oyzfj0jvjaher4qxub17kjld6tpiqjzy1k4pf55rqq.png" width="40" height="40" alt="">

						

					</div>

					<div class="sidebar-brand-text mx-3">LO KREATIF</div>

				</a>

				

				<!-- Divider -->

				<hr class="sidebar-divider my-0">

				

				<!-- Nav Item - Dashboard -->

				<li class="nav-item">

					<a class="nav-link" href="<?= base_url();?>dashboard">

						<i class="fas fa-fw fa-tachometer-alt"></i>

					<span>Dashboard</span></a>

				</li>

				

				<!-- Divider -->

				<hr class="sidebar-divider">

				

				<!-- Heading -->

				<div class="sidebar-heading">

					Interface

				</div>

				<?php 
				foreach($menu as $row){ ?>
						<li class="nav-item">
							<a class="nav-link" href="<?=base_url().$row->link;?>">
							<i class="fas fa-fw fa-chart-area"></i>
							<span><?=$row->namamenu?></span></a>
						</li>
				<?php } ?>
					
				
				<li class="nav-item">

					<a class="nav-link" href="<?=base_url();?>logout">

						<i class="fas fa-fw fa-chart-area"></i>

					<span>Logout</span></a>

				</li>

				

				<!-- Divider -->

				<hr class="sidebar-divider d-none d-md-block">

				

				<!-- Sidebar Toggler (Sidebar) -->

				<div class="text-center d-none d-md-inline">

					<button class="rounded-circle border-0" id="sidebarToggle"></button>

				</div>

				

			</ul>

			<!-- End of Sidebar -->

			

			<!-- Content Wrapper -->

			<div id="content-wrapper" class="d-flex flex-column">

				

				<!-- Main Content -->

				<div id="content">

					

					<!-- Topbar -->

					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

						

						<!-- Sidebar Toggle (Topbar) -->

						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">

							<i class="fa fa-bars"></i>

						</button>

						

						

						

						<!-- Topbar Navbar -->

						<ul class="navbar-nav ml-auto">

							

							<!-- Nav Item - Search Dropdown (Visible Only XS) -->

							<li class="nav-item dropdown no-arrow d-sm-none">

								<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

									<i class="fas fa-search fa-fw"></i>

								</a>

								<!-- Dropdown - Messages -->

								<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">

									<form class="form-inline mr-auto w-100 navbar-search">

										<div class="input-group">

											<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">

											<div class="input-group-append">

												<button class="btn btn-primary" type="button">

													<i class="fas fa-search fa-sm"></i>

												</button>

											</div>

										</div>

									</form>

								</div>

							</li>

							

							

						
							

							<div class="topbar-divider d-none d-sm-block"></div>

							

							<!-- Nav Item - User Information -->

							<li class="nav-item dropdown no-arrow">

								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

									<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->nama; ?></span>

									<img class="img-profile rounded-circle" src="<?=base_url();?>assets/account.png">

								</a>

								<!-- Dropdown - User Information -->

								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

									<a class="dropdown-item" href="<?php echo base_url()?>peserta">

										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

										Profile

									</a>


									<div class="dropdown-divider"></div>

									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">

										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

										Logout

									</a>

								</div>

							</li>

							

						</ul>

						

					</nav>

					<!-- End of Topbar -->

					<!-- Begin Page Content -->

				<div class="container-fluid">				
