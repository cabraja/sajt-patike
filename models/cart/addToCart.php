<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $modelId =$_POST['modelId'];
    $sizeId = $_POST['sizeId'];
    $cartId = $_POST['cartId'];

    if(isset($_SESSION['user'])){
        $addToCart = addToCart($modelId, $sizeId, $cartId);

        if($addToCart){
            $response = ['response' => 'Proizvod dodat u korpu.'];
            echo json_encode($response);
            http_response_code(200);
        }else{
            $response = ['response' => 'Greska na serveru, probajate ponovo kasnije.'];
            echo json_encode($response);
            http_response_code(500);
        }
    }else{
        $response = ['response' => 'Morate biti ulogovani da bi ste pristupili korpi.'];
        echo json_encode($response);
        http_response_code(401);
    }


}else{
    http_response_code(404);
    return;
}
?>