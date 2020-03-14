<?php //require_once('../Admin/pageAdmin.php'); ?>

<?php


 if (isset($_POST['supprimer'])) $supprimer = $_POST['supprimer'];
 else $supprimer = "";

 if (isset($_POST['id'])) $id = $_POST['id'];
 else $id = "";



    //connection local
    // $host = "localhost:3308";
    // $dbname = "mailproject; port=3808 ;charset=utf8";
    // $user = "root";
    // $pass = "";
    
    $host = "localhost";
    $dbname = "joans_mailproject; port=3808; charset=utf8";
    $user = "joans"; 
    $pass = "knjs9opz0AHmqA==";
 



    try {
            $conn = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($supprimer){
                    //requete supprimer 
                    $sql = $conn->prepare("DELETE FROM user_contact WHERE id = :id");  
                    $sql->execute([':id'=>$id]);

                    header('Location: pageAdmin.php');

                } else {
                     echo "";

                    }

        }catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            }

