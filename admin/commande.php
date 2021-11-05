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
if(isset($_POST['archiver'])){
$req = "UPDATE commande set archive='1' where id='".$_POST['id']."' ";
$stmt= $db->prepare($req);
$stmt->execute();
}
 
?>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
   <div class="market-updates">
      <div class="col-md-4 market-update-gd">
        <div class="market-update-block clr-block-4">
          <div class="col-md-8 market-update-left">
          <?php 
                        $sql = "SELECT count(*) as allCommandes from commande JOIN foods ON 
                        commande.id_food=foods.id JOIN restaurant ON foods.restaurant_id=restaurant.id 
                        JOIN admins on restaurant.id=admins.id_restaurant where commande.archive='0'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowComm= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowComm as $numberComm){ }
                    ?>
            <h3><?php echo $numberComm['allCommandes'] ?></h3>
            <h4>Commandes(s)</h4>
            <p>Existe(s)</p>
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
                            <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="search" onkeyup="myFunction()"
                                placeholder="Rechercher..."/>
                            </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="myTable">
                                  <thead>
                                    <tr>
                                      <th>N°</th>
                                      <th>Nom du client</th>
                                      <th>Nom du plat</th>
                                     <th>Nom restaurant</th>
                                      <th>Prix</th>                                                             
                                      <th>Quantite</th>
                                      <th>Prix total</th>
                                      <th>Réponse</th>
                                      <th>Archiver</th>
                                    </tr>
                              </thead>
                <tbody>
                              <?php 
                                    $i=1;
                                    $sql = "SELECT user.username,foods.name,foods.price,commande.quantity,
                                    commande.prix_total,commande.id,commande.reponse,restaurant.name as nom_restau
                                    FROM commande JOIN user ON commande.id_user = user.id 
                                    JOIN foods on commande.id_food=foods.id JOIN restaurant on
                                     foods.restaurant_id=restaurant.id
                                      WHERE commande.archive='0'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allComm= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allComm as $comm){
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $comm['username'] ?></td> 
                                    <td><?php echo $comm['name'] ?></td> 
                                    <td><?php echo $comm['nom_restau'] ?></td>                
                                    <td><?php echo $comm['price'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $comm['quantity']?></span></td>
                                    <td><?php echo $comm['prix_total'] ?></td>
                                    <td><?php if($comm['reponse']=='0'){
                                        echo "Encours";}
                                        else{ echo $comm['reponse']; } ?>
                                    </td>
                                    <form method="post">
                                    <td>
                                    <input type="hidden" value="<?php echo $comm['id'] ?>" name="id">
                                    <button class="btn btn-warning" name="archiver"><i class="fa fa-archive"></i></button>
                                    </td>
                                    </form>
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

<script>
      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          td1 = tr[i].getElementsByTagName("td")[2];
          td2 = tr[i].getElementsByTagName("td")[3];
          td3 = tr[i].getElementsByTagName("td")[7];
          if (td) {
            txtValue = td.textContent || td.innerText;
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            txtValue3 = td3.textContent || td3.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1
            || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }       
        }
      }
</script>
</body>
</html>                     
<?php
}
?>
