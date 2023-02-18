<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";
?>
    <!-- Modal -->
    <div class="modal fade" id="register-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Patike.rs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="register-modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                    <button type="button" class="btn btn-primary"><a href="login.php" class="text-light">Ulogujte se</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 border p-4">
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Korisničko ime</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <input type="emaill" class="form-control" id="email" name="email">
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Lozinka</label>
                        <input class="form-control" type="password" id="password" name="password" >
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="passwordConfirm" class="form-label">Potvrdi lozinku</label>
                        <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm">
                        <small class="text-danger"></small>
                    </div>

                    <button type="button" id="register-btn" class="btn btn-primary px-5 mx-auto d-block">Registrujte se</button>
                </form>
                <p class="text-dark text-center mt-4">Imate nalog? <a href="login.php">Ulogujte se ovde.</a></p>
            </div>
        </div>
    </div>

    <script src="assets/js/auth.js"></script>
<?php
include "views/fixed/footer.php";
?>