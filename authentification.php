<?php
	session_start();

	//Vérifiez si l'utilisateur est déjà connecté, si oui on le redirige vers
	// son espace de profil
	if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] === true){
		header("location: authentification.php");
		exit;
	}

	//On inclut le fichier de connexion
	require_once "connexion.php";

	//On doit définir les variables et initialiser avec des valeurs vides
	$tel = $username = $email = $password = "";
	$username_er = $email_er = $password_er = $login_er = "";

	//Traitement des données du formulaire lors de la soumission du formulaire
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//On vérifie si l'email est vide
		// En utilisant trim() pour supprimer
		// les espaces (ou d'autres caractères) en début et fin de chaîne
		if(empty(trim($_POST["email"]))){
			$email_er = "S\'il vous plaît entrer une adresse email valide !";
		}
		else{
			$email = trim($_POST["email"]);
		}

		//On vérifie si le mot de passe est vide
		if(empty(trim($_POST["password"]))){
			$password_er = "S\'il vous plaît entrer un mot de passe valide !";
		}
		else{
			$password = trim($_POST["password"]);
		}
			// Je déclare ces variables pour stocker leurs informations au niveau de $_SESSION
			// Ensuite je vais essayer de poser des conditions pour recupérer des messages
			if(empty(trim($_POST["username"]))){
				$username_er ="Veuillez saisir un nom d'utilisateur !";
			}
			else{
				$username = trim($_POST["username"]);
			}
			

		// On passe à la validation des identifiants
		if(empty($email_er) && empty($password_er) && empty($username_er)){
			// On prépare une requête sql avec l'instruction SELECT
			$sql = "SELECT id,nom, prenom,username,email,password,tel FROM utilisateurs WHERE email = :email";

			if($req = $db->prepare($sql)){
		
				// On fait la liaison des variables à l'instruction préparée en tant que paramétres
				$req->bindParam(":email", $param_email, PDO::PARAM_STR);

				// On configure les paramétres
				$param_email = trim($_POST["email"]);

				//on tente d'executer l'instruction préparée
				if($req->execute()){
					// On vérifie si l'email existe, si oui, 
					// on vérifie le mot de passe
					if($req->rowCount() == 1){
						if($row = $req->fetch()){
							$id = $row["id"];
							$nom = $row["nom"];
							$prenom = $row["prenom"];
							$username = $row["username"];
							$email = $row["email"];
							$password_hash = $row["password"];
							$tel= $row["tel"];
							if(password_verify($password, $password_hash)){
								//Si le mot de passe est correcte, on démarre la session
								session_start();

								//On stock les données dans la variable Session

								$_SESSION["connecte"] = true;
								$_SESSION["nom"] = $nom;
								$_SESSION["id"] = $id;
								$_SESSION["prenom"] = $prenom;
								$_SESSION["username"] = $username;
								$_SESSION["email"] = $email;
								$_SESSION["tel"] = $tel;

								//On redirige l'utilisateur vers la page de gestion

								header("location: gestionUtilisateur.php");
							}else{
								// Si le mot de passe n'est pas valide, on génére un message
								$login_er = "Mot de passe ou adresse email invalide !";
							}
						}		
					} else{
						//Si l'adresse mail n'existe pas, on génére un message
						$login_er = "Mot de passe ou adresse email invalide !";
					}
				} else{
					echo "Réessayez svp, les identifiants ne correspondent pas !";
				}
				// On ferme la requête
				unset($req);
			}
		}

		// On ferme la connexion
		unset($db);

	}
?>
<?php include('composants/en-tête.php'); ?>
	<div class="container-fluid  col-xxl-8 px-4 py-5">
		<div class="row justify-content-center">
			<div class="col-md-12 col-lg-10">
			<?php 
        if(!empty($login_er)){
            echo '<div class="alert alert-danger">' . $login_er . '</div>';
        	}        
        	?>
				<div class="wrap d-md-flex">
					<div class="img" style="background-image: url(img/login.png);">
					</div>
					<div class="login-wrap p-4 p-md-5">
							<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Authentification</h3>
								</div>
								<div class="w-100">
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fab fa-twitter"></span></a>
									</p>
								</div>
							</div>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="" method="post">

							<div class="form-floating mb-3">
								<input type="text" name="username" class="form-control <?php echo (!empty($username_er)) ? 'is-invalid' : ''; ?>"
								 value="<?php echo $username; ?>"  id="floatingInput">
								 <span class="invalid-feedback"><?php echo $username_er; ?></span>
								<label class="floatingInput" for="username">Nom d'utilisateur</label>
							</div>
							<div class="form-floating mb-3">
								<input type="email" name="email" class="form-control <?php echo (!empty($email_er)) ? 'is-invalid' : ''; ?>"
								 value="<?php echo $email; ?>"  id="floatingInput">
								 <span class="invalid-feedback"><?php echo $email_er; ?></span>
								<label class="floatingInput" for="email">Email</label>
							</div>
							<div class="form-floating mb-3">
								<input type="password" name="password" class="form-control <?php echo (!empty($password_er)) ?
								 'is-invalid' : ''; ?>"  id="floatingPassword">
								 <span class="invalid-feedback"><?php echo $password_er; ?></span>
								<label class="floatingInput" for="password">Mot de passe</label>
							</div>
							<div class="form-group">
								<button type="submit" class="w-100 form-control btn btn-primary rounded submit px-3">Se connecter</button>
							</div>
							<div class="form-floating d-md-flex">
								<div class="w-50 ">
									<a href="reinitialiseMDP.php">Mot de passe oublié?</a>
								</div>
							</div>
						</form>
							<!-- <p class="text-center">? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('composants/pied-de-page.php') ?>