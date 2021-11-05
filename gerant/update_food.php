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

if(isset($_POST['modifier'])){
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $price = $_POST['prix'];
    $restaurant_id=$_POST['restau_id'];
    $cat=$_POST['category'];
    $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.',$fname);
        $extension = strtolower(end($extension));  
        $fimg = uniqid().'.'.$extension;
        $store = "images/food_added/".basename($fimg);
    if(!(empty($nom))&&!(empty($cat))&&!(empty($description))&&!(empty($price))&&!(empty($restaurant_id))&&($extension!='')){
        if( ($extension=='jpg')||($extension=='png')||($extension=='gif') ){
            $req = "UPDATE foods set name='$nom', description='$description', price='$price', image='$fimg', 
            categorie_id='$cat',restaurant_id='$restaurant_id' where id='$_GET[food_id]' ";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            $success="votre plat a été modifié avec succées";
        }else{
            $error_img="Type d'image non valide (seulement jpg ,png ou gif)";
        }
    }else if (!(empty($nom))&&!(empty($cat))&&!(empty($description))&&!(empty($price))&&!(empty($restaurant_id))){
            $requete = "UPDATE foods set name='$nom', description='$description', price='$price', 
            categorie_id='$cat',restaurant_id='$restaurant_id' where id='$_GET[food_id]' ";
            $resultat= $db->prepare($requete);
            $resultat->execute();
            $success="votre plat a été modifié avec succées";
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
        <fieldset><legend>Modifier votre plat :</legend>
            <?php 
                    $sql = "SELECT foods.*,category.name as nom from foods join category on foods.categorie_id=category.id where foods.id= '".$_GET['food_id']."'";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $Restau= $stmt->fetchAll(PDO::FETCH_BOTH);
                    foreach($Restau as $rest){}
            ?>
        <div class="row">
        <div class="form-group col-md-12">
                <input type="hidden" class="form-control" id="inputRes" name="restau_id" value="<?php echo $rest['restaurant_id'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputNom">Nom</label>
                <input type="text" class="form-control" id="inputNom" name="nom" value="<?php echo $rest['name'] ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputCat">Catégorie</label>
                <select id="inputCat" name="category" class="form-control">
                    <option selected disabled><?php echo $rest['nom'] ?></option>
                    <?php 
                        $requete="select * from category";
                        $stmt = $db->prepare($requete);
                        $stmt->execute();
                        $row=$stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach ($row as $cat) {
                    ?>
                    <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputDescription">Description</label>
            <input type="text" class="form-control" id="inputDescription" name="description" value="<?php echo $rest['description'] ?>">
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <img src="<?php echo 'images/food_added/'.$rest['image'].' '; ?>" class="form-control form-group" style="width:100%;height:auto;border-radius:10%">
            </div>
            <div class="form-group col-md-6">
                <label for="inputImg">Image</label>
                <input type="file" class="form-control" id="inputImg" name="file">
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrix">Prix</label>
                <input type="text" class="form-control" id="inputPrix" name="prix" value="<?php echo $rest['price'] ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Modifier" name="modifier">
            <a href="foods.php"><input class="btn btn-info" value="Retour"></a>
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