
        <?php


        //function pour envoyé a la base de donnée: appeler dans le HomeController.php au moment du submit

        function envoieBdd($to, $email, $message, $zip_name)
        {


            //pour le mettre en local
            // $host = "localhost";
            // $dbname = "mailproject;port=3308; charset=utf8";
            // $user = "root";
            // $pass = "";


            //pour le mettre en ligne
            $host = "localhost";
            $dbname = "joans_mailproject; charset=utf8";
            $user = "joans";
            $pass = "knjs9opz0AHmqA==";

            

            //connection à la bdd
            try {
                $dbco = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $pass);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




                //prepare la requete pour inserer dans la bdd
                if ($to && $email && $message) {
                    // $sth = $dbco->prepare("INSERT INTO user_contact SET email_emet = :email_emet, email_recept = :email_recept, message = :message");
                    $sth = $dbco->prepare("INSERT INTO user_contact (email_emet,email_recept, message) VALUES (:email_emet, :email_recept, :message)");
                    // execute la requete
                    $sth->execute(array(
                        ':email_emet' => $to,
                        ':email_recept' => $email,
                        ':message' => $message,
                       
                    ));
                    // echo "<br>Entrée ajoutée dans la table";
                    "<div id=\"envoyer\">Envoyé</div>";
                }
                if($zip_name){ //si il a un fichier file.zip insert le aussi dans la bdd
                    $sth = $dbco->prepare("INSERT INTO user_contact (file_zip) VALUES (:file_zip)");
                    $sth->execute([
                        ':file_zip' => $zip_name,
                    ]);

                }else {
                    
                    //sinon arrete ne fait rien et redirection
                    header('Location: HomeView.php');
                }
            } catch (PDOException $e) { //si pb dans connection
                echo "Erreur : " . $e->getMessage();
            }
        }
