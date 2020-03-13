<?php require_once('../Admin/deletebdd.php');?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>Dashboard</h1>

<?php
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
$sql = "SELECT * FROM user_contact";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
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

        echo"<form action =\"traitement.php\" method=\"get\">";

        // http://localhost/MailProject/Admin/pageAdmin.php?supprimer=supprimer:" .$row["id"].
        // echo "<tr><p name='id'>id : " . $row["id"]."</p></td>";


        echo "<td><input type=\"submit\" onclick=\"delete($id)\" name=\"supprimer\" class=\"suppression btn btn-danger\" value=\"supprimer\"/>$id</td></tr>";
        echo"</form>";
        echo"</table>";
        echo"<br>";
        echo"delete()";
    }
} else {
    echo "0 results";
}
$conn->close();
require_once('../Views/footer.php');

