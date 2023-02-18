<?php
include "views/fixed/header.php";
include "views/fixed/navAdmin.php";
?>

<?php
include "models/functions/functions.php";
$page = 1;

if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$models = getModels($page);
$count = getModelCount();
$brands = getAllBrands();
$genders = getAllGenders();
$sizes = getAllSizes();

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

<!--PRODUCTS-->
    <div class="container my-5">
        <h2 class="fw-bold">Svi Proizvodi</h2>
        <hr />
        <table class="table table-dark table-striped mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Brend</th>
                    <th>Cena</th>
                    <th>Izmeni</th>
                    <th>Izbriši</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($models as $model):
            ?>
                <tr>
                    <td ><?=$model->id?></td>
                    <td ><?=$model->model_name?></td>
                    <td><?=$model->brand_name?></td>
                    <td><?=$model->price?> RSD</td>
                    <td><a href="editProduct.php?id=<?=$model->id?>"><button type="button" class="btn btn-primary mx-auto d-block"><i class="fa-solid fa-pen-ruler"></i></button></a></td>
                    <td><button type="button" data-id="<?=$model->id?>" class="delete-product-btn btn btn-danger mx-auto d-block delete-model"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
            <?php
                endforeach;
            ?>
            </tbody>
        </table>

        <nav class="d-flex justify-content-center align-items-center mb-4 mt-4">
            <ul class="pagination pagination">
                <?php
                $pageNum = ceil($count->count/6);
                for($i = 0; $i < $pageNum; $i++):
                    ?>
                    <li class="page-item <?= $page == $i+1 ? 'active' : ''?>">
                        <a href="adminProducts.php?page=<?=$i+1?>" class="page-link"><?=$i+1?></a>
                    </li>
                <?php
                endfor;
                ?>
            </ul>
        </nav>


        <h2 class="fw-bold">Dodaj proizvod</h2>
        <hr />

        <div class="container ">
            <div class="row d-flex justify-content-start align-items-center">
                <div class="col-12 col-md-7">
                    <form method="POST">
                        <div class="mb-2">
                            <label for="model_name" class="form-label fw-bold">Ime modela</label>
                            <input type="text" class="form-control" name="model_name" id="model_name">
                            <small class="text-danger"></small>
                        </div>
<!--                        BRAND SELECT-->
                        <div class="mt-2">
                            <label for="brand" class="form-label fw-bold">Brend</label>
                            <div class="mb-0 d-flex flex-row">
                                <?php
                                foreach ($brands as $b):
                                    ?>
                                    <div class="form-check me-2">
                                        <input class="form-check-input brand-check" type="radio" name="brand" value="<?=$b->id?>">
                                        <label class="form-check-label" for="brand">
                                            <?=$b->brand_name?>
                                        </label>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <small class="text-danger" id="brand-error"></small>
                        </div>

<!--                        GENDER SELECT-->
                        <div class="mt-2">
                            <label for="gender" class="form-label fw-bold">Pol</label>
                            <div class="mb-0 d-flex flex-row">
                                <?php
                                foreach ($genders as $g):
                                    ?>
                                    <div class="form-check me-2">
                                        <input class="form-check-input gender-check" type="radio" name="gender" value="<?=$g->id?>">
                                        <label class="form-check-label" for="gender">
                                            <?=$g->gender_name?>
                                        </label>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                            <small class="text-danger" id="gender-error"></small>
                        </div>

<!--                        SIZES SELECT-->

                        <div class="mt-2">
                            <label for="size" class="form-label fw-bold">Dostupne veličine</label>
                            <div class="mb-0 d-flex flex-row">
                                <div class="d-flex flex-column flex-lg-row">
                                    <?php
                                    foreach ($sizes as $s):
                                        ?>
                                        <div class="form-check me-2">
                                            <input class="form-check-input size-check" name="size" type="checkbox" value="<?=$s->id?>" >
                                            <label class="form-check-label" for="size">
                                                <?=$s->size?>
                                            </label>
                                        </div>

                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <small class="text-danger" id="size-error"></small>
                        </div>

<!--                        URL IMAGE SELECT-->
                        <div class="mb-2 mt-2">
                            <label for="image_url" class="form-label fw-bold">URL slike</label>
                            <input type="text" class="form-control" name="image_url" id="image_url">
                            <small class="text-danger"></small>
                        </div>

<!--                        PRICE SELECT-->
                        <div class="mb-2 mt-2">
                            <label for="price" class="form-label fw-bold">Cena</label>
                            <input type="number" class="form-control" name="price" id="price">
                            <small class="text-danger"></small>
                        </div>


                        <button type="button" id="new-model-btn" class="btn btn-primary mt-3 px-5 py-2">Potvrdi</button>
                    </form>
                </div>
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