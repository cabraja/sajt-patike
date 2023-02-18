<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";

if(isset($_SESSION['user'])):
    $cartId = checkIfCartExistsAndReturn($_SESSION['user']->id);

    if(!$cartId){
        createCart($_SESSION['user']->id);
        $cartId = checkIfCartExistsAndReturn($_SESSION['user']->id);
    }

    $cartItems = getCart($cartId->id);
?>
    <div class="container my-5">
        <h3 class="text-center fw-bold">Vaša Korpa</h3>
        <div id="cart-wrapper" class="border p-4">
            <?php
            foreach ($cartItems as $item):
            ?>
                <div class="card mb-2">
                    <div class="card-body bg-light py-1">
                        <div class="row">
                            <div class="col-12 col-md-8 d-flex flex-row align-items-center">
                                <img src="<?= $item->image_url?>" height="80px"/>
                                <h6 class="mb-0 ms-3"><?= $item->model_name?> | Veličina: <span class="fw-bold"><?= $item->size?></span></h6>
                            </div>
                            <div class="col-12 col-md-4 d-flex flex-row align-items-center justify-content-end">
                                <h5 class="mb-0"><?= $item->price?> RSD</h5>
                                <button data-id="<?= $item->id?>" type="button" class="btn btn-outline-danger ms-3 delete-cart-item"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

            <?php
            $sum = 0;

            foreach($cartItems as $ci){
                $sum += $ci->price;
            }
            ?>

            <h5 class="text-center fw-bold">Ukupna cena: <?= $sum?> RSD</h5>

            <div class="row mt-4">
                <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center mb-3">
                    <button type="button" class="btn btn-primary px-5">Naruči</button>
                </div>
                <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center mb-3">
                    <button type="button" class="btn btn-danger px-5" id="empty-cart-btn">Isprazni korpu</button>
                </div>
            </div>
        </div>
    </div>
<?php
else:
?>
    <div class="container">
        <div class="alert alert-secondary mx-auto my-5 text-center" role="alert">
            Ulogujte se da bi ste pristupili ovoj stranici!
        </div>
    </div>
<?php
endif;
?>

<script src="assets/js/cart.js"></script>
<?php
include "views/fixed/footer.php";
?>