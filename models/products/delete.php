<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../functions/functions.php';

    $modelId = $_POST['id'];

    $deleteModel = deleteModel($modelId);

    if($deleteModel){
        $response = ['response' => 'Proizvod izbrisan.'];
        echo json_encode($response);
        http_response_code(200);
    }else{
        $response = ['response' => 'Doslo je do greske u bazi. Pokusajte ponovo kasnije.'];
        echo json_encode($response);
        http_response_code(500);
    }

}else{
    http_response_code(404);
    return;
}
?>