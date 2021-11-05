<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

if(isset($_POST['reserver'])){
	if(!(empty($_POST['name']))&&!(empty($_POST['phone']))){
	$req = "INSERT INTO reservation (id_user,name,id_restaurant,phone,nb_places,date,time,reponse,archive) 
        VALUES ('".$_SESSION['user_id']."','".$_POST['name']."','".$_POST['id_restaurant']."','".$_POST['phone']."',
        '".$_POST['number_places']."','".$_POST['date']."','".$_POST['time']."','0','0')";
    $res= $db->prepare($req);
    $res->execute();
	echo'<script>alert("Votre réservation a été bien envoyée");
    window.location.assign("index.php");</script>';
	}
	else{
	echo'<script>alert("Veuillez remplir tous les champs possibles");
    window.location.assign("reservation.php?id='.$_POST['id_restaurant'].'");</script>';
	}
}
?>