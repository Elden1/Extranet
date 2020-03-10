<?php

    if (isset($donnees['id_acteur'])) {
    	$req3 = $bdd->prepare('
    SELECT upvote
    FROM vote 
    WHERE id_acteur = ?
    AND upvote = 1');
$req3->execute(array($donnees['id_acteur']));

         $req4 = $bdd->prepare('
    SELECT downvote 
    FROM vote 
    WHERE id_acteur = ?
    AND downvote = -1');

$req4->execute(array($donnees['id_acteur']));

$result1 = $req3->rowCount();
$result2 = $req4->rowCount();

$result_vote=$result1-$result2; 

echo $result_vote;
}
?>