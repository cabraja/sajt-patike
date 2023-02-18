
<nav class="navbar navbar-expand-lg navbar-light bg-light px-1 d-block d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand fw-bolder fs-3" href="index.php"><img src="assets/images/favicon.png" width="45px" />PATIKE.RS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                include 'config/connection.php';

                global $conn;
                $query = "SELECT * FROM links";
                $res = $conn->query($query)->fetchAll();
                ?>

                <?php
                foreach ($res as $link):
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=$link->url?>"><?= $link->name?></a>
                    </li>

                <?php
                endforeach;
                ?>

                <?php
                if(isset($_SESSION['user'])):
                ?>
                    <a href="cart.php" class="text-dark fs-4 me-4 cart-icon"><i class="fa-solid fa-cart-shopping"></i> Vaša korpa</a>
                    <a href="models/auth/logout.php"><button type="button" class="btn btn-outline-danger mt-2 px-3 ">Logout</button></a>
                    <?php
                    if($_SESSION['user']->role_name == 'Admin'):
                        ?>
                        <a href="adminProducts.php"><button type="button" class="btn btn-warning  px-3 me-2">Admin Panel</button></a>
                    <?php
                    endif;
                    ?>
                <?php
                else:
                ?>
                    <a href="login.php"><button type="button" class="btn btn-outline-danger  px-3 ">Login</button></a>
                <?php
                endif;
                ?>

            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light d-none d-lg-flex px-3 flex-row align-items-center justify-content-between">
    <a class="navbar-brand fw-bolder fs-2" href="index.php"><img src="assets/images/favicon.png" />PATIKE.RS</a>
    <div class="d-flex flex-row justify-content-evenly align-items-center">
        <?php

        global $conn;
        $query = "SELECT * FROM links";
        $res = $conn->query($query)->fetchAll();
        ?>

        <?php
        foreach ($res as $link):
            ?>
                <a class="nav-link text-dark px-2" href="<?=$link->url?>"><?= $link->name?></a>
        <?php
        endforeach;
        ?>
        <?php
        if(isset($_SESSION['user'])):
        ?>
            <div class="d-flex flex-row align-items-center border-start border-2 ms-1 ps-3">
                <h6 class="mb-0 d-flex flex-row align-items-center me-4"><i class="fa-regular fa-user me-2 fs-3"></i><?= $_SESSION['user']->username?></h6>
                <a href="cart.php" class="text-dark fs-4 me-4 cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="models/auth/logout.php"><button type="button" class="btn btn-outline-danger  px-3 me-2">Logout</button></a>
                <?php
                    if($_SESSION['user']->role_name == 'Admin'):
                ?>
                <a href="adminProducts.php"><button type="button" class="btn btn-warning  px-3 me-2">Admin Panel</button></a>
                <?php
                    endif;
                ?>
            </div>
        <?php
        else:
            ?>
            <a href="login.php"><button type="button" class="btn btn-outline-danger  px-3 me-2">Login</button></a>
        <?php
        endif;
        ?>    </div>
</nav>