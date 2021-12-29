<?php
// Initialize the session
session_start();
 
// Vérifiez si l'utilisateur est connecté, sinon le redirige à la page de connexion
if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true){
    header("location: authentification.php");
    exit;
}

?>
<?php include 'composants/entêteProfil.php'; ?>
    <div class="container my-5">
        <div class="row  pt-lg-5  rounded-3 border shadow-lg">
                 <h2 class="">Salut,  
                <?php echo htmlspecialchars($_SESSION["prenom"]); ?> <b><?php  echo htmlspecialchars($_SESSION["nom"]); ?></b>
                 </h2>
                <p class="lead">Bienvenue sur l'application "Utilisateur Under-Construction."</p>
                <div class="wrapper">
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="mt-5 mb-3 clearfix">
                                    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
                                </div>
                                <?php
                                ///On inclut le fichier de connexion
                                require_once "connexion.php";
                                
                                // tentative d'exécution de requête sélectionnée            
                                $sql = "SELECT * FROM utilisateurs";
                                if($result = $db->query($sql)){
                                    if($result->rowCount() > 0){
                                       echo '<h2 class="text-center">Détails des utilisateurs</h2>';
                                        echo '<div class="table-responsive"> <table class="table table-bordered table-striped table-sm">';
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo '<th scope="col">#</th>';
                                                    echo '<th scope="col">Nom</th>';
                                                    echo '<th scope="col">Prenom</th>';
                                                    echo '<th scope="col">Nom d\'utilisateur</th>';
                                                    echo '<th scope="col">Email</th>';
                                                    echo '<th scope="col">Tel</th>';
                                                    echo '<th scope="col">Action</th>';
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            while($row = $result->fetch()){
                                                echo "<tr>";
                                                    echo "<td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['nom'] . "</td>";
                                                    echo "<td>" . $row['prenom'] . "</td>";
                                                    echo "<td>" . $row['username'] . "</td>";
                                                    echo "<td>" . $row['email'] . "</td>";
                                                    echo "<td>" . $row['tel'] . "</td>";
                                                    echo "<td>";
                                                        echo '<a href="profil.php?id='. $row['id'] .'" class="mr-3" title="Afficher" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                        echo '<a href="maj.php?id='. $row['id'] .'" class="mr-3" title="Modifier" data-toggle="tooltip"><span class="fas fa-pencil-alt"></span></a>';
                                                        echo '<a href="supprimer.php?id='. $row['id'] .'" title="Supprimer" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</tbody>";                            
                                        echo "</table></div>";
                                    // On désarme le resultat                          
                                    unset($result);
                                    } else{
                                        echo '<div class="alert alert-danger"><em>Aucun enregistrement n\'a été trouvé.</em></div>';
                                    }
                                } else{
                                    echo "Oops! Quelque chose s'est mal passé.Veuillez réessayer plus tard.";
                                }
                                
                                // Fermer la connexion                    
                                unset($db);
                                ?>
                            </div>
                        </div>        
                    </div>
                </div>   
        </div>
    </div>

<?php include("composants/pied-de-page.php");