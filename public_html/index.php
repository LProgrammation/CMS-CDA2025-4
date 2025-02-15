<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/module/autoloader.php';

Use \Src\Model\BDD ;
Use \Src\Module\Router ;

session_start();
// Load .env variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
// Get url content for router redirection
$uri = $_SERVER['REQUEST_URI'] ;
$uri = parse_url($uri, PHP_URL_PATH);

// If uri is not defined, return to /home
if ($uri == '/') {
    header('Location:/home');
    exit();
}
    // Clean url (redirect from /home/ to /home (remove / at end))
$cleanUri = rtrim($uri, '/');
if ($cleanUri != $uri) {
    header('Location:'.$cleanUri.'');
    exit();
}

// Instanciation
$router = new Router();

// Initialisation of all routes for users
$router->routeMap("GET", "/home", "home") ;

$router->routeMap("GET", "/logs", "logs") ;

$router->routeMap("GET", "/error", "error") ;
$router->routeMap("GET", "/home/test", "home") ;
$router->match($uri) ;
// call router for actual $uri

// call router for actual $uri

