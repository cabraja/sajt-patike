<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $cartId = checkIfCartExistsAndReturn($_SESSION['user']->id);

    $emptyCart = emptyCart($cartId->id);

    if($emptyCart){
        $res = ['Response' => 'Uspesno brisanje.'];
        echo json_encode($res);
        http_response_code(200);
    }else{
        $res = ['Response' => 'Doslo je do greske na serveru. Pokusajte ponovo kasnije.'];
        echo json_encode($res);
        http_response_code(500);
    }


}else{
    $res = ['Response' => 'Nemate pravo pristupa.'];
    echo json_encode($res);
    http_response_code(404);
}


?>