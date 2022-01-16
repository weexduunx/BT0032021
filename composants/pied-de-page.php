<div class="container-fluid bg-primary">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-light text-decoration-none lh-1">
        <li class="fas fa-users"></li>
      </a>
      <span class="text-light">© 2021 Aminata Wade & Idrissa Ndiouck, PSEJ</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
     <a href=""><li class="ms-3 fab fa-facebook text-light" ></li></a>
     <a href=""><li class="ms-3 fab fa-instagram text-light" ></li></a>
     <a href=""><li class="ms-3 fab fa-twitter text-light" ></li></a>
    </ul>
  </footer>
</div>

</body>
 <!-- Javascript & Jquery -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script src="js/bootstrap.bundle.js"></script>
 <script src="js/jquery.dataTables.min.js"></script>
 <script src="js/jquery.min.js"></script>
 <script src="js/dataTables.bootstrap4.min.js"></script>
 <script src="js/script.js"></script>
  <!-- Javascript & Jquery -->
</html>

<!-- Modal Ajouter -->

<div id="userModal" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-5 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h2 class="modal-title">Ajouter un utilisateur</h2> 
        <!-- <h2 class="fw-bold mb-0">Ajouter un utilisateur</h2> -->
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body p-5 pt-0">
        <form method="post" id="formUtilisateur" enctype="multipart/form-data">
          <div class="form-floating mb-3">
            <input type="text" name="nom" class="form-control rounded-4" id="nom">
            <label for="floatingInput">Nom</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="prenom" class="form-control rounded-4" id="prenom">
            <label for="floatingInput">Prenom</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control rounded-4" id="username">
            <label for="floatingInput">Nom d'utilisateur</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control rounded-4" id="email">
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="tel" name="tel" class="form-control rounded-4" id="tel">
            <label for="floatingInput">N° Téléphone</label>
          </div>
          <hr class="my-4">
          <div class="form-floating mb-3">
            <input type="file" name="image"  class="form-control rounded-4" id="image">
            <span id="imageUtilisateur"></span>
            <label for="floating">Ajouter une image</label>
          </div>
          <div class="modal-footer">
					<input type="hidden" name="utilisateur_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Ajouter" />
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				  </div>
          <hr class="my-4">
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Modal Ajouter -->