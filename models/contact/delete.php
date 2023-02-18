<?php
session_start();
header("Content-type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    if($_SESSION['user']->role_name == 'Admin'){
        include '../../config/connection.php';
        include '../../models/functions/functions.php';
        $id = $_GET['id'];

        $deleteMessage = deleteMessage($id);
        header('Location: ../../adminMessages.php');
    }else{
        header('Location: ../../login.php');
    }

}else{
    header('Location: ../../login.php');
    http_response_code(400);
}

?>