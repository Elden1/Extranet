<?php
include("../extra-config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link href="/projet-3/style.css" rel="stylesheet" /> 
	<title>Modification du mot de passe</title>
</head>
<body>
        <div id="admin_page"> 
    <div class="titre_admin">
        <h2>Réinitialisation de votre mot de passe</h2>
    </div>
    <div class="modif_info">
<p>Lors de la création de votre compte personnel, vous avez dû inscrire une question personnelle et sa réponse. Veuillez renseigner votre pseudo pour récupérer ladite question secrète, puis y répondre.</p> <br/>
		<form action="/projet-3/admin_account/check_user.php" method="get">
		<input type="text" name="username"><br/>
		<br/><input type="submit" name="send"><br/>
	</form>
	<br/>


<?php

//vérification username
if(isset($_GET['username'])) {
        $req = $bdd->prepare('
        SELECT username
        FROM account
        WHERE username = :username');

$req->execute(array(
    ':username' => $_GET['username']));

$donnees = $req->fetch();
$Exist = $req->rowcount();

if ($Exist == 1){
	 header('Location: /projet-3/admin_account/form_answer.php?username='. $donnees['username']);
  } else {
    echo 'Pseudo inconnu';
  }
 }

?>

        </div>
     </div>
</body>
</html>