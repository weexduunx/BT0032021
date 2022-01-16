<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateur</title>
    <link rel="stylesheet" href="css/sama.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/csspersonnalise.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    
</head>
<body>

<nav class="navbar navbar-expand-lg  navbar-dark bg-primary ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <!-- <i class="fas fa-home"></i> -->
          <span>&#10092;/&#10093;</span>SunuCodeSN</a>
        </a>
        <button class="navbar-toggler collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon "></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent2" style="">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Produits</a>
                </li>          
              </ul>
              
            <div class="d-flex">
                <div class="barreDeRecherche">
                  
                    <input class="inputRecherche" type="text" name="" placeholder="Rechercher...">
                    <a href="#" class="iconeDeRecherche"><i class="fa fa-search"></i></a>
                 </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href=""><i class="fas fa-user-circle mr-2"></i><?php echo $_SESSION['username'];?></a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="deconnexion.php"><i class="fa fa-power-off mr-2"></i> Se déconnecter</a>
                </li>
                </ul>
            </div>
            
       </div>
       
    </div>
</nav>