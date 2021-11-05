<?php
error_reporting(0);
session_start();
include("connexion/connect.php");
$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($_POST) && isset($_POST))
{
	$requete="select * from admin where username='$username' && password = '$password'";
	$stmt = $db->prepare($requete);
	$stmt->execute();
	$rows=$stmt->fetchAll(PDO::FETCH_BOTH);
	foreach ($rows as $row){}
	if($stmt->rowCount()==1){
		$_SESSION['admin_id']=$row['id'];
		$success = "Admin connecté avec succées ! ";
		header("refresh:2;url=index.php");
	}else{
		$error = "Invalide username ou mot de passe";
	}
}

?>
<html>
	<head>
	<link rel="stylesheet" href="login_style/css/style.css">
	</head>
<body>
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
</body>
</html>