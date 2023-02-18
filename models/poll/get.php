<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $results = getPollResults();

    if($results){
        echo json_encode($results);
        http_response_code(200);
    }else{
        $response = ['response' => 'Greska na serveru. Pokusajte ponovo kasnije.'];
        echo json_encode($response);
        http_response_code(500);
    }


}else{
    header('Location: ../../login.php');
    http_response_code(400);
}

?>