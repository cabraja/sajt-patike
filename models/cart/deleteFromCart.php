<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $id = $_POST['id'];

    $deleteItem = deleteItemFromCart($id);

    if($deleteItem){
        $response = ['response' => 'Uspesno brisanje.'];
        echo json_encode($response);
        http_response_code(200);

    }else{
        $response = ['response' => 'Doslo je do greske u bazi, pokusajte opet kasnije.'];
        echo json_encode($response);
        http_response_code(500);
    }

}else{
    $res = ['Response' => 'Nemate pravo pristupa.'];
    echo json_encode($res);
    http_response_code(404);
}

?>