<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $errors = array();

    if(strlen($subject) < 4){
        array_push($errors, "Prekratak naslov.");
    }
    if(strlen($body) < 8){
        array_push($errors, "Prekratka poruka.");
    }

    if(count($errors) == 0){
        $addMessage = addMessage($_SESSION['user']->id,$subject,$body);

        if($addMessage){
            $response = ['response' => 'Poruka uspešno poslata.'];
            echo json_encode($response);
            http_response_code(200);
        }else{
            $response = ['response' => 'Greska na serveru. Pokusajte ponovo kasnije.'];
            echo json_encode($response);
            http_response_code(500);
        }
    }else{
        $response = ['response' => $errors[0]];
        echo json_encode($response);
        http_response_code(400);
    }
}else{
    http_response_code(404);
    return;
}

?>