<?php 
include("connexion/connect.php");
error_reporting(0);
if(!empty($_POST)&&isset($_POST)){
    if(!(empty($_POST['nom']))&&!(empty($_POST['email']))&&!(empty($_POST['telephone']))&&!(empty($_POST['password']))){
        $req="insert into user (username,email,password,phone) values ('$_POST[nom]','$_POST[email]',
        '$_POST[password]','$_POST[telephone]') ";
        $exe=$db->prepare($req);
        $exe->execute();
        $success="Vous avez enregistré avec succès";
    }else{
        $error="veuillez remplir tous les champs possibles";
    }
}
include("header.php");
?>

<link rel="stylesheet" href="login_style/css/style.css">
<div class="section">
	<div class="form-holder m-t-60">
		<img src="login_style/img/logo1.png">
		<form method="post">
            <input type="text" name="nom" placeholder="Votre nom...">
			<input type="text" name="email" placeholder="Votre Email...">
            <input type="text" name="telephone" minlength="8" maxlength="8" placeholder="Votre téléphone...">
			<input type="password" name="password" placeholder="Mot de passe...">
			<button type="submit">Inscrire</button>
            <?php if($success){
			echo '<div class="success">'.$success.'</div>';
			}
			if($error) { 
				echo '<div class="error">'.$error.'</div>';
			}?>
			<p class="go_register">Vous avez un compte ? <a href="login.php">Se connecter</a></p>
		</form>
	</div>
</div>	
<?php include("footer.php"); ?>