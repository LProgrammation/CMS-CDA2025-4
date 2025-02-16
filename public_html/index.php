<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/module/autoloader.php';

Use \Src\Module\Router ;

session_start();
// Load .env variable
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Get url content for router redirection
$uri = $_SERVER['REQUEST_URI'] ;
$uri = parse_url($uri, PHP_URL_PATH);

if ($uri == '/') {
    header('Location:/home');
    exit();
}
$cleanUri = rtrim($uri, '/');
if ($cleanUri != $uri) {
    header('Location:'.$cleanUri.'');
    exit();
}

// Instanciation
$router = new router();

// Initialisation of all routes for users
$router->routeMap("GET", "/home", "home") ;

$router->routeMap("GET", "/page/edit-page", "page") ;
$router->routeMap("GET", "/page/new-page", "page", "new-page") ;
$router->routeMap("GET", "/page/gestion-pages", "page", "gestion-pages") ;
$router->routeMap("GET", "/page/delete-page", "page", "delete-page") ;

$router->routeMap("GET", "/logs", "logs") ;
$router->routeMap("GET", "/error", "error") ;

$router->routeMap("GET", "/sites/see-site", "site", "see-site") ;
$router->routeMap("GET", "/sites/new-site", "site", "new-site") ;
$router->routeMap("GET", "/sites/list", "site", "sites-list") ;
$router->routeMap("GET", "/sites/mysites", "site", "my-sites") ;

$router->routeMap("GET", "/login", "login");
$router->routeMap("GET", "/register", "register");
$router->routeMap("GET", "/logout", "logout");
$router->routeMap("GET", "/user_management", "user_management");
$router->match($uri) ;




