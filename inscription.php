<?php 
  // On inclut le fichier de la connexion bdd
require_once "connexion.php";
 
//On doit définir les variables et les initialiser avec des valeurs vides
$nom = $prenom = $email = $tel = $username = $password = $confirm_password = $roleid ="";
$nom_err = $prenom_err = $email_err = $tel_err =$username_err = $password_err = $confirm_password_err = $roleid_er = "";
$msg ="";
 
// Traitement des données du formulaire lors de la soumission du formulaire
if($_SERVER["REQUEST_METHOD"] == "POST"){
   // On valide le nom
    if(empty(trim($_POST["nom"]))){
        $nom_err = "Svp!!! veuillez entrer un nom.";     
    } else{
        $nom = trim($_POST["nom"]);
    }
     // On valide le prenom
    if(empty(trim($_POST["prenom"]))){
        $prenom_err = "Svp!!! veuillez entrer un prénom.";     
    } else{
        $prenom = trim($_POST["prenom"]);
    }
    // On valide le nom d'utilisateur
    if(empty(trim($_POST["username"]))){
        $username_err = "Svp!!! veuillez entrer un nom d'utilisateur.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // On prépare une requête sql avec l'instruction SELECT
        $sql = "SELECT id FROM utilisateurs WHERE username = :username";
        if($req = $db->prepare($sql)){
				// On fait la liaison des variables à l'instruction préparée en tant que paramétres
            $req->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // On paramétre le nom d'utilisateur
            $param_username = trim($_POST["username"]);
            
            // On Tente d'exécuter la déclaration préparée
            if($req->execute()){
                if($req->rowCount() == 1){
                    $username_err = "Ce nom d'utilisateur est déjà pris.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            // on ferme la déclaration préparée
            unset($req);
        }
    }

     // On valide l'adresse mail
    if(empty(trim($_POST["email"]))){
        $email_err = "S'il vous plaît entrer un email.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
  
    // On valide le mot de passe
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer un mot de passe.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Le mot de passe doit avoir au moins 6 caractères.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // On valide la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les mots de Passe ne correspondent pas";
        }
    }

     // On valide le numéro de téléphone
     $input_tel = trim($_POST["tel"]);
    if(empty($input_tel)){
        $tel_err = "Svp! saisissez un numéro de téléphone.";     
    }
    elseif (filter_var($input_tel,FILTER_VALIDATE_INT) == false) {
        $tel_err = "Entrez uniquement des caractères numériques pour le champ Numéro de Téléphone !";
    }  else{
        $tel = $input_tel;
    }


    if(empty(trim($_POST["roleid"]))){
        $roleid_er = "";
    }else {
        $roleid = trim($_POST["roleid"]);
    }
    
    
    // On vérifie les erreurs d'entrée avant d'insérer dans la base de données
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($tel_err)){
        
        // On Prépare une déclaration d'insertion avec l'instruction INSERT
        $sql = "INSERT INTO utilisateurs (nom,prenom,username,email, password,tel, roleid)
         VALUES (:nom, :prenom, :username, :email, :password,:tel, :roleid)";
         
        if($req = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $req->bindParam(":nom", $param_nom, PDO::PARAM_STR);
            $req->bindParam(":prenom", $param_prenom, PDO::PARAM_STR);
            $req->bindParam(":username", $param_username, PDO::PARAM_STR);
            $req->bindParam(":email", $param_email, PDO::PARAM_STR);
            $req->bindParam(":password", $param_password, PDO::PARAM_STR);
            $req->bindParam(":tel", $param_tel,PDO::PARAM_INT);
            $req->bindParam(":roleid", $param_role,PDO::PARAM_STR);
            
            
            // On configure les paramétres
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_username = $username;
            $param_email = $email;
            $param_tel = $tel;
            $param_role = $roleid;
            // Ce paramétre crée l'encodage du mot de passe avec la fonction prédéfinie password_hash
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            // On Tente d'exécuter la déclaration préparée
            if($req->execute()){
                // On peut faire une redirection par ici vers la page de connexion
                // Comme on peut aussi faire une alerte 
                header( "refresh:2; url=authentification.php" );
                $msg = '<div class=" alert alert-success alert-dismissible mt-3" id="flash-msg"><strong>Wooow Succés !!</strong> Inscription réussie 
                <i class="fa fa-check" aria-hidden="true"></i> <a href="authentification.php">Connectez par ici</a></div>';

            } else{
                echo "Oups! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            // On ferme la déclaration en le désarmant avec unset
            unset($req);
        }
    }
    
    // On ferme la connexion en le désarmant avec unset
    unset($db);
}
?>
<?php include('composants/en-tête.php'); ?>

<div class="container-fluid col-xxl-8 px-4 py-5">
    <div class="row justify-content-center">
         <div class="col-md-12 col-lg-10">
            <?php echo $msg ?>
            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url(img/Signup.png);"></div>
                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Inscription</h3>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                            </p>
                        </div>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom" class="form-control" id="floatingInput" >
                            <span class="invalid-feedback"><?php echo $nom_err; ?></span>
                            <label for="floatingInput">Nom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="prenom" class="form-control" id="floatingInput">
                            <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
                            <label for="floatingInput">Prénom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            id="floatingInput">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            <label for="floatingInput">Nom d'utilisateur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                            id="floatingInput" >
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="tel" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>"
                            id="floatingInput" pattern="[0-9]{9}"  maxlength="14" >
                            <span class="invalid-feedback"><?php echo $tel_err; ?></span>
                            <label for="floatingInput">N° Téléphone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" 
                            id="floatingPassword">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <label for="floatingPassword">Mot de passe</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                             id="floatingInput">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <label for="floatingInput">Confirmez le Mot de Passe</label>
                        </div>
                        <div class="form-floating">
                            <input type="hidden" name="roleid" value="3" class="form-control">
                        </div>
                        <button class="w-100 btn btn-lg btn-success" name="inscrire"  type="submit">S'inscrire</button>
                        <hr class="my-4">
                    </form>
                    <p class="text-center">Si vous avez déjà un compte clicquez sur <a data-toggle="tab" href="authentification.php">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('composants/pied-de-page.php'); ?>
