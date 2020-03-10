<?php 
include('extra-config.php');
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf_8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="style.css" rel="stylesheet" />
	<title>Accueil</title> 
</head>

<body>
	<div id="page_connexion">
		<div class="titre_connexion">
			<h2>Connexion à l'espace membre </h2><br />
		</div>		

		<div class="connexion_form">
		    <h3>
					<form action="functions/form_accueil.php" method="post">
    	<p>Pseudo<br /><input type="text" name="username" required></p><br />
  <p>Mot de passe<br /><input type="password" name="password" required> </p><br />
					   <input type="submit" name="connexion" value="Connexion">
					</form>
			</h3>
<?php
if (isset($_GET['error'])){
echo $_GET['error'];
}
?>			
		</div>

		<div class="connexion_links">
<a href="registration.php"><p>Pas encore inscrit ?</p></a> 
<a href="admin_account/check_user.php"><p>Mot de passe oublier ?</p></a>
			</div>
	</div>
</body>
</html>