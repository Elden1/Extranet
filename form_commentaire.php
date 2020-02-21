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

//valeurs
$id_user = (isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '');
$id_acteur = (isset($_POST['id_acteur']) ? $_POST['id_acteur'] : '');
$_POST['comment'] = (isset($_POST['comment']) ? $_POST['comment'] : '');


//vérifications

if(isset($_POST['comment'] )) {
        $req = $bdd->prepare('
        SELECT id_acteur
        FROM comment
        WHERE id_acteur = :id_acteur');

$req->execute(array(
    ':id_acteur' => $_POST['id_acteur']));

$Exist = $req->rowcount();
if ($Exist == 1) {
 header("Location: pageActeur.php?acteur=$id_acteur/");    
    echo 'Déjà commenté !';
 } else {
//préparation commentaire
        $req = $bdd->prepare('
    INSERT INTO comment(id_user, id_acteur, date_add, comment) 
    VALUES(:id_user, :id_acteur, NOW(), :comment)');

//insertion dans base de donnée
$req->execute(array(
    ':id_user' => $id_user,
    ':id_acteur' => $id_acteur,
    ':comment' =>$_POST['commentaire']));

 header("Location: pageActeur.php?acteur=$id_acteur/");
 }
}
?>