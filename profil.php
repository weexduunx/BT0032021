<?php
// Initialize the session
session_start();
 
// Vérifiez si l'utilisateur est connecté, sinon le redirige à la page de connexion
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}

// Vérifier l'existence du paramètre ID avant de traiter plus
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    //On inclut le fichier de connexion
    require_once "connexion.php";
    
    // Préparer une instruction SELECT
    $sql = "SELECT * FROM utilisateurs WHERE id = :id";
    
    if($stmt = $db->prepare($sql)){
        // Lier les variables à l'instruction préparée en tant que paramètres
        $stmt->bindParam(":id", $param_id);
        
        // Définir des paramètres
        $param_id = trim($_GET["id"]);
        
        // Tenter d'exécuter la déclaration préparée
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Extraire la ligne de résultat en tant que tableau associatif.Depuis le résultat
                contient une seule rangée, nous n'avons pas besoin d'utiliser pendant que la boucle */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // récupérez la valeur de champ individuelle
                $nom = $row["nom"];
                $prenom = $row["prenom"];
                $username = $row["username"];
                $email = $row["email"];
                $tel = $row["tel"];
            } else{
                // URL ne contient pas de paramètre d'identification valide.Rediriger la page d'erreur
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oups!Quelque chose s'est mal passé.Veuillez réessayer plus tard.";
        }
    }
     
    // Déclaration de fermeture
    unset($stmt);
    
    // Fermer la connexion
    unset($db);
} else{
    // L'URL ne contient pas de paramètre ID.Rediriger la page d'erreur
    header("location: erreur.php");
    exit();
}

?>
<?php include 'composants/entêteProfil.php'; ?>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
             <div class="col-lg-6  p-0 p-lg-5 pt-lg-3">
                    <div class="form-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3 " aria-current="true">
                            <!-- <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0"> -->
                            <i class="fa fa-user rounded-circle flex-shrink-0 "></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-0"><?php echo $row["prenom"]; ?></h5>
                                    <h5 class="mb-0"><?php echo $row["nom"]; ?></</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                 
                    <div class="form-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <!-- <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0"> -->
                            <i class="fa fa-envelope rounded-circle flex-shrink-0 "></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-0"><?php echo $row["email"]; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="form-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <!-- <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0"> -->
                            <i class="fa fa-phone rounded-circle flex-shrink-0 "></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h5 class="mb-0"><?php echo $row["tel"]; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                     <a href="gestionUtilisateur.php"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Retour</button></a> 
                     <a href="modifMDP.php"><button type="button" class="btn btn-secondary btn-lg px-4 me-md-2 fw-bold"> Modifier le Mot de passe</button></a> 
                    </div>
                </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="img/Account-pana.png" alt="" width="720">
            </div>
        </div>
    </div>

<?php include("composants/pied-de-page.php");