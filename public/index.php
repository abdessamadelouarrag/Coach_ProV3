<?php
session_start();

require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/CoachController.php";
require_once __DIR__ . "/../controllers/SportifController.php";

// ✅ fix: ignore query string
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ✅ normalize trailing slash
$path = rtrim($path, '/');
if ($path === '') $path = '/';

$routes = [
    '/' => ['HomeController', 'index'],

    '/login' => ['AuthController', 'login'],
    '/signup' => ['AuthController', 'signup'],
    '/logout' => ['AuthController', 'logout'],

    '/coach' => ['CoachController', 'coach'],

    '/coach/disponibilite' => ['CoachController', 'disponibilite'],
    '/coach/disponibilite/add' => ['CoachController', 'addDisponibilite'],
    '/coach/disponibilite/delete' => ['CoachController', 'deleteDisponibilite'],

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
