<?php
include("connexion/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["admin_id"]))
{
    header('location:login.php');
}
else
{
include("header.php");

	$sql1 = "SELECT COUNT(id) as nbr_restau from restaurant";
	$stmt1 = $db->prepare($sql1);
	$stmt1->execute();
	$restau= $stmt1->fetch();

	$sql2 = "SELECT COUNT(id) as nbr_admins from admins";
	$stmt2 = $db->prepare($sql2);
	$stmt2->execute();
	$gerants= $stmt2->fetch();

	$sql3 = "SELECT COUNT(reservation.id) as nbr_res from reservation";
	$stmt3 = $db->prepare($sql3);
	$stmt3->execute();
	$reservation= $stmt3->fetch();

	$sql4 = "SELECT SUM(commande.quantity) as cmd from commande";
	$stmt4 = $db->prepare($sql4);
	$stmt4->execute();
	$commande= $stmt4->fetch();

	$sql5 = "SELECT (sum(rating.rating)/count(rating.id_restaurant))/100 AS percent FROM rating ";
	$stmt5 = $db->prepare($sql5);
	$stmt5->execute();
	$rating= $stmt5->fetch();
?>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $restau['nbr_restau'] ?></h3>
						<h4>Restaurant(s)</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-cutlery"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				 <div class="col-md-8 market-update-left">
					<h3><?php echo $gerants['nbr_admins'] ?></h3>
					<h4>Gérants(s)</h4>
					
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $reservation['nbr_res'] ?></h3>
						<h4>Réservation(s)</h4>
					
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-pencil-square-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div><br>
		<div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $commande['cmd'] ?></h3>
						<h4>Commande(s)</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-phone"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-5">
					<div class="col-md-8 market-update-left">
						<h3><?php $percent = round($rating['percent']*100,2);
						 echo $percent ?> %</h3>
						<h4>Satisfaction</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-thumbs-o-up"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		</div>




</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include("footer.php");?>	
<!--COPY rights end here-->
</div>
</div>
<?php include("menu.php");?>
</body>
</html>                     
<?php
}
?>