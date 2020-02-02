<?php

function supprimer(){

    if (isset($_GET['supprimer'])) $supprimer = $_GET['supprimer'];
    else $supprimer = "";
    
if($supprimer){
    
    $servername = "localhost:3308";
    $username = "root";
    $password = "";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $database = mysqli_select_db($conn, 'mailproject');
    if (!$database) {
        die('Could not connect to database: ');
    }
    //requete recupere les champs des deux tables en gardant seulement le id de la table utilisateur
    $sql = "DELETE FROM utilisateurs, user_contact WHERE id=".$_GET['id'];
    
    $conn->query($sql);

}
$conn->close();
}