<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/module/autoloader.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
Use Src\Model\UserModel ;

$options= [
    "firstname_user:",
    "name_user:",
    "email:",
    "password:",
    "role:",
] ;

$args = getopt('', $options);

if($args) {
    $firstname_user = $args['firstname_user'];
    $name_user = $args['name_user'];
    $email_user = $args['email_user'];
    $password_user = $args['password_user'];
    (isset($args['role_user'])) ? $role_user = $args['role_user'] : $role_user = "user";
}

if(isset($firstname_user, $name_user, $email_user, $password_user, $role_user)) {
    $userModel = new userModel();
    try {
        $password = password_hash($password_user, PASSWORD_DEFAULT);
        $userModel->registerUser(guidv4(), $firstname_user, $name_user, $email_user, $password_user, $role_user);
    } catch (\Random\RandomException $e) {
        echo $e->getMessage();
    }
}