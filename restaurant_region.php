<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

include("header.php");

$region = $_POST['region'];
$requete="select * from restaurant where address_id = '$region'";
$stmt = $db->prepare($requete);
$stmt->execute();
$reg=$stmt->fetchAll(PDO::FETCH_BOTH);
?>

<section class="section-welcome bg1-pattern p-t-120 p-b-105">
		<div class="container">

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
										$address=$stmt->fetchAll(PDO::FETCH_BOTH);
										foreach ($address as $adr) {
									?>
									<option value="<?php echo $adr['id'] ?>"><?php echo $adr['name'] ?></option>
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

		<?php
		$requete="select name from address where id = '$region'";
		$stmt = $db->prepare($requete);
		$stmt->execute();
		$nom=$stmt->fetch();
		?>
		<h4>Restaurant(s) de <b> <?php echo $nom['name'] ?><b> :</h4>
            <?php foreach ($reg as $r) { ?>
			<div class="row">
				<div class="col-md-6 p-t-45 p-b-30">
					<div class="wrap-text-welcome t-center">
						<span class="tit2 t-center">
							<?php echo $r['name'] ?>
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-5">
                            <?php echo $r['localisation'] ?>
						</h3>

						<p class="t-center m-b-22 size3 m-l-r-auto">
                            <?php echo $r['description'] ?>
						</p>
						<div class="row">
						<div class="col-md-6">
						<a href="restaurant.php?id=<?php echo $r['id'] ?>" class="txt4">
							Voir restaurant
							<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
						</a>
						</div>
						<div class="col-md-6">
						<a href="reservation.php?id=<?php echo $r['id'] ?>" class="txt4">
							Réserver
							<i class="fa fa-long-arrow-right m-l-10" aria-hidden="true"></i>
						</a>
						</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 p-t-60">
					<div class="wrap-pic-welcome size2 bo-rad-10 hov-img-zoom m-l-r-auto">
						<img src="gerant/images/restaurants/<?php echo $r['image'] ?>">
					</div>
				</div>
			</div>
            <?php } ?>
		</div>
	</section>

<?php include("footer.php"); ?>

