<?php
    //on définit les variables de connexion
    $localhost = 'localhost';
    $base = 'bootcamprojet';
    $utilisateur = 'root';
    $motdepasse = '';

    //On essaye d'établir  la connexion
    try {
        $db = new PDO("mysql:host=$localhost;dbname=$base",$utilisateur,$motdepasse);

        // définit le mode d'erreur PDO sur exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET CHARACTER SET utf8");
        
    }
    //On capte l'erreur et on l'affiche 
    catch(PDOException $e){
        die ("<div class='alert alert-danger' role='alert'>"."Erreur de connection à la base de donnée... ". $e->getMessage()."</div>");
    }
?>