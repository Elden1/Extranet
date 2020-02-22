<?php
require('affichage_accueil.php');
//connexion database  
try {
    $bdd = new PDO("mysql:host=localhost;dbname=extranet;port=3308", 'root', '');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


//vérification valeurs vide


//valeurs défault
$user = (!isset($_POST['username']) || empty($_POST['username']));
$pass = (!isset($_POST['password']) || empty($_POST['password']));

//vérification si des informations ont étaient rentrés
$req = $bdd->prepare('
    SELECT id_user, nom, prenom, password, nom 
    FROM account 
    WHERE username = :username');

$req->execute(array(
    'username' => $_POST['username']));

$result = $req->fetch();


if (isset($_POST['username'])) {

if (password_verify ($_POST['password'], $result['password'])) {
     session_start();
        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['nom'] = $result['nom'];
        $_SESSION['prenom'] = $result['prenom'];
     header("Location: extra_gbaf.php");
} else {
        echo 'Mauvais identifiant ou mot de passe !<br />';
    }
} else {
die ('Champs vide.');
}
?>