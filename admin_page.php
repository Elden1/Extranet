<!DOCTYPE html>
<html>
<head>
	<title>Page d'administration</title>
<?php
include ("header_admin.php");
?>
</head>
<body>
<br /> 
Vos informations :<br /> 
<?php include("info_account.php");?> <br />

<p>Modification des informations de base (laissez les champs vide si vous ne souhaitez pas le modifiers) :</p>

	<form action="change_info.php" method="post">
		<label>Pseudo <input type="text" name="username"></label><br />
		<label>Nom    <input type="text" name="nom"></label><br />
		<label>Prénom <input type="text" name="prenom"></label><br />
		<input type="submit" name="send" value="Modifier"></p>
	</form>

<p>si vous souhaitez remplacez votre question et votre réponse secrète, veuilliez insérer votre mot de passe :</p>

	<form action="prep_change_ques&rep.php" method="post">
		<label>Mot de passe <input type="password" name="password"></label><br />
		<input type="submit" name="send" value="Valider"></p>
	</form>

<p>Si vous souhaitez changez votre mot de passe, veuillez répondre à votre question secrète :</p>

<?php if(isset($_SESSION['id_user'])) {    
	$req = $bdd->prepare('
    SELECT id_user, question, reponse, username
    FROM account
    WHERE id_user = :id_user');

$req->execute(array(
    ':id_user' => $_SESSION['id_user']));
$donnees = $req->fetch();

echo $donnees['question'];?>
	<form action="admin_page.php" method="post">
		<label>Réponse :<input type="text" name="reponse"></label><br />
		<input type="submit" name="send" value="Modifier"></p>
	</form>

<?php

if (isset($_POST['reponse'])) {
if ($_POST['reponse'] == $donnees['reponse']) {
  header('Location: new_mdp.php?username='.$donnees['username']);   
 } else {
  }
 }
}
?>

</body>
</html>