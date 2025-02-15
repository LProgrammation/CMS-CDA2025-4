<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once "../src/model/BDD.php" ;  
require_once "../src/module/router.php";
session_start();


$_SESSION['utilisateur'] = [
    'id_utilisateur' => '6',
    'prenom_utilisateur' => 'po',
    'role_utilisateur' => 'admin',
    'nom_utilisateur' => 'adeline',
    'email_utilisateur' => 'test@gmail.com',
    'password_utilisateur' => 'test2'
];



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

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


$router = new router();

$router->routeMap("GET", "/home", "home") ; 

$router->routeMap("GET", "/error", "error") ; 

$router->routeMap("GET", "/site", "site");

$router->routeMap("GET", "/voirsite", "voirsite");

$router->routeMap("GET", "/monsite", "monsite");


$router->match($uri) ; 

