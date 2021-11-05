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
						<h3 class="tit22 p-b-20">Vos réservation(s) en cours</h3>
							<table class="table table-bordered table-responsive table-hover">
							  <thead>
							    <tr>
							    	<th scope="col">Restaurant</th>
                                    <th scope="col">Nom du réservant</th>
                                    <th scope="col">Nombre de place</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Réponse</th>
							    </tr>
							  </thead>
							  <tbody>
                                <?php
                                $req="SELECT reservation.*,restaurant.name as nom_restau FROM reservation  
                                join restaurant on reservation.id_restaurant = restaurant.id
                                WHERE reservation.id_user='".$_SESSION['user_id']."'
								and reservation.reponse='0'";
                                $stmt = $db->prepare($req);
                                $stmt->execute();
                                $reservation=$stmt->fetchAll(PDO::FETCH_BOTH);
                                if($stmt->rowCount()>0){
                                foreach ($reservation as $r) {
                                ?>
							    <tr>
							    	<td><?php echo $r['nom_restau']  ?></td>
                                    <td><?php echo $r['name']  ?></td>
                                    <td><?php echo $r['nb_places']  ?></td>
                                    <td><?php echo $r['date'].' à '.$r['time']  ?></td>
                                    <td>Encours</td>
                                </tr>
                                <?php } } else { ?>
                                <tr>
                                	<td colspan="5" class="text-center">Aucune réservation en cours pour le moment</td>
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