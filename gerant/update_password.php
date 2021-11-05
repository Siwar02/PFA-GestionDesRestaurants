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

if(isset($_POST['update_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    $requete="select * from admins where id='".$_SESSION['gerant_id']."'";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $admin=$stmt->fetch(PDO::FETCH_BOTH);

        if( $new_password==$confirm_new_password ){
            if($admin['password']==$old_password){
                $req = "UPDATE admins set password='$confirm_new_password'where id='".$_SESSION['gerant_id']."'";
                $res= $db->prepare($req);
                $res->execute();
                echo'<script>alert("Votre mot de passe a été modifié avec succées");
                window.location.assign("profile.php");</script>';
            }else{
                echo'<script>alert("Ancien mot de psse est incorrect");
                window.location.assign("profile.php");</script>';
            }
        }else{
            echo'<script>alert("Les nouveaux mots de passes ne sont pas identiques");
            window.location.assign("profile.php");</script>';
        }
}
}
?>