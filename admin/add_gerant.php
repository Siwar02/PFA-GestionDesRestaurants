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

if(isset($_POST['ajouter'])){
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
            $req = "INSERT INTO admins
            (first_name,last_name,username,email,password,phone,birth_date,image,id_restaurant) 
            VALUES ('$nom','$prenom','$username','$email','$password','$phone','$birth_date','$fimg','$restaurant_id')";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            $success="un gérant a été ajouté avec succées";
        }else{
            $error_img="Type d'image non valide (seulement jpg ou png)";
        }
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
    <form method="post" enctype="multipart/form-data">
        <fieldset><legend>Ajouter nouveau gérant :</legend>
            
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputNom">Nom</label>
                <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom de gérant ...">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrenom">Prénom</label>
                <input type="text" class="form-control" id="inputPrenom" name="prenom" placeholder="Prénom de gérant ...">
            </div>
            <div class="form-group col-md-4">
                <label for="inputUsername">Pseudo</label>
                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Pseudo de gérant ...">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email de gérant ...">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">Mot de passe</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Mot de passe de gérant ...">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputTel">Téléphone</label>
                <input type="text" class="form-control" id="inputTel" name="phone" placeholder="Téléphone de gérant ..." minlength="8" maxlength="8">
            </div>
            <div class="form-group col-md-4">
                <label for="inputDate">Date de naissance</label>
                <input type="date" class="form-control" id="inputDate" name="birth_date" placeholder="Date de naissance du gérant ...">
            </div>
            <div class="form-group col-md-4">
                <label for="inputImg">Image</label>
                <input type="file" class="form-control" id="inputImg" name="file">
            </div>
        </div>
        <div class="row">
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
                    <option value="<?php echo $res['id'] ?>"><?php echo $res['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Ajouter" name="ajouter">
            <input type="reset" class="btn btn-danger" value="Vider">
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