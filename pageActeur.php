<?php
include("header.php");
include("extra-config.php");

$req = $bdd->prepare('
	SELECT id_acteur, acteur, description, logo 
	FROM acteur 
	WHERE id_acteur = ?');
$req->execute(array($_GET['acteur']));
$donnees = $req->fetch();
?><!DOCTYPE html>

		<title><?php echo htmlspecialchars($donnees['acteur']); ?></title>

<link href="style.css" rel="stylesheet" /> 
</head>
<body>
<div class="img_page">
<img src="<?php echo $donnees['logo']; ?>" >
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
</div>

<div id="comment_section">
	<div class="titre_comm">
	<h2>Commentaires</h2>
	</div>

 <div id="comm">

		<div class="form_comm">
	<form action="functions/form_commentaire.php" method="post">
		<input type="text" name="comment"placeholder="Commentaire...">
		<input type="submit"  name="publier" value="Publier"></p>
			<?php if (isset($_GET['error'])){echo $_GET['error'];}?>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>
	
	     </div>

	     <div class="form_vote">
	     	<div class="nb_vote">
<?php
include ("functions/vote_count.php");
?>
			</div>
	<form action="functions/form_vote.php" method="post">
		<label>Vote Positif<input type=radio name="vote" id="vote1" value="upvote"></label><br />
		<label>Vote Négatif<input type=radio name="vote" id="vote2" value="downvote"></label><br />
		<input type="submit" name="voter" value="Publier"></p>
					<?php if (isset($_GET['error2'])){echo $_GET['error2'];}?>
		<input type="hidden" name="id_acteur" value="<?php echo $donnees['id_acteur'];?>">
	</form>

		</div>
	</div>
</div>


<?php
// Récup commentaires

$req2 = $bdd->prepare('
	SELECT account.name, account.id_user, comment.id_acteur, comment.date_add, comment
	FROM comment 
	INNER JOIN account
	ON comment.id_user = account.id_user 
	WHERE id_acteur = ?
	ORDER BY date_add');

$req2->execute(array($_GET['acteur'],));

while ($donnees2 = $req2->fetch())
{
?>	<div id="comm_color">

	<div class="afficher_comm">
 
		 <div class="info_comm">
	<p><strong><?php echo htmlspecialchars($donnees2['name']); ?>
</strong> le <?php echo htmlspecialchars($donnees2['date_add']); ?></p>
		 </div>

	<div class="list_comm">
	<p><?php echo nl2br(htmlspecialchars($donnees2['comment'])); ?></p>
   </div>

  </div>
 </div>

<?php
} // Fin de la boucle des commentaires
$req2->closeCursor();
?>

</body>
<?php
include 'footer.php';
?>
