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

if(isset($_POST['update_restau_info'])){
    $name_restau = $_POST['name_restau'];
    $region = $_POST['region'];
    $localisation = $_POST['localisation'];
    $description = $_POST['description'];
    $id_restau_info = $_POST['id_restau_info'];
    
            $req = "UPDATE restaurant set name='$name_restau', description='$description',localisation='$localisation',address_id='$region' where id='$id_restau_info'";
            $res= $db->prepare($req);
            $res->execute();
            echo'<script>alert("Votre restaurant a été modifié avec succées");
            window.location.assign("profile.php");</script>';

}
}
?>