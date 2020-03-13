<?php require_once('../Admin/pageAdmin.php'); ?>

<?php
 if (isset($_GET['supprimer'])) $supprimer = $_GET['supprimer'];
 else $supprimer = "";

 if (isset($_GET['id'])) $id = $_GET['id'];
 else $id = "";


echo "-----$id------------------";

function delete($id){

global $supprimer, $id;



    if($supprimer){
    
            $host = "localhost:3308";
            $dbname = "mailproject; port=3808 ;charset=utf8";
            $user = "root";
            $pass = "";
            
        try {
                    $database = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $pass);
                    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check connection
                
                    if (!$database) {
                        die('Could not connect to database: ');
                    }

                    //requete supprimer 
                    $sql = $database->prepare("DELETE FROM user_contact WHERE id = ".$_GET['id']." ");  
                    $sql->execute([$_GET['id'] => $id]);
                    header('Location: pageAdmin.php');

            }catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
    }
}