<?php
//si login

if (isset($_GET['login'])) {
    session_start(); // ouvre une session
    $login = $_GET['login']; 

    if (isset($_GET['user'])) $user = $_GET['user'];
    else $user = "";

    if (isset($_GET['password'])) $pass = $_GET['password'];
    else $pass = "";

 /////////////////////////////

//verification quel type se connecte
    
    if ($user === "admin" && $pass === "admin") { //si admin

        $_SESSION['type'] = "admin";
        header('Location: https://joans.promo-36.codeur.online/MailProject/Admin/pageAdmin.php'); //redirection sur pageAdmin.php

    }else if ($user !== "admin") { // si utilisateur 

        $_SESSION['type'] = "user";
        header('Location: https://joans.promo-36.codeur.online/MailProject'); //redirection a la page d'accueuil 
    }

    $servername = "localhost";
    $username = "joans";
    $password = "knjs9opz0AHmqA==";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //connection bdd 'mailproject'
    $database = mysqli_select_db($conn, 'joans_mailproject');
    if (!$database) {
        die('Could not connect to database: ');
    }
    //requete recupère dans la table user_contact et tout les infos

    // $sql = "INSERT INTO utilisateurs (username,mdp,type_user) VALUES ( '" . $user . "' , '" . $pass . "','" . $_SESSION['type'] . "')";
    $sql = "SELECT * FROM user_contact";

    // success or error
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //executer la requete
    $resultat = $conn->query($sql);

//deconnection
    //mysqli_close($conn);

}

