<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/module/autoloader.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
Use Src\Model\UserModel ;

$options= [
    "firstname:",
    "lastname:",
    "email:",
    "password:",
    "role:",
] ;

$args = getopt('', $options);

if($args) {
    $firstname = $args['firstname'];
    $lastname = $args['lastname'];
    $email = $args['email'];
    $password = $args['password'];
    (isset($args['role'])) ? $role = $args['role'] : $role = "user";
}

if(isset($firstname, $lastname, $email, $password, $role)) {
    $userModel = new userModel();
    try {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $userModel->registerUser(guidv4(), $firstname, $lastname, $email, $password, $role);
    } catch (\Random\RandomException $e) {
        echo $e->getMessage();
    }
}