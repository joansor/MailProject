<?php

// recupère le model Home.php
require_once('Models/Home.php');

// affiche ce title
$title = "Home";

//////////////////////////////////
if (isset($_POST['message'])) $message = $_POST['message'];
else $message = "";

if (isset($_POST['email_emet'])) $to = $_POST['email_emet'];
else $to = "";

if (isset($_POST['email_recept'])) $email = $_POST['email_recept'];
else $email = "";

if (isset($_POST['subject'])) $subject = $_POST['subject'];
else $subject = "";
///////////////////////////////////


//function pour fichier zip
if ($_FILES && $_FILES['file_zip']) {

    if (!empty($_FILES['file_zip']['name'][0])) {

        $zip = new ZipArchive();
        $zip_name = "uploads/upload_" . time() . ".zip";

        // Create a zip target
        if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
            $error .= "Sorry ZIP creation is not working currently.<br/>";
        }

        $imageCount = count($_FILES['file_zip']['name']);
        for ($i = 0; $i < $imageCount; $i++) {

            if ($_FILES['file_zip']['tmp_name'][$i] == '') {
                continue;
            }
            $newname = date('YmdHis', time()) . mt_rand() . '.jpg';

            // Moving files to zip.
            $zip->addFromString($_FILES['file_zip']['name'][$i], file_get_contents($_FILES['file_zip']['tmp_name'][$i]));

            // moving files to the target folder.
            //move_uploaded_file($_FILES['file_zip']['tmp_name'][$i], './uploads/' . $newname);
        }
        $zip->close();

        // Create HTML Link option to download zip
        $success = basename($zip_name);
    } else {
        $error = '<strong>Error!! </strong> Please select a file.';
    }
}



//envoie de mail en local sur la boite mailtrap.io ou en ligne
if (isset($_POST["submit"])) 
{


    global $zip_name, $buttonUpload;

    $to      = $_POST['email_recept'];
    $subject = $_POST['subject'];
 
// Construction du mail receptionné

    $header = "From:" .$_POST['email_emet'];
    $header .= "Reply-To: ". $_POST['email_emet'] . "\r\n";
    $header .= "CC:".$_POST['email_emet']."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
    
// la mise en page du mail de reception en html
    $htmlContent = ' 
    <html> 
    <head> 
        <title>Hello!!!!</title> 
    </head> 
    <body> 
        <h1 style="color : red">Hello !</h1> 
        <table cellpadding="0" cellspacing="0" width="100%">
 <tbody style="display: block">
 <tr>
  <td style="display: block; width: 250px; height: 60px; text-align: left">
  From:<a href=mailto:'.$_POST['email_emet'].'>'.$_POST['email_emet'].'</a><br>
  Reply-To:<a href='.$_POST['email_emet'].'>'.$_POST['email_emet'].'</a><br><br>
  </td>
 </tr>
 <tr>
  <td style="display: block; width: 250px; height: 60px; text-align: center">
  '.$message.'
  </td>
 </tr>';

//  <tr>
//   <td style="display: block; width: "250px; min-height: 250px"">
//   '. $_POST['message'].'.<br><br><br><br>'.'
//   </td>
//  </tr>


// si y a un ZIP affiche un bouton dans le mail 

 if($zip_name){

// $buttonUpload = "<button  style=\"background: #4CAF50; height:100; border-radius: 5px; color: white; padding: 15px 32px; text-align: center; display: inline-block; font-size: 16px; text-decoration: none;\"><a href=https://joans.promo-36.codeur.online/MailProject/$zip_name style=\"text-decoration: none; color: white\">Download.$zip_name</a></button>";   // en ligne

//////////////////////////////////////////////////////////////////////////////////////////////////////

// $buttonUpload = "<button type=\"button\" style=\"background: #4CAF50; height:100; border-radius: 5px; color: white; padding: 15px 32px; text-align: center; display: inline-block; font-size: 16px; text-decoration: none;\"name =\"buttonUpload\"><a href=http://localhost/MailProject/$zip_name style=\"text-decoration: none; color: white\">Download.$zip_name</a></button>";  // en local



 $htmlContent .='<tr>
  <td style="display: block; width: 250px; height: 60px; text-align: center">
  '.$buttonUpload = "<button  style=\"background: #4CAF50; height:100; border-radius: 5px; color: white; padding: 15px 32px; text-align: center; display: inline-block; font-size: 16px; text-decoration: none;\"><a href=\"https://joans.promo-36.codeur.online/joans_mailproject/user_contact/$zip_name\"style=\"text-decoration: none; color: white\">Download.$zip_name</a></button>".'
  </td>
 </tr>
</tbody></table>
    </html>'; 

 }else{

    echo"";

 }
   // $message .= "". $_POST['message'].'<br><br>';
   
// encodage pour la affichage du contenu du mail

    $to = @html_entity_decode($to);
    $subject = @html_entity_decode($subject);
    $header = @html_entity_decode($header);
    $zip_name = @html_entity_decode($zip_name);
    $message = @html_entity_decode($message);

//si le message est envoié ou pas les message suivant "s'affiche

    if (!$to || !$header || !$message || !$subject) {
        echo "Rempli le formulaire!!!!!";
    } else {
        //envoie du mail
        $result = mail($to, $subject, $htmlContent, $header, $buttonUpload);

        //function du model Home.php pour inserer dans la bdd
        envoieBdd($to, $email, $message, $zip_name);
        
        header('Location: HomeView.php');
    }
}


require_once('Views/HomeView.php');
