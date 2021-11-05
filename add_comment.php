<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

if(isset($_POST['commenter'])){
	$req = "INSERT INTO comment (id_user,id_restaurant,comment) 
        	VALUES ('".$_SESSION['user_id']."','".$_POST['restaurant_id']."','".$_POST['comment']."')";
    $res= $db->prepare($req);
    $res->execute();
	echo'<script>alert("Votre commentaire a été bien publié");
    window.location.assign("restaurant.php?id='.$_POST['restaurant_id'].'");</script>';
}
?>