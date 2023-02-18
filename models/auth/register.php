<?php
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    try{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // CHECK IF SAME EMAIL EXISTS IN DATABASE
        $emailCheck = checkIfEmailExists($email);

        if($emailCheck){
            $response = ['response' => 'Korisnik sa ovom email adresom vec postoji.'];
            echo json_encode($response);
            http_response_code(200);
            return;
        }

        // REGEX
        $usernameReg = '/^[a-z][a-z0-9]{5,16}$/i';
        $emailReg = '/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i';
        $phoneReg = '/^[0][6][0-9]{7,12}$/';
        $passwordReg = '/^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i';

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
        if(!preg_match($passwordReg, $password)){
            array_push($errors, "Neispravan format lozinke.");
        }

        if(count($errors) == 0){
            $roleId = 2;
            $encryptedPassword = md5($password);

            $user = addUser($username, $email, $phone, $encryptedPassword, $roleId);

            if($user){
                $response = ['response' => 'Uspesna registracija.'];
                echo json_encode($response);
                http_response_code(201);

            }else{
                $response = ['response' => 'Doslo je do greske u bazi, pokusajte opet kasnije.'];
                echo json_encode($response);
                http_response_code(500);
            }
        }else{
            echo json_encode($errors);
        }
    }catch (PDOException $ex){
        echo $ex;
    }

}else{
    $res = ['Response' => 'Nemate pravo pristupa.'];
    echo json_encode($res);
    http_response_code(404);

}

?>