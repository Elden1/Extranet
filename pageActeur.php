<?php
include("header.php");
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// récupération de l'acteur
$req = $bdd->prepare('
	SELECT id_acteur, acteur, description, logo 
	FROM acteur 
	WHERE id_acteur = ?');
$req->execute(array($_GET['acteur']));
$donnees = $req->fetch();
?><!DOCTYPE html>

<html>
<head>
		<meta charset="utf_8" />
		<title><?php echo htmlspecialchars($donnees['acteur']); ?></title>
<link href="style.css" rel="stylesheet" /> 
</head>
<body>
<div class="img_page">
<img src="<?php echo $donnees['logo']; ?>" max-width="120" height="100" >
</div>
<br />
<div class="acteur_pg">
	<h2>
		<?php echo htmlspecialchars($donnees['acteur']); ?>
	</h2>
	<p>
		<?php
		echo nl2br(htmlspecialchars($donnees['description']));
		?>
	</p>
	<p><a href =extra_gbaf.php>Retour aux acteurs.</a></p>
</div>

	<div class="titre_comm">
	<h2>Commentaires</h2>
</div>

		<div id="comm">

		<div class="form_comm">
	<form action="form_commentaire.php" method="post">
		<input type="text" name="commentaire"placeholder="Commentaire...">
		<input type="submit" name="publier" value="Publier"></p>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>
	</div>

	<div class="form_vote">
	<form action="form_vote.php" method="post">
		<label>Vote cool    <input type=radio name="vote" id="vote1" value="vote_pos"></label><br />
		<label>Vote pas cool<input type=radio name="vote" id="vote2" value="vote_neg"></label><br />
		<input type="submit" name="voter" value="Publier"></p>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>
<?php

$vote_count = include ("vote_count.php");

echo $vote_count;

?>
</div>
</div>
<?php
// Récup commentaires

$req2 = $bdd->prepare('
	SELECT account.prenom, account.id_user, comment.id_acteur, comment.date_add, comment
	FROM comment 
	INNER JOIN account
	ON comment.id_user = account.id_user 
	WHERE id_acteur = ?
	ORDER BY date_add');

$req2->execute(array($_GET['acteur'],));

while ($donnees2 = $req2->fetch())
{
?>	<div id="comm_color"><div class="afficher_comm">
<div class="info_comm"><p><strong><?php echo htmlspecialchars($donnees2['prenom']); ?>
</strong> le <?php echo htmlspecialchars($donnees2['date_add']); ?></p></div>
<div class="list_comm"><p><?php echo nl2br(htmlspecialchars($donnees2['comment'])); ?></p></div></div></div>
<?php
} // Fin de la boucle des commentaires
$req2->closeCursor();
?>
</body>
</html>