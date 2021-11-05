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
    $req = "DELETE from admins where id='$_GET[id_gerant]' ";
        $res= $db->prepare($req);
        $res->execute();
        header('location:gerants.php');
}
?>