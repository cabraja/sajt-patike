<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $roleId = $_POST['roleId'];
    $userId = $_POST['userId'];

    // REGEX
    $usernameReg = '/^[a-z][a-z0-9]{5,16}$/i';
    $emailReg = '/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i';
    $phoneReg = '/^[0][6][0-9]{7,12}$/';

    $errors = array();

    if(!preg_match($usernameReg, $username)){
        array_push($errors, "Neispravno korisnicko ime.");
    }
    if(!preg_match($emailReg, $email)){
        array_push($errors, "Neispravna email adresa.");
    }
    if(!preg_match($phoneReg, $phone)){
        array_push($errors, "Neispravan format telefona.");
    }

    if(count($errors) == 0){

        $editUser = editUser($userId,$username,$email,$phone,$roleId);

        if($editUser){
            $response = ['response' => 'Uspesna izmena.'];
            echo json_encode($response);
            http_response_code(200);
        }else{
            $response = ['response' => 'Greska na serveru. Pokusajte ponovo kasnije.'];
            echo json_encode($response);
            http_response_code(500);
        }


    }else{
        echo json_encode($errors);
        http_response_code(400);
    }

    http_response_code(200);

}