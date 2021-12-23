<?php include('composants/en-tête.php') ?>

<div class="container-fluid samaContainer col-xxl-8 px-4 py-5 ">
        <div class="card-header bg-light">
          <h3 class='text-center'>Page d'enregistrement</h3>
        </div>
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <!-- Debut Formulaire d'authentification -->
            <form class="p-4 p-md-5 border rounded-3 bg-light" action="" method="">
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
              <!-- Fin Formulaire d'authentification -->
        </div>
    </div>
</div>

<?php include('composants/pied-de-page.php') ?>