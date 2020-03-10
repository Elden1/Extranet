<?php
include("header.php");
include('extra-config.php');
?>
<!DOCTYPE html>
		<title>Acteurs</title>
 
</head>

<body>
    <div class="gbaf_titles">
    <div class="gbaf_text">
        <h1>Text GBAF et site </h1>

        <h2> Texte acteurs et partenaires </h2>
    </div>
    </div>
 </body>
</html>

<?php
// Connexion à la base de données
include("extra-config.php");

// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id_acteur, acteur, description, logo FROM acteur');

while ($donnees = $req->fetch())
{
?>
<div class="acteur_order">
<div id="act">

    <div class='img_acteur'>
    <img src="<?php echo $donnees['logo']; ?>">
    </div>

    <div class="acteur">

    <div class="acteur_name">
    <h2>
        <?php echo htmlspecialchars($donnees['acteur']); ?>
    </h2>
    </div>
    
    <div class="acteur_des">
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['description']));
    ?>
    <br />
    </div>  
    </div>
    </p>
    
    <div class="acteur_page">
    <em><a href="pageActeur.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite</a></em>
    </div>

</div>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
</body>
<?php
include 'footer.php';
?>