<?php

// $action = $_GET['action'] ?? null;

// if($action == 'coach'){
//     require __DIR__ . "/../view/Coach/dashboardCoach.php";
// }
// if($action == 'sportif'){
//     require __DIR__ . "/../view/Sportif/pageSportif.php";
// }
// if($action == 'login'){
//     require __DIR__ . "/../view/Auth/login.php";
// }
// if($action == 'add'){
//     require __DIR__ . "/../view/style/home.php";
// }

$y = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

?>