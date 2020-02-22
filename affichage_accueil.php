<?php 
if (isset($_SESSION['id_user']) AND isset($_SESSION['username']))
{
    echo 'Bonjour ' . $_SESSION['username'];
}
?>
<html>
<head>
		<meta charset="utf_8" />
		<title>Accueil</title>
<link href="style.css" rel="stylesheet" /> 

</head>

<body>

<h2>Connexion à l'espace membre :</h2><br />
					<form action="index.php" method="post">
<p>Pseudo : 		<input type="text" name="username" ></p><br />
<p>Mot de passe :   <input type="password" name="password" ></p><br />
<input type="submit" name="connexion" value="Connexion">
</form>

<a href="inscription.php"><p>Vous inscrire</p></a> <br />
<a href="recup_mdp.php"><p>Mot de passe oublier ?</p></a><br/>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>