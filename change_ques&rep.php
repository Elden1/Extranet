<!DOCTYPE html>
<html>
<head>
    <title>Changement question et réponse.</title>
</head>
<body>
    <form action="change_ques&rep.php" method="post">
        <label>Nouvelle question <input type="text" name="question"></label><br />
        <label>Nouvelle réponse    <input type="text" name="reponse"></label><br />
        <input type="submit" name="send" value="Modifier"></p>
    </form>
</body>
</html>

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

    //recupération compte avec username
    $req = $bdd->prepare('
    SELECT id_user
    FROM account
    WHERE id_user = :id_user');

$req->execute(array(
    ':id_user' => $_SESSION['id_user']));

$donnees = $req->fetch();

if (isset($_POST['question']) && isset($_POST['reponse'])){

        $req2 = $bdd->prepare('
    UPDATE account 
    SET question = :question, reponse = :reponse
    WHERE id_user = :id_user');

$req2->execute(array(
    ':question' => $_POST['question'],
    ':reponse' => $_POST['reponse'],
    ':id_user' => $donnees['id_user']));
    header("Location: admin_page.php");
} else {
    echo 'Veuillez remplir les champs';
}
?>