<!DOCTYPE html>
<?php
include ("header_admin.php");
?>
	<title>Paramètres du compte</title>
</head>
<body>
<br />


	<div id="admin_page"> 

		<div class="titre_admin">
			<h2> Paramètres du compte </h2>
		</div>

		<div class="info_admin">
			<p>Vos informations :</p><br /> 

			<?php include("admin_account/info_account.php");?> <br />
			
		</div>

	<div class="modif_info">
	<p>Si vous souhaitez modifier vos informations :</p>
		<form action="admin_account/change_info.php" method="post">
				<input type="text" name="username" placeholder="Pseudo" required><br />
		<br />  <input type="text" name="surname" placeholder="Nom" required><br />
		<br />  <input type="text" name="name" placeholder="Prénom" required><br />
		<br />  <input type="submit" name="send" value="Modifier" required></p>
		</form>
	</div>

	<div class="modif_info">
	<p>Si vous souhaitez remplacez votre question et votre réponse secrète, veuilliez insérer votre mot de passe :</p>
		<form action="admin_account/new_pw.php" method="post">
		  	<input type="password" name="password" placeholder="Mot de passe" required><br />
		  	<?php 
if (isset($_GET['error'])){
echo $_GET['error'];
}
?>
		<br /><input type="submit" name="send" value="Valider" ></p>
		</form>
	</div>

	<div class="modif_info">
	<p>Si vous souhaitez changez votre mot de passe, veuillez répondre à votre question secrète :</p>

<?php if(isset($_SESSION['id_user'])) {    
		$req = $bdd->prepare('
    SELECT id_user, question, answer, username
    FROM account
    WHERE id_user = :id_user');

		$req->execute(array(
    ':id_user' => $_SESSION['id_user']));
$donnees = $req->fetch();
?>
		<form action="../admin_account/check_answer.php" method="get">
			<p>Votre question : "<?php echo  $donnees['question'];?>"</p>			
		<input type="text" name="answer" required><br />
		<input type="hidden" name="question2" value="<?php echo $donnees['question'];}?>">
		<br /><input type="submit" name="send">
		</form>
	</div>
</div>
</body>
<?php
include 'footer.php';
?>