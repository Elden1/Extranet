<!DOCTYPE html>
<html>
<head>

		<meta charset="utf_8" />
		<title>Commentaires ?</title>
<link href="style.css" rel="stylesheet" /> 
</head>
<body>

<h1>Acteur avec commentaires </h1>
<p><a href =post.php>Retour aux acteurs.</a></p>
<br />

<?php

// connexion
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// récupération de l'acteur
$req = $bdd->prepare('SELECT id_acteur, acteur, description FROM acteur WHERE id_acteur = ?');
$req->execute(array($_GET['post']));
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

	<h2>Commentaires</h2>

	<?php
$req->closeCursor();

// Récup commentaires
$req = $bdd->prepare('SELECT username, post, DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_add FROM post WHERE id_acteur = ?');
$req->execute(array($_GET['post']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['username']); ?></strong> le <?php echo $donnees['date_add']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['post'])); ?></p>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>
</body>
</html>