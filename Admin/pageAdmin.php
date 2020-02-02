<?php require_once('../Admin/deletebdd.php'); ?>
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
$sql = "SELECT utilisateurs.id, utilisateurs.username, utilisateurs.mdp, utilisateurs.type_user, user_contact.email_emet, user_contact.email_recept, user_contact.message, user_contact.file_zip FROM utilisateurs, user_contact";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<table>";
        echo "<tr>id : " . $row["id"]."</td>";
        echo "<tr> - username: " . $row["username"]."</td>";
        echo "<tr> - le mdp " . $row["mdp"]."</td>";
        echo "<tr> - type utilisateur " . $row["type_user"]."</td>";
        echo "<tr>- email envoyé par : " . $row["email_emet"]."</td>";
        echo "<tr> - email de réception: " . $row["email_recept"]."</td>";
        echo "<tr> - message : " . $row["message"]."</td>";
        echo "<tr> - fichier_upload " . $row["file_zip"] ."</td><br>";
        echo "<td><input type=\"button\" onclick=\"supprimer();\" name=\"supprimer\" class=\"suppression\" value=\"supprimer\"/></td></tr>";
        echo"</table>";
        
        //. " - username: " . $row["username"] . " - le mdp " . $row["mdp"] . " - type utilisateur " . $row["type_user"] . " - email envoyé par : " . $row["email_emet"] . " - email de réception: " . $row["email_recept"] . " - message : " . $row["message"] . " - fichier_upload " . $row["file_zip"] . "<br>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
require_once('../Views/footer.php');

?>