<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include '../../config/connection.php';
    include '../functions/functions.php';

    $keyword = $_GET['keyword'];

    $models = searchModels($keyword);
    echo json_encode($models);
}
?>