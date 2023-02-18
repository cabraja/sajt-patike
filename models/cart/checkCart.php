<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    if(isset($_SESSION['user'])){
        $userId = $_SESSION['user']->id;

//        GET CART ID IF ALREADY EXISTS
        $cartId = checkIfCartExistsAndReturn($userId);

        if(!$cartId){
            $cart = createCart($userId);
            $cartId = checkIfCartExistsAndReturn($userId);
        }

        echo json_encode($cartId);
        http_response_code(200);

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