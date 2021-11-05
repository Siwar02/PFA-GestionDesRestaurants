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
?>

<?php 
	$sql = "SELECT restaurant.*,address.name as adresse from restaurant join address on restaurant.address_id=address.id join admins where admins.id ='".$_SESSION['gerant_id']."' ";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$rowRestau= $stmt->fetchAll(PDO::FETCH_BOTH);
	foreach($rowRestau as $restau){	}
?>
<!--inner block start here-->
<div class="inner-block">
	<div class="typo-wells">
         <div class="distracted">
			  <h3 class="propos_restau">A propos du restaurant :</h3>
			  	   <div class="well">
					<img src="images/restaurants/<?php echo $restau['image']; ?>">
				   </div>
				   <div class="well">
				  	<b> Nom : </b> <?php echo $restau['name']; ?>
				   </div>
				   <div class="well">
				   <b> Adresse : </b> <?php  echo $restau['adresse'].' , '.$restau['localisation']; ?>
				   </div>
				   <div class="well">
				   <b>Description : </b> <?php echo $restau['description']; ?>
				   </div>
				   <div class="well">
				   <b>Coût publicitaire : </b> <?php echo $restau['cost']; ?> DT
				   </div>
		    </div>
	</div>
</div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include("footer.php");?>	
<!--COPY rights end here-->
</div>
<?php include("menu.php");?>
</body>
</html>
<?php
}
?>