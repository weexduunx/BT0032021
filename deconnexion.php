<?php
// Initialisons la session
session_start();
 
// On désarme  toutes les variables de session
$_SESSION = array();
 
// On Détruit la session.
session_destroy();
 
// On redirige vers la page d'accueil
header("location: index.php");
exit;
?>