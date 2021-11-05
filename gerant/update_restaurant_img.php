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

if(isset($_POST['update_restau_img'])){

    $id_restau_img = $_POST['id_restau_img'];
    $fname = $_FILES['file_restau']['name'];
        $temp = $_FILES['file_restau']['tmp_name'];
        $fsize = $_FILES['file_restau']['size'];
        $extension = explode('.',$fname);
        $extension = strtolower(end($extension));  
        $fimg = uniqid().'.'.$extension;
        $store = "images/restaurants/".basename($fimg);
        if( ($extension=='jpg')||($extension=='png')||($extension=='gif') ){
            $req = "UPDATE restaurant set image='$fimg' where id='$id_restau_img'";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            echo'<script>alert("L\'image de restaurant a été mise a jour");
            window.location.assign("profile.php");</script>';
        }else{
            echo'<script>alert("Type de votre image non validé (seulement jpg ,png ou gif)");
            window.location.assign("profile.php");</script>';
        }
}
}
?>