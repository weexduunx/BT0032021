<?php

include ('connexion.php');

//On établit la connexion
try{
    $conn = $db;

    // définit le mode d'erreur PDO sur exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //on ajoute les données

    if(isset($_POST['inscrire'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $roleid = $_POST['roleid'];
        $password = $_POST['password'];

            $sql = "INSERT INTO utilisateurs (nom,prenom,username, email, password, tel, roleid) 
                    VALUES($nom, $prenom, $username, $email, $password, $tel, $roleid)";


           $result = $conn->exec($sql);
        if ($result) {
        $msg = '<strong>Succés !</strong> Wow, Vous vous êtes bien inscrit!';
        
        }
        else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Erreur !</strong> Quelque chose a mal tourné !</div>';
          return $msg;
        }

  }
//     if (isset($_POST['ajout'])) {
//         $matricule = $_POST['matricule'];
//         $nom = $_POST['nom'];
//         $prenom = $_POST['prenom'];
//         $datenaiss = $_POST['datenaiss'];
//         $niveau = $_POST['niveau'];
        
//         $sql = "INSERT INTO `etudiant`(`Matricule`, `Nom`, `Prenom`, `DateNaissance`, `Niveau`) 
//         VALUES ('$matricule', '$nom', '$prenom', '$datenaiss', '$niveau');";

//         // utilise exec() car aucun résultat n'est renvoyé
//         $conn->exec($sql);
//         echo "<div class='alert alert-success' role='alert'>" . "Etudiant(e) ajouté(e) avec succés" . "</div>";
//     }
// }
catch(PDOException $e){
    echo "<div class='alert alert-danger' role='alert'>"."Erreur est: ". $e->getMessage()."</div>";
}
$conn = null;



?>