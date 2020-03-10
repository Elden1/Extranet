<?php
include("../extra-config.php");
    //recupération compte avec username
    $req = $bdd->prepare('
    SELECT username
    FROM account
    WHERE username = ?');

$req->execute(array($_GET['username']));

$donnees = $req->fetch();
?>
<head>
<link href="../style.css" rel="stylesheet" /> 
</head>
<body>
 <div id="admin_page"> 
        <div class="titre_admin">
        <h2>Réinitialisation mot de passe.</h2>
        </div>
    <div class="modif_info">
        <form action="new_mdp.php" method="get">      
        <input type="password" name="password_1" placeholder="Nouveau mot de passe"><br /> 
<br />  <input type="password" name="password_2" placeholder="Confirmez votre mot de passe"> <br />
         <br /><input type="hidden" name="username" value="<?php echo $donnees['username'];?>">
        <input type="submit" name="send"> 
    </form>
    <br/>
<?php

$password_1= (isset($_GET['password_1']) ? $_GET['password_1'] : '');
$password_2= (isset($_GET['password_2']) ? $_GET['password_2'] : '');




if ($password_1 == '' or $password_2 == ''){
    echo 'Champs vides';
               
            } else if ($password_1 != $password_2){
                echo 'Les mots de passes doivent être identiques.';
            }
            else if ($password_1 === $password_2)
            {

$password = password_hash($_GET['password_1'], PASSWORD_DEFAULT); 

        $req2 = $bdd->prepare('
    UPDATE account 
    SET password = :password
    WHERE username = :username');

$req2->execute(array(
    ':password' => $password,
    ':username' => $donnees['username']));
  header("Location: ../index.php");    
            }
?>
</div>
</div>