<?php
include("connexion/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
    header('location:login.php');
}
else
{
include("header.php");

if(isset($_POST['update_password'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    $requete="select * from user where id='".$_SESSION['user_id']."'";
    $stmt = $db->prepare($requete);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_BOTH);

        if( $user['password']==$old_password){
            if($new_password==$confirm_new_password ){
                $req = "UPDATE user set password='$confirm_new_password'where id='".$_SESSION['user_id']."'";
                $res= $db->prepare($req);
                $res->execute();
                echo'<script>alert("Votre mot de passe a été modifié avec succées");
                window.location.assign("profile.php");</script>';
            }else{
                echo'<script>alert("Les nouveaux mots de passes ne sont pas identiques");
                window.location.assign("profile.php");</script>';
            }
        }else{
            echo'<script>alert("Ancien mot de psse est incorrect");
            window.location.assign("profile.php");</script>';
        }
}
}
?>