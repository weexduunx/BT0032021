<?php
session_start();
 
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}
require_once "connexion.php";
 
$nom = $prenom = $email = $tel = $username = "";
$nom_er = $prenom_er = $email_er = $username_er = $tel_er = "";
$msg = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    
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
    
    if(empty($nom_er) && empty($prenom_er) && empty($email_er) && empty($username_er) && empty($tel_er)){
        $sql = "UPDATE utilisateurs SET 
        nom=:nom, 
        prenom=:prenom,
        username=:username, 
        email=:email, 
        tel=:tel 
        WHERE id=:id";
 
        if($stmt = $db->prepare($sql)){
            $stmt->bindParam(":nom", $param_nom);
            $stmt->bindParam(":prenom", $param_prenom);
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":email", $param_email);
            $stmt->bindParam(":tel", $param_tel);
            $stmt->bindParam(":id", $param_id);
            
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_username = $username;
            $param_email = $email;
            $param_tel = $tel;
            $param_id = $id;
            
            if($stmt->execute()){
                
                $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Succés !</strong> Wow, Vos informations ont été mises à jour avec succés!<a href="gestionUtilisateur.php">Retour</a></div>';
                        
              } else{
                $msg = 'Oops! Une erreur a été survenue durant le processus.';
            }
        }
         
        unset($stmt);
    }
    
    unset($db);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM utilisateurs WHERE id = :id";
        if($stmt = $db->prepare($sql)){
            $stmt->bindParam(":id", $param_id);
            
            $param_id = $id;
            
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    $noms = $row["nom"];
                    $prenoms = $row["prenom"];
                    $usernames = $row["username"];
                    $emails = $row["email"];
                    $tels = $row["tel"];
                } else{
                    $msg = 'Oops! Une erreur a été survenue durant le processus.';
                }
                
            } else{
                $msg = 'Oops! Quelque chose ne fonctionne pas.';  
            }
        }
        
        unset($stmt);
        
        unset($db);
    }  else{
        $msg = 'Oops! Une erreur a été survenue durant le processus.';
    }
}
?>
 
 <?php include 'composants/entêteProfil.php'; ?>

 <div class="container-fluid col-xxl-8 px-4 py-5">
    <div class="row justify-content-center">
        
         <div class="col-md-12 col-lg-10">
         <?php echo $msg; ?>
            <div class="wrap d-md-flex">
                <div class="img" style="background-image: url(img/update.png);"></div>
                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h2 class="mb-4">Mettre à jour les infos</h2>
                        </div>
                        <div class="w-100">
                            <p class="social-media d-flex justify-content-end">
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
                                <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
                                <a href="gestionUtilisateur.php" class="btn btn-secondary ml-2 d-flex align-items-center justify-content-center"><span class="fa fa-back">Retour</span></a>
                            </p>
                        </div>
                    </div>
                   
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name="nom" class="form-control <?php echo (!empty($nom_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $noms; ?>">
                            <span class="invalid-feedback"><?php echo $nom_er;?></span>
                            <label class="floatingInput">Nom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="prenom" class="form-control <?php echo (!empty($prenom_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $prenoms; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_er;?></span>
                            <label class="floatingInput">Prenom</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="username" class="form-control <?php echo (!empty($username_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $usernames; ?>">
                            <span class="invalid-feedback"><?php echo $username_er;?></span>
                            <label class="floatingInput">Nom d'utilisateur</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $emails; ?>">
                            <span class="invalid-feedback"><?php echo $email_er;?></span>
                            <label class="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="tel" class="form-control <?php echo (!empty($tel_er)) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $tels; ?>">
                            <span class="invalid-feedback"><?php echo $tel_er;?></span>
                            <label class="floatingInput">N° Téléphone</label>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Modifier">
                    </form>
                    </div>
            </div>
        </div>
    </div>
</div>      
            
<?php include("composants/pied-de-page.php");
