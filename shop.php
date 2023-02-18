<?php
include "views/fixed/header.php";
include "views/fixed/nav.php";
?>

<?php
include "models/functions/functions.php";

$page = 1;

if(isset($_GET["page"])){
    $page = $_GET["page"];
}

$models = getModels($page);
$count = getModelCount();
?>

<div class="container mt-5">
    <div class="container d-flex flex-row justify-content-between align-items-center mb-3">
        <div class="row w-100">
            <div class="col-12 col-lg-6">
                <div class="input-group mb-3 rounded position-relative" id="search-container">
                    <input type="text" class="form-control" placeholder="Pretraga" id="search">
                    <span class="input-group-text p-0 border-0 " id="search-btn"><button type="button" class="btn btn-primary news-button px-4">Pretraži</button></span>

                    <div id="search-results" class="border rounded">
                        <ul id="search-results-list" class="mb-0 py-2 ">

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 d-none d-lg-flex justify-content-end align-items-center" >
                <h6 class="mb-0"><?= $count->count?> products found</h6>
            </div>
        </div>
    </div>

<!--  SHOP MAIN SECTION  -->
    <div class="row">
        <?php
            foreach ($models as $m):
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

    <nav class="d-flex justify-content-center align-items-center mb-4 mt-4">
        <ul class="pagination pagination">
            <?php
                $pageNum = ceil($count->count/6);
                for($i = 0; $i < $pageNum; $i++):
            ?>
                <li class="page-item <?= $page == $i+1 ? 'active' : ''?>">
                    <a href="shop.php?page=<?=$i+1?>" class="page-link"><?=$i+1?></a>
                </li>
            <?php
                endfor;
            ?>
        </ul>
    </nav>
</div>



<script src="assets/js/shop.js"></script>
<?php
include "views/fixed/footer.php";
?>