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

if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    
        if(!(empty($username))&&!(empty($email))){
                $req = "UPDATE admin set  username='$username',email='$email' where id='".$_SESSION['admin_id']."'";
                $res= $db->prepare($req);
                $res->execute();
                echo'<script>alert("Votre profil a été modifié avec succées");
                window.location.assign("profile.php");</script>';
            }else{
            echo'<script>alert("Veuillez remplir tous les champs possibles);
                window.location.assign("profile.php");</script>';
            }

}
}
?>