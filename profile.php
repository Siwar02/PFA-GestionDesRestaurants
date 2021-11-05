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

<section class="flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/ah.jpg); background-attachment: fixed;background-size: cover;">
</section>

<?php
    $requete="select * from user where id='".$_SESSION['user_id']."'";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_BOTH);    
?>
    <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img m-r-50">
                            <img src="images/profile/<?php echo $user['image']?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h6 class="tit2">
                                    <?php echo $user['first_name'].' '.$user['last_name']?>
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Vos commandes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Vos réservations</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="profile-edit-btn" data-toggle="modal" data-target="#exampleModal">Modifier profil</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p class="tit2 m-b-10">Informations personnelles</p>
                            <b>Nom & Prénom :</b> <?php echo $user['first_name'].' '.$user['last_name']?><br/>
                            <b>Pseudo :</b> <?php echo $user['username']?><br/>
                            <b>Email :</b> <?php echo $user['email']?><br/>
                            <b>Date de naissance :</b> <?php echo $user['birth_date']?><br>
                            <b>Téléphone :</b> <?php echo $user['phone']?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-bordered table-hover table-responsive table-profile">
                                    <thead>
                                        <tr>
                                            <th scope="col">Restaurant</th>
                                            <th scope="col">Nom de plat</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Prix Total</th>
                                            <th scope="col">Réponse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $req="SELECT restaurant.name as nom_restau,foods.name,commande.* 
                                        FROM commande JOIN foods ON commande.id_food=foods.id 
                                        join restaurant on foods.restaurant_id = restaurant.id
                                        WHERE commande.id_user='".$_SESSION['user_id']."'
                                        AND commande.reponse!='0' ";
                                        $stmt = $db->prepare($req);
                                        $stmt->execute();
                                        $comm=$stmt->fetchAll(PDO::FETCH_BOTH);
                                        if($stmt->rowCount()>0){
                                        foreach ($comm as $c) {
                                        ?>
                                        <tr>
                                            <td><?php echo $c['nom_restau']  ?></td>
                                            <td><?php echo $c['name']  ?></td>
                                            <td><?php echo $c['price']  ?></td>
                                            <td><?php echo $c['quantity']  ?></td>
                                            <td><?php echo $c['prix_total']  ?></td>
                                            <td><?php echo $c['reponse'] ?></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune commande n'a été répondue pour le moment</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-bordered table-hover table-responsive table-profile">
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
                                        $req="SELECT restaurant.name as nom_restau,reservation.* 
                                        FROM reservation JOIN restaurant 
                                        ON reservation.id_restaurant=restaurant.id 
                                        WHERE reservation.id_user='".$_SESSION['user_id']."'
                                        AND reservation.reponse!='0' ";
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
                                            <td><?php echo $r['reponse'] ?></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Aucune réservation n'a été répondue pour le moment</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>         
        </div>
        <style>
          
.emp-profile{
    padding: 0%;
    margin-top: 5%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width:50%;
    border:2px solid #de4535;
    border-radius: 8px;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.57);
}
.table-profile th,td{
    text-align: center;
}
.profile-head h6{
    color: black;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 83%;
    padding: 5%;
    font-weight: 600;
    color: white;
    cursor: pointer;
    background-color: #de4535;
}
.profile-edit-btn:hover{
    border:2px solid #de4535;
    background-color: white;
    color: #de4535;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link:focus{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 20px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-size: 16px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
.img-profile{
    width: 100%;
    height: 12.5em;
    border-radius: 10px;
}
.input-profile{
    box-shadow: 0 0 0px 2px rgba(236, 29, 37, 0.25);
    border-radius: 7px;
    padding:5px;
}
input[type='file']{
    width: 100%;font-size: 14px;
}
.modal-content{
    border: 3px solid #de4535;
    box-shadow: 1px 1px 10px 3px rgba(0, 0, 0, 0.54);
}
</style>

  <!-- Modal personel information-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="profile-form" method="post" action="update_profile.php" enctype="multipart/form-data">

              <div class="row">

                  <div class="col-md-6">
                        <img src="images/profile/<?php echo $user['image']?>" alt="" class="img-profile" />
                  </div>

                  <div class="col-md-6">
                        <label>Nom :</label>
                        <input type="text" name="first_name" class="input-profile" value="<?php echo $user['first_name']; ?>" required>
                        <label>Prénom :</label>
                        <input type="text" name="last_name" class="input-profile" value="<?php echo $user['last_name']; ?>" required>
                        <label>Pseudo :</label>
                        <input type="text" name="username" class="input-profile" value="<?php echo $user['username']; ?>" required>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-6">
                        <label>Photo :</label>
                        <input type="file" name="file" class="input-profile">
                    </div>
                    <div class="col-md-6">
                        <label>Email:</label>
                        <input type="text" name="email" class="input-profile" value="<?php echo $user['email']; ?>" required> 
                    </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                        <label>Téléphone :</label>
                        <input type="text" name="phone" minlength="8" maxlength="8" class="input-profile" value="<?php echo $user['phone']; ?>" required>
                      </div>

                  <div class="col-md-6">
                    <label>Date de naissance :</label>
                    <input type="text" name="birth_date" class="my-calendar input-profile" value="<?php echo $user['birth_date']; ?>" required>
                  </div>

              </div>

              <div class="row">
                <div class="col-md-6 p-t-20">
                    <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#mypassword">Change mot de passe</a>
                  </div>
              </div>

          

      </div>
      <div class="modal-footer">
            <input type="submit" name="save" class="btn btn-primary" value="Enregistrer">
        </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal password-->
  <div class="modal fade" id="mypassword" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modifier mot de passe</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <form class="profile-form" method="post" action="update_password.php">
            <div class="row">
                <div class="col-md-6">
                    <label>Ancien mot de passe :</label>
                    <input type="text" name="old_password" class="input-profile" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Nouveau mot de passe :</label>
                    <input type="text" name="new_password" class="input-profile" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Confirmer nouveau mot de passe :</label>
                    <input type="text" name="confirm_new_password" class="input-profile" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="update_password" class="btn btn-primary" value="Enregistrer">
        </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
      
    </div>
  </div>
<?php include("footer.php"); }?>