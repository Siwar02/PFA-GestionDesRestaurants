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
      $sql="UPDATE commande SET reponse=? WHERE id=?";
      $stmt = $db->prepare($sql);
      $stmt->execute(['accepte',$_POST['id_commande']]);
  }
  else{
      $sql="UPDATE commande SET reponse=? WHERE id=?";
      $stmt = $db->prepare($sql);
      $stmt->execute(['refuse',$_POST['id_commande']]);
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
                        $sql = "SELECT count(*) as allCommandes from commande JOIN foods ON 
                        commande.id_food=foods.id JOIN restaurant ON foods.restaurant_id=restaurant.id 
                        JOIN admins on restaurant.id=admins.id_restaurant where admins.id = '".$_SESSION['gerant_id']."'
                        and commande.reponse='0'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowComm= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowComm as $numberComm){ }
                    ?>
            <h3><?php echo $numberComm['allCommandes'] ?></h3>
            <h4>Commandes(s)</h4>
            <p>encours</p>
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
                                <a href="archive_commandes.php" style="float: right;"><u>Liste des archives</u></a>
                                <span>Les commandes :</span>
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
                                    $sql = "SELECT user.username,foods.name,user.phone,foods.price,commande.quantity,
                                    commande.prix_total,commande.id,commande.reponse FROM commande JOIN user ON commande.id_user = user.id 
                                    JOIN foods on commande.id_food=foods.id JOIN admins on
                                     foods.restaurant_id=admins.id_restaurant
                                      WHERE admins.id = '".$_SESSION['gerant_id']."' and commande.reponse='0'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allComm= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allComm as $comm){
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $comm['username'] ?></td> 
                                    <td><?php echo $comm['name'] ?></td>                
                                    <td><?php echo $comm['phone'] ?></td>
                                    <td><?php echo $comm['price'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $comm['quantity']?></span></td>
                                    <td><?php echo $comm['prix_total'] ?></td>
                                    <td>
                                    <form method="POST">
                                      <input type="hidden" name="id_commande" value="<?php echo $comm['id'] ?>"/>
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
</body>
</html>                     
<?php
}
?>
