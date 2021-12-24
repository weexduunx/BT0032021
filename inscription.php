<?php include('composants/en-tête.php') ?>
		<div class="container-fluid samaContainer col-xxl-8 px-4 py-5">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(img/Signup.png);">
			      		</div>
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
							<form action="#" class="">
                  <div class="form-floating mb-3">
                    <input type="text" name="nom" class="form-control" id="floatingInput" >
                    <label for="floatingInput">Nom</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="prenom" class="form-control" id="floatingInput">
                    <label for="floatingInput">Prénom</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="floatingInput">
                    <label for="floatingInput">Nom d'utilisateur</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput">
                    <label for="floatingInput">Email</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="tel" class="form-control" id="floatingInput">
                    <label for="floatingInput">N° Téléphone</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword">
                    <input type="hidden" name="roleid" value="3" class="form-control">
                    <label for="floatingPassword">Mot de passe</label>
                  </div>
                  <button class="w-100 btn btn-lg btn-success" type="submit">S'inscrire</button>
                  <hr class="my-4">
		          </form>
		          <!-- <p class="text-center">? <a data-toggle="tab" href="#signup">Sign Up</a></p> -->
		        		</div>
		      		</div>
				</div>
			</div>
		</div>
<?php include('composants/pied-de-page.php') ?>
