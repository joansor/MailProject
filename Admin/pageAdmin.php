<?php 
 
function getdatabddUser(){

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
    if(!$database)
    {
        die('Could not connect to database: ');
    }

    $sql = "SELECT id, username, mdp, type_user FROM Utilisateurs";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - username: " . $row["username"]. " " . $row["mdp"] . $row["type_user"]."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}

getdatabddUser();

?>
