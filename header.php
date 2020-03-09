<?php
include("extra-config.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>       
 <meta charset="utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="style.css" rel="stylesheet" /> 
 
<div id="head_info">
    <div class="img_header">
     <img src='logo\logoGbaf.png' width="90" alt='??'>
    </div>
     <div id="text_head">
    <div class="head_session"><p>
<?php
    if(isset($_SESSION['id_user'])) {
echo $_SESSION['surname'] ;
?> <br/> <?php
echo $_SESSION['name'];
} else {
     header("Location: ../accueil.php");
} ?></div>
 <div class="head_link">
	<p><form>
<a href="admin_page.php">Paramètres du compte</a> <br/>  
<a href="deconnexion.php"> Vous déconnecter</a><br/>
    </form></p>
</div>
</div>
</div>