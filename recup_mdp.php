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
?>

<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8" />
	<title>Modification du mot de passe</title>
</head>
<body>
<h2>Réinitialisation de votre mot de passe</h2> <br/>
	
<p>Lors de la création de votre compte personnel, vous avez dû inscrire une question personnelle et sa réponse. Veuillez renseigner votre pseudo pour récupérer ladite question secrète, puis y répondre.</p>
	
	<form>
		<form action="recup_mdp.php" method="post">
		<input type="text" name="username">
		<input type="submit" name="send">
	</form>

</body>
</html>

<?php
// value 
$donnees = (isset($_GET['username']) ? $_GET['username'] : '');

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
	 header('Location: chang_pass.php?username='. $donnees['username']);
  }
 }

?>