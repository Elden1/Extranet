<html>
<head>
		<meta charset="utf_8" />
		<title>Inscription</title>
<link href="style.css" rel="stylesheet" /> 

</head>

<body>
	<br />
		<div id="insc">
			<div class="titre_insc">
				<h2>Inscription à l'espace membre :</h2><br />
			</div>

			<div class="form_insc">
		<form action="functions/form_registration.php" method="post">
		<br /><label>Nom </label><br /><input type="text" name="surname" required><br />
	<br /><label>Prénom </label><input type="text" name="name" required><br />
	<br /><label>Pseudonyme </label><input type="text" name="username" required><br />
			<h3>
	<?php
if (isset($_GET['error'])){
echo $_GET['error'];
}
?>
		</h3>
	<br /><label>Mot de passe  </label><input type="password" name="password" required><br />
	<br /><label>Votre question secrète </label><input type="text" name="question" required><br />
	<br /><label>Réponse </label><input type="text" name="answer"><br />
	
			<div class="insc_button">
		<br /><input type="submit" name="inscription"  value="Inscription">
			</div>
		</form>
			</div>
		</div>
</body>
</html>