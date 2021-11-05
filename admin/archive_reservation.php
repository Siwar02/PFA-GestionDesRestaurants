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
?>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
					<?php 
                        $sql = "SELECT COUNT(reservation.id) as nbr_archives
                        FROM reservation
                        JOIN restaurant on reservation.id_restaurant=restaurant.id
                        JOIN user ON reservation.id_user=user.id
                        WHERE reservation.archive='1'";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowRes= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowRes as $numberRes){	}
                    ?>
						<h3><?php echo $numberRes['nbr_archives'] ?></h3>
						<h4>Réservation(s)</h4>
						<p>archivée(s)</p>
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
                                <a href="reservation.php" style="float: right;"><u>Liste des réservations</u></a>
                                <span>Les demandes de réservation archivées :</span>
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="search" onkeyup="myFunction()"
                                placeholder="Rechercher..."/>
                            </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-responsive" id="myTable">
                                  <thead>
                                    <tr>
                                      <th>N°</th>
									                    <th>Utilisateur</th>
                                      <th>Nom du client</th>
                                      <th>Restaurant</th>                                                              
                                      <th>Nombre de places</th>
                                      <th>Date d'envoi</th>
                                      <th>Date de réservation</th>
									                    <th>Réponse</th>
                                    </tr>
                              </thead>
							  <tbody>
                              <?php 
                                    $i=1;
                                    $sql = "SELECT reservation.* , restaurant.name as nom_restau , user.username as nom_user
                                    FROM reservation
                                    JOIN restaurant on reservation.id_restaurant=restaurant.id
                                    JOIN user ON reservation.id_user=user.id
                                    WHERE reservation.archive='1'";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allRes= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allRes as $res){
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
									                  <td><?php echo $res['nom_user'] ?></td> 
                                    <td><?php echo $res['name'] ?></td>                                                      
                                    <td><?php echo $res['nom_restau'] ?></td>
                                    <td><span class="badge badge-danger"><?php echo $res['nb_places'] ?></span></td>
                                    <td><?php echo $res['date_envoi']?></td>
                                    <td><?php echo $res['date']." à " .$res['time'] ?></td>
									                  <td><?php if($res['reponse']=='0'){
                                        echo "Encours";}
                                        else{ echo $res['reponse']; } ?>
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
<style>
 th , td {
     text-align: center;
 }
 table{
     margin-top: 10px;
 }
</style>
</body>
</html>                     
<?php
}
?>