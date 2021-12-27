<?php
include ('db/connexion.php');

//On crée la classe des utilisateurs
class Utilisateurs{
    
    //La méthode de formatage de la Date
    public function dateFormat($date){
    //date_default_timezone_set ('Africa / Dakar'); 
        $strtime = strtotime($date);
        return date('Y-m-d H:i:s', $strtime);
    }

    // La méthode pour effectuer une vérification si une adresse email existe ou pas
    public function VerifEmail($email){
        $sql = "SELECT email FROM utilisateurs WHERE email = :email";
        $declaration = $this->bdd->pdo->prepare($sql);
        $declaration->bindValue(':email', $email);
        $declaration->execute();
        if ($declaration->rowCount()> 0){
            return true;
        }else{
            return false;
        }

    }

}



?>