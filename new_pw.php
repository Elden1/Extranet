<?php
include("../extra-config.php");
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
?>
<html>

    <title>Changement question et réponse.</title>
    <link href="/projet-3/style.css" rel="stylesheet" /> 
</head>
<body>
    <div id="admin_page"> 
        <div class="titre_admin">
        <h2>Nouvelle question et réponse.</h2>
    </div>
    <div class="modif_info">
    <form action="new_pw.php" method="post">
       <input type="text" name="question"placeholder="Nouvelle question"></label><br />
      <br /> <input type="text" name="answer"placeholder="Nouvelle réponse"></label><br />
    <input type="submit" name="send" value="Modifier"></p>
    </form>
</div>
</div>
</body>
</html>
<?php
    //recupération compte avec username
    $req2 = $bdd->prepare('
    SELECT id_user
    FROM account
    WHERE id_user = :id_user');

$req2->execute(array(
    ':id_user' => $_SESSION['id_user']));

$donnees = $req2->fetch();

if (isset($_POST['question']) && isset($_POST['answer'])){

        $req3 = $bdd->prepare('
    UPDATE account 
    SET question = :question, answer = :answer
    WHERE id_user = :id_user');

$req3->execute(array(
    ':question' => $_POST['question'],
    ':answer' => $_POST['answer'],
    ':id_user' => $donnees['id_user']));
    header("Location: admin_page.php");
} } else {

     $connexion1 = "Mauvais mot de passe."; 
     header('Location: ../admin_page.php?error='. $connexion1);
  }
 }
}
?>