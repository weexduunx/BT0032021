<?php
session_start();
 
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}

if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "connexion.php";
    
    $sql = "DELETE FROM utilisateurs WHERE id = :id";
    
    if($stmt = $db->prepare($sql)){

        $stmt->bindParam(":id", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if($stmt->execute()){
            header("location: gestionUtilisateur.php");
            exit();
        } else{
            echo "Oops! Une erreur a été survenue !";
        }
    }
     
    unset($stmt);
    
    unset($db);
} else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>
 <?php include 'composants/entêteProfil.php'; ?>
<div class="container-fluid col-xxl-8 px-4 py-5">
   <div class="row justify-content-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="alert alert-danger">
                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                    <p> Vous êtes sûr de vouloir supprimer cet enregistrement?</p>
                    <p>
                        <input type="submit" value="Oui" onclick="return confirm(Vous voulez vraiment le supprimer ?)" class="btn btn-danger">
                        <a href="gestionUtilisateur.php" class="btn btn-secondary ml-2">Non</a>
                    </p>
            </div>
        </form> 
   </div>
</div>      
           
<?php include("composants/pied-de-page.php");



                     
