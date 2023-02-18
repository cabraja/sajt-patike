<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $brandId = $_POST['brandId'];

    if(isset($_SESSION['user'])){
        $userId = $_SESSION['user']->id;

//        CHECK IF USER VOTED
        $userVote = checkUserVote($userId);

        if($userVote){
            $response = ['response' => 'Već ste glasali.', 'done' => 0];
            echo json_encode($response);
            http_response_code(200);
        }else{
            $addVote = addVote($userId, $brandId);

            if($addVote){
                $response = ['response' => 'Uspešno ste glasali.', 'done' => 1];
                echo json_encode($response);
                http_response_code(201);
            }else{
                $response = ['response' => 'Greska na serveru. Pokusajte ponovo kasnije.', 'done' => 0];
                echo json_encode($response);
                http_response_code(500);
            }
        }


    }else{
        $response = ['response' => 'Morate se ulogovati da bi ste glasali.', 'done' => 0];
        echo json_encode($response);
        http_response_code(200);
    }



}else{
    http_response_code(404);
    return;
}

?>

