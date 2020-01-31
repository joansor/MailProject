
<?php


require('env.php');




/*$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];



$pdo = new PDO('mysql:host='.$host.'; dbname='.$dbname, $user, $pass, $options);*/


if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'Home';
}





$page = ucfirst($page);

include('Controllers/' . $page . 'Controller.php');

?>

