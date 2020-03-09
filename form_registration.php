<?php
// Connexion serveur
include_once '../extra-config.php';
//valeurs
 $surname =  (isset($_POST['surname']) ? $_POST['surname'] : '');
    $name = (isset($_POST['name']) ? $_POST['name'] : '');
$username = (isset($_POST['username']) ? $_POST['username'] : '');
$password = (isset($_POST['password']) ? $_POST['password'] : '');
$question = (isset($_POST['question']) ? $_POST['question'] : '');
  $answer = (isset($_POST['answer']) ? $_POST['answer'] : '');

//Vérification
if(isset($_POST['password'])){
//hachage
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

//Insertion
$req = $bdd->prepare('
    INSERT INTO account(surname, name, username, password, question, answer) 
    VALUES(:surname, :name, :username, :password, :question, :answer)');

$req2 = $bdd->prepare('
        SELECT username
        FROM account
        WHERE username = :username');

//vérification de la complétion du forme



$req2->execute(array(':username' => $_POST['username']));

$verf = $req2->fetch();

if ($verf['username'] === $_POST['username']){

  $connexion = "Pseudonyme déjà pris."; 
     header('Location: ../registration.php?error='. $connexion);
    }
  

//execution

else {

$req->execute(array(
    ':surname' => $surname,
    ':name' => $name,
    ':username' => $username,
  ':password' => $password,
  ':question' => $question,
  ':answer' => $answer));
  
     header("Location: ../index.php");

  }
}
?>

