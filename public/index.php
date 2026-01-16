<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/CoachController.php";
require_once __DIR__ . "/../controllers/SportifController.php";
require_once __DIR__ . "/../controllers/ReservationController.php";
require_once __DIR__ . "/../controllers/ErrorController.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); 
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}

$path = rtrim($path, '/');
if ($path === '') $path = '/';

// routes
$routes = [
    '/' => ['HomeController', 'index'],

    // Auth routes
    '/login' => ['AuthController', 'login'],
    '/signup' => ['AuthController', 'signup'],
    '/logout' => ['AuthController', 'logout'],

    // Coach routes
    '/coach' => ['CoachController', 'coach'],
    '/coach/profile' => ['CoachController', 'publicProfile'],
    '/coach/disponibilite' => ['CoachController', 'disponibilite'],
    '/coach/addDisponibilite' => ['CoachController', 'addDisponibilite'],
    '/coach/deleteDisponibilite' => ['CoachController', 'deleteDisponibilite'],

    // Sportif routes
    '/sportif' => ['SportifController', 'sportif'],
    '/details' => ['SportifController', 'details'],

    '/coach/done' => ['ReservationController', 'reserve'],
    '/reservations' => ['ReservationController', 'myReservations'],
    '/reservation/cancel' => ['ReservationController', 'cancel'],
    '/error' => ['ErrorController', 'error'],
];

if (isset($routes[$path])) {
    [$controller, $method] = $routes[$path];

    $controllerObj = new $controller();

    if (method_exists($controllerObj, $method)) {
        $controllerObj->$method();
    } else {
        http_response_code(500);
        echo "Method not found.";
    }
} else {
    http_response_code(404);
    echo "Page not found.";
}