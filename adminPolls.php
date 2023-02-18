<?php
include "views/fixed/header.php";
include "views/fixed/navAdmin.php";
?>

<?php
include "models/functions/functions.php";
$brands = getAllBrands();
$results = getPollResults();

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


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <h2 class="fw-bold">Rezultati ankete</h2>
                <hr class="mb-5" />
                <?php
                foreach ($brands as $b):
                    $voteCount = 0;
                    foreach ($results as $r){
                        if($r->id_brand == $b->id) $voteCount++;
                    }
                ?>
                    <h5><?=$b->brand_name?> (Broj glasova: <?=$voteCount?>)</h5>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: <?=(100/count($results)*$voteCount)?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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