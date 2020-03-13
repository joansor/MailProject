<?php require_once('../Admin/pageAdmin.php'); ?>

<?php


 if (isset($_GET['supprimer'])) $supprimer = $_GET['supprimer'];
 else $supprimer = "";

//  if (isset($_GET['id'])) $id = $_GET['id'];
//  else $id = "";

 global $id;

echo "-----$id--------------!!----";

    
    
    $host = "localhost:3308";
    $dbname = "mailproject; port=3808 ;charset=utf8";
    $user = "root";
    $pass = "";
            
    try {
            $conn = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($supprimer){
                    //requete supprimer 
                    $sql = $conn->prepare("DELETE FROM user_contact WHERE id = :id");  
                    $sql->execute([':id'=>$id]);
                  
                    //header('Location: pageAdmin.php');

                } else {
                     echo "";

                    }

        }catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            }

