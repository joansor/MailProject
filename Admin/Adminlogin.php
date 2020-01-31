<?php
if (isset($_GET['login'])){
    session_start();
    $login = $_GET['login'];

    if (isset($_GET['user'])) $user = $_GET['user'];
    else $user = "";

    if (isset($_GET['password'])) $pass = $_GET['password'];
    else $pass = "";


    if($user === "admin" && $pass === "admin"){
        $_SESSION['type'] = "admin";
        header('Location: http://localhost/MailProject/Admin/pageAdmin.php');

    }else if ($username !== "admin"){
        $_SESSION['type'] = "user";
        header('Location: http://localhost/MailProject/');
    }
    
}






