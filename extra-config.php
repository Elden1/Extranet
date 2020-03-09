<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=u754539175_extranet", 'u754539175_admin', 'Totobas499');
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>