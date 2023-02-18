<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../../config/connection.php';
    include '../../models/functions/functions.php';

    try{
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usernameReg = '/^[a-z][a-z0-9]{5,16}$/i';
        $passwordReg = '/^(?=.*[a-z])(?=.*\d)[a-z\d]{8,20}$/i';

        $errors = array();

        if(!preg_match($usernameReg, $username)) {
            array_push($errors, "Neispravno korisnicko ime.");
        }
        if(!preg_match($passwordReg, $password)){
            array_push($errors, "Neispravan format lozinke.");
        }

        if(count($errors) === 0){
            $encryptedPassword = md5($password);

            $user = loginAttempt($username, $encryptedPassword);

            if($user){
                http_response_code(200);
                $response = ['success' => 'Uspesno logovanje.'];
                $_SESSION['user'] = $user;
                echo json_encode($response);
            }else{
                $response = ['response' => 'Neispravni kredencijali.'];
                echo json_encode($response);
                http_response_code(401);
            }

        }else{
            echo json_encode($errors);
            http_response_code(400);
        }




    }catch(PDOException $ex){
        echo $ex;
    }
}else{
    http_response_code(400);
    return;
}


?>