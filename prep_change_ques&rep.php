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
session_start();
//récupération id user 
	if (isset($_SESSION['id_user'])) {
	$req = $bdd->prepare('
    SELECT id_user, password
    FROM account 
    WHERE id_user = :id_user');

$req->execute(array(
	':id_user' => $_SESSION['id_user']));

$donnees = $req->fetch();

//vérification si des informations ont étaient rentrés
if (!empty($_POST['password']));{

if (password_verify ($_POST['password'], $donnees['password'])) {

header("Location: change_ques&rep.php");} else {

header("Location: admin_page.php");
  }
 }
}
?>