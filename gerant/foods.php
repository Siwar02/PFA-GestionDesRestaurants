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
                        $sql = "SELECT count(*) as allFoods from foods join admins where foods.restaurant_id =admins.id_restaurant and admins.id = '".$_SESSION['gerant_id']."' ";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowFoods= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowFoods as $number){	}
                    ?>
						<h3><?php echo $number['allFoods'] ?></h3>
						<h4>Plats disponibles</h4>
						<p>Other hand, we denounce</p>
					</div>
					<div class="col-md-4 market-update-right">
              <i class="fa fa-cutlery"></i>
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
                                  <span>Mes plats disponibles :</span>
                            </div>
                            <div class=" table table-responsive">
                                <table class="table table-hover table-bordered table-striped">
									<caption><a href="add_food.php" class="btn btn-primary">Ajouter nouveau plat</a></caption>
                                  <thead class="bg-dark">
                                    <tr>
                                      <th>N°</th>
									                    <th>Image</th>
                                      <th>Nom</th>
                                      <th>Description</th>                                                    
                                      <th>Prix</th>
									                    <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                              <?php 
                                    $i=1; 
                                    $sql = "SELECT foods.* from foods join admins where foods.restaurant_id =admins.id_restaurant and admins.id = '".$_SESSION['gerant_id']."'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allFoods= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allFoods as $foods){
                                ?>
                                  <tr>
                                    <td><?php echo $i++;  ?></td>
                                    <td style="width: 20%;"><img style="width: 45%;border-radius:50%;margin-left:3em;" src="images/food_added/<?php echo $foods['image'] ?>"></td>
                                    <td><?php echo $foods['name'] ?></td>  
                                    <td><?php echo $foods['description'] ?></td>
                                    <td><span class="badge badge-info"><?php echo $foods['price'] ?></span></td>
                                    <td>
                                        <a href="update_food.php?food_id=<?php echo $foods['id'] ?>"><button class="btn btn-info">Modifier </button></a>
                                        <a  onclick="return confirm('voulez-vous vraiment supprimer ce plat ?')" href="delete_food.php?id_food=<?php echo $foods['id'] ?>">
                                        <button class="btn btn-danger">Supprimer</button>
                                        </a>
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