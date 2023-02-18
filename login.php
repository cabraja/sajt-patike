<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 border p-4">
            <div class="alert alert-danger text-center" id="login-alert" role="alert">
                Neispravni kredencijali
            </div>
            <form >
                <div class="mb-3">
                    <label for="username" class="form-label">Korisničko ime</label>
                    <input type="text" class="form-control" id="username" name="username">
                    <small class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Lozinka</label>
                    <input class="form-control" type="password" id="password" name="password">
                    <small class="text-danger"></small>
                </div>

                <button type="button" id="login-btn" class="btn btn-primary px-5 mx-auto d-block">Potvrdi</button>
            </form>
            <p class="text-dark text-center mt-4">Nemate nalog? <a href="register.php">Registrujte se ovde.</a></p>
        </div>
    </div>
</div>

<script src="assets/js/auth.js"></script>
<?php
include "views/fixed/footer.php";
?>
