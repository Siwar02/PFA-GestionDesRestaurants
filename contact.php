<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

include ("header.php");

if(isset($_POST['contacter'])){
	$req = "INSERT INTO contact (email,message) 
        	VALUES ('".$_POST['email']."','".$_POST['message']."')";
    $res= $db->prepare($req);
    $res->execute();
	echo'<script>alert("Votre message a été bien envoyée");</script>';
}
?>


	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/contact.jpg);">

	</section>



	<!-- Contact form -->
	<section class="section-contact bg1-pattern p-t-90 p-b-113">
		<!-- Map -->
		<div class="container">
			<div class="map bo8 bo-rad-10 of-hidden">
				<div class="mapouter">
					<div class="gmap_canvas">
						<iframe width="1165" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=monastir&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
						</iframe>
						<a href="https://123movies-to.org">123movies</a><br>
						<style>.mapouter{position:relative;text-align:right;height: 500px;;width:1165px;}</style>
						<a href="https://www.embedgooglemap.net">google maps embed link</a>
						<style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:1165px;}</style>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<h3 class="tit7 t-center p-b-62 p-t-105">
				Envoie-nous un message
			</h3>

			<form class="wrap-form-reservation size22 m-l-r-auto" method="POST">
				<div class="row">
					<div class="col-md-4">
						<!-- Email -->
						<span class="txt9">
							Email
						</span>

						<div class="wrap-inputemail size12 bo2 bo-rad-10 m-t-3 m-b-23">
							<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="email" required>
						</div>
					</div>

					<div class="col-12">
						<!-- Message -->
						<span class="txt9">
							Message
						</span>
						<textarea class="bo-rad-10 size35 bo2 txt10 p-l-20 p-t-15 m-b-10 m-t-3" name="message" placeholder="Votre message..." required></textarea>
					</div>
				</div>

				<div class="wrap-btn-booking flex-c-m m-t-13">
					<!-- Button3 -->
					<input type="submit" class="btn3 flex-c-m size36 txt11 trans-0-4" value="Contacter" name="contacter">
				</div>
			</form>

			<div class="row p-t-135">
				<div class="col-sm-8 col-md-4 col-lg-4 m-l-r-auto p-t-30">
					<div class="dis-flex m-l-23">
						<div class="p-r-40 p-t-6">
							<img src="images/icons/map-icon.png" alt="IMG-ICON">
						</div>

						<div class="flex-col-l">
							<span class="txt5 p-b-10">
								Emplacement
							</span>

							<span class="txt23 size38">
								Monastir , Cité El Aagba
							</span>
						</div>
					</div>
				</div>

				<div class="col-sm-8 col-md-3 col-lg-4 m-l-r-auto p-t-30">
					<div class="dis-flex m-l-23">
						<div class="p-r-40 p-t-6">
							<img src="images/icons/phone-icon.png" alt="IMG-ICON">
						</div>


						<div class="flex-col-l">
							<span class="txt5 p-b-10">
								Appelez-nous
							</span>

							<span class="txt23 size38">
								(+216) 55635707
							</span>
						</div>
					</div>
				</div>

				<div class="col-sm-8 col-md-5 col-lg-4 m-l-r-auto p-t-30">
					<div class="dis-flex m-l-23">
						<div class="p-r-40 p-t-6">
							<img src="images/icons/clock-icon.png" alt="IMG-ICON">
						</div>


						<div class="flex-col-l">
							<span class="txt5 p-b-10">
								Horaires d'ouvertures
							</span>

							<span class="txt23 size38">
								09:30 AM – 11:00 PM <br/>Chaque jour
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php include("footer.php"); ?>