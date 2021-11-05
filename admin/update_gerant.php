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

if(isset($_POST['modifier'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $birth_date = $_POST['birth_date'];
    $restaurant_id=$_POST['restaurant_id'];
    $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.',$fname);
        $extension = strtolower(end($extension));  
        $fimg = uniqid().'.'.$extension;
        $store = "../gerant/images/admins/".basename($fimg);

        if(!(empty($nom))&&!(empty($prenom))&&!(empty($username))&&!(empty($email))&&!(empty($password))&&!(empty($phone))&&!(empty($birth_date))&&!(empty($restaurant_id))&&($extension!='')){
            if( ($extension=='jpg')||($extension=='png')){
            $req = "UPDATE admins set first_name='$nom', last_name='$prenom', username='$username',
             email='$email',password='$password',phone='$phone',birth_date='$birth_date',image='$fimg',id_restaurant='$restaurant_id' where id='$_GET[gerant_id]' ";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            $success="Le gérant a été modifié avec succées";
        }else{
            $error_img="Type d'image non valide (seulement jpg ou png)";
        }
    }else if(!(empty($nom))&&!(empty($prenom))&&!(empty($username))&&!(empty($email))&&!(empty($password))&&!(empty($phone))&&!(empty($birth_date))&&!(empty($restaurant_id))){
            $requete = "UPDATE admins set first_name='$nom', last_name='$prenom', username='$username',
             email='$email',password='$password',phone='$phone',birth_date='$birth_date',id_restaurant='$restaurant_id' where id='$_GET[gerant_id]' ";
            $resultat= $db->prepare($requete);
            $resultat->execute();
            $success="Le gérant a été modifié avec succées";
    }else{
        $error="veuillez remplir tous les champs possibles";
    }
}
?>
<div class="inner-form">
    <?php if($success){ echo '<h3 class="success">'.$success.'</h3>'; }?>
    <?php if($error){ echo '<h3 class="error">'.$error.'</h3>'; }?>
    <?php if($error_img){ echo '<h3 class="error">'.$error_img.'</h3>'; }?>

    <div class="work-progres">
    <form method="POST" enctype="multipart/form-data">
        <fieldset><legend>Modifier gérant :</legend>
            <?php 
                    $sql = "SELECT * from admins where id= '".$_GET['gerant_id']."'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $gerants= $stmt->fetchAll(PDO::FETCH_BOTH);
                    foreach($gerants as $ger){}
            ?>
        <div class="row">
            <input type="hidden" class="form-control" id="inputGer" name="restau_id" value="<?php echo $ger['id'] ?>">
            <div class="form-group col-md-4">
                <label for="inputNom">Nom</label>
                <input type="text" class="form-control" id="inputNom" name="nom" value="<?php echo $ger['first_name'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrenom">Prénom</label>
                <input type="text" class="form-control" id="inputPrenom" name="prenom" value="<?php echo $ger['last_name'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputUsername">Pseudo</label>
                <input type="text" class="form-control" id="inputUsername" name="username" value="<?php echo $ger['username'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $ger['email'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" name="password" value="<?php echo $ger['password'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputTel">Téléphone</label>
                <input type="text" class="form-control" id="inputTel" name="phone" value="<?php echo $ger['phone'] ?>" minlength="8" maxlength="8">
            </div>
            <div class="form-group col-md-4">
                <label for="inputDate">Date de naissance</label>
                <input type="date" class="form-control" id="inputDate" name="birth_date" value="<?php echo $ger['birth_date'] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputRes">Restaurant</label>
                <select id="inputRes" name="restaurant_id" class="form-control">
                    <option selected disabled>Choisir un restaurant</option>
                    <?php 
                        $requete="select * from restaurant";
                        $stmt = $db->prepare($requete);
                        $stmt->execute();
                        $row=$stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach ($row as $res) {
                    ?>
                    <option <?php if($ger['id_restaurant']==$res['id']){ ?> selected <?php } ?>
                        value="<?php echo $res['id'] ?>"><?php echo $res['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <img src="<?php echo '../gerant/images/admins/'.$ger['image'].' '; ?>" class="form-control form-group" style="width:100%;height:auto;border-radius:10%">
            </div>
            <div class="form-group col-md-4">
                <label for="inputImg">Image</label>
                <input type="file" class="form-control" id="inputImg" name="file">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">
            <a href="gerants.php"><input class="btn btn-info" value="Retour"></a>
        </div>
        </fieldset>
    </form>
    </div>
</div>
<?php include("footer.php");?>
</div>
</div>
<?php include("menu.php");?>
<?php
}
?>