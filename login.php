<?php
error_reporting(0);
session_start();
include("connexion/connect.php");
$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($_POST) && isset($_POST))
{
	$requete="select * from user where username='$username' && password = '$password'";
	$stmt = $db->prepare($requete);
	$stmt->execute();
	$rows=$stmt->fetchAll(PDO::FETCH_BOTH);
	foreach ($rows as $row){}
	if($stmt->rowCount()==1){
		$_SESSION['user_id']=$row['id'];
		$success = "User connecté avec succées ! ";
		header("refresh:2;url=index.php");
	}else if ($stmt->rowCount()<1){
		$requete1="select * from admins where username='$username' && password = '$password'";
		$stmt1 = $db->prepare($requete1);
		$stmt1->execute();
		$r=$stmt1->fetchAll(PDO::FETCH_BOTH);
		foreach ($r as $ro){}
			if($stmt1->rowCount()==1){
				$_SESSION['gerant_id']=$ro['id'];
				$success = "Gérant connecté avec succées ! ";
				header("refresh:2;url=gerant/index.php");
			}else{
				$error = "Invalide username ou mot de passe";
			}
	}
}
include("header.php");
?>
	<link rel="stylesheet" href="login_style/css/style.css">
	<div class="section">
	<div class="form-holder">
		<img src="login_style/img/logo1.png">
		<form method="POST">
			<input type="text"  name="username" placeholder="Votre Email...">
			<input type="password" name="password" placeholder="Mot de passe...">
			<button type="submit">Se connecter</button>

			<?php if($success){
			echo '<div class="success">'.$success.'</div>';
			}
			if($error) { 
				echo '<div class="error">'.$error.'</div>';
			}?>

			<p class="go_register">Vous n'avez pas de compte ? <a href="register.php">S’inscrire</a></p>
		</form>
	</div>
</div>
		<?php include("footer.php"); ?>