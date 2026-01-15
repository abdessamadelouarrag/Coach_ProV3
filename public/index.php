<?php
declare(strict_types=1);

session_start();

$path = $_SERVER['REQUEST_URI'];

$path = rtrim($path, '/');
if ($path === '') $path = '/';

$routes = [
    '/'        => ['HomeController', 'index'],
    '/login'   => ['AuthController', 'login'],
    '/coach'   => ['CoachController', 'coach'],
    '/sportif' => ['SportifController', 'sportif'],
    '/signup' => ['AuthController', 'signup'],
];

if (!isset($routes[$path])) {
    http_response_code(404);
    echo "404";
    exit;
}

[$controller, $method] = $routes[$path];

require __DIR__ . '/../controllers/' . $controller . '.php';

$instance = new $controller();
$instance->$method();
