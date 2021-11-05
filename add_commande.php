<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

if(isset($_POST['commander'])){
	$req = "INSERT INTO commande (id_user,id_food,price,quantity,prix_total,reponse,archive) 
        	VALUES ('".$_SESSION['user_id']."','".$_POST['food_id']."','".$_POST['price_unit']."','".$_POST['qty']."',
            '".$_POST['price_total']."','0','0')";
    $res= $db->prepare($req);
    $res->execute();
	echo'<script>alert("Votre commande a été bien envoyée");
    window.location.assign("cart_commande.php");</script>';
}
?>