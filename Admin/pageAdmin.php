<?php
    require_once('../Admin/deletebdd.php');
    session_start();
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>toto</title>
</head>
<body>
<!--page Dashboard-->
<h1>Dashboard</h1>

<?php


//variable pour la connection a la bdd
$servername = "localhost:3308";
$username = "root";
$password = "";

// Cree une connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//connection a la table mailproject
$database = mysqli_select_db($conn, 'mailproject');
if (!$database) {
    die('Could not connect to database: ');
}

//requete recupere les champs table user_contact
$sql = "SELECT * FROM user_contact";
$result = $conn->query($sql);

//pour chaque donnée, on les récupères et on les alignes 
if ($result->num_rows > 0) {
    //tant qu'il y a des données récupère et affiche
    while ($row = $result->fetch_assoc()) {

        $id = $row["id"];

        echo "<table>";
        
        // echo "<tr> - username: " . $row["username"]."</td>";
        // echo "<tr> - le mdp " . $row["mdp"]."</td>";
        // echo "<tr> - type utilisateur " . $row["type_user"]."</td>";
        echo "<tr>- email envoyé par : " . $row["email_emet"]."</td>";
        echo "<tr> - email de réception: " . $row["email_recept"]."</td>";
        echo "<tr> - message : " . $row["message"]."</td>";
        echo "<tr> - fichier_upload " . $row["file_zip"] ."</td>";

        echo"<form action =\"traitement.php\" method=\"post\">";
        
        echo "<tr><input type=\"hidden\" name=\"id\" value=".$row['id']."></td>";
        
        echo "<td><input type=\"submit\" name=\"supprimer\" class=\"suppression btn btn-danger\" value=\"supprimer\" onclick=\"return confirm('Are you sure?')\"/></td></tr>";

        echo"</form>";
        echo"</table>";
        echo"<br>";
    }
} else {
    //si pas de résultat affiche 0 results
    echo "0 results";
}
//ferme la connection
$conn->close();
//affiche le footer
require_once('../Views/footer.php');


