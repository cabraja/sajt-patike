<?php
include 'config/connection.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light px-2 py-3">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">PATIKE.RS | Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="adminProducts.php">Proizvodi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminUsers.php">Korisnici</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminMessages.php">Poruke</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminPolls.php">Anketa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><button type="button" class="btn btn-outline-danger">Nazad na sajt</button></a>
                </li>
            </ul>
        </div>
    </div>
</nav>