<?php
include "views/fixed/header.php";
include "views/fixed/navAdmin.php";
?>

<?php
include "models/functions/functions.php";

$messages = getAllMessages();

if(isset($_SESSION['user']) && $_SESSION['user']->role_name == 'Admin'):
    ?>

    <!--MODAL-->
    <div class="modal fade" id="add-product-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Patike.rs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="add-product-modal-text">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(count($messages) != 0):
    ?>
            <!--CONTENT-->
            <div class="container my-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h2 class="fw-bold">Poruke korisnika</h2>
                        <hr />
                        <?php
                        foreach ($messages as $m):
                            ?>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fs-6"><span class="fw-bold me-1 fs-4"><?=$m->subject?></span> | Poslao: <?=$m->username?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?=$m->date?></h6>
                                    <p class="card-text"><?=$m->body?></p>
                                    <a href="models/contact/delete.php?id=<?=$m->id?>" class="card-link btn btn-danger">Izbriši poruku</a>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>

            </div>
    <?php
    else:
    ?>
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-9">
                    <h2 class="fw-bold">Poruke korisnika</h2>
                    <hr />
                    <div class="container">
                        <div class="alert alert-primary mx-auto my-5 text-center" role="alert">
                            Trenutno nema novih poruka.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php
    endif;
    ?>


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