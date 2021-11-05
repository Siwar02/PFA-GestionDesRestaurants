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

if(isset($_POST['save'])){
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birth_date = $_POST['birth_date'];
    $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.',$fname);
        $extension = strtolower(end($extension));  
        $fimg = uniqid().'.'.$extension;
        $store = "images/profile/".basename($fimg);
    if($extension!=''){
        if( ($extension=='jpg')||($extension=='png')||($extension=='gif') ){
            $req = "UPDATE user set first_name='$firstname',last_name='$lastname',username='$username',email='$email',phone='$phone',birth_date='$birth_date',
             image='$fimg' where id='".$_SESSION['user_id']."'";
            $res= $db->prepare($req);
            $res->execute();
            move_uploaded_file($temp, $store);
            echo'<script>alert("Votre profil a été modifié avec succées");
            window.location.assign("profile.php");</script>';
        }else{
            echo'<script>alert("Type de votre image non validé (seulement jpg ,png ou gif)");
            window.location.assign("profile.php");</script>';
        }
    }else if (!(empty($username))&&!(empty($email))&&!(empty($phone))&&!(empty($birth_date))){
            $requete = "UPDATE user set first_name='$firstname',last_name='$lastname', username='$username', email='$email', phone='$phone',
            birth_date='$birth_date' where id='".$_SESSION['user_id']."'";
            $resultat= $db->prepare($requete);
            $resultat->execute();
            echo'<script>alert("Votre profil a été modifié avec succées");
            window.location.assign("profile.php");</script>';
    }else{
        echo'<script>alert("Veuillez remplir tous les champs possibles);
            window.location.assign("profile.php");</script>';
    }
}
}
?>