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
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
					<?php 
                        $sql = "SELECT count(*) as allCommandes from commande JOIN foods ON commande.id_food=foods.id JOIN restaurant ON foods.restaurant_id=restaurant.id JOIN admins on restaurant.id=admins.id_restaurant where admins.id = '".$_SESSION['gerant_id']."'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowComm= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowComm as $numberComm){ }
                    ?>
						<h3><?php echo $numberComm['allCommandes'] ?></h3>
						<h4>Commandes(s)</h4>
						<p>dans l'archive</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"></i>
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
                                <a href="commande.php" style="float: right;"><u>les Commandes encours</u></a>
                                <span>Tous les Commandes :</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                  <thead>
                                    <tr>
                                      <th>N°</th>
									  <th>Nom du client</th>
                                      <th>Nom du plat</th>
                                      <th>Téléphone</th> 
                                      <th>Prix</th>                                                             
                                      <th>Quantite</th>
                                      <th>Prix total</th>
									  <th>Action</th>
                                    </tr>
                              </thead>
							  <tbody>
                              <?php 
                                    $i=1;
                                    $sql2 ="SELECT user.username,foods.name,user.phone,foods.price,commande.quantity,
                                    commande.prix_total,commande.reponse FROM commande JOIN user ON commande.id_user = user.id 
                                    JOIN foods on commande.id_food=foods.id JOIN admins on
                                     foods.restaurant_id=admins.id_restaurant WHERE admins.id = '".$_SESSION['gerant_id']."' and
                                     commande.reponse!='0'";
                                    $stmt = $db->prepare($sql2);
                                    $stmt->execute();
                                    $allCom= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allCom as $comm){
                                ?>
                                    
                                    <?php 
                                      if($comm['reponse']=='accepte'){
                                     ?>
                                <tr style="background-color: #86e886;">
                                    <td><?php echo $i++ ?></td>
									<td><?php echo $comm['username'] ?></td> 
                                    <td><?php echo $comm['name'] ?></td>                                                      
                                    <td><?php echo $comm['phone'] ?></td>
                                    <td><?php echo $comm['price'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $comm['quantity'] ?></span></td>
                                    <td><?php echo $comm['prix_total']?></td>
                                    <td>Accepté</td>
                                </tr> 
                                    <?php } else {
                                     ?>
                                <tr style="background-color: #e68888; color:white">
                                    <td><?php echo $i++ ?></td>
									<td><?php echo $comm['username'] ?></td> 
                                    <td><?php echo $comm['name'] ?></td>                                                      
                                    <td><?php echo $comm['phone'] ?></td>
                                    <td><?php echo $comm['price'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $comm['quantity'] ?></span></td>
                                    <td><?php echo $comm['prix_total']?></td>
                                    <td>Refusé</td>
                                </tr> 
                                    <?php } ?>
                                    
                                
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
</body>
</html>                     
<?php
}
?>
