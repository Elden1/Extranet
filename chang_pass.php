<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
//vérification réponse à la question
//récupération question

$req = $bdd->prepare('
	SELECT username, question, reponse
	FROM account
	WHERE username = ?');

$req->execute(array($_GET['username']));

$donnees = $req->fetch();

?>
<head>
            <meta charset="utf_8" />
<link href="style.css" rel="stylesheet" />
</head>
    <div id="page_connexion">
        <div class="titre_connexion">
            <h2>Réinitialisation de votre mot de passe</h2><br />
        </div>
         <div class="modif_info">
		<form action="chang_pass.php" method="get">
<p>"<?php echo  $donnees['question'];?>"</p>			
		<input type="text" name="reponse"><br />
		<input type="hidden" name="question" value="<?php echo $donnees['username'];?>">
		<br /><input type="submit" name="send">
	</form>
</div>
</div>
<?php


//vérification réponse à la question
$_GET['question'] = (isset($_GET['question']) ? $_GET['question'] : '');
$_GET['reponse'] = (isset($_GET['reponse']) ? $_GET['reponse'] : '');

if(isset($_GET['reponse'])) {
        $req2 = $bdd->prepare('
        SELECT username, reponse, question
        FROM account
        WHERE question = :question
        AND reponse = :reponse');

$req2->execute(array(
     ':reponse' => $_GET['reponse'],
	':question' => $_GET['question']));

$result = $req->fetch();
$Exist = $req->rowcount();

if ($Exist == 1){
	header('Location: new_mdp.php?username='. $donnees['username']);
  
 }      
}
?>