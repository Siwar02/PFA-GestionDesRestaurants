<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
    header('location:login.php');
}
else
{
include ("header.php");
?>

<section class="flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/gallery7.jpg); background-attachment: fixed;background-size: cover;">
</section>

    	<!-- cart section end -->
	<section class="cart-section spad m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
						<h3 class="tit22 p-b-20">Vos commande(s) en cours</h3>
							<table class="table table-bordered table-responsive table-hover">
							  <thead>
							    <tr>
							    	<th scope="col">Restaurant</th>
							      	<th scope="col">Nom de plat</th>
	                                <th scope="col">Ingrédients</th>
	                                <th scope="col">Prix</th>
	                                <th scope="col">Quantité</th>
	                                <th scope="col">Prix Totale</th>
	                                <th scope="col">Réponse</th>
							    </tr>
							  </thead>
							  <tbody>
                                <?php
                                $req="SELECT restaurant.name as nom_restau,foods.name,foods.description,
                                commande.* FROM commande 
                                JOIN foods ON commande.id_food=foods.id 
                                join restaurant on foods.restaurant_id = restaurant.id
                                WHERE commande.id_user='".$_SESSION['user_id']."'
								and commande.reponse='0'";
                                $stmt = $db->prepare($req);
                                $stmt->execute();
                                $commande=$stmt->fetchAll(PDO::FETCH_BOTH);
                                if($stmt->rowCount()>0){
                                foreach ($commande as $c) {
                                ?>
							    <tr>
							    	<td> <?php echo $c['nom_restau']  ?></td>
	                                <td> <?php echo $c['name']; ?></td>
	                                <td> <?php echo $c['description']; ?></td>
	                                <td> <?php echo $c['price']; ?> DT</td>
	                                <td> <?php echo $c['quantity']; ?></td>
	                                <td> <?php echo $c['prix_total']; ?> DT</td>
                                    <td> Encours</td>
                                   
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                	<td colspan="7" class="text-center">Aucune commande en cours pour le moment</td>
                                </tr>
                            	<?php } ?>
							  </tbody>
							</table>
				</div>
			</div>
		</div>
	</section>


    <style>

 table th,td{
	text-align: center;
}

    </style>


<?php include("footer.php"); }?>