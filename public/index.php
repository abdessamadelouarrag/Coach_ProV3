<?php
session_start();

require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/CoachController.php";
require_once __DIR__ . "/../controllers/SportifController.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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

if ($uri === '/coach/details' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $coachController->details();
    exit;
}
