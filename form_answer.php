<?php
//vérification réponse à la question
//récupération question
include("check_answer.php");

$req2 = $bdd->prepare('
    SELECT username, question, answer
    FROM account
    WHERE username = ?');

$req2->execute(array($_GET['username']));

$donnees = $req2->fetch();

?>
<head>
            <meta charset="utf_8" />
<link href="/projet-3/style.css" rel="stylesheet" />
</head>
    <div id="admin_page">
        <div class="titre_admin">
            <h2>Réinitialisation de votre mot de passe</h2><br />
        </div>
         <div class="modif_info">
        <form action="../admin_account/check_answer.php" method="get">
<p>Votre question : "<?php echo  $donnees['question'];?>"</p>           
        <input type="text" name="answer"><br />
        <input type="hidden" name="question2" value="<?php echo $donnees['question'];?>">
        <input type="hidden" name="username" value="<?php echo $donnees['username'];?>">
        <br /><input type="submit" name="send">
    </form>
</div>
</div>
