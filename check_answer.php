<?php
include("../extra-config.php");
    
//vérification réponse à la question
$_GET['question2'] = (isset($_GET['question2']) ? $_GET['question2'] : '');
$_GET['answer'] = (isset($_GET['answer']) ? $_GET['answer'] : '');

if(isset($_GET['answer'])) {
        $req3 = $bdd->prepare('
        SELECT username, answer, question
        FROM account
        WHERE question = :question2
        AND answer = :answer');

$req3->execute(array(
     ':answer' => $_GET['answer'],
   ':question2' => $_GET['question2']));

$result = $req3->fetch();
$Exist = $req3->rowcount();

if ($Exist == 1){
	header('Location: ../admin_account/new_mdp.php?username='. $result['username']);
  
 }      
}
?>