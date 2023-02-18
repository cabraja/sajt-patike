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
$users = getAllUsers($page);
$count = getUsersCount();

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
        <h2 class="fw-bold">Svi Korisnici</h2>
        <hr />
        <table class="table table-dark table-striped mt-2">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Admin</th>
                <th>Datum registracije</th>
                <th>Izmeni</th>
                <th>Izbriši</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user):
                ?>
                <tr>
                    <td ><?=$user->id?></td>
                    <td ><?=$user->username?></td>
                    <td><?=$user->email?></td>
                    <td><?=$user->phone?></td>
                    <td><?=$user->role_name == 'Admin' ? '<i class="fa-solid fa-check text-info"></i>' :'<i class="fa-solid fa-xmark text-danger"></i>'?></td>
                    <td><?=$user->date_reg?></td>
                    <td><a href="editUser.php?id=<?=$user->id?>"><button type="button" class="btn btn-primary mx-auto d-block"><i class="fa-solid fa-pen-ruler"></i></button></a></td>
                    <td><button type="button" data-id="<?=$user->id?>" class="delete-user-btn btn btn-danger mx-auto d-block delete-model"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>

        <nav class="d-flex justify-content-center align-items-center mb-4 mt-4">
            <ul class="pagination pagination">
                <?php
                $pageNum = ceil($count->count/5);
                for($i = 0; $i < $pageNum; $i++):
                    ?>
                    <li class="page-item <?= $page == $i+1 ? 'active' : ''?>">
                        <a href="adminUsers.php?page=<?=$i+1?>" class="page-link"><?=$i+1?></a>
                    </li>
                <?php
                endfor;
                ?>
            </ul>
        </nav>

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