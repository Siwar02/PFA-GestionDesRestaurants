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
        <div class="market-update-block clr-block-2">
          <div class="col-md-8 market-update-left">
                    <?php 
                        $sql = "SELECT COUNT(id) as nbr_admins from admins";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowGer= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowGer as $number){  }
                    ?>
            <h3><?php echo $number['nbr_admins'] ?></h3>
            <h4>Gérants(s).</h4>
            <p>Other hand, we denounce</p>
          </div>
          <div class="col-md-4 market-update-right">
              <i class="fa fa-users"></i>
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
                                <a href="add_gerant.php" class="btn btn-primary" style="float: right;color:white;">
                                Ajouter nouveau gérant</a>
                                <span>Les Gérants existants :</span>
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="search" onkeyup="myFunction()"
                                placeholder="Rechercher..."/>
                            </div>
                            </div>
                            <div class=" table table-responsive">
                                <table class="table table-hover table-bordered table-striped" id="myTable">
                                  <thead class="bg-dark">
                                    <tr>
                                      <th>N°</th>
                                      <th>Image</th>
                                      <th>Nom & Prénom</th>
                                      <th>Pseudo</th>
                                      <th>Email</th>                                                    
                                      <th>Mot de passe</th>
                                      <th>Téléphone</th>
                                      <th>Date de naissance</th>
                                      <th>Restaurant</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                              <?php 
                                    $i=1; 
                                    $sql = "SELECT admins.*,restaurant.name as nom_rest from admins
                                    join restaurant on admins.id_restaurant= restaurant.id";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allGerant= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allGerant as $gerant){
                                ?>
                                  <tr>
                                    <td><?php echo $i++;  ?></td>
                                    <td style="width: 20%;"><img style="width: 45%;border-radius:50%;margin-left:3em;" src="../gerant/images/admins/<?php echo $gerant['image'] ?>"></td>
                                    <td><?php echo $gerant['first_name'].' '.$gerant['last_name'] ?></td>  
                                    <td><?php echo $gerant['username'] ?></td>
                                    <td><?php echo $gerant['email'] ?></td>
                                    <td><span class="badge badge-info"><?php echo $gerant['password'] ?></span></td>
                                    <td><?php echo $gerant['phone'] ?></td>
                                    <td><?php echo $gerant['birth_date'] ?></td>
                                    <td><?php echo $gerant['nom_rest'] ?></td>
                                    <td>
                                        <a href="update_gerant.php?gerant_id=<?php echo $gerant['id'] ?>"><button class="btn btn-info">Modifier </button></a>
                                        <a  onclick="return confirm('voulez-vous vraiment supprimer cet gérant ?')" href="delete_gerant.php?id_gerant=<?php echo $gerant['id'] ?>">
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
<script>
      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[2];
          td1 = tr[i].getElementsByTagName("td")[3];
          td2 = tr[i].getElementsByTagName("td")[4];
          td3 = tr[i].getElementsByTagName("td")[6];
          td4 = tr[i].getElementsByTagName("td")[7];
          td5 = tr[i].getElementsByTagName("td")[8];
          if (td) {
            txtValue = td.textContent || td.innerText;
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            txtValue3 = td3.textContent || td3.innerText;
            txtValue4 = td4.textContent || td4.innerText;
            txtValue5 = td5.textContent || td5.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1
            || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1
            || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1){
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