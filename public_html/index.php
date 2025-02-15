<?php 

require_once __DIR__ . '/../vendor/autoload.php';
require_once "../src/model/BDD.php" ;  
require_once "../src/module/router.php";
session_start();

$_SESSION['utilisateur'] = [
    'id_utilisateur' => '2',
    'prenom_utilisateur' => 'wow',
    'role_utilisateur' => 'user',
    'nom_utilisateur' => 'michel',
    'email_utilisateur' => 'wow@test.fr',
    'password_utilisateur' => 'youhou'
];



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
$router = new router();

// Initialisation of all routes for users
$router->routeMap("GET", "/home", "home") ; 

$router->routeMap("GET", "/error", "error") ; 

$router->routeMap("GET", "/site", "site");

$router->routeMap("GET", "/login", "login");

$router->routeMap("GET", "/register", "register");

$router->routeMap("GET", "/logout", "logout");

$router->routeMap("GET", "/voirsite", "voirsite");

$router->routeMap("GET", "/monsite", "monsite");


// call router for actual $uri 
$router->match($uri) ; 

