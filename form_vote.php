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
$vote_pos = (isset($_POST['vote_pos']) ? $_POST['vote_pos'] : '1');
$vote_neg = (isset($_POST['vote_neg']) ? $_POST['vote_neg'] : '-1');


//vérification doubl vote
if(isset($_POST['vote'])) {
        $req = $bdd->prepare('
        SELECT id_acteur, id_user
        FROM vote
        WHERE id_acteur = :id_acteur 
        AND id_user = :id_user');

$req->execute(array(
    ':id_acteur' => $_POST['id_acteur'],
    ':id_user' => $_SESSION['id_user']));

$Exist = $req->rowcount();
if ($Exist == 1){
 header("Location: pageActeur.php?acteur=$id_acteur/");
//ajout vote
} else if ($vote == "vote_pos") {
	$req = $bdd->prepare('
    INSERT INTO vote(id_user, id_acteur, date_add, vote_pos )
    VALUES(:id_user, :id_acteur, NOW(), :vote_pos)');

    $req->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur, 
	':vote_pos' => $vote_pos));

header("Location: pageActeur.php?acteur=$id_acteur/");

} else if ($vote == "vote_neg") {
	$req = $bdd->prepare('
    INSERT INTO vote(id_user, id_acteur, date_add, vote_neg )
    VALUES(:id_user, :id_acteur, NOW(), :vote_neg)');

    $req->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur, 
	':vote_neg' => $vote_neg));

header("Location: pageActeur.php?acteur=$id_acteur/");

 }
} 
?>