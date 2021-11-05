<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();
include("header.php");
?>

	<?php
		$requete="select * from restaurant where id='".$_GET['id']."'";
		$stmt = $db->prepare($requete);
		$stmt->execute();
		$restau=$stmt->fetch()
	?>	
	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(gerant/images/restaurants/<?php echo $restau['image'] ?>);">
		<h2 class="tit6 t-center">
			<!--A propos-->
		</h2>
	</section>

	<div class="section-gallery p-t-20 p-b-10">
		<div class="title-section-ourmenu t-center m-b-22">
				<span class="tit2 t-center">
					Découvrir
				</span>

				<h3 class="tit5 t-center m-t-2">
					Notre Menu
				</h3>

				<h4 class="tit7 t-center m-t-2 m-b-10">Ou</h4>
				<a href="reservation.php?id=<?php echo $restau['id'] ?>">
					<button class="btn btn-outline-danger">Faire une réservation</button>
				</a>
		</div>
		<div class="wrap-label-gallery filter-tope-group size27 flex-w flex-sb-m m-l-r-auto flex-col-c-sm p-l-15 p-r-15 m-b-60">
			<button class="label-gallery txt26 trans-0-4 is-actived" data-filter="*">
				Tous
			</button>
			<?php 
				$req="SELECT category.name FROM category JOIN foods on category.id = foods.categorie_id
				 WHERE foods.restaurant_id='".$_GET['id']."' group by category.name";
				$stmt = $db->prepare($req);
				$stmt->execute();
				$resultat=$stmt->fetchAll(PDO::FETCH_BOTH);
				foreach ($resultat as $res) {
			?>
			<button class="label-gallery txt26 trans-0-4" data-filter=".<?php echo $res['name']; ?>">
				<?php echo $res['name']; ?>
			</button>
			<?php } ?>
			<!--<button class="label-gallery txt26 trans-0-4" data-filter=".tabouna">
				Food
			</button>

			<button class="label-gallery txt26 trans-0-4" data-filter=".events">
				Events
			</button>

			<button class="label-gallery txt26 trans-0-4" data-filter=".guests">
				Vip guests
			</button>-->
		</div>

		<div class="wrap-gallery isotope-grid flex-w p-l-25 p-r-25">

			<?php 
				$req="SELECT foods.*,category.name as nom_category FROM foods join category on foods.categorie_id = category.id WHERE foods.restaurant_id='".$_GET['id']."'";
				$stmt = $db->prepare($req);
				$stmt->execute();
				$rows=$stmt->fetchAll(PDO::FETCH_BOTH);
				foreach ($rows as $r) {

					$query="SELECT SUM(quantity) as qty FROM commande WHERE id_food='".$r['id']."'";
					$st = $db->prepare($query);
					$st->execute();
					$q=$st->fetch();
			?>
			<!-- - -->
			<div class="item-gallery isotope-item bo-rad-10 hover-img-zoom <?php echo $r['nom_category']; ?>">
				<div class="wrap-pic-blo1 bo-rad-10 hov-img-zoom">
					<img src="gerant/images/food_added/<?php echo $r['image']; ?>" alt="IMG-GALLERY">
				</div>

				<div class="overlay-item-gallery trans-0-4 flex-c-m ">
					<a class="btn-show-gallery flex-c-m fa fa-search" href="admins/images/food_added/<?php echo $r['image']; ?>" data-lightbox="gallery"></a>
				</div>

				<div class="wrap-text-blo1 p-t-35">
					<a href="commande.php?food_id=<?php echo $r['id']; ?>"><h4 class="txt5 color0-hov trans-0-4 m-b-13">
						<?php echo $r['name']; ?></h4>
					</a>

					<p class="m-b-10">
						Prix : <?php echo $r['price']; ?> DT

						<b style="float: right;"><?php if($q['qty']!=0){echo $q['qty']." commande(s)";}
							else{ echo" 0 Commande"; } ?></b>
					</p>
				
					<a href="commande.php?food_id=<?php echo $r['id']; ?>" class="txt4">
						Voir détail & commander
						<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>

		<div class="pagination flex-c-m flex-w p-l-15 p-r-15 m-t-24 m-b-50">
			<a href="menu.php?id=<?php echo $r['restaurant_id']; ?>" class="item-pagination flex-c-m trans-0-4 active-pagination">voir plus des plats</a>
		</div>
	</div>
	<!-- Our Story -->
	<section class="bg2-pattern p-t-50 p-b-50 t-center p-l-15 p-r-15">
		<span class="tit2 t-center">
		 	<?php echo $restau['name'] ?>
		</span>

		<!--<h3 class="tit3 t-center m-b-35 m-t-5">
			A propos 
		</h3>-->
		<h3 class="tit3 t-center m-b-35 m-t-5">
		<?php echo $restau['localisation']; ?>
		</h3>

		<p class="t-center size32 m-l-r-auto">
		<?php echo $restau['description']; ?>
		</p>
	</section>

	<!-- Chef -->
	<section class="section-chef bgwhite p-t-30">
		<div class="container t-center">
			<span class="tit2 t-center">
				Meet Our
			</span>

			<h3 class="tit5 t-center m-b-50 m-t-5">
				Chef
			</h3>

			<div class="row">
				<div class="col-md-8 col-lg-4 m-l-r-auto p-b-30">
					<!-- -Block5 -->
					<div class="blo5 pos-relative p-t-60">
						<div class="pic-blo5 size14 bo4 wrap-cir-pic hov-img-zoom ab-c-t">
							<a href="#"><img src="images/avatar-02.jpg" alt="IGM-AVATAR"></a>
						</div>

						<div class="text-blo5 size34 t-center bo-rad-10 bo7 p-t-90 p-l-35 p-r-35 p-b-30">
							<a href="#" class="txt34 dis-block p-b-6">
								Peter Hart
							</a>

							<span class="dis-block t-center txt35 p-b-25">
								Chef
							</span>

							<p class="t-center">
								Donec porta eleifend mauris ut effici-tur. Quisque non velit vestibulum, lob-ortis mi eget, rhoncus nunc
							</p>
						</div>
					</div>
				</div>

				<div class="col-md-8 col-lg-4 m-l-r-auto p-b-30">
					<!-- -Block5 -->
					<div class="blo5 pos-relative p-t-60">
						<div class="pic-blo5 size14 bo4 wrap-cir-pic hov-img-zoom ab-c-t">
							<a href="#"><img src="images/avatar-03.jpg" alt="IGM-AVATAR"></a>
						</div>

						<div class="text-blo5 size34 t-center bo-rad-10 bo7 p-t-90 p-l-35 p-r-35 p-b-30">
							<a href="#" class="txt34 dis-block p-b-6">
								Joyce Bowman
							</a>

							<span class="dis-block t-center txt35 p-b-25">
								Chef
							</span>

							<p class="t-center">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ultricies felis a sem tempus tempus.
							</p>
						</div>
					</div>
				</div>

				<div class="col-md-8 col-lg-4 m-l-r-auto p-b-30">
					<!-- -Block5 -->
					<div class="blo5 pos-relative p-t-60">
						<div class="pic-blo5 size14 bo4 wrap-cir-pic hov-img-zoom ab-c-t">
							<a href="#"><img src="images/avatar-05.jpg" alt="IGM-AVATAR"></a>
						</div>

						<div class="text-blo5 size34 t-center bo-rad-10 bo7 p-t-90 p-l-35 p-r-35 p-b-30">
							<a href="#" class="txt34 dis-block p-b-6">
								Peter Hart
							</a>

							<span class="dis-block t-center txt35 p-b-25">
								Chef
							</span>

							<p class="t-center">
								Phasellus aliquam libero a nisi varius, vitae placerat sem aliquet. Ut at velit nec ipsum iaculis posuere quis in sapien
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

		<!-- Review -->
		<section class="section-review p-t-50 p-b-10">
		<!-- - -->
		<div class="title-review t-center m-b-2">
			<span class="tit2 p-l-15 p-r-15">
			Commentaires de nos clients
			</span>

			<h3 class="tit8 t-center p-l-20 p-r-15 p-t-3">
				<!--Review-->
			</h3>
		</div>

		<!-- - -->
		<div class="wrap-slick3">
			<div class="slick3">
				<?php
					$requete="select user.username,user.image,comment.* FROM user JOIN comment ON user.id=comment.id_user
					 WHERE comment.id_restaurant='".$_GET['id']."'";
					$stmt = $db->prepare($requete);
					$stmt->execute();
					$comm=$stmt->fetchAll(PDO::FETCH_BOTH);
					foreach ($comm as $com) {
				?>
				<div class="item-slick3 item1-slick3">
					<div class="wrap-content-slide3 p-b-50 p-t-50">
						<div class="container">
							<div class="pic-review size14 bo4 wrap-cir-pic m-l-r-auto animated visible-false" data-appear="zoomIn">
								<img src="images/profile/<?php echo $com['image']; ?>" alt="">
							</div>

							<div class="content-review m-t-33 animated visible-false" data-appear="fadeInUp">
								<p class="t-center txt36 size15 m-l-r-auto">
								<?php echo $com['comment']; ?>
								</p>

								<div class="star-review fs-18 color0 flex-c-m m-t-12">
									<p><?php $date = date_create($com['date']);
									 echo 'Le ' .date_format($date,"d/m/Y"); ?></p>
								</div>

								<div class="tit10s more-review t-center animated visible-false m-t-20" data-appear="fadeInUp" >
								<?php echo $com['username']; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>

			<div class="wrap-slick3-dots m-t-30"></div>
		</div>

		<div class="star-rating" title="10%">
			<div class="back-stars">
				<i class="fa fa-star-o" aria-hidden="true"></i>
				<i class="fa fa-star-o" aria-hidden="true"></i>
				<i class="fa fa-star-o" aria-hidden="true"></i>
				<i class="fa fa-star-o" aria-hidden="true"></i>
				<i class="fa fa-star-o" aria-hidden="true"></i>
				
				<div class="front-stars" style="width: 10%">
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<form method="post" action="add_rating.php">
			<input type="hidden" name="id_restaurant" value="<?php echo $restau['id'] ?>">
			<input type="number" name="rating_percent" class="njoum" value="10" max="100" min="0"><span class="percent"> %</span>
			<?php if(isset($_SESSION['user_id'])) {  ?>
			<input type="submit" name="evaluer" class="btn btn-warning text-dark" value="Evaluez">
			<?php } else { ?>
			<a href="login.php" class="btn btn-warning">
				Connectez vous d'abord
			</a>
			<?php } ?>
		</form><br>
		<p class="container text-center alert bg-danger text-light"><i class="fa fa-exclamation-triangle"></i> Pour faire évaluer, merci de taper la pourcentage correspendante a votre choix</p>

<script>
const numberInput = document.querySelector('.njoum');
const starRatingWrapper = document.querySelector('.star-rating');
const frontStars =  document.querySelector('.front-stars');
const rate = e => {
    const percentage = e.target.value + '%';
    starRatingWrapper.title = percentage;
	frontStars.style.width = percentage;
};
numberInput.addEventListener('click', rate);
numberInput.addEventListener('keyup', rate);
</script>
	
<style>
/*---------- star rating ----------*/
.front-stars, .back-stars, .star-rating {
  display: flex;
}
.star-rating {
  align-items: center;
  font-size: 2.5em;
  justify-content: center;
  margin-top: 10px;
}
.back-stars {
  color: #e7d403;
  position: relative;
}
.front-stars {
  color: #e7d403;
  overflow: hidden;
  position: absolute;
  top: 0;
  transition: all 0.5s;
}
.njoum {
  box-shadow: 0 0 0px 1px gold;
  border-radius: 3px;
  color: #000000;
  font-size: 1.1em;
  height: 37px;
  width: 60px;
  text-align: center;
  margin-top: 35px;
  margin-left: 44%;
  padding-bottom: 4px;
}
.percent {
  color: red;
  font-size: 1.5em;
}
</style>

	</section>
	
	<!-- Leave a comment -->
	<div class="container">
		<form class="leave-comment p-t-10 m-b-40" method="POST" action="add_comment.php">
			<h4 class="txt33 p-b-14">
				Laisser un commentaire
			</h4>
			<p>
				Votre commentaire sera publié
			</p>
			<div class="row">
				<div class="col-md-8">
					<textarea class="bo-rad-10 size29 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-20" name="comment" placeholder="Commentaire..." required></textarea>
					<?php if(isset($_SESSION['user_id'])) {  ?>
					<input type="submit" value="Commenter" name="commenter" class="btn3 flex-c-m size31 txt11 trans-0-4">
					<?php } else { ?>
					<a href="login.php" class="btn3 flex-c-m size13 txt11 trans-0-4" style="padding: 3%;">
						Connectez vous d'abord
					</a>
					<?php } ?>
				</div>
				<div class="col-md-4">
				  	<?php
						$requete="select * from user where id='".$_SESSION['user_id']."'";
						$stmt = $db->prepare($requete);
						$stmt->execute();
						$row=$stmt->fetch(PDO::FETCH_BOTH);
					?>	
					<span>Nom</span>
					<div class="size30 bo2 bo-rad-10 m-t-3 m-b-10 m-t-5">
						<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="name" value="<?php echo $row['username']; ?>" disabled>
					</div>
					<span>Email</span>
					<div class="size30 bo2 bo-rad-10 m-t-3 m-b-10">
						<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="email" value="<?php echo $row['email']; ?>" disabled>
					</div>
					<input type="hidden" name="restaurant_id" value="<?php echo $restau['id']; ?>">
				</div>
			</div>
		</form>
	</div>

	<?php include("footer.php"); ?>