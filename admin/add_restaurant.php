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
    $description = $_POST['description'];
    $localisation = $_POST['localisation'];
    $address_id = $_POST['region'];
    $cost=$_POST['cost'];
    $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.',$fname);
        $extension = strtolower(end($extension));  
        $fimg = uniqid().'.'.$extension;
        $store = "../gerant/images/restaurants/".basename($fimg);

    if(!(empty($nom))&&!(empty($description))&&!(empty($localisation))&&!(empty($address_id))&&!(empty($cost))&&($extension!='')){
        if( ($extension=='jpg')||($extension=='png')){
            $req = "INSERT INTO restaurant (name, description, localisation, address_id ,cost, image) 
                    VALUES ('$nom','$description','$localisation','$address_id','$cost','$fimg')";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            $success="un restaurant a été ajouté avec succées";
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
        <fieldset><legend>Ajouter nouveau restaurant :</legend>
            
        <div class="row">
            <div class="form-group col-md-6">
                <label for="inputNom">Nom</label>
                <input type="text" class="form-control" id="inputNom" name="nom" placeholder="Nom de restaurant ...">
            </div>
            <div class="form-group col-md-6">
                <label for="inputImg">Image</label>
                <input type="file" class="form-control" id="inputImg" name="file">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDescription">Description</label>
            <input type="text" class="form-control" id="inputDescription" name="description" placeholder="Description...">
        </div>
        
        <div class="row">
            <div class="form-group col-md-4">
                <label for="inputReg">Région</label>
                <select id="inputReg" name="region" class="form-control">
                    <option selected disabled>Choisir une région</option>
                    <?php 
                        $requete="select * from address";
                        $stmt = $db->prepare($requete);
                        $stmt->execute();
                        $row=$stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach ($row as $reg) {
                    ?>
                    <option value="<?php echo $reg['id'] ?>"><?php echo $reg['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputAdr">Adresse</label>
                <input type="text" class="form-control" id="inputAdr" name="localisation" placeholder="Adresse...">
            </div>
            <div class="form-group col-md-4">
                <label for="inputCost">Coùt publicitaire</label>
                <input type="text" class="form-control" id="inputCost" name="cost" placeholder="Coùt publicitaire...">
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