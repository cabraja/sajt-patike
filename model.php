<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";
$id = $_GET['id'];
$model = getSingleModel($id);
$sizes = getModelSizes($id);
?>

<!--MODAL-->

<div class="modal fade" id="add-product-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Patike.rs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modal-text">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<!--CONTENT-->
<div class="container my-5 bg-light rounded shadow">
    <div class="row">
        <div class="col-12 col-md-6">
            <img src="<?= $model->image_url?>" width="100%"/>
        </div>

        <div class="col-12 col-md-6 py-5 px-4 px-lg-0">
            <h3 class="fw-bold"><?= $model->model_name?></h3>
            <p class="fs-6 mb-0">Proizvođač: <?= $model->brand_name?></p>
            <p class="fs-6">Pol: <?= $model->gender_name?></p>

            <h5>Dostupne veličine</h5>
            <div class="d-flex flex-row">
                <?php
                foreach ($sizes as $s):
                    ?>
                    <span class="badge rounded-pill text-dark border me-2 fs-6 size-div" data-id="<?= $s->id?>"><?= $s->size?></span>
                <?php
                endforeach;
                ?>
            </div>

            <div class="alert alert-danger py-2 mt-2" role="alert" id="size-alert">
                Niste izabrali veličinu!
            </div>

            <h5 class="fs-3 mt-4">Cena</h5>
            <h4 class="fw-bold fs-2"><?= $model->price?> RSD</h4>

            <button type="button" class="btn btn-primary mt-2" id="add-to-cart" data-id="<?=$id?>">Dodaj u korpu <i class="fa-solid fa-cart-shopping"></i></button>

            <?php
                if($model->free_shipping):
            ?>
                <p class="mt-4 fs-5"><i class="fa-solid fa-truck"></i> Besplatna dostava</p>
            <?php
                endif;
            ?>
        </div>

    </div>
</div>

<script src="assets/js/model.js"></script>
<?php
include "views/fixed/footer.php";
?>
