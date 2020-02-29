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

    if (isset($donnees['id_acteur'])) {
    	$req3 = $bdd->prepare('
    SELECT vote_pos
    FROM vote 
    WHERE id_acteur = ?
    AND vote_pos = 1');
$req3->execute(array($donnees['id_acteur']));

         $req4 = $bdd->prepare('
    SELECT vote_neg 
    FROM vote 
    WHERE id_acteur = ?
    AND vote_pos = -1');

$req3->execute(array($donnees['id_acteur']));
$req4->execute(array($donnees['id_acteur']));

$result1 = $req3->rowCount();
$result2 = $req4->rowCount();

$vote = $result1 - $result2;
return $vote;
    }
?>