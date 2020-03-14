
        <?php


        //function pour envoyé a la base de donnée

        function envoieBdd($to, $email, $message, $zip_name)
        {

            if (isset( $_FILES['file_zip'])) $zip_name =  $_FILES['file_zip'];
            else $zip_name = "";

           // pour le mettre en local
            $host = "localhost";
            $dbname = "mailproject;port=3308; charset=utf8";
            $user = "root";
            $pass = "";


              //pour le mettre en ligne

            // $host = "localhost";
            // $dbname = "joans_mailproject; charset=utf8";
            // $user = "joans";
            // $pass = "knjs9opz0AHmqA==";



            try {
                $dbco = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




                //prepare la requete
                if ($to && $email && $message && $zip_name) {
                    $sth = $dbco->prepare("INSERT INTO user_contact SET email_emet = :email_emet, email_recept = :email_recept, message = :message, file_zip = :file_zip");
                    // $sth = $dbco->prepare("INSERT INTO user_contact (email_emet,email_recept, message, file_zip) VALUES (:email_emet, :email_recept, :message, :file_zip)");
                    // execute la requete
                    $sth->execute(array(
                        ':email_emet' => $to,
                        ':email_recept' => $email,
                        ':message' => $message,
                        ':file_zip' => $zip_name,
                    ));
                    // echo "<br>Entrée ajoutée dans la table";
                    "<div id=\"envoyer\">Envoyé</div>";
                }else {
                    // echo "--- pas de fichier envoyé ---";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }



   /*     function getdatabddUser()
        {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mailproject";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT id, username, mdp, type_user FROM Utilisateurs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"] . " - username: " . $row["username"] . " " . $row["mdp"] . " " . $row["type_user"] . "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        }
*/
        