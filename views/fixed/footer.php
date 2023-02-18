<footer class="container-fluid pb-4">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center fs-5">
            <i class="fa-solid fa-earth-americas mx-2 footer-icon"></i>
            <i class="fa-brands fa-facebook mx-2 footer-icon"></i>
            <i class="fa-brands fa-instagram mx-2 footer-icon"></i>
            <i class="fa-brands fa-pinterest mx-2 footer-icon"></i>
        </div>

        <hr class="mb-1"/>

        <div class="d-flex justify-content-center align-items-center fs-6">
            <?php

            global $conn;
            $query = "SELECT * FROM links";
            $res = $conn->query($query)->fetchAll();
            ?>
            <?php
            foreach ($res as $link):
                ?>
                <a class="nav-link text-dark" href="<?=$link->url?>"><?= strtoupper($link->name)?></a>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</footer>


</body>
</html>