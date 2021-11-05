<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

include ("header.php");
?>
	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/reserved.jpg);">

	</section>


	<!-- Reservation -->
	<section class="section-reservation bg1-pattern p-t-100 p-b-113">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 p-b-30">
					<div class="t-center">
						<span class="tit2 t-center">
							Réservation
						</span>

						<h3 class="tit3 t-center m-b-35 m-t-2">
							Réservez une table
						</h3>
					</div>

					<form class="wrap-form-reservation size22 m-l-r-auto" method="POST" action="add_reservation.php">
					<div class="row">
							<div class="col-md-6">

								<span class="txt9">
									Nom
								</span>

								<div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="name" placeholder="Nom">
								</div>
								
								<!-- Date -->
								<span class="txt9">
									Date
								</span>

								<div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="bo-rad-10 sizefull txt10 p-l-20" type="date" name="date">
								</div>
								

								<!-- People -->
								<span class="txt9">
									Nombre des places
								</span>

								<div class="wrap-inputpeople size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<!-- Select2 -->
									<select class="selection-1" name="number_places">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
							</div>

							<div class="col-md-6">

								<span class="txt9">
									Restaurant
								</span>

								<?php 
										$requete="select * from restaurant where id = '".$_GET['id']."'";
										$stmt = $db->prepare($requete);
										$stmt->execute();
										$row=$stmt->fetch();
								?>
				
									<input class="bo-rad-10 sizefull txt10 p-l-20" value="<?php echo $row['id'] ?>" type="hidden" name="id_restaurant">
							

								<div class="wrap-inputname size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="bo-rad-10 sizefull txt10 p-l-20" value="<?php echo $row['name'] ?>" type="text" name="restaurant" disabled>
								</div>	
								
								<!-- Time -->
								<span class="txt9">
									Horaire
								</span>

								<div class="wrap-inputtime size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<!-- Select2 -->
									<select class="selection-1" name="time">
									<?php 
									for($i=11;$i<24;$i++){ ?>
									<option value="<?php echo $i.':00' ?>"><?php echo $i.':00' ?> H </option>';
									<?php }	?>
										<!--<option>9:00</option>
										<option>9:30</option>
										<option>10:00</option>
										<option>10:30</option>
										<option>11:00</option>
										<option>11:30</option>
										<option>12:00</option>
										<option>12:30</option>
										<option>13:00</option>
										<option>13:30</option>
										<option>14:00</option>
										<option>14:30</option>
										<option>15:00</option>
										<option>15:30</option>
										<option>16:00</option>
										<option>16:30</option>
										<option>17:00</option>
										<option>17:30</option>
										<option>18:00</option>
										<option>18:30</option>
										<option>19:00</option>
										<option>19:30</option>-->
									</select>
								</div>
								<!-- Phone -->
								<span class="txt9">
									Téléphone
								</span>

								<div class="wrap-inputphone size12 bo2 bo-rad-10 m-t-3 m-b-23">
									<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="phone" placeholder="Téléphone" minlength="8" maxlength="8">
								</div>

							</div>
						</div>

						<div class="wrap-btn-booking flex-c-m m-t-6">
							<!-- Button3 -->
							<?php if(isset($_SESSION['user_id'])) {  ?>
							<input type="submit" name="reserver" value="Réservez" class="btn3 flex-c-m size13 txt11 trans-0-4">
							<?php } else { ?>
							<a href="login.php" class="btn3 flex-c-m size13 txt11 trans-0-4" style="padding: 3%;">
								Connectez vous d'abord
							</a>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>

			<div class="info-reservation flex-w p-t-80">
				<div class="size23 w-full-md p-t-40 p-r-30 p-r-0-md">
					<h4 class="txt5 m-b-18">
						Réservez par téléphone
					</h4>

					<p class="size25">
						Vous pouvez aussi faire une réservation par téléphone ,
						juste appeler :
						<span class="txt24">+(216)55635707</span>
					</p>
				</div>

				<div class="size24 w-full-md p-t-40">
					<h4 class="txt5 m-b-18">
						For Event Booking
					</h4>

					<p class="size26">
						Donec feugiat ligula rhoncus:
						<span class="txt24">(001) 345 6889</span>
						, varius nisl sed, tinci-dunt lectus sodales sem.
					</p>
				</div>

			</div>
		</div>
	</section>


	<!-- Footer -->
	<?php include("footer.php"); ?>