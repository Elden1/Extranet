<?php 
session_start();
include_once '../extra-config.php';


$id_user = (isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '');
$id_acteur = (isset($_POST['id_acteur']) ? $_POST['id_acteur'] : '');
$vote = (isset($_POST['vote']));
$upvote = (isset($_POST['upvote']) ? $_POST['upvote'] : '1');
$downvote = (isset($_POST['downvote']) ? $_POST['downvote'] : '-1');


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

$Exist = $req->fetch();
        if ($Exist == TRUE){
        $connexion = "Déjà voté !"; 
        header("Location: ../pageActeur.php?acteur=$id_acteur&error2=$connexion");
//ajout vote
}       else if (($_POST['vote'] == 'upvote')) {

$req = $bdd->prepare('
        INSERT INTO vote(id_user, id_acteur, date_add, upvote )
        VALUES(:id_user, :id_acteur, NOW(), :upvote)');

    $req->execute(array(
        ':id_user' => $_SESSION['id_user'],
        ':id_acteur' => $_POST['id_acteur'], 
        ':upvote' => $upvote));

header("Location: ../pageActeur.php?acteur=$id_acteur/");

} else if (($_POST['vote'] == 'downvote')) {

    $req = $bdd->prepare('
    INSERT INTO vote(id_user, id_acteur, date_add, downvote )
    VALUES(:id_user, :id_acteur, NOW(), :downvote)');

    $req->execute(array(
        ':id_user' => $_SESSION['id_user'],
        ':id_acteur' => $_POST['id_acteur'], 
        ':downvote' => $downvote));

header("Location: ../pageActeur.php?acteur=$id_acteur/");

 }
} 
?>