<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../functions/functions.php';

    $id = $_POST['id'];
    $model_name = $_POST['model_name'];
    $brandId = $_POST['brandId'];
    $genderId = $_POST['genderId'];
    $sizes = $_POST['sizes'];
    $url = $_POST['image_url'];
    $price = $_POST['price'];

    $nameReg = '/^[a-z0-9](.){6,50}$/i';
    $urlReg = '/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/';

    $errors = array();

    if(!preg_match($nameReg, $model_name)){
        array_push($errors, "Neispravno ime modela.");
    }
    if(!preg_match($urlReg, $url)){
        array_push($errors, "Neispravnai URL do slike.");
    }
    if($price <= 1){
        array_push($errors, "Cena ne sme biti manja od 1.");
    }

    if(count($errors) === 0){
        $update = editModel($id,$model_name, $brandId, $genderId, $price, $url);
        $updateSizes = editModelSizes($id, $sizes);
        if($update && $updateSizes){
            $response = ['response' => 'Proizvod izmenjen.'];
            echo json_encode($response);
            http_response_code(200);
        }else{
            $response = ['response' => 'Greska u bazi. Pokusajte kasnije ponovo'];
            echo json_encode($response);
            http_response_code(500);
        }
    }
}else{
    http_response_code(404);
    return;
}


?>