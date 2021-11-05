<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

include("header.php");
?>

	<!-- Slide1 -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<?php
					$req="SELECT * from restaurant group by cost desc";
					$stmt = $db->prepare($req);
					$stmt->execute();
					$restau=$stmt->fetchAll(PDO::FETCH_BOTH);
					foreach ($restau as $r) {
				?>
				<div class="item-slick1 item1-slick1" style="background-image: url(gerant/images/restaurants/<?php echo $r['image'] ?>);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 txt1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
							Bienvenue dans
						</span>

						<h2 class="caption2-slide1 tit1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
							<?php echo $r['name'] ?>
						</h2>

						<div class="wrap-btn-slide1 animated visible-false" data-appear="zoomIn">
							<!-- Button1 -->
							<a href="restaurant.php?id=<?php echo $r['id']; ?>" class="btn1 flex-c-m size1 txt3 trans-0-4">
							 	Voir Menu
							</a>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>

			<div class="wrap-slick1-dots"></div>
		</div>

		<div class="t-center p-t-20">
			<span class="tit2 t-center">
				Comment ça marche
			</span>
		</div>
		<div class="p-l-110 p-r-110">
		<div class="row">
			<div class="col-md-4 p-t-45 p-b-30">
				<div class="t-center"><img src="images/p1.jpg" class="t-center"></div>
				<h4 class="tit10 t-center">Séléctionnez votre région</h4>
				<p class="t-center">Renseignez l'adresse la plus proche de vous où vous souhaitez aller.</p>
			</div>
			<div class="col-md-4 p-t-45 p-b-30">
				<div class="t-center"><img src="images/p2.jpg"></div>
				<h4 class="tit10 t-center">Choisissez un restaurant</h4>
				<p class="t-center">Parcourir les restaurants dans lesquels vous souhaitez emporter des plats.</p>
			</div>
			<div class="col-md-4 p-t-45 p-b-30">
				<div class="t-center"><img src="images/p3.png"></div>
				<h4 class="tit10 t-center">Commandez & Réservez</h4>
				<p class="t-center">Votre commande ou réservation vous sera prét en un rien de temps</p>
			</div>
		</div>
		</div>


		<form method="post" action="restaurant_region.php">
		<div class=" p-t-20 p-b-35">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<label class="tit22">Séléctionner votre région :</label>
					</div>
					
					<div class="col-md-6 p-t-9">
						<div class="row">
							<div class="col-md-10">
								<select class="form-control" name="region">
									<option selected disabled>Séléctionner votre région</option>
									<?php 
										$requete="select * from address";
										$stmt = $db->prepare($requete);
										$stmt->execute();
										$row=$stmt->fetchAll(PDO::FETCH_BOTH);
										foreach ($row as $r) {
									?>
									<option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-20">
								<button class="btn btn-danger">Choisir</button>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</div>
		</form>
	</section>
	

	<!-- Welcome présentation du plateforme-->
	<section class="section-welcome bg1-pattern p-t-90 p-b-105">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-t-45 p-b-30">
					<div class="wrap-text-welcome t-center">
						<span class="tit2 t-center">
							D'S Restaurant
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-5">
							Bienvenue
						</h3>

						<p class="t-center m-b-22 size3 m-l-r-auto">
							Notre espace sert à regrouper plusieurs restaurants dans le but de faciliter 
							la réservation et la commande des plats sans perde du temps 
						</p>

						<a href="restaurants.php" class="txt4">
							Voir les restaurants
							<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
						</a>
					</div>
				</div>

				<div class="col-md-6 p-b-30 p-t-40">
					<div class="wrap-pic-welcome size2 bo-rad-10 hov-img-zoom m-l-r-auto">
						<img src="images/compare.jpg" alt="IMG-OUR">
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Video -->
	<section class="section-video parallax100" style="background-image: url(images/gallery8.jpg);">
		<div class="content-video t-center p-t-225 p-b-250">
			<span class="tit2 p-l-15 p-r-15">
				Vidéo présentatif publicitaire de
			</span>

			<h3 class="tit4 t-center p-l-15 p-r-15 p-t-3">
				Mix Max
			</h3>

			<h3 class="txt6 t-center p-l-15 p-r-15 p-t-3">
				<a href="#" data-toggle="modal" data-target="#modal-video-01">voir cet viéo</a>
			</h3>

			<div class="btn-play ab-center size16 hov-pointer m-l-r-auto m-t-43 m-b-33" data-toggle="modal" data-target="#modal-video-01">
				<div class="flex-c-m sizefull bo-cir bgwhite color1 hov1 trans-0-4">
					<i class="fa fa-play fs-18 m-l-2" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</section>


	<!-- Event -->
	<section class="section-event">
		<div class="wrap-slick2">
			<div class="slick2">
				<div class="item-slick2 item1-slick2" style="background-image: url(images/bg-event-01.jpg);">
					<div class="wrap-content-slide2 p-t-115 p-b-208">
						<div class="container">
							<!-- - -->
							<div class="title-event t-center m-b-52">
								<span class="tit2 p-l-15 p-r-15">
									Upcomming
								</span>

								<h3 class="tit6 t-center p-l-15 p-r-15 p-t-3">
									Events
								</h3>
							</div>

							<!-- Block2 -->
							<div class="blo2 flex-w flex-str flex-col-c-m-lg animated visible-false" data-appear="zoomIn">
								<!-- Pic block2 -->
								<a href="#" class="wrap-pic-blo2 bg1-blo2" style="background-image: url(images/event-02.jpg);">
									<div class="time-event size10 txt6 effect1">
										<span class="txt-effect1 flex-c-m t-center">
											08:00 PM Tuesday - 21 November 2018
										</span>
									</div>
								</a>

								<!-- Text block2 -->
								<div class="wrap-text-blo2 flex-col-c-m p-l-40 p-r-40 p-t-45 p-b-30">
									<h4 class="tit7 t-center m-b-10">
										Wines during specific nights
									</h4>

									<p class="t-center">
										Donec quis lorem nulla. Nunc eu odio mi. Morbi nec lobortis est. Sed fringilla, nunc sed imperdiet lacinia
									</p>

									<div class="flex-sa-m flex-w w-full m-t-40">
										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 days">
												25
											</span>

											<span class="dis-block t-center txt8">
												Days
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 hours">
												12
											</span>

											<span class="dis-block t-center txt8">
												Hours
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 minutes">
												59
											</span>

											<span class="dis-block t-center txt8">
												Minutes
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 seconds">
												56
											</span>

											<span class="dis-block t-center txt8">
												Seconds
											</span>
										</div>
									</div>

									<a href="#" class="txt4 m-t-40">
										View Details
										<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick2 item2-slick2" style="background-image: url(images/bg-event-02.jpg);">
					<div class="wrap-content-slide2 p-t-115 p-b-208">
						<div class="container">
							<!-- - -->
							<div class="title-event t-center m-b-52">
								<span class="tit2 p-l-15 p-r-15">
									Upcomming
								</span>

								<h3 class="tit6 t-center p-l-15 p-r-15 p-t-3">
									Events
								</h3>
							</div>

							<!-- Block2 -->
							<div class="blo2 flex-w flex-str flex-col-c-m-lg animated visible-false" data-appear="fadeInDown">
								<!-- Pic block2 -->
								<a href="#" class="wrap-pic-blo2 bg2-blo2" style="background-image: url(images/event-06.jpg);">
									<div class="time-event size10 txt6 effect1">
										<span class="txt-effect1 flex-c-m">
											08:00 PM Tuesday - 21 November 2018
										</span>
									</div>
								</a>

								<!-- Text block2 -->
								<div class="wrap-text-blo2 flex-col-c-m p-l-40 p-r-40 p-t-45 p-b-30">
									<h4 class="tit7 t-center m-b-10">
										Wines during specific nights
									</h4>

									<p class="t-center">
										Donec quis lorem nulla. Nunc eu odio mi. Morbi nec lobortis est. Sed fringilla, nunc sed imperdiet lacinia
									</p>

									<div class="flex-sa-m flex-w w-full m-t-40">
										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 days">
												25
											</span>

											<span class="dis-block t-center txt8">
												Days
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 hours">
												12
											</span>

											<span class="dis-block t-center txt8">
												Hours
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 minutes">
												59
											</span>

											<span class="dis-block t-center txt8">
												Minutes
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 seconds">
												56
											</span>

											<span class="dis-block t-center txt8">
												Seconds
											</span>
										</div>
									</div>

									<a href="#" class="txt4 m-t-40">
										View Details
										<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick2 item3-slick2" style="background-image: url(images/bg-event-04.jpg);">
					<div class="wrap-content-slide2 p-t-115 p-b-208">
						<div class="container">
							<!-- - -->
							<div class="title-event t-center m-b-52">
								<span class="tit2 p-l-15 p-r-15">
									Upcomming
								</span>

								<h3 class="tit6 t-center p-l-15 p-r-15 p-t-3">
									Events
								</h3>
							</div>

							<!-- Block2 -->
							<div class="blo2 flex-w flex-str flex-col-c-m-lg animated visible-false" data-appear="rotateInUpLeft">
								<!-- Pic block2 -->
								<a href="#" class="wrap-pic-blo2 bg3-blo2" style="background-image: url(images/event-01.jpg);">
									<div class="time-event size10 txt6 effect1">
										<span class="txt-effect1 flex-c-m">
											08:00 PM Tuesday - 21 November 2018
										</span>
									</div>
								</a>

								<!-- Text block2 -->
								<div class="wrap-text-blo2 flex-col-c-m p-l-40 p-r-40 p-t-45 p-b-30">
									<h4 class="tit7 t-center m-b-10">
										Wines during specific nights
									</h4>

									<p class="t-center">
										Donec quis lorem nulla. Nunc eu odio mi. Morbi nec lobortis est. Sed fringilla, nunc sed imperdiet lacinia
									</p>

									<div class="flex-sa-m flex-w w-full m-t-40">
										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 days">
												25
											</span>

											<span class="dis-block t-center txt8">
												Days
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 hours">
												12
											</span>

											<span class="dis-block t-center txt8">
												Hours
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 minutes">
												59
											</span>

											<span class="dis-block t-center txt8">
												Minutes
											</span>
										</div>

										<div class="size11 flex-col-c-m">
											<span class="dis-block t-center txt7 m-b-2 seconds">
												56
											</span>

											<span class="dis-block t-center txt8">
												Seconds
											</span>
										</div>
									</div>

									<a href="#" class="txt4 m-t-40">
										View Details
										<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="wrap-slick2-dots"></div>
		</div>
	</section>

	<!-- Sign up -->
	<div class="section-signup bg1-pattern p-t-85 p-b-85">
		<form class="flex-c-m flex-w flex-col-c-m-lg p-l-5 p-r-5">
			<span class="txt5 m-10">
				Specials Sign up
			</span>

			<div class="wrap-input-signup size17 bo2 bo-rad-10 bgwhite pos-relative txt10 m-10">
				<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="email-address" placeholder="Email Adrress">
				<i class="fa fa-envelope ab-r-m m-r-18" aria-hidden="true"></i>
			</div>

			<!-- Button3 -->
			<button type="submit" class="btn3 flex-c-m size18 txt11 trans-0-4 m-10">
				Sign-up
			</button>
		</form>
	</div>

<?php include("footer.php"); ?>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
				<div class="video-mo-01">
						<video controls allowfullscreen>
							<source src="images/intro.mp4" type="video/mp4" />
						</video>
				</div>
			</div>
		</div>
	</div>




