<?php
include "views/fixed/header.php";
include "views/fixed/navAdmin.php";
?>
<?php
include "models/functions/functions.php";
$userId = null;
if(isset($_GET['id'])){
    $userId = $_GET['id'];
}
$roles = getAllRoles();
$user = getUser($userId);

if(isset($_SESSION['user']) && $_SESSION['user']->role_name == 'Admin' && isset($_GET['id'])):

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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button></div>
            </div>
        </div>
    </div>

    <!--PRODUCTS-->
    <div class="container my-5">
    <h2 class="fw-bold">Izmeni korisnika</h2>
    <hr />

    <div class="container mb-5">
        <div class="row d-flex justify-content-start align-items-center">
            <div class="col-12 col-md-7">
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Korisničko ime</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?=$user->username?>">
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <input type="emaill" class="form-control" id="email" name="email" value="<?=$user->email?>">
                        <small class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?=$user->phone?>">
                        <small class="text-danger"></small>
                    </div>


                    <div class="mt-2">
                        <label for="role" class="form-label fw-bold">Uloga</label>
                        <div class="mb-0 d-flex flex-row">
                            <?php
                            foreach ($roles as $r):
                                ?>
                                <div class="form-check me-2">
                                    <input <?=$user->role_name == $r->role_name ? "checked" : null ?> class="form-check-input role-check" type="radio" name="role" value="<?=$r->id?>">
                                    <label class="form-check-label" for="role">
                                        <?=$r->role_name?>
                                    </label>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                        <small class="text-danger" id="gender-error"></small>
                    </div>

                    <button type="button" id="edit-user-btn" data-id="<?=$userId?>" class="btn btn-primary px-5 mt-3 d-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
<?php
else:
    ?>
    <div class="container">
        <div class="alert alert-secondary mx-auto my-5 text-center" role="alert">
            Ne smete pristupiti ovoj stranici!
        </div>
    </div>
<?php
endif;
?>


<?php
include "views/fixed/footerAdmin.php";
?>