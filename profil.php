<?php
// Initialize the session
session_start();
 
// Vérifiez si l'utilisateur est connecté, sinon le redirige à la page de connexion
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}
<<<<<<< HEAD

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

=======
//On inclut le fichier de connexion
require_once "connexion.php";
//On stocke des informations de SESSION dans les variables pour les recupérer aprés 
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$username = $_SESSION["username"];
$email = $_SESSION["email"];
$tel = $_SESSION["tel"];

// On initialise les nouvelles variables à mettre à jour
$nvnom = $nvprenom = $nvusername = $nvemail = $nvtel = "";
$nvnom_er = $nvprenom_er = $nvusername_er = $nvemail_er = $nvtel_er = "";
$msg = "";
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Valider le nom
        if(empty(trim($_POST["nom"]))){
            $nvnom_er = "Veuillez entrer le nouveau nom.";     
        } else{
            $nvnom = trim($_POST["nom"]);
        }

        //On valide le prenom
        if(empty(trim($_POST["prenom"]))){
            $nvprenom_er = "Veuillez entrer le nouveau prenom.";     
        } else{
            $nvprenom = trim($_POST["prenom"]);
        }

        //On valide le nom d'utilisateur
        if(empty(trim($_POST["username"]))){
            $nvusername_er = "Veuillez entrer le nouveau nom d'utilisateur.";     
        } else{
            $nvusername = trim($_POST["username"]);
        }

        //On valide l'adresse mail
        if(empty(trim($_POST["email"]))){
            $nvemail_er = "Veuillez entrer la nouvelle adresse mail.";     
        } else{
            $nvemail = trim($_POST["email"]);
        }
    
        
    // Vérification des erreurs de saisie avant de mettre à jour la base de données
    if(empty($new_password_err) && empty($confirm_password_err)){
        // On prépare une instruction de mise à jour
        $sql = "UPDATE utilisateurs SET password = :password WHERE username = :username";
        
        if($stmt = $db->prepare($sql)){
            // Lier les variables à l'instruction préparée sous forme de paramètres
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Définir les paramètres
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_username = $_SESSION["username"];
            
            // Tentative d'exécution de la déclaration préparée
            if($stmt->execute()){
                //Mot de passe mis à jour avec succès, on détruit la session et on fait une redirection
                session_destroy();
                echo "Mot de passe modifié";
                header("location: authentification.php");
                exit();
            } else{
                $msg = "Oops! Quelque chose a mal tourné..";
            }

            // Fermeture de la déclaration
            unset($stmt);
        }
    }
    
    // Fermeture de la
    unset($db);

    }
>>>>>>> 864eea85c9d2fab5ad1f84a1cab52a8b07526a0d
?>
<?php include 'composants/entêteProfil.php'; ?>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
             <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                 <h1 class="display-4 fw-bold lh-1">Salut,  
                <?php echo htmlspecialchars($_SESSION["prenom"]); ?> <b><?php  echo htmlspecialchars($_SESSION["nom"]); ?></b>
                 </h1>
                <p class="lead">Bienvenue sur l'application "Utilisateur Under-Construction."</p>
<<<<<<< HEAD
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
=======
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom" class="form-control" id="floatingInput"
                            value="<?php echo $nom; ?>" >
                            <span class="invalid-feedback"><?php echo $nom_err; ?></span>
                            <label for="floatingInput">Nom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="prenom" class="form-control" id="floatingInput"
                            value="<?php echo $prenom; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
                            <label for="floatingInput">Prénom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $username; ?>" id="floatingInput">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            <label for="floatingInput">Nom d'utilisateur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                            id="floatingInput" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="tel" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>"
                            id="floatingInput" value="<?php echo $tel; ?>">
                            <span class="invalid-feedback"><?php echo $tel_err; ?></span>
                            <label for="floatingInput">N° Téléphone</label>
                        </div>
                       
                        <hr class="my-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                         <a href=""><button type="submit" class="btn btn-success btn-lg px-4 me-md-2 fw-bold">Mettre à jour</button></a>
                         <a href="modifMDP.php"><button type="button" class="btn btn-outline-secondary btn-lg px-4">Modifier le mot de passe</button></a>
                        </div>
                    </form>
>>>>>>> 864eea85c9d2fab5ad1f84a1cab52a8b07526a0d
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="img/Account-pana.png" alt="" width="720">
            </div>
        </div>
    </div>

<?php include("composants/pied-de-page.php");