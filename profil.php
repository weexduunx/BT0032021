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
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Déclaration de fermeture
    unset($stmt);
    
    // Fermer la connexion
    unset($db);
} else{
    // L'URL ne contient pas de paramètre ID.Rediriger la page d'erreur
    header("location: error.php");
    exit();
}

?>
<?php include 'composants/entêteProfil.php'; ?>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
             <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                 <h1 class="display-4 fw-bold lh-1">Salut,  
                <?php echo htmlspecialchars($_SESSION["prenom"]); ?> <b><?php  echo htmlspecialchars($_SESSION["nom"]); ?></b>
                 </h1>
                <p class="lead">Bienvenue sur l'application "Utilisateur Under-Construction."</p>
                <div class="form-group">
                        <label>Nom</label>
                        <p><b><?php echo $row["nom"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Prenom</label>
                        <p><b><?php echo $row["prenom"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Nom Utilisateur</label>
                        <p><b><?php echo $row["username"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tel</label>
                        <p><b><?php echo $row["tel"]; ?></b></p>
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