<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression des cookies de connexion automatique
setcookie('username', '');
setcookie('password', '');
header("Location: index.php");
?>

<p>Vous êtes déconnectez</p>