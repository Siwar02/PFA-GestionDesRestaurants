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
                        $sql = "SELECT COUNT(id) as nbr_restau from restaurant";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowRes= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowRes as $number){  }
                    ?>
            <h3><?php echo $number['nbr_restau'] ?></h3>
            <h4>Restaurant(s).</h4>
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
                                <a href="add_restaurant.php" class="btn btn-primary" style="float: right;color:white;">
                                Ajouter nouveau restaurant</a>
                                <span>Les restaurants existants :</span>
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
                                      <th>Nom</th>
                                      <th>Description</th>                                                    
                                      <th>Localisation</th>
                                      <th>Adresse</th>
                                      <th>Coût publicitaire</th>
                                      <th>Gérant</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                              <?php 
                                    $i=1; 
                                    $sql = "SELECT restaurant.*,admins.username as gerant,address.name as addresse
                                    from restaurant
                                    join address on restaurant.address_id= address.id
                                    join admins on restaurant.id =admins.id_restaurant";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $allRestau= $stmt->fetchAll(PDO::FETCH_BOTH);
                                    foreach($allRestau as $restau){
                                ?>
                                  <tr>
                                    <td><?php echo $i++;  ?></td>
                                    <td style="width: 20%;"><img style="width: 45%;border-radius:50%;margin-left:3em;" src="../gerant/images/restaurants/<?php echo $restau['image'] ?>"></td>
                                    <td><?php echo $restau['name'] ?></td>  
                                    <td><?php echo $restau['description'] ?></td>
                                    <td><?php echo $restau['localisation'] ?></td>
                                    <td><?php echo $restau['addresse'] ?></td>
                                    <td><span class="badge badge-info"><?php echo $restau['cost'] ?></span></td>
                                    <td><?php echo $restau['gerant'] ?></td>
                                    <td>
                                        <a href="update_restaurant.php?restau_id=<?php echo $restau['id'] ?>"><button class="btn btn-info">Modifier </button></a>
                                        <a  onclick="return confirm('voulez-vous vraiment supprimer ce restaurant ?')" href="delete_restaurant.php?id_restau=<?php echo $restau['id'] ?>">
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
          td3 = tr[i].getElementsByTagName("td")[5];
          td4 = tr[i].getElementsByTagName("td")[7];
          if (td) {
            txtValue = td.textContent || td.innerText;
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            txtValue3 = td3.textContent || td3.innerText;
            txtValue4 = td4.textContent || td4.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1
            || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1
            || txtValue4.toUpperCase().indexOf(filter) > -1){
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