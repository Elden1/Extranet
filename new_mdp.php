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
    //recupération compte avec username
    $req = $bdd->prepare('
    SELECT username
    FROM account
    WHERE username = ?');

$req->execute(array($_GET['username']));

$donnees = $req->fetch();
?>
    <form>
        <form action="new_mdp.php" method="get">
        <p>Veuillez inscrire votre nouveau mot de passe.</p>           
        <input type="text" name="password_1">
        <p>Veuillez Confirmez votre mot de passe.</p>   
         <input type="text" name="password_2"> <br />
         <input type="hidden" name="username" value="<?php echo $donnees['username'];?>">
        <input type="submit" name="send"> 
    </form>

<?php

$password_1= (isset($_GET['password_1']) ? $_GET['password_1'] : '');
$password_2= (isset($_GET['password_2']) ? $_GET['password_2'] : '');

if ($password_1 == '' or $password_2 == ''){

                echo "Complete all entries";
            }
            else if ($password_1 != $password_2)
            {
                echo "New Passwords must match";
            }
            else
            {

 $password = $password_1;

        $req2 = $bdd->prepare('
    UPDATE account 
    SET password = :password
    WHERE username = :username');

$req2->execute(array(
    ':password' => password_hash($password, PASSWORD_DEFAULT),
    ':username' => $donnees['username']));
  header("Location: index.php");    
            }
?>