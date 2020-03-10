<!DOCTYPE html>

<?php
session_start();
if (isset($_SESSION['id_user'])){
	$req=$bdd->prepare('
    SELECT id_user, username, surname, name, question  
    FROM account 
    WHERE id_user = ?');

$req->execute(array($_SESSION['id_user']));
$donnees = $req->fetch();

?> <p>Pseudo : <?php echo htmlspecialchars($donnees['username']); ?>
<br /> <p>Nom de famille : <?php echo nl2br(htmlspecialchars($donnees['surname'])); ?>
<br /> <p>Prénom : <?php echo nl2br(htmlspecialchars($donnees['name'])); ?>
<br /> <p>Votre question secrète : <?php echo nl2br(htmlspecialchars($donnees['question'])); 

} else {
	echo 'problème bro';
}

?>
