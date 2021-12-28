<?php
// Initialize the session
session_start();
 
// Vérifiez si l'utilisateur est connecté, sinon le redirige à la page de connexion
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}
//On stocke des informations sur les variables 
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$username = $_SESSION["username"];
$email = $_SESSION["email"];
$tel = $_SESSION["tel"];
//On inclut le fichier de connexion
require_once "connexion.php";




?>
<?php include 'composants/entêteProfil.php'; ?>
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
             <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                 <h1 class="display-4 fw-bold lh-1">Salut,  
                <?php echo htmlspecialchars($_SESSION["prenom"]); ?> <b><?php  echo htmlspecialchars($_SESSION["nom"]); ?></b>
                 </h1>
                <p class="lead">Bienvenue sur l'application "Utilisateur Under-Construction."</p>
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
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="img/Account-pana.png" alt="" width="720">
            </div>
        </div>
    </div>

<?php include("composants/pied-de-page.php");