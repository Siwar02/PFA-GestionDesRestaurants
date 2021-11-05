<?php
include("connexion/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["gerant_id"]))
{
    header('location:../login.php');
}
else
{
include("header.php");

	$sql1 = "SELECT COUNT(foods.id) as plats from foods JOIN admins ON foods.restaurant_id=admins.id_restaurant
	where admins.id = '".$_SESSION['gerant_id']."'";
	$stmt1 = $db->prepare($sql1);
	$stmt1->execute();
	$foods= $stmt1->fetch();

	$sql2 = "SELECT COUNT(reservation.id) as reservation from reservation JOIN admins ON
	 reservation.id_restaurant=admins.id_restaurant where admins.id = '".$_SESSION['gerant_id']."'";
	$stmt2 = $db->prepare($sql2);
	$stmt2->execute();
	$reservation= $stmt2->fetch();

	$sql3 = "SELECT SUM(commande.quantity) as cmd from commande JOIN foods ON commande.id_food=foods.id 
	JOIN admins ON foods.restaurant_id=admins.id_restaurant where admins.id = '".$_SESSION['gerant_id']."'";
	$stmt3 = $db->prepare($sql3);
	$stmt3->execute();
	$commande= $stmt3->fetch();

	$sql4 = "SELECT COUNT(comment.id) as cmt from comment JOIN admins ON
	 comment.id_restaurant=admins.id_restaurant  where admins.id = '".$_SESSION['gerant_id']."'";
	$stmt4 = $db->prepare($sql4);
	$stmt4->execute();
	$comment= $stmt4->fetch();

	$sql5 = "SELECT (sum(rating.rating)/count(rating.id_restaurant))/100 AS percent,
			restaurant.name
			FROM rating 
			JOIN restaurant on rating.id_restaurant=restaurant.id
			JOIN admins ON rating.id_restaurant = admins.id_restaurant
			WHERE admins.id = '".$_SESSION['gerant_id']."'
			GROUP BY rating.id_restaurant ";
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
						<h3><?php echo $foods['plats'] ?></h3>
						<h4>Plats disponibles</h4>
						
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
					<h3><?php echo $reservation['reservation'] ?></h3>
					<h4>Réservation(s)</h4>
					
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-pencil-square-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php if($commande['cmd']==null){ echo "0";}
						else{ echo $commande['cmd'];}?></h3>
						<h4>Commande(s)</h4>
					
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-phone"> </i>
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
						<h3><?php echo $comment['cmt'] ?></h3>
						<h4>Commentaire(s)</h4>
						
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-comments-o"> </i>
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