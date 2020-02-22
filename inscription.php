<?php

require('affichage_inscription.php');

// Connexion serveur
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

     $nom =  (isset($_POST['nom']) ? $_POST['nom'] : '');
  $prenom = (isset($_POST['prenom']) ? $_POST['prenom'] : '');
$username = (isset($_POST['username']) ? $_POST['username'] :'' );
$password = (isset($_POST['password']) ? $_POST['password'] : '');
$question = (isset($_POST['question']) ? $_POST['question'] : '');
 $reponse = (isset($_POST['reponse']) ? $_POST['reponse'] : '');

//Vérification

//hachage
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

//Insertion
$req = $bdd->prepare('
    INSERT INTO account(nom, prenom, username, password, question, reponse) 
    VALUES(:nom, :prenom, :username, :password, :question, :reponse)');

//vérification de la complétion du forme

if    
	       (empty($_POST['nom'] == TRUE) 
	  or empty($_POST['prenom'] == TRUE) 
	or empty($_POST['username'] == TRUE) 
	or empty($_POST['password'] == TRUE) 
	or empty($_POST['question'] == TRUE) 
	 or empty($_POST['reponse'] == TRUE)) {

    echo 'Veuillez saisir les informations requises.';

    } 

//execution

else {

$req->execute(array(
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':username' => $username,
	':password' => $password,
	':question' => $question,
	':reponse' => $reponse));
	
    echo 'Vos identifiants ont bien étaient enregistrés.';

    }

?>
