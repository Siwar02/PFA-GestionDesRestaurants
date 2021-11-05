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
<?php
    $requete="select * from admins where id='".$_SESSION['gerant_id']."'";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $admin=$stmt->fetch(PDO::FETCH_BOTH);    
?>
    <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="images/admins/<?php echo $admin['image']?>" alt=""/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="profile-head">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Modifier restaurant</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Modifier profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Modifier Mot de passe</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p class="">Informations personnelles</p><hr>
                            <b>Nom & Prénom :</b> <?php echo $admin['first_name'].' '.$admin['last_name']?><br/>
                            <b>Pseudo :</b> <?php echo $admin['username']?><br/>
                            <b>Date de naissance :</b> <?php echo $admin['birth_date']?><br>
                            <b>Téléphone :</b> <?php echo $admin['phone']?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo de restaurant</th>
                                            <th scope="col">Nom de restaurant</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Localisation</th>
                                            <th scope="col">Région</th>
                                            <th scope="col">Coût publicitaire</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $req="SELECT restaurant.* , address.name as region FROM restaurant
                                        JOIN address ON restaurant.address_id = address.id
                                        JOIN admins on restaurant.id = admins.id_restaurant 
                                        WHERE admins.id='".$_SESSION['gerant_id']."'";
                                        $stmt = $db->prepare($req);
                                        $stmt->execute();
                                        $comm=$stmt->fetchAll(PDO::FETCH_BOTH);
                                        foreach ($comm as $c) {
                                        ?>
                                        <tr>
                                            <td><img src="images/restaurants/<?php echo $c['image']?>" style="width:100%"></td>
                                            <td><?php echo $c['name']  ?></td>
                                            <td><?php echo $c['description']  ?></td>
                                            <td><?php echo $c['localisation']  ?></td>
                                            <td><?php echo $c['region']  ?></td>
                                            <td><?php echo $c['cost']  ?></td>
                                            <td><button class="btn btn-info" data-toggle="modal" data-target="#modifierRestau">Modifier</button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" action="update_profile.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nom :</label>
                                        <input type="text" name="first_name" class="form-control" value="<?php echo $admin['first_name']; ?>" required>
                                        <label>Pseudo :</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $admin['username']; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Prénom :</label>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo $admin['last_name']; ?>" required>
                                        <label>Email:</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $admin['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Téléphone :</label>
                                        <input type="text" name="phone" minlength="8" maxlength="8" class="form-control" value="<?php echo $admin['phone']; ?>" required>
                                        <label>Photo :</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Date de naissance :</label>
                                        <input type="date" name="birth_date" class="form-control" value="<?php echo $admin['birth_date']; ?>" required>
                                    </div>
                                </div><br>
                                    <input type="submit" name="update_profile" class="btn btn-primary" value="Enregistrer">
                                </form>
                            </div>
                            <div class="tab-pane" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <form method="post" action="update_password.php">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Ancien mot de passe :</label>
                                            <input type="text" name="old_password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nouveau mot de passe :</label>
                                            <input type="text" name="new_password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Confirmer nouveau mot de passe :</label>
                                            <input type="text" name="confirm_new_password" class="form-control" required>
                                        </div>
                                    </div><br>
                                    <input type="submit" name="update_password" class="btn btn-primary" value="Enregistrer">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>         
        </div>
        <style>
          
.emp-profile{
    padding: 0%;
    margin-top: 20%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    margin-top: -7em;
    width:35%;
    border:2px solid #68ae00;
    border-radius: 8px;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.57);
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
    font-family: 'Acme',sans-serif;
    letter-spacing: 1px;
    font-size: 20px;
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
    font-size: 25px;
    color: #44c063;
    font-family: 'Acme' , sans-serif ;
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
input[type='file']{
    width: 100%;
    font-size: 14px;
}
</style>

<?php include("footer.php");?>	
<!--COPY rights end here-->
</div>
</div>
<?php include("menu.php");?>

<!--model edit restau-->
<div class="modal fade" id="modifierRestau" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Modifier restaurant</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div><!--end modal-header-->
        <ul class="nav nav-tabs">
           <li class="active"><a href="#informations" data-toggle="tab" aria-expanded="true">Modifier informations du restaurant</a></li>
           <li class=""><a href="#photo" data-toggle="tab" aria-expanded="false">Modifier photo du restaurant</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="informations">
        <form method="post" action="update_restaurant_info.php">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Nom de restaurant :</label>
                        <input type="text" name="name_restau" class="form-control" value="<?php echo $c['name'] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label>Région :</label>
                        <select name="region" class="form-control" required>
                            <?php
                            $req="SELECT * FROM address";
                            $adr = $db->prepare($req);
                            $adr->execute();
                            $address=$adr->fetchAll(PDO::FETCH_BOTH);
                            foreach ($address as $a) {
                            ?>
                            <option <?php if($c['region']==$a['name']){ ?> selected <?php } ?> value="<?php echo $a['id'] ?>">
                                <?php echo $a['name'] ?>        
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Localisation :</label>
                        <input type="text" name="localisation" class="form-control" value="<?php echo $c['localisation'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Description :</label>
                        <textarea name="description" id="desc" class="form-control" required rows="5"></textarea>
                        <script type="text/javascript">
                            document.getElementById('desc').value="<?php echo $c['description'] ?>";
                        </script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Coût publicitaire :</label>
                        <input type="text" class="form-control" value="<?php echo $c['cost'] ?>" disabled>
                        <input type="hidden" name="id_restau_info" value="<?php echo $c['id'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size: 12px;font-weight:bold;color: red">NB : Ce montant se modifie par l'administrateur de plateforme</p>
                    </div>
                </div>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <input type="submit" name="update_restau_info" class="btn btn-primary" value="Enregistrer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div><!--end modal-footer-->
        </form>
        </div><!--end id informations-->
        <div class="tab-pane fade" id="photo">
            <form method="post" action="update_restaurant_img.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Photo actuelle:</label>
                        </div>
                        <div class="col-md-8">
                            <img src="images/restaurants/<?php echo $c['image']?>" style="width: 100%">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Changer photo :</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="file_restau" class="form-control" required>
                            <input type="hidden" name="id_restau_img" value="<?php echo $c['id'] ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="update_restau_img" class="btn btn-primary" value="Enregistrer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div><!--end modal-footer-->
            </form>
        </div><!--end id passwords-->
    </div><!--end myTabContent-->
    </div><!--end modal-content-->
    </div><!--end modal-dialog-->
  </div><!--end-->

</body>
</html>

<?php
}
?>