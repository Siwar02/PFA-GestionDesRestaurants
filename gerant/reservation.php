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

if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['accept'])){
        $sql="UPDATE reservation SET reponse=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(['accepte',$_POST['id_reservation']]);
    }
    else{
        $sql="UPDATE reservation SET reponse=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->execute(['refuse',$_POST['id_reservation']]);
    }
}
?>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
					<?php 
                        $sql = "SELECT count(*) as allReservations from reservation JOIN restaurant 
                        ON reservation.id_restaurant=restaurant.id JOIN admins on 
                        restaurant.id=admins.id_restaurant where admins.id = '".$_SESSION['gerant_id']."' 
                        and reservation.reponse='0'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowRes= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowRes as $numberRes){	}
                    ?>
						<h3><?php echo $numberRes['allReservations'] ?></h3>
						<h4>Réservation(s)</h4>
						<p>encours</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-calendar-check-o"></i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>


		   <div class="clearfix"> </div>
		</div>
	
<!--market updates end here-->
<!--mainpage chit-chating-->
<div class="chit-chat-layer1">
	<div class="col-md-12 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                <a href="archive_reservation.php" style="float: right;"><u>Liste des archives</u></a>
                                <span>Les demandes de réservation :</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-responsive">
                                  <thead>
                                    <tr>
                                      <th>N°</th>
									  <th>Email</th>
                                      <th>Nom du client</th>
                                      <th>Téléphone</th>                                                              
                                      <th>Nombre de places</th>
                                      <th>Date d'envoi</th>
                                      <th>Date de réservation</th>
									  <th>Action</th>
                                    </tr>
                              </thead>
							  <tbody>
                              <?php 
                                    $i=1;
                                    $sql = "SELECT reservation.*,user.email FROM reservation JOIN restaurant
                                     ON reservation.id_restaurant=restaurant.id  JOIN user
                                      on reservation.id_user=user.id JOIN admins on 
                                      restaurant.id=admins.id_restaurant 
                                      where admins.id = '".$_SESSION['gerant_id']."' and reservation.reponse='0'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allRes= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allRes as $res){
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
									<td><?php echo $res['email'] ?></td> 
                                    <td><?php echo $res['name'] ?></td>                                                      
                                    <td><?php echo $res['phone'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $res['nb_places'] ?></span></td>
                                    <td><?php echo $res['date_envoi']?></td>
                                    <td><?php echo $res['date']." à " .$res['time'] ?></td>
									<td>
                                        <form method="POST">
                                            <input type="hidden" name="id_reservation" value="<?php echo $res['id'] ?>"/>
                                            <input type="submit" name="accept" value="Accepter" class="btn btn-success"/>
                                            <input type="submit" name="refuse" value="Refuser" class="btn btn-danger"/>
                                        </form> 
                                    </td>
                                </tr> 
                                <?php } ?>
                            </tbody>
                      </table>
                  </div>
             </div>
      </div>

     <div class="clearfix"> </div>
</div>
<!--main page chit chating end here-->

</div>
<!--inner block end here-->
<?php include("footer.php");?>
</div>
</div>
<?php include("menu.php");?>
<!-- mother grid end here-->
</body>
</html>                     
<?php
}
?>
