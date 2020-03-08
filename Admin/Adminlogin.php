<?php

if (isset($_GET['login'])) {
    session_start();
    $login = $_GET['login'];

    if (isset($_GET['user'])) $user = $_GET['user'];
    else $user = "";

    if (isset($_GET['password'])) $pass = $_GET['password'];
    else $pass = "";

    if ($user === "admin" && $pass === "admin") {

        $_SESSION['type'] = "admin";
        header('Location: http://localhost/MailProject/Admin/pageAdmin.php');
    }else if ($user !== "admin") {

        $_SESSION['type'] = "user";
        header('Location: http://localhost/MailProject/');
    }

    $servername = "localhost:3308";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 //connection bdd 'mailproject'
    $database = mysqli_select_db($conn, 'mailproject');
    if (!$database) {
        die('Could not connect to database: ');
    }
//requete inserer dans la table utilisateur
    $sql = "INSERT INTO utilisateurs (username,mdp,type_user) VALUES ( '" . $user . "' , '" . $pass . "','" . $_SESSION['type'] . "')";
// succes or error
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

