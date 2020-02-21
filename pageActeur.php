<?php
include("header.php");
?><!DOCTYPE html>

<html>
<head>

		<meta charset="utf_8" />
		<title>Page acteur</title>
<link href="style.css" rel="stylesheet" /> 
</head>
<body>

<h1>Acteur avec commentaires </h1>
<p><a href =extra_gbaf.php>Retour aux acteurs.</a></p>
<br />

<?php
// connexion
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
	SELECT id_acteur, acteur, description 
	FROM acteur 
	WHERE id_acteur = ?');
$req->execute(array($_GET['acteur']));
$donnees = $req->fetch();
?>

<div class="acteur">
	<h3>
		<?php echo htmlspecialchars($donnees['acteur']); ?>
	</h3>
	<p>
		<?php
		echo nl2br(htmlspecialchars($donnees['description']));
		?>
	</p>
</div>
<?php
$req->closeCursor();
?>

	<h2>Commentaires</h2>
	<form action="form_vote.php" method="post">
		<label>Vote cool    <input type=radio name="vote" id="vote1" value="votePos"></label><br />
		<label>Vote pas cool<input type=radio name="vote" id="vote2" value="voteNeg"></label><br />
		<input type="submit" name="voter" value="Publier"></p>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>

	<form action="form_commentaire.php" method="post">
		<input type="text" name="commentaire">
		<input type="submit" name="publier" value="Publier"></p>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>
<?php
$req->closeCursor();
// Récup commentaires
$req = $bdd->prepare('
	SELECT account.prenom, account.id_user, comment.id_acteur, comment.date_add, comment
	FROM comment 
	INNER JOIN account
	ON comment.id_user = account.id_user 
	WHERE id_acteur = ?
	ORDER BY date_add
	');

$req->execute(array(
	$_GET['acteur'],
	));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['prenom']); ?></strong> le <?php echo $donnees['date_add']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['comment'])); ?></p>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>
</body>
</html>