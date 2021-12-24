<?php
include ('db/connexion.php');

//On crée la classe des utilisateurs

class Utilisateurs{
    //Propriété de la base de donnée (attribut private afin de définir la propriété bdd en mode privée)
    private $bdd;

    //La méthode de construction de la base de donnée
    public function __construct(){
       $this->bdd = new BaseDeDonnee(); 
    }

}



?>