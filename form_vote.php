<?php 
session_start();
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$id_user = (isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '');
$id_acteur = (isset($_POST['id_acteur']) ? $_POST['id_acteur'] : '');
$vote = $_POST['vote'];
$votePos = (isset($_POST['votePos']) ? $_POST['votePos'] : '1');
$voteNeg = (isset($_POST['voteNeg']) ? $_POST['voteNeg'] : '-1');


//vérification doubl vote
if(isset($_POST['vote'] )) {
        $req = $bdd->prepare('
        SELECT id_acteur
        FROM vote
        WHERE id_acteur = :id_acteur');

$req->execute(array(
    ':id_acteur' => $_POST['id_acteur']));

$Exist = $req->rowcount();
if ($Exist == 1) {
 header("Location: pageActeur.php?acteur=$id_acteur/");    
    echo 'Déjà voté !';

//ajout vote
} else if ($vote == "votePos") {
	$req = $bdd->prepare('
    INSERT INTO vote(id_user, id_acteur, date_add, votePos )
    VALUES(:id_user, :id_acteur, NOW(), :votePos)');

    $req->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur, 
	':votePos' => $votePos));

header("Location: pageActeur.php?acteur=$id_acteur/");

} else if ($vote == "voteNeg") {
	$req = $bdd->prepare('
    INSERT INTO vote(id_user, id_acteur, date_add, voteNeg )
    VALUES(:id_user, :id_acteur, NOW(), :voteNeg)');

    $req->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur, 
	':voteNeg' => $voteNeg));

header("Location: pageActeur.php?acteur=$id_acteur/");

 }
} 
?>