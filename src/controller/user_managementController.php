<?php

class user_managementController
{

    public function index($routeMap, $uri): void
    {
        require_once __DIR__ . '/../model/userModel.php';

        $userModel = new userModel();

        $users = $userModel->getUsers();

        require_once "../src/view/" . $routeMap[$uri]['name'] . ".php";
    }

}






