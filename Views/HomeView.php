<?php
require_once("header.php");
//include("/wamp64/www/MailProject/Models/Home.php");
?>

<div id="main">

<form action="" method="post" enctype="multipart/form-data">


        <div class="container-input">
                <input type="file" name="file_zip[]" class="input-file" multiple="multiple">
                <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label><br>
        </div>
        <p class="file-return"></p>

        <div>
                
                <input type="email" id="myemail" name="email_emet" placeholder ="Your email address..." required autocomplete="off">
        </div>

        <div>
                
                <input type="email" id="email" name="email_recept" placeholder ="Send to..." required autocomplete="off">
        </div>
        <div>
               
                <input type="text" id="sujet" name="subject" placeholder ="Subject..." required autocomplete="off">
        </div>
        <div>
                
                <textarea id="msg" name="message" placeholder ="Message..." style="height:100px;"></textarea>
        </div>


                <div class="button-form">
                        
                <input class="send" type="submit" name="upload_file" value="Send">
                </div>

       
</form>

</div>
<form method ="get" action="http://localhost/MailProject/Admin/Adminlogin.php" id="formlog">


<input type="submit" onclick="getdatabddUser()" value="admin" name="username" id="login_user"/>

</form>
<?php


require_once("footer.php");

?>
