<?php
include("../extra-config.php");
session_start();
	if (!empty($_SESSION['id_user'])){
	
	$req=$bdd->prepare('
    SELECT id_user, username, surname, name 
    FROM account 
    WHERE id_user = :id_user');

$req->execute(array(
	':id_user' => $_SESSION['id_user']));
$donnees = $req->fetch();

//values 
$username = (isset($_POST['username']) ?$_POST['username'] : '');
$surname = (isset($_POST['surname']) ?$_POST['surname'] : '');
$name = (isset($_POST['name']) ?$_POST['name'] : '');
$id = $donnees['id_user'];

//vérification
if (!empty($_POST['username']) && !empty($_POST['surname']) && !empty($_POST['name'])) {

        $req2 = $bdd->prepare('
    UPDATE account 
    SET username = :username, surname = :surname, name = :name 
    WHERE id_user = :id_user');

$req2->execute(array(
    ':username' => $username,
    ':surname' => $surname,
	':name' => $name,
	':id_user'=> $id));

header("Location: ../admin_page.php");} else {
	echo 'informations manquantes'; 
 }
}
?>