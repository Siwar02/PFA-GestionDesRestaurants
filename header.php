<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<div class="progress-container">
    	<div class="progress-bar" id="myBar"></div>
  	</div>
  	<script>
	window.onscroll = function() {myFunction()};
	function myFunction() {
  	var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  	var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  	var scrolled = (winScroll / height) * 100;
  	document.getElementById("myBar").style.width = scrolled + "%";
	}
	</script>
	<style>
	.progress-container {
	  width: 100%;
	  height: 5px;
	  position: fixed;
	  top: 0;
	  z-index: 1;
	  width: 100%;
	  background-color: rgba(255,255,255,0.9);  
	}
	.progress-bar {
	  height: 5px;
	  background: red;
	  width: 0%;
	}
	</style> 
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="wrap-menu-header gradient1 trans-0-4">
			<div class="container h-full">
				<div class="wrap_header trans-0-3">
					<!-- Logo -->
					<div class="logo">
						<a href="index.php">
							<img src="images/icons/logo5.png" alt="IMG-LOGO" data-logofixed="images/icons/logo3.png">
						</a>
					</div>

					<!-- Menu -->
					<div class="wrap_menu p-l-45 p-l-0-xl">
						<nav class="menu">
							<ul class="main_menu">
								<li class="sous_menu">
									<a href="index.php">Accueil</a>
								</li>

								<li class="sous_menu">
									<a href="restaurants.php">Restaurants</a>
								</li>

								<li class="sous_menu">
									<a href="contact.php">Contact</a>
								</li>
								<?php if(isset($_SESSION['user_id'])) {  
									$requete="select * from user where id='$_SESSION[user_id]' ";
									$stmt = $db->prepare($requete);
									$stmt->execute();
									$row=$stmt->fetch(PDO::FETCH_BOTH); 
								echo '<li>
										<a href="#" data-toggle="dropdown">Bienvenue '.$row['username'].' <i class="fa fa-caret-down"></i></a>
										<div class="dropdown-menu">
											<a href="profile.php" class="drp"><i class="fa fa-user">&nbsp;</i> Voir profil</a>
											<a href="logout.php" class="drp"><i class="fa fa-sign-out">&nbsp;</i> Se déconneter</a>
										</div>
									 </li>'; ?>
								<li>
									<a href="#" data-toggle="dropdown">
										Panier <i class="fa fa-cart-arrow-down"></i>
									</a>
									<div class="dropdown-menu">
										<a href="cart_commande.php" class="drp"><i class="fa fa-phone">&nbsp;</i> Commandes en cours</a>
										<a href="cart_reservation.php" class="drp"><i class="fa fa-calendar-check-o">&nbsp;</i> Réservations en cours</a>
									</div>
								</li>
								<li>
									<?php
										$r="SELECT COUNT(reservation.id)as num_res FROM reservation
										JOIN restaurant on reservation.id_restaurant=restaurant.id
										WHERE reservation.id_user='".$_SESSION['user_id']."'
										AND reservation.reponse!='0'
										AND DATEDIFF(reservation.date , NOW()) >= '0' ";
										$st = $db->prepare($r);
										$st->execute();
										$count=$st->fetch();
									?>
									<a href="#" data-toggle="dropdown" class="notification">
									<?php if($count['num_res']==0){ ?>
									<i class="fa fa-bell"></i>
									<?php } else { ?>
									<i class="fa fa-bell">
									<sup><?php echo $count['num_res'] ?></sup>
									</i>
									<?php } ?>
									</a>
									<div class="dropdown-menu" style="min-width: 18em;">
									<?php
									$req="SELECT DATEDIFF(reservation.date , NOW()) as temps,reservation.*,restaurant.name as nom_restau FROM reservation
										JOIN restaurant on reservation.id_restaurant=restaurant.id
										WHERE reservation.id_user='".$_SESSION['user_id']."'
										AND reservation.reponse!='0'
										AND DATEDIFF(reservation.date , NOW()) >= '0'
										ORDER BY reservation.date_envoi DESC";
										$stm = $db->prepare($req);
										$stm->execute();
										$reserv=$stm->fetchAll();
									?>
									<?php
									if($stm->rowCount()>0){
									foreach($reserv as $res){
									?>
									    <p class="p-l-20"><b><?php echo $res['nom_restau'] ?></b></p>
									    <p class="p-l-20 p-r-20">Votre réservation de 
											<?php echo $res['date'] ?> à <?php echo $res['time'] ?> a été
											<?php if($res['reponse']=="accepte"){
												echo '<b style="color:green">accepté</b>';}
												else{echo '<b style="color:red">refusé</b>';}?></p>
									    <hr>
									<?php }
										echo'<p class="dropdown-item" style="color:grey;text-align:center">Voir tous</p>';
									 } else {
										echo '<p class="dropdown-item" style="color:grey">Aucune notification</p>';
									} ?>
									</div>
								</li>
								<?php } else { ?>
								<li>
									<a href="#" data-toggle="dropdown">Se Connecter <i class="fa fa-caret-down"></i></a>
									<div class="dropdown-menu">
										<a href="login.php" class="drp"><i class="fa fa-sign-in">&nbsp;</i> Se Connecter</a>
										<a href="register.php" class="drp"><i class="fa fa-user-plus">&nbsp;</i> Créer un compte</a>
									</div>
								</li>
								<?php } ?>
							</ul>
						</nav>
					</div>

					<!-- Social -->
					<div class="social flex-w flex-l-m p-r-20">
						<a href="#"><i class="fa fa-facebook m-l-20" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-instagram m-l-20" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-youtube m-l-20" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-twitter m-l-20" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-whatsapp m-l-20" aria-hidden="true"></i></a>
						<button class="btn-show-sidebar m-l-33 trans-0-4"></button>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Sidebar -->
	<aside class="sidebar trans-0-4">
		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

		<!-- - -->
		<ul class="menu-sidebar p-t-60 p-b-30">
			<li class="t-center m-b-13">
				<a href="index.php" class="txt19">Accueil</a>
			</li>

			<li class="t-center m-b-13">
				<a href="restaurants.php" class="txt19">Restaurants</a>
			</li>

			<li class="t-center m-b-13">
				<a href="contact.php" class="txt19">Contact</a>
			</li>
			<?php if(isset($_SESSION['user_id'])) { ?>
			<li class="t-center m-b-13 dropdown-btn">
				<a href="#" class="txt19">Bienvenue <?php echo $row['username']?>  <i class="fa fa-caret-down"></i></a>
			</li>
				<div class="dropdown-container">
				<li class="t-center m-b-13">
					<a href="profile.php">Voir profil</a>
				</li>
				<li class="t-center m-b-33" style="padding-bottom: 4%">
					<a href="logout.php">Se déconneter</a>
				</li>
				</div>
			<li class="t-center m-b-13 dropdown-btn">
				<a href="#" class="txt19"> Panier <i class="fa fa-cart-arrow-down"></i> <i class="fa fa-caret-down"></i> </a>
			</li>
				<div class="dropdown-container">
				<li class="t-center m-b-13">
					<a href="cart_commande.php">Commandes en cours</a>
				</li>
				<li class="t-center m-b-33" style="padding-bottom: 4%">
					<a href="cart_reservation.php">Réservations en cours</a>
				</li>
				</div>
			<?php } else { ?>
			<li class="t-center m-b-13 dropdown-btn">
				<a href="#">Se connecter <i class="fa fa-caret-down"></i></a>
			</li>
				<div class="dropdown-container">
				<li class="t-center m-b-13">
					<a href="login.php">Se connecter</a>
				</li>
				<li class="t-center m-b-33" style="padding-bottom: 4%">
					<a href="register.php">Créer un compte</a>
				</li>
				</div>
			<?php } ?>
			<div class="t-center m-b-13 p-t-30">
				<a href="#"><i class="fa fa-facebook m-l-20" aria-hidden="true" style="font-size: x-large;"></i></a>
				<a href="#"><i class="fa fa-instagram m-l-20" aria-hidden="true" style="font-size: x-large;"></i></a>
				<a href="#"><i class="fa fa-youtube m-l-20" aria-hidden="true" style="font-size: x-large;"></i></a>
				<a href="#"><i class="fa fa-twitter m-l-20" aria-hidden="true" style="font-size: x-large;"></i></a>
				<a href="#"><i class="fa fa-whatsapp m-l-20" aria-hidden="true" style="font-size: x-large;"></i></a>
			</div>
		</ul>

		<!-- - -->
		<div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40 p-t-1">
			<!-- - -->
			<h4 class="txt20  m-b-33">
				Galerie
			</h4>

			<!-- Gallery -->
			<div class="wrap-gallery-sidebar flex-w">
				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-01.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-01.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-02.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-02.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-03.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-03.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-05.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-05.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-06.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-06.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-07.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-07.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-09.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-09.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-10.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-10.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-11.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-11.jpg" alt="GALLERY">
				</a>
			</div>
		</div>
	</aside>