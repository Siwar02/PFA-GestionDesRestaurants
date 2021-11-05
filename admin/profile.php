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
<?php
    $requete="select * from admin where id='".$_SESSION['admin_id']."'";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $admin=$stmt->fetch(PDO::FETCH_BOTH);    
?>
    <div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                    
                    </div>
                    <div class="col-md-8">
                        <div class="profile-head">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                            <b>Pseudo :</b> <?php echo $admin['username']?><br/>
                            <b>Email :</b> <?php echo $admin['email']?><br>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" action="update_profile.php" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Pseudo :</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo $admin['username']; ?>" required>
                                        <label>Email:</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $admin['email']; ?>" required>
                                    </div>
                                </div>
                             <br>
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

<?php include("footer.php");?>	
<!--COPY rights end here-->
</div>
</div>
<?php include("menu.php");?>

<!--model edit restau-->
</body>
</html>

<?php
}
?>