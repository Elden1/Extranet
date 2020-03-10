<?php
include_once '../extra-config.php';
//valeurs défault
$user = (!isset($_POST['username']) || empty($_POST['username']));
$pass = (!isset($_POST['password']) || empty($_POST['password']));

//vérification si des informations ont étaient rentrés
$req = $bdd->prepare('
    SELECT id_user, surname, name, password
    FROM account 
    WHERE username = :username');
if (isset($_POST['username'])){
$req->execute(array(
    ':username' => $_POST['username']));

$result = $req->fetch();

// début session et passage sur l'extranet

if (password_verify ($_POST['password'], $result['password'])) {
     session_start();
        $_SESSION['id_user'] = $result['id_user'];
        $_SESSION['surname'] = $result['surname'];
        $_SESSION['name'] = $result['name'];
     header("Location: ../extra_gbaf.php");
  } else {
        $connexion = "Identifiant ou mot de passe incorrect"; 
        header('Location: ../index.php?error='. $connexion);
 }
}
?>