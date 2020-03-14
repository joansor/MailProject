<?php

//Nommer ces variables correctement, ce fichier pourra être dans un .gitignore
// $host = "localhost";
// $dbname = "mailproject; port=3808; charset=utf8";
// $user = "root";
// $pass = "";
// $projetName = "mailproject";

// $host = "localhost";
$dbname = "joans_; port=3808; charset=utf8";
$user = "joans";
$pass = "knjs9opz0AHmqA==";
$projetName = "joans_mailproject";

$projectNameLength = strlen($projetName) + 1;
$base_url = mb_substr($_SERVER['REQUEST_URI'], 0, $projectNameLength);

