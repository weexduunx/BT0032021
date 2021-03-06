<?php

// Inclure le fichier de connexion
require_once "connexion.php";
 
// Définir les variables et initialiser avec des valeurs vides
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$msg = "";
 
//  traitement de données de la formulaire lorsque la formulaire est soumise
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Valider le nouveau mot de passe
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Veuillez entrer le nouveau mot de passe.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Le mot de passe doit avoir au moins 6 caractères.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Valider la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "S'il vous plaît confirmer le mot de passe.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Le mot de passe ne correspond pas.";
        }
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
?>
<?php include 'composants/en-tête.php'; ?>
<div class="container-fluid col-xxl-8 px-4 py-5">
    <div class="row justify-content-center">
         <div class="col-md-12 col-lg-10">
            <?php echo $msg ?>
            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url(img/modifMDP.png);"></div>
                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Réinitialiser le Mot de passe</h3>
                        </div>
                       
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="" method="POST">
                        <div class="form-floating mb-3">
                            <input id="floatingInput" type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                            <label for="floatingInput">New Password</label>
                        </div>
            
                        <div class="form-floating mb-3">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $confirm_password; ?>" id="floatingInput">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <label for="floatingInput">Confirmez le Mot de Passe</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Réinitialiser">
                         <a class="btn btn-link ml-2" href="authentification.php">Retour</a>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'composants/pied-de-page.php';?>
