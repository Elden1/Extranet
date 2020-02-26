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

    if (isset($_GET['id_acteur'])) {
    	$req3 = $bdd->prepare('
    SELECT id_user, id_acteur, vote_pos, vote_neg 
    FROM vote 
    WHERE id_acteur = ?');

$req3->execute(array($_GET['id_acteur']));

$result = $req3->rowCount();
$vote = $result['vote_pos'] + $result['vote_neg'];
echo $vote;
echo $result['vote_pos'];
echo $result['vote_neg'];
    }
?>