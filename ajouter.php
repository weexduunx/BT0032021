<?php
session_start();
 
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}
require_once "connexion.php";
 
$nom = $prenom = $email = $tel = $username = $role = "";
$nom_er = $prenom_er = $email_er = $username_er = $tel_er = $role_er = "";
$msg = "";
$password = $confirm_password = "";
$password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $nom_er = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_er = "Svp! saisissez votre nom.";
    } else{
        $nom = $input_name;
    }
    
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_er = "Svp! saisissez votre prenom.";     
    } else{
        $prenom = $input_prenom;
    }

    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_er = "Svp! saisissez votre nom d'utilisateur.";     
    } else{
        $username = $input_username;
    }
    
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_er = "Svp! saisissez votre adresse email.";     
    }  else{
        $email = $input_email;
    }
    $input_tel = trim($_POST["tel"]);
    if(empty($input_tel)){
        $tel_er = "Svp! saisissez un numéro de téléphone.";     
    }  else{
        $tel = $input_tel;
    }

    $input_role = trim($_POST["roleid"]);
    if(empty($input_role)){
        $role_er = "Svp! saisissez un numéro de téléphone.";     
    }  else{
        $role = $input_role;
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
    
    
    if(empty($nom_er) && empty($prenom_er) && empty($email_er) && empty($username_er) && empty($password_err) && empty($confirm_password_err) && empty($tel_er)){

        $sql = "INSERT INTO utilisateurs (nom, prenom, username, email,password, tel, roleid) 
        VALUES (:nom, :prenom, :username, :email, :password, :tel, :roleid)";
 
        if($stmt = $db->prepare($sql)){
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":prenom", $param_prenom);
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":password", $param_password);
            $stmt->bindParam(":tel", $param_tel);
            $stmt->bindParam(":roleid", $param_role);
            
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_tel = $tel;
            $param_role = $role;
            
            if($stmt->execute()){
                header("location: gestionUtilisateur.php");
                exit();
            } else{
                echo "Oops! Quelque chose va mal !";
            }
        }
         
        unset($stmt);
    }
    
    unset($db);
}
?>
 <?php include 'composants/entêteProfil.php'; ?>
 <div class="container-fluid col-xxl-8 px-4 py-5">
    <div class="row justify-content-center">
         <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url(img/Account-2.png);"></div>
                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h2 class="mb-4">Ajouter un utilisateur</h2>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                                <a href="gestionUtilisateur.php" class="btn btn-secondary ml-2 d-flex align-items-center justify-content-center">Retour</a>
                            </p>
                        </div>
                    </div>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom" class="form-control <?php echo (!empty($nom_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $nom_er;?></span>
                            <label for="floatingInput">Nom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="prenom" class="form-control <?php echo (!empty($prenom_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $prenom; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_er;?></span>
                            <label for="floatingInput">Prenom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="username" class="form-control <?php echo (!empty($username_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_er;?></span>
                            <label for="floatingInput">Nom d'utilisateur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_er;?></span>
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="tel" class="form-control <?php echo (!empty($tel_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $tel; ?>">
                            <span class="invalid-feedback"><?php echo $tel_er;?></span>
                            <label for="floatingInput">N° Téléphone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $password; ?>" id="floatingPassword">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            <input type="hidden" name="roleid" value="3" class="form-control">
                            <label for="floatingPassword">Mot de passe</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $confirm_password; ?>" id="floatingInput">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <label for="floatingInput">Confirmez le Mot de Passe</label>
                        </div>
                        <input type="submit" class="btn btn-success" value="Ajouter">
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>      
            
<?php include("composants/pied-de-page.php");
