<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
    include "views/fixed/slideshow.php";
    include "models/functions/functions.php";

    $newModels = getNewModels();
    $allBrands = getAllBrands();
?>

<div class="container py-4">
    <h3 class="fw-bold fs-2 mb-3">Najnovi modeli</h3>

    <div class="row">
        <?php
            foreach ($newModels as $m):
        ?>
        <div class="col-12 col-md-4">
            <a href="model.php?id=<?= $m->id?>">
            <div class="card">
                <div class="model-overlay"></div>

                <img src="<?= $m->image_url?>" class="card-img-top" alt="<?= $m->model_name?>">
                <div class="card-body text-dark">
                    <h5 class="card-title"><?= $m->model_name?></h5>
                    <p class="card-text fs-5 card-subtext"><?= $m->price?> RSD</p>
                </div>
            </div>
            </a>
        </div>
        <?php
            endforeach;
        ?>

    </div>
</div>

<div class="container-fluid bg-dark py-4">
    <div class="container">
        <h5 class="text-light text-center">Tražite posao? Voleli bi smo da nam se pridružite! Pošaljite nam vaš CV na patikers@gmail.com</h5>
    </div>
</div>


<div class="container-fluid background-fluid" style="background-image: url('assets/images/sneakers1.jpg')" >
</div>

<div class="container-fluid bg-dark py-5 newsletter-container">
    <div class="container text-light d-flex flex-column align-items-center text-center">
        <h4 class="fw-bold">Pretplatite se na naš Newsletter</h4>
        <p>Pretplatite se da bi ste dobijali informacije o najnovijim ponudama i akcijama na našem sajtu.</p>
        <div class="input-group mb-3 rounded" >
            <input type="text" class="form-control" placeholder="Email adresa" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text p-0 border-0 " id="basic-addon2"><button type="button" class="btn btn-primary news-button px-4">Pošalji</button></span>
        </div>
    </div>
</div>

<div class="container py-5 my-2">
    <div class="row">
        <?php
        foreach ($allBrands as $b):
            ?>
            <div class="col d-flex justify-content-center align-items-center">
                <img src="<?= $b->brand_img?>" alt="<?= $b->brand_name?>">
            </div>
        <?php
        endforeach;
        ?>
    </div>

    <div class="mt-5">
        <h4 class="text-center fw-bold mb-3">Anketa : Koji je vaš omiljeni brend patika?</h4>
        <div class="row justify-content-center mt-2">
            <div class="col-12 col-lg-8">
                <form>
                    <div class="d-flex flex-column flex-lg-row justify-content-evenly">
                        <?php
                        foreach ($allBrands as $b):
                            ?>
                            <div class="form-check me-3">
                                <input class="form-check-input brand-check" type="radio" name="brand" value="<?=$b->id?>">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <?=$b->brand_name?>
                                </label>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <small id="poll-error" class="text-danger text-center w-100 d-block"></small>
                    <small id="poll-success" class="text-success text-center w-100 d-block"></small>
                    <button type="button" id="poll-vote-btn" class="btn btn-primary px-4 mx-auto d-block mt-3">Glasaj</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/index.js"></script>

<?php
    include "views/fixed/footer.php";
?>