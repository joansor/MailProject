<?php
if (isset($_GET['username'])){
    session_start();
    $username = $_GET['username'];
    if($username === "admin"){
        $_SESSION['type'] = "admin";
        header('Location: http://localhost/MailProject/Admin/pageAdmin.php');

    }else if ($username !== "admin"){
        $_SESSION['type'] = "user";
        header('Location: http://localhost/MailProject/');
    }
    
}






