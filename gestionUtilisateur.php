<!-- PHP -->
	<?php
	// Initialize the session
	session_start();
	
	// Vérifiez si l'utilisateur est connecté, sinon le redirige à la page de connexion
	if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
		header("location: authentification.php");
		exit;
	}

	?>
<!-- PHP -->

<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!-- Favicon icon -->
		<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
		<!-- Google font-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
		<!-- waves.css -->
		<link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
		<!-- Required Fremwork -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
		<!-- waves.css -->
		<link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
		<!-- themify icon -->
		<link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
		<!-- font-awesome-n -->
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
		<!-- scrollbar.css -->
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
		<!-- Style.css -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
		<script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
		
	</head>
	<body>
	<!-- Pre-loader start -->
		<div class="theme-loader">
			<div class="loader-track">
				<div class="preloader-wrapper">
					<div class="spinner-layer spinner-blue">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
					<div class="spinner-layer spinner-red">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>

					<div class="spinner-layer spinner-yellow">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>

					<div class="spinner-layer spinner-green">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	<!-- Pre-loader end --> 

	<!-- Div Container Principal -->
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				<nav class="navbar header-navbar pcoded-header ">
					<div class="navbar-wrapper">
						<div class="navbar-logo">
							<a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
								<i class="ti-menu"></i>
							</a>
							<div class="mobile-search waves-effect waves-light">
								<div class="header-search">
									<div class="main-search morphsearch-search">
										<div class="input-group">
											<span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
											<input type="search" name="search" id="search" class="form-control" placeholder="Rechercher" aria-controls="donnee">
											<span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
										</div>
									</div>
								</div>
							</div>
							<a href="gestionUtilisateur.php">
								<!-- <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" /> -->
								<strong><span>&#10092;/&#10093;</span>SunuCodeSN</strong> 
							</a>
							<a class="mobile-options waves-effect waves-light">
								<i class="ti-more"></i>
							</a>
						</div>
						<div class="navbar-container container-fluid">
							<ul class="nav-left">
								<li>
									<div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
								</li>
								<li>
									<a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
										<i class="ti-fullscreen"></i>
									</a>
								</li>
							</ul>
							<ul class="nav-right">
								
								<li class="user-profile header-notification">
									<a href="#!" class="waves-effect waves-light">
										<img src="assets/images/av.png" class="img-radius" alt="User-Profile-Image">
										<span><?php echo htmlspecialchars($_SESSION["username"]); ?> </span>
										<i class="ti-angle-down"></i>
									</a>
									<ul class="show-notification profile-notification">
									
										<li class="waves-effect waves-light">
											<a href="user-profile.html">
												<i class="ti-user"></i> Profil
											</a>
										</li>
			
										<li class="waves-effect waves-light">
											<a href="deconnexion.php">
												<i class="ti-layout-sidebar-left"></i> Déconnexion
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>

				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<nav class="pcoded-navbar">
							<div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
							<div class="pcoded-inner-navbar main-menu">
								<div class="">
									<div class="main-menu-header">
										<img class="img-80 img-radius" src="assets/images/av.png" alt="User-Profile-Image">
										<div class="user-details">
											<span id="more-details"><?php echo htmlspecialchars($_SESSION["username"]); ?> <i class="fa fa-caret-down"></i></span>
										</div>
									</div>
									<div class="main-menu-content">
										<ul>
											<li class="more-details">
												<a href="#"><i class="ti-user"></i>Voir Profil</a>
												<a href="deconnexion.php"><i class="ti-layout-sidebar-left"></i>Décoonexion</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="p-15 p-b-0">
									<form class="form-material">
										<div class="form-group form-primary">
											<input type="search"  placeholder aria-controls="donnee" name="search" class="form-control">
											<span class="form-bar"></span>
											<label class="float-label"><i class="fa fa-search m-r-10"></i>Rechercher</label>
										</div>
									</form>
								</div>
								<div class="pcoded-navigation-label">Navigation</div>
								<ul class="pcoded-item pcoded-left-item">
									<li class="active">
										<a href="gestionUtilisateur.php" class="waves-effect waves-dark">
											<span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
											<span class="pcoded-mtext">Tableau de bord</span>
											<span class="pcoded-mcaret"></span>
										</a>
									</li>
								</ul>
								<div class="pcoded-navigation-label">Gestion</div>
								<ul class="pcoded-item pcoded-left-item">
									<li class="pcoded-hasmenu">
										<a href="javascript:void(0)" class="waves-effect waves-dark">
											<span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
											<span class="pcoded-mtext">Gestion des Utilisateurs</span>
											<span class="pcoded-mcaret"></span>
										</a>
										<ul class="pcoded-submenu">
											<li class=" ">
												<a href="breadcrumb.html" class="waves-effect waves-dark">
													<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
													<span class="pcoded-mtext">Ajouter</span>
													<span class="pcoded-mcaret"></span>
												</a>
											</li>
											<li class=" ">
												<a href="button.html" class="waves-effect waves-dark">
													<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
													<span class="pcoded-mtext">Modifier</span>
													<span class="pcoded-mcaret"></span>
												</a>
											</li>
											<li class="">
												<a href="accordion.html" class="waves-effect waves-dark">
													<span class="pcoded-micon"><i class="ti-angle-right"></i></span>
													<span class="pcoded-mtext">Supprimer</span>
													<span class="pcoded-mcaret"></span>
												</a>
											</li>
											
										</ul>
									</li>
								</ul>
							</div>
						</nav>
						<div class="pcoded-content">
							<!-- Page-header start -->
							<div class="page-header">
								<div class="page-block">
									<div class="row align-items-center">
										<div class="col-md-8">
											<div class="page-header-title">
												<h5 class="m-b-10">
												<?php echo htmlspecialchars($_SESSION["prenom"]); ?> <b><?php  echo htmlspecialchars($_SESSION["nom"]); ?></b>
												</h5>
												<p class="m-b-0">Bienvenue sur l'application "Utilisateur Under-Construction."</p>
											</div>
										</div>
										<div class="col-md-4">
											<ul class="breadcrumb">
												<li class="breadcrumb-item">
													<a href="index.html"> <i class="fa fa-home"></i> </a>
												</li>
												<li class="breadcrumb-item"><a href="#!">Tableau de bord</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<!-- Page-header end -->
							<div class="pcoded-inner-content">
								<!-- Main-body start -->
								<div class="main-body">
									<div class="page-wrapper">
										<!-- Page-body start -->
										<div class="page-body">
											<div class="row">
										
												<!-- Conenu Principal du table -->
												<div class="col-xl-12">
													<div class="card proj-progress-card">
														<div class="card-block">
															<!-- Table des données -->
																<div class="table-responsive">
																	<div >
																	<button type="button" id="BoutonAjout" data-toggle="modal" data-target="#userModal"
																	class="btn btn-success"><i class="fa fa-plus"></i>Ajouter</button>
																	</div>
																	<br>
																	<table id="donnee" class="table">
																		<thead>
																			<tr>
																				<th width="10%">Image</th>
																				<th width="35%">Nom</th>
																				<th width="35%">Prenom</th>
																				<th width="35%">Nom d'utilisateur</th>
																				<th width="35%">Email</th>
																				<th width="35%">N° Téléphone</th>
																				<th width="10%">Editer</th>
																				<th width="10%">Supprimer</th>
																			</tr>
																		</thead>
																	</table>
																	
																</div>
															<!-- Fin Table des données -->
														</div>
													</div>
												</div>
												<!-- Contenu principal du Table -->
											</div>
										</div>
										<!-- Page-body end -->
									</div>
									<div id="styleSelector"> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	<!-- Div Container Principal -->

	<!-- Javascript code  -->
		<!-- waves js -->
		<script src="assets/pages/waves/js/waves.min.js"></script>
		<!-- jquery slimscroll js -->
		<script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

		<!-- slimscroll js -->
		<script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

		<!-- menu js -->
		<script src="assets/js/pcoded.min.js"></script>
		<script src="assets/js/vertical/vertical-layout.min.js "></script>

		<script type="text/javascript" src="assets/js/script.js "></script>
		<script type="text/javascript" src="js/script.js" language="javascript" ></script>
	<!-- Javascript code  -->
	</body>
</html>

<!-- Modal Fade -->
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="form" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Ajouter un utilisateur</h4>
					</div>
					<div class="modal-body">
						<label>Nom</label>
						<input type="text" name="nom" id="nom" class="form-control" />
						<br />
						<label>Prenom</label>
						<input type="text" name="prenom" id="prenom" class="form-control" />
						<br />
						<label>Nom d'utilisateur</label>
						<input type="text" name="username" id="username" class="form-control" />
						<br />
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" />
						<br />
						<label>N° Téléphone</label>
						<input type="tel" name="tel" id="tel" class="form-control" />
						<br />
						<label>Image de profil</label>
						<input type="file" name="image" id="image" />
						<span id="imageCharge"></span>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="utilisateur_id" id="utilisateur_id" />
						<input type="hidden" name="operation" id="operation" />
						<input type="submit" name="action" id="action" class="btn btn-success" value="Ajouter" />
						<button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<!-- Modal Fade -->

