<?php
include("header.php");
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf_8" />
		<title>Acteurs</title>
<link href="style.css" rel="stylesheet" /> 
</head>

<body>
        <h1>Text GBAF et site </h1>

        <h2> Texte acteurs et partenaires </h2>

 </body>
</html>

<?php
// Connexion à la base de données
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id_acteur, acteur, description FROM acteur');

while ($donnees = $req->fetch())
{
?>
<div class="acteur">
    <h3>
        <?php echo htmlspecialchars($donnees['acteur']); ?>
    </h3>
    
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['description']));
    ?>
    <br />

    <em><a href="pageActeur.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite</a></em>
    </p>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
</body>
</html>