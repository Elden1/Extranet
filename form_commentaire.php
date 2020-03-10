<?php
session_start();
include_once '../extra-config.php';


//valeurs
$id_user = (isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '');
$id_acteur = (isset($_POST['id_acteur']) ? $_POST['id_acteur'] : '');
$_POST['comment'] = (isset($_POST['comment']) ? $_POST['comment'] : '');

//vérifications

if(isset($_POST['comment'] )) {
        $req = $bdd->prepare('
        SELECT id_acteur, id_user
        FROM comment
        WHERE id_acteur = :id_acteur 
        AND id_user = :id_user');

$req->execute(array(
    ':id_acteur' => $_POST['id_acteur'],
    ':id_user' => $_SESSION['id_user']));

$Exist = $req->fetch();
if ($Exist == TRUE) {
        $connexion = "Commentaire déjà posté !"; 
        header("Location: /projet-3/pageActeur.php?acteur=$id_acteur&error=$connexion");
 } else {
//préparation commentaire
        $req2 = $bdd->prepare('
    INSERT INTO comment(id_user, id_acteur, date_add, comment) 
    VALUES(:id_user, :id_acteur, NOW(), :comment)');

//insertion dans base de donnée
$req2->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur,
    ':comment' => $_POST['comment']));

 header("Location: ../pageActeur.php?acteur=$id_acteur/");
 }
}
?>