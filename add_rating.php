<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

if(isset($_POST['evaluer'])){
	$req = "INSERT INTO rating (id_user,id_restaurant,rating) 
        	VALUES ('".$_SESSION['user_id']."','".$_POST['id_restaurant']."','".$_POST['rating_percent']."')";
    $res= $db->prepare($req);
    $res->execute();
	echo'<script>alert("Votre évaluation a été prise en considération");
    window.location.assign("restaurant.php?id='.$_POST['id_restaurant'].'");</script>';
}
?>