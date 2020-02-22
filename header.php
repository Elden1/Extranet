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
    
if(isset($_SESSION['id_user'])) {
echo $_SESSION['nom'] ;
?> <br/> <?php
echo $_SESSION['prenom'];
} else {
	 header("Location: index.php");
} 
 ?>
<!DOCTYPE html>
<html>
<head>       
 <meta charset="utf-8" />
</head> 
<body>
	<form>
<a href="deconnexion.php">Vous déconnecter</a><br/>
	</form>
</body>
</html>