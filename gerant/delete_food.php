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
    $req = "DELETE from foods where id='$_GET[id_food]' ";
        $res= $db->prepare($req);
        $res->execute();
        header('location:foods.php');
}
?>